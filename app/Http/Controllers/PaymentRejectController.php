<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentRejectController extends Controller
{

    public function reject_payment(Request $request){
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|exists:ccp_payment,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }   
        $payment = SaveCcpPaymentProof::where('id' , $request->payment_id)->latest('created_at')->first();
        $payment->status = 'reject' ;
        $payment->save();
        return ; 

    }

}
