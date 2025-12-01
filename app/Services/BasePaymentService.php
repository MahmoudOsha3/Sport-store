<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class BasePaymentService
{
    protected array  $header ;

    // for generate token
    protected function buildRequest($method, $url, $data = null ,$type='json'): \Illuminate\Http\JsonResponse
    {
        try {
            // dd($url);
            $response = Http::withHeaders($this->header)->send($method,  $url, [
                $type => $data
            ]);

            return response()->json([
                'success' => $response->successful(),
                'status' => $response->status(),
                'data' => $response->json(),
            ], $response->status());

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
