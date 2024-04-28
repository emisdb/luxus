<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }

    public function pay(Request $request)
    {
        $amount = $request->input('amount');

        // Validate amount input
        if (!is_numeric($amount) || $amount < 10 || $amount > 100) {
            return redirect()->back()->with('error', 'Invalid amount. Please enter an amount between 10 and 100 EUR.');
        }
        $formatted_number = number_format($amount, 2); // Format the number with 2 decimal places
        $apiKey = "test_djMStRFvKuTbamgd6s9HzrJE2jPDTJ";
        $paymentData = [
            "amount" => [
                "currency" => "EUR",
                "value" => $formatted_number
            ],
            "description" => "Payment for Outspot",
            "redirectUrl" => "https://luxus.emisdb.ru/payment/status",
            // Add more parameters as needed
        ];

        $ch = curl_init("https://api.mollie.com/v2/payments");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($paymentData),
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $apiKey",
                "Content-Type: application/json"
            ]
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);
//        dd($responseData);
       if($responseData['status']=='open'){
             return redirect($responseData['_links']['checkout']['href']);
        }
        if($responseData['status']===422){
            return view('payment.error',['message' => $responseData['detail']]);
        }
    }

    public function status(Request $request)
    {

        return view('payment.status');
    }
}
