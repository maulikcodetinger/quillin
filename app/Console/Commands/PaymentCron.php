<?php

namespace App\Console\Commands;

use App\Models\AutoTransaction;
use App\Models\CommissionHistory;
use App\Models\Seller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PaymentCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info("Cron is working fine!");

        $curl = curl_init();
        $transactions = CommissionHistory::where('is_paid', 0)->
        where('created_at', '<=', Carbon::now()->subDays(15)->toDateTimeString())->get();
        foreach ($transactions as $transaction) {
            $seller = Seller::where('user_id', $transaction->seller_id)->get()->first();
            $amount = $transaction->seller_earning * 100;
            $user = User::find($seller->user_id);
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.razorpay.com/v1/payouts',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
            "account_number":"2323230039058862",
            "amount":' . $amount . ',
            "currency":"INR",
            "mode":"NEFT",
            "purpose":"refund",
            "fund_account":{
                "account_type":"bank_account",
                "bank_account":{
                    "name":"' . $seller->bank_name . '",
                    "ifsc":"' . $seller->bank_routing_no . '",
                    "account_number":"' . $seller->bank_acc_no . '"
                },
                "contact":{
                    "name":"' . $user->name . '",
                    "email":"' . $user->email . '",
                    "contact":"' . $user->phone . '",
                    "type":"vendor",
                    "reference_id":"Acme Contact ID 12345",
                    "notes":{
                        "notes_key_1":"Tea, Earl Grey, Hot",
                        "notes_key_2":"Tea, Earl Grey… decaf."
                    }
                }
            },
            "queue_if_low_balance":true,
            "reference_id":"Acme Transaction ID 12345",
            "narration":"Acme Corp Fund Transfer",
            "notes":{
                "notes_key_1":"Beam me up Scotty",
                "notes_key_2":"Engage"
            }
        }',
                CURLOPT_HTTPHEADER => array(
                    'X-Payout-Idempotency: ',
                    'Authorization: Basic cnpwX3Rlc3RfSGtaMUNhSm5kY1dzcEU6R1FMM3MyVGRPTDZ5NlJZRWVUZU9RbExU',
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            $payout_id = substr($response, 7, 19);
            $transaction->is_paid = true;
            $transaction->update();
            $seller->admin_to_pay =$seller->admin_to_pay - $transaction->seller_earning;
            $seller->update();

            $auto_transaction = new AutoTransaction();
            $auto_transaction->razorpay_payout_id = $payout_id;
            $auto_transaction->seller_id = $seller->user_id;
            $auto_transaction->order_id = $transaction->order_id;
            $auto_transaction->order_detail_id = $transaction->order_detail_id;
            $auto_transaction->amount = $transaction->seller_earning;
            $auto_transaction->save();
        }
    }
}
