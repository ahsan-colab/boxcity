@extends('layouts.app')

@section('title', 'Thank You')

@section('content')

    <div class="thank-you">
        {{-- Heading --}}
        <h1>Thank you for your order!</h1>

        {{-- Confirmation message --}}
        <p>Your order was placed successfully. You’ll receive a confirmation email shortly.</p>

        {{-- Button back to homepage --}}
        <a href="{{ route('home') }}" class="btn">Go back to Home</a>
    </div>

@endsection
