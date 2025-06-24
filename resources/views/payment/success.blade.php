@extends('app')
@section('head_title', 'Payment Successful | ' . getcong('site_name'))
@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <svg width="64" height="64" fill="none" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="12" fill="#28a745" opacity="0.1"/>
                <path d="M7 13l3 3 7-7" stroke="#28a745" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h2 class="mt-3 text-success">Payment Successful</h2>
        </div>
        <div class="text-center">
            <p class="mb-1">Thank you for your payment!</p>
            {{-- <p>Ref: {{ $data['reference'] }}</p>
            <p>Amount: ₦{{ number_format($data['amount'] / 100, 2) }}</p> --}}
            <a href="{{ url('/') }}" class="btn btn-success mt-3 w-100">Go to home</a>
        </div>
    </div>
</div>
@endsection