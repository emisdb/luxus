<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Stripe API key (you should move this to .env file)
        Stripe::setApiKey(env('STRIPE_SECRET_KEY', 'sk_test_51Q...')); // Replace with your Stripe secret key
    }

    public function index()
    {
        return view('payment.index');
    }

    public function pay(Request $request)
    {
        $amount = $request->input('amount');
        $paymentMethod = $request->input('payment_method', 'mollie'); // Default to mollie

        // Validate amount input
        if (!is_numeric($amount) || $amount < 10 || $amount > 100) {
            return redirect()->back()->with('error', 'Invalid amount. Please enter an amount between 10 and 100 EUR.');
        }

        // Validate payment method
        if (!in_array($paymentMethod, ['mollie', 'stripe'])) {
            return redirect()->back()->with('error', 'Invalid payment method selected.');
        }

        $formatted_number = number_format($amount, 2);

        if ($paymentMethod === 'mollie') {
            return $this->processMolliePayment($formatted_number);
        } else {
            return $this->processStripePayment($amount, $formatted_number);
        }
    }

    private function processMolliePayment($formatted_number)
    {
        $apiKey = env('MOLLIE_API_KEY', 'test_djMStRFvKuTbamgd6s9HzrJE2jPDTJ');
        $paymentData = [
            "amount" => [
                "currency" => "EUR",
                "value" => $formatted_number
            ],
            "description" => "Payment for Outspot",
            "redirectUrl" => route('payment.status'),
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
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $responseData = json_decode($response, true);

        if ($httpCode === 201 && isset($responseData['status']) && $responseData['status'] == 'open') {
            return redirect($responseData['_links']['checkout']['href']);
        }

        if ($httpCode === 422) {
            return view('payment.error', ['message' => $responseData['detail'] ?? 'Payment creation failed']);
        }

        return redirect()->back()->with('error', 'Failed to create payment. Please try again.');
    }

    private function processStripePayment($amount, $formatted_number)
    {
        try {
            $checkout_session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Payment for Outspot',
                        ],
                        'unit_amount' => (int)($amount * 100), // Stripe uses cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.status') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.index') . '?canceled=true',
            ]);

            return redirect($checkout_session->url);
        } catch (ApiErrorException $e) {
            return view('payment.error', ['message' => $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create payment. Please try again.');
        }
    }

    public function status(Request $request)
    {
        $sessionId = $request->query('session_id');
        $paymentStatus = 'unknown';

        if ($sessionId) {
            // Stripe payment
            try {
                $session = Session::retrieve($sessionId);
                $paymentStatus = $session->payment_status === 'paid' ? 'success' : 'pending';
            } catch (\Exception $e) {
                $paymentStatus = 'error';
            }
        } else {
            // Mollie payment - you might want to check the payment status from Mollie API
            $paymentStatus = 'success'; // Default for now
        }

        return view('payment.status', ['status' => $paymentStatus]);
    }

    public function webhook(Request $request)
    {
        // Handle Stripe webhook for payment confirmation
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                // Handle successful payment
                break;
            default:
                return response()->json(['received' => true]);
        }

        return response()->json(['received' => true]);
    }
}
