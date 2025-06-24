@extends('app')
@section('head_title', 'Make a Payment | ' . getcong('site_name'))
@section('head_url', Request::url())
@section('content')
<form id="paymentForm" class="card p-4 shadow-sm" style="max-width: 400px; margin: 40px auto;">
    <h4 class="mb-3 text-center">Make a Payment</h4>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input 
            type="email" 
            id="email" 
            class="form-control" 
            placeholder="Email" 
            value="{{ Auth::user()->email }}" 
            required disabled
        >
    </div>
    
    <div class="mb-3">
        <label for="amount" class="form-label">Amount (₦)</label>
        <input 
            type="number" 
            id="amount" 
            class="form-control" 
            placeholder="Amount in Naira" 
            value="{{$price = DB::table('cart')
                ->where('user_id', Auth::id())
                ->sum('item_price')}}"
            required disabled
        >
    </div>
    <button type="submit" class="btn btn-primary w-full text-center">Pay Now</button>
</form>



<script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);

        function payWithPaystack(e) {
            e.preventDefault();
            let handler = PaystackPop.setup({
                key: '{{ env("PAYSTACK_PUBLIC_KEY") }}',
                email: document.getElementById("email").value,
                amount: document.getElementById("amount").value * 100, // in kobo
                currency: "NGN",
                ref: '' + Math.floor((Math.random() * 1000000000) + 1),
                callback: function(response) {
                    // Make AJAX call to your backend to store the transaction
                    fetch('/paystack/callback', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            reference: response.reference,
                            email: document.getElementById("email").value,
                            amount: document.getElementById("amount").value * 100
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        // alert('Payment successful and saved!');
                        window.location.href='/payment/success';
                        console.log(data);
                    })
                    .catch(err => {
                        // alert('Payment successful but failed to save!');
                        window.location.href='/payment/failed';
                        console.error(err);
                    });
                },
                onClose: function() {
                    alert('Transaction was not completed, window closed.');
                }
            });
            handler.openIframe();
        }
    </script>
@endsection

