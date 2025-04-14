@extends('layouts.app')

    @section('title', 'Product')  <!-- This will replace the @yield('title') in the master layout -->

@section('content')

<?php

$site_url = env('SITE_URL');
$home_url = env ('HOME_URL');

?>


<div class="container">
    <div class="row">
        <div id="single-product">
        <div class="col-md-6">
            <img id="product-image" src="" alt="Product Image" />
        </div>
        <div class="col-md-6">
            <h1 id="product-title"></h1>
            <div id="product-sku"></div>
            <div id="product-description"></div>
        </div>
        </div>
    </div>

    <div class="row table-row">
        <div class="col-md-12">
            <div class="table-responsive">
            <table id="product-table" class="responsive-table">
                <thead>
                <tr>
                    <th rowspan="2">Product ID</th>
                    <th rowspan="2">Name</th>
                    <th rowspan="2">Retail Price</th>
                    <th colspan="3" class="bulk-price-header main">Discounted Bulk Price</th>
                    <th rowspan="2">Add To Cart</th>
                </tr>
                <tr>
                    <th class="bulk-price-header">12+</th>
                    <th class="bulk-price-header">50+</th>
                    <th class="bulk-price-header">100+</th>
                </tr>
                </thead>
                <tbody id="product-list">

                    <tr>
                        <td><a class="product-single" href="#" id="product-id"></a></td>
                        <td><a class="product-single" href="#" id="product-name"></a></td>
                        <td class="retail-price" id="retail-price"></td>
                        <td class="bulk-price-12" id="bulk-12"></td>
                        <td class="bulk-price-50" id="bulk-50"></td>
                        <td class="bulk-price-100" id="bulk-100"></td>
                        <td>
                            <div class="quantity-container">
                                <div class="qty-container">
                                    <button class="quantity-btn minus">−</button>
                                    <input type="text" class="quantity-input" value="12">
                                    <button class="quantity-btn plus">+</button>
                                </div>
                                <button class="add-btn" data-product-id="" data-product-name="" data-product-image="" data-product-retail-price="" data-product-bulk-price-12="" data-product-bulk-price-50="" data-product-bulk-price-100="">ADD</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>


</div>

<a href="{{route('cart')}}">
    <div class="cart-icon"><svg class="icon-default" width="36" height="30" viewBox="0 0 36 30" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M7 7h22v18a4 4 0 0 1-4 4H11a4 4 0 0 1-4-4V7z" stroke="currentColor" stroke-width="2"></path><path d="M13 10V6c0-2.993 2.009-5 5-5s5 2.026 5 5v4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
        <div class="cart-counter">0</div>
    </div>
</a>
@endsection

<style>
    #single-product{
        display: none;
        margin: 72px 0px;
    }

    #product-title {
        font-size: 43px !important;
    }

    #product-image {
        width: 65%;
    }

    .table-row{
     margin: 0px 0px 100px 0px;
        display: none;
    }

    #product-sku {
        font-family: 'gilroy-semibolduploaded_file';
        font-size: 17px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    const productId = window.location.pathname.split('/').pop();
    $.ajax({
        url: `https://app.ecwid.com/api/v3/109333282/products/${productId}`,
        type: "GET",
        contentType: "application/json",
        headers: {
            "Authorization": "Bearer public_TKetLbQHRiCT4zFeDFBzzncr3rWjzA9E"
        },
        beforeSend: function () {
            console.log("Fetching product info from Ecwid API...");
        },
        success: function (response) {
            console.log("Product loaded:", response);

            $('.table-row').css('display', 'block');
            $('#single-product').css('display','flex');
            $('#product-title').text(response.name);
            $('#product-image').attr('src', response.imageUrl);
            $('#product-price').text('$' + response.price);
            $('#product-sku').html("SKU: " + response.sku);
            $('#product-description').html(response.description);
            $('#product-id').text(productId);
            $('#product-name').text(response.name);
            $('#retail-price').text('$' + response.price);
            $('#bulk-12').text('{{env("CURRENCY_SYMBOL")}}' + (response.price * 0.84).toFixed(2));
            $('#bulk-50').text('{{env("CURRENCY_SYMBOL")}}' + (response.price * 0.70).toFixed(2));
            $('#bulk-100').text('{{env("CURRENCY_SYMBOL")}}' + ( response.price * 0.50).toFixed(2));
            $('.add-btn').attr('data-product-id', productId);
            $('.add-btn').attr('data-product-name', response.name);
            $('.add-btn').attr('data-product-image', response.imageUrl);
            $('.add-btn').attr('data-product-retail-price', response.price);
            $('.add-btn').attr('data-product-bulk-price-12', (response.price * 0.84).toFixed(2));
            $('.add-btn').attr('data-product-bulk-price-50', (response.price * 0.70).toFixed(2));
            $('.add-btn').attr('data-product-bulk-price-100', (response.price * 0.50).toFixed(2));



        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.error("Full Error Response:", xhr.responseText);
            alert("Failed to load product. Please try again.");
        }
    });
</script>

