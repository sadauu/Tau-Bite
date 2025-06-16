<?php

namespace App\Http\Controllers;

use App\Payment;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    //
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    // public function redirectToGateway()
    // {
    //     try{
    //         return Paystack::getAuthorizationUrl()->redirectNow();
    //     }catch(\Exception $e) {
    //         return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
    //     }
    // }
 
    // /**
    //  * Obtain Paystack payment information
    //  * @return void
    //  */
    // public function handleGatewayCallback()
    // {
 
    //     $payment = Paystack::getPaymentData();


    // // Check status
    // if ($payment['status'] && $payment['data']['status'] === 'success') {
    //     $amount = $payment['data']['amount'] / 100; // Convert from Kobo

    //     $user = auth()->user();
    
    //     // Update or create wallet
    //     $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
    //     $wallet->increment('balance', $amount);
    
    //     // dd($payment);
   
    // // WalletTransaction::create([
    // //     'user_id' => $user->id,
    // //     'amount' => $amount,
    // //     'type' => 'credit',
    // //     'reference' => $payment['data']['reference']
    // // ]);

    // // return redirect()->back()->with('success', 'Wallet funded successfully!');

    //     return view('pages.cart_order_confirm_details')->with('payment', $payment);
    // } else {
    //     return redirect()->route('cart')->with('error', 'Payment was not successful');
    // }
        
    // }

     /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
     //Getting authenticated user 
        $id = Auth::id();
        // Getting the specific student and his details
        $user = User::where('id',$id)->first();
        // $class_id = $user->class_id;
        // $section_id = $student->section_id; 
        // $level_id = $student->level_id; 
        $student_id = $user->id; 
        
        $paymentDetails = Paystack::getPaymentData(); //this comes with all the data needed to process the transaction
        // Getting the value via an array method
        $inv_id = $paymentDetails->data->metadata->invoiceId;// Getting InvoiceId I passed from the form
        $status = $paymentDetails->data->status; // Getting the status of the transaction
        $amount = $paymentDetails->data->amount; //Getting the Amount
        $number = $randnum = rand(1111111111,9999999999);// this one is specific to application
        $number = 'year'.$number;
        // dd($status);
        if($status == "success"){ //Checking to Ensure the transaction was succesful
          
            // Payment::create(['student_id' => $student_id,'invoice_id'=>$inv_id,'amount'=>$amount,'status'=>1]); // Storing the payment in the database

            Payment::create();
            // User::where('id', $id)
                //   ->update(['register_no' => $number,'acceptance_status' => 1]);
                  
            return view('pages.payment'); 
        }
      
        // Now you have the payment details,
        // you can store the authorization_code in your DB to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
        return redirect()->back()->withErrors(['msg'=> 'Not successfully']);
    }   

}
