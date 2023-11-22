<?php

namespace App\Http\Middleware;

use App\Http\Requests\PaymentTwoRequest;
use App\Models\Merchant1;
use App\Models\Merchant2;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyGatewayTwoSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $receivedSignature = $request->header('Authorization');
        if (!$receivedSignature) {
            return response('Authorization header not found!', 401);
        }
        $data = $request->all();
        $secretKey = Merchant2::where('merchant_id',$data['merchant_id'])->first()?->merchant_key;
        ksort($data);
        $signatureString = implode('.', $data) . '.' . $secretKey;
        $generatedSignature = md5($signatureString);
        if ($generatedSignature !== $receivedSignature) {
            return response('Invalid signature', 401);
        }
        return $next($request);
    }
}
