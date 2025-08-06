@extends('layouts.app')

@section('title', 'Cart')

@section('content')

    <div class="container cart-container">
        {{-- Page Title --}}
        <h2>Your Cart</h2>

        {{-- Cart Table --}}

        <div class="table-responsive">
        <table id="product-table" class="responsive-table">
            <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th style="display: none">Unit Price</th>
                <th style="display: none">Retail Price</th>
                <th>Total Price</th>
                <th style="display: none">You Save</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="cart-page-list">
            {{-- JavaScript will populate this area dynamically --}}
            <tr><td colspan="6">Loading cart...</td></tr>
            </tbody>
        </table>
        </div>
        {{-- Cart Total and Clear Button --}}
        <div class="cart-total-container">
            <div class="cart-btn-container">
                <button id="clear-cart" class="btn btn-danger">Clear Cart</button>
                <a href="{{route('home')}}" id="continue-shopping" class="btn btn-danger">Continue Shopping</a>
            </div>
            <h3 class="cart-total">Sub Total :</h3>

        </div>
        <h3 class="save-amount-heading"><span class="save-amount">You Save :</span></h3>
        {{-- Proceed to Checkout Button --}}
        <div class="proceed-container">
            <button id="proceed-to-checkout" class="btn btn-danger">Proceed To Checkout</button>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            // Load Cart Items from Local Storage
            {{--function updateCartPage() {--}}
            {{--    let $cartPageList = $("#cart-page-list");--}}
            {{--    $cartPageList.empty();--}}

            {{--    if (cart.length === 0) {--}}
            {{--        $cartPageList.append("<tr><td colspan='5'>Cart is empty</td></tr>");--}}
            {{--    } else {--}}
            {{--        cart.forEach(item => {--}}
            {{--            var productDetailUrl = "{{ route('product.detail', ['id' => '000']) }}".replace('000', item.productId);--}}
            {{--            $cartPageList.append(`--}}
            {{--        <tr>--}}
            {{--            <td ><a href="${productDetailUrl}" target="_blank">${item.productId}</a></td>--}}
            {{--            <td><a href="${productDetailUrl}" target="_blank">${item.product}</a></td>--}}
            {{--            <td>--}}
            {{--                <div class="quantity-container">--}}
            {{--                <div class="qty-container">--}}
            {{--                    <button class="quantity-btn minus" data-product="${item.product}">−</button>--}}
            {{--                    <input type="text" class="cart-quantity text-center" data-product="${item.product}" value="${item.quantity}" min="1" style="width: 40px;">--}}
            {{--                    <button class="quantity-btn plus" data-product="${item.product}">+</button>--}}
            {{--                </div>--}}
            {{--                </div>--}}
            {{--            </td>--}}
            {{--            <td class="cart-price">$${item.price}</td>--}}
            {{--            <td class="cart-price total-unit">$${(item.price * item.quantity).toFixed(2)}</td>--}}
            {{--            <td>--}}
            {{--                <button class="remove-item btn btn-sm btn-danger" data-product="${item.product}">Remove</button>--}}
            {{--            </td>--}}
            {{--        </tr>--}}
            {{--    `);--}}
            {{--        });--}}
            {{--    }--}}
            {{--}--}}

            updateCartPage(); // Update cart page on load
            syncCartWithSession(); // Sync cart with Laravel session on page load

            // Function to sync cart data with Laravel session
            function syncCartWithSession() {
                $.ajax({
                    url: "{{ route('cart.store') }}",
                    method: "POST",
                    data: { cart: cart, _token: "{{ csrf_token() }}" },
                    success: function (response) {
                        console.log("Cart synced with session!");
                    }
                });
            }




            $(document).on("click", ".quantity-btn", function () {
                let $row = $(this).closest("tr");
                let productName = $(this).data("product");
                let $input = $row.find(".cart-quantity");
                let value = parseInt($input.val());

                if ($(this).hasClass("plus")) {
                    $input.val(value + 1);
                } else if ($(this).hasClass("minus")) {
                    $input.val(Math.max(1, value - 1));
                }

                let newQuantity = parseInt($input.val());
                updateCartQuantity(productName, newQuantity, $row);

            });



            $(document).on("change", ".cart-quantity", function () {
                let $row = $(this).closest("tr"); // Get the closest row
                let productName = $(this).data("product");
                let newQuantity = parseInt($(this).val());

                if (newQuantity < 1 || isNaN(newQuantity)) {
                    alert("Quantity must be at least 1");
                    $(this).val(1);
                    newQuantity = 1;
                }

                updateCartQuantity(productName, newQuantity, $row); // Pass row for updating
                updateCartPage();
            });






            updateTotalPrice();




            // Clear Cart
            $("#clear-cart").click(function () {
                $.ajax({
                    url: "{{ route('cart.clear') }}",
                    method: "POST",
                    data: { _token: "{{ csrf_token() }}" },
                    success: function () {
                        localStorage.removeItem("cart");
                        location.reload();
                    }
                });
                updateTotalPrice();
            });


            $("#proceed-to-checkout").click(function () {
                window.location.href = "{{ route('checkout') }}";
            });
        });

    </script>
@endsection
