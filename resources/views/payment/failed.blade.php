@extends('app')
@section('head_title', 'Payment Failed | ' . getcong('site_name'))
@section('content')
<br>
<div class="container vh-100 d-flex justify-content-center align-items-center ">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <svg width="64" height="64" fill="none" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="12" fill="#dc3545" opacity="0.1"/>
                <path d="M8 8l8 8M16 8l-8 8" stroke="#dc3545" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h2 class="mt-3 text-danger">Payment Failed</h2>
        </div>
        <div class="text-center">
            <p class="mb-1">Try again later.</p>
            <a href="{{ url('/pay') }}" class="btn btn-danger mt-3 w-100">Try Again</a>
        </div>
    </div>
</div>
<br>
@endsection