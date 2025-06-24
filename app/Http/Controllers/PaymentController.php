<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{

    public function paymentPage(Request $request){
        return view('pay');
    }
    public function redirectToGateway(Request $request)
    {
        $email = 'user@example.com'; // or $request->user()->email;
        $amount = 5000 * 100; // 5000 NGN

        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))->post('https://api.paystack.co/transaction/initialize', [
            'email' => $email,
            'amount' => $amount,
            'callback_url' => route('payment.callback'),
        ]);

        if ($response->successful()) {
            return redirect($response->json()['data']['authorization_url']);
        }

        return back()->with('error', 'Payment initiation failed.');
    }

    public function handleGatewayCallback(Request $request)
    {
        $reference = $request->query('reference');

        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))->get("https://api.paystack.co/transaction/verify/{$reference}");

        if ($response->successful() && $response->json()['data']['status'] == 'success') {
            // Payment successful
            // Save transaction to DB, notify user, etc.
            
            return view('payment.success', ['data' => $response->json()['data']]);
        }

        return view('payment.failed');
    }

    public function successfulPayment(){
        Cart::where('user_id', Auth::id())->delete();
        return view('payment.success');
    }

    public function failedPayment(){
        return view('payment.failed');
    }


    public function storeTransaction(Request $request)
    {
        $reference = $request->reference;

        // Verify transaction with Paystack
        $res = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->get("https://api.paystack.co/transaction/verify/{$reference}");

        if ($res->successful() && $res['data']['status'] === 'success') {
            $tx = Transaction::create([
                'email' => $request->email,
                'reference' => $reference,
                'amount' => $request->amount,
                'status' => 'success'
            ]);

            return response()->json(['message' => 'Transaction saved.', 'transaction' => $tx]);
        }

        

        return response()->json(['message' => 'Verification failed.'], 400);

    //     return redirect()->back()->with('message', 'Transaction '.$tx.' saved.');
    //     }

    //     return redirect()->back()->with('message', 'Verification failed.');
    // }
    }
}
