@extends('layouts.app')

@section('title', 'Thank You')

@section('content')

    <div class="thank-you">
        <h1>Thank you for your order!</h1>
        <p>Your order was placed successfully. You’ll receive a confirmation email shortly.</p>
        <a href="{{ url('/') }}" class="btn">Go back to Home</a>
    </div>


<style>
 .thank-you{
     text-align: center;
     margin: 150px 0px;
     font-family: 'gilroy-semibolduploaded_file';
     font-size: 18px;
 }

 .btn {
     background: #000 !important;
     padding: 14px 36px 14px 36px !important;
     border-radius: 40px !important;
     color: #F8BE00 !important;
     text-transform: uppercase !important;
 }

</style>

@endsection
