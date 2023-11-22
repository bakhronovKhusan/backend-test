<?php

namespace App\Http\Middleware;

use App\Models\Merchant1;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyGatewayOneSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $data = $request->all();
        $secretKey = Merchant1::where('merchant_id',$data['merchant_id'])->first()?->merchant_key;
        $sign = $data['sign'];
        unset($data['sign']);
        ksort($data);
        $signatureString = implode(':', $data) . ':' . $secretKey;
        $generatedSignature = hash('sha256', $signatureString);
        if ($generatedSignature !== $sign) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }
        return $next($request);
    }
}
