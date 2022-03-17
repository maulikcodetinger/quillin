<?php

namespace App\Http\Api\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $curl = curl_init();
        // $transactions = CommissionHistory::where('is_paid',0)->get();
        // foreach($transactions as $transaction)
        // {
        //     $seller = Seller::find($transaction->seller_id);
        //     $amount = $transaction->seller_earning * 100;
        //     $user = User::find($seller->user_id);
        //     curl_setopt_array($curl, array(
        //         CURLOPT_URL => 'https://api.razorpay.com/v1/payouts',
        //         CURLOPT_RETURNTRANSFER => true,
        //         CURLOPT_ENCODING => '',
        //         CURLOPT_MAXREDIRS => 10,
        //         CURLOPT_TIMEOUT => 0,
        //         CURLOPT_FOLLOWLOCATION => true,
        //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //         CURLOPT_CUSTOMREQUEST => 'POST',
        //         CURLOPT_POSTFIELDS => '{
        //     "account_number":"2323230039058862",
        //     "amount":' . $amount . ',
        //     "currency":"INR",
        //     "mode":"NEFT",
        //     "purpose":"refund",
        //     "fund_account":{
        //         "account_type":"bank_account",
        //         "bank_account":{
        //             "name":"' . $seller->bank_name . '",
        //             "ifsc":"' . $seller->bank_routing_no . '",
        //             "account_number":"' . $seller->bank_acc_no . '"
        //         },
        //         "contact":{
        //             "name":"'.$user->name.'",
        //             "email":"'.$user->email.'",
        //             "contact":"'.$user->phone.'",
        //             "type":"vendor",
        //             "reference_id":"Acme Contact ID 12345",
        //             "notes":{
        //                 "notes_key_1":"Tea, Earl Grey, Hot",
        //                 "notes_key_2":"Tea, Earl Grey… decaf."
        //             }
        //         }
        //     },
        //     "queue_if_low_balance":true,
        //     "reference_id":"Acme Transaction ID 12345",
        //     "narration":"Acme Corp Fund Transfer",
        //     "notes":{
        //         "notes_key_1":"Beam me up Scotty",
        //         "notes_key_2":"Engage"
        //     }
        // }',
        //         CURLOPT_HTTPHEADER => array(
        //             'X-Payout-Idempotency: ',
        //             'Authorization: Basic cnpwX3Rlc3RfTTNwajh2UnBoWDQzQUM6WEo4RlJVNEcxWjNLZmpxM0k5ZGpKZW1a',
        //             'Content-Type: application/json'
        //         ),
        //     ));
        //     $response = curl_exec($curl);

        //     $payout_id = substr($response, 7, 19);

        // }
        
        // \Log::info("Cron is working fine!");

            

    }

    public function test()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
