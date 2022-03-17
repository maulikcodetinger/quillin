<?php

namespace App\Http\Controllers;

use App\Models\AutoTransaction;
use App\Models\CommissionHistory;
use Illuminate\Http\Request;
use App\Models\SellerWithdrawRequest;
use Auth;
use App\Models\Seller;
use App\Models\User;

class SellerWithdrawRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller_withdraw_requests = SellerWithdrawRequest::where('user_id', Auth::user()->seller->id)->paginate(9);
        $seller_payout_histories = AutoTransaction::where('seller_id', Auth::user()->id)->paginate(9);
        foreach($seller_payout_histories as $seller_payout_history)
        {
        $seller_payout_history->order;
        $seller_payout_history->order_details;
        }
        // dd($seller_payout_historys);
        return view('frontend.user.seller.seller_withdraw_requests.index', compact('seller_withdraw_requests','seller_payout_histories'));
    }

    public function request_index()
    {
        $seller_withdraw_requests = SellerWithdrawRequest::paginate(15);
        $seller_payout_histories = AutoTransaction::paginate(15);
        foreach($seller_payout_histories as $seller_payout_history)
        {
        $seller_payout_history->order;
        $seller_payout_history->order_details;
        $seller_payout_history->seller;
        }
        return view('backend.sellers.seller_withdraw_requests.index', compact('seller_withdraw_requests','seller_payout_histories'));
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
        $seller_withdraw_request = new SellerWithdrawRequest;
        $seller_withdraw_request->user_id = Auth::user()->seller->id;
        $seller_withdraw_request->amount = $request->amount;
        $seller_withdraw_request->message = $request->message;
        $seller_withdraw_request->status = '0';
        $seller_withdraw_request->viewed = '0';
        if ($seller_withdraw_request->save()) {
            flash(translate('Request has been sent successfully'))->success();
            return redirect()->route('withdraw_requests.index');
        } else {
            flash(translate('Something went wrong'))->error();
            return back();
        }
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

    public function payment_modal(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        $seller_withdraw_request = SellerWithdrawRequest::where('id', $request->seller_withdraw_request_id)->first();
        return view('backend.sellers.seller_withdraw_requests.payment_modal', compact('seller', 'seller_withdraw_request'));
    }

    public function message_modal(Request $request)
    {
        $seller_withdraw_request = SellerWithdrawRequest::findOrFail($request->id);
        if (Auth::user()->user_type == 'seller') {
            return view('frontend.partials.withdraw_message_modal', compact('seller_withdraw_request'));
        } elseif (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            return view('backend.sellers.seller_withdraw_requests.withdraw_message_modal', compact('seller_withdraw_request'));
        }
    }
}
