<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SaveCcpPaymentProof;

class PaymentAcceptController extends Controller
{
    public function accept_payment(Request $request){
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|exists:ccp_payment,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }   
        $payment = SaveCcpPaymentProof::where('id' , $request->payment_id)->latest('created_at')->first();
        $payment->status = 'accept' ;
        $payment->save();
        return response()->json(['message' => 'Paiement accepté avec succès'], 200); 

    }

}
