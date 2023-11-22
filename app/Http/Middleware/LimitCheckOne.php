<?php

namespace App\Http\Middleware;

use App\Models\Merchant1;
use App\Models\Payment;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LimitCheckOne
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $paymentSum = Payment::where('type',1)->where('status','completed')->whereDate('created_at', '=', Carbon::today())->sum('amount');
        if($paymentSum>config('payway.one')) {
            return response()->json([
                'message' => 'Today was limit expired!'
            ], 403);
        }
        return $next($request);
    }
}
