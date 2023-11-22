<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentOneRequest;
use App\Http\Requests\PaymentTwoRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function gatewayOneCallback(PaymentOneRequest $request)
    {
        $payment = Payment::find($request->payment_id);
        if ($payment) {
            $payment->status = $request->status;
            $payment->save();
        }
        return response()->json(['status' => 'success']);
    }
    public function gatewayTwoCallback(PaymentTwoRequest $request)
    {
        $payment = Payment::find($request->invoice);
        if ($payment) {
            $payment->status = $request->status;
            $payment->save();
        }
        return response()->json(['status' => 'success']);
    }

}
