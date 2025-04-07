@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="container cart-container">
        <h2>Your Cart</h2>
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="cart-page-list">
            <tr><td colspan="5">Loading cart...</td></tr>
            </tbody>
        </table>
        <div class="cart-total-container">
        <button id="clear-cart" class="btn btn-danger">Clear Cart</button>
            <h3 class="cart-total">Total Price :</h3>
        </div>
        <div class="proceed-container">
        <button id="proceed-to-checkout" class="btn btn-danger">Proceed To Checkout</button>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            console.log(cart);
            // Load Cart Items from Local Storage
            function updateCartPage() {
                let $cartPageList = $("#cart-page-list");
                $cartPageList.empty();

                if (cart.length === 0) {
                    $cartPageList.append("<tr><td colspan='5'>Cart is empty</td></tr>");
                } else {
                    cart.forEach(item => {
                        console.log("Cart Item:", item);
                        $cartPageList.append(`
                    <tr>
                        <td><img src="${item.productThumb}" class="product-thumb"></td>
                        <td style="display: none;">${item.productId}</td>
                        <td>${item.product}</td>
                        <td>
                            <div class="quantity-container">
                            <div class="qty-container">
                                <button class="quantity-btn minus btn btn-sm btn-secondary" data-product="${item.product}">−</button>
                                <input type="text" class="cart-quantity text-center" data-product="${item.product}" value="${item.quantity}" min="1" style="width: 40px;">
                                <button class="quantity-btn plus btn btn-sm btn-secondary" data-product="${item.product}">+</button>
                            </div>
                            </div>
                        </td>
                        <td class="cart-price">$${item.price}</td>
                        <td>
                            <button class="remove-item btn btn-sm btn-danger" data-product="${item.product}">Remove</button>
                        </td>
                    </tr>
                `);
                    });
                }
            }

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
                let $row = $(this).closest("tr"); // Get the closest row
                let productName = $(this).data("product");
                let $input = $row.find(".cart-quantity"); // Get input in the same row
                let value = parseInt($input.val());

                if ($(this).hasClass("plus")) {
                    $input.val(value + 1);
                } else if ($(this).hasClass("minus")) {
                    $input.val(Math.max(1, value - 1)); // Prevent going below 1
                }

                let newQuantity = parseInt($input.val());

                updateCartQuantity(productName, newQuantity, $row); // Pass row for updating
            });

// Handle manual quantity input change
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
            });


            function updateCartQuantity(productName, newQuantity, $row) {
                let item = cart.find(item => item.product === productName);

                if (item) {
                    item.quantity = newQuantity;

                    // Ensure all price values exist
                    let retailPrice = parseFloat(item.retailPrice) || 0;
                    let priceBulkOne = parseFloat(item.priceBulkOne) || retailPrice;
                    let priceBulkTwo = parseFloat(item.priceBulkTwo) || priceBulkOne;
                    let priceBulkThree = parseFloat(item.priceBulkThree) || priceBulkTwo;

                    // Apply bulk pricing based on quantity
                    if (newQuantity >= 100) {
                        item.price = priceBulkThree;
                    } else if (newQuantity >= 50) {
                        item.price = priceBulkTwo;
                    } else if (newQuantity >= 12) {
                        item.price = priceBulkOne;
                    } else {
                        item.price = retailPrice; // Default price for 1-11 quantity
                    }

                    // Save updated cart to localStorage
                    localStorage.setItem("cart", JSON.stringify(cart));

                    // Ensure price is a valid number before updating UI
                    let displayPrice = parseFloat(item.price) || 0;

                    // Update only the closest `.cart-price` inside the same row
                    $row.find(".cart-price").text(`$${displayPrice.toFixed(2)}`);
                    updateTotalPrice();
                }
            }

            updateTotalPrice();

            function updateTotalPrice() {
                let total = 0;

                cart.forEach(item => {
                    total += item.price * item.quantity; // Multiply price by quantity
                });

                $(".cart-total").text(`Total Price: $${total.toFixed(2)}`);
            }








            // Remove Item from Cart
            $(document).on("click", ".remove-item", function () {
                let productName = $(this).data("product");
                cart = cart.filter(item => item.product !== productName);
                localStorage.setItem("cart", JSON.stringify(cart));
                updateCartPage();
                syncCartWithSession(); // Update session after item removal
                updateTotalPrice();
            });

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
                window.location.href = "{{ url('/checkout') }}";
            });
        });

    </script>

    <style>

        .qty-container {
            border: 1px solid;
            border-radius: 38px;
            padding: 0px 2px;
        }
        .quantity-btn {
            background: #FFE175 !important;
            border: none;
            padding: 5px 15px;
            font-size: 25px;
            cursor: pointer;
            border-radius: 40px;
            font-family: 'gilroy-regularuploaded_file';
            color: #000 !important;
        }

        .cart-quantity{
            width: 40px;
            text-align: center;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            font-family: 'gilroy-semibolduploaded_file' !important;
            background: transparent;
        }

        .table>tbody {
            vertical-align: middle;
        }

        #cart-page-list tr {
            border-radius: 15px !important;
            padding: 0px 0px;
            border: 1px solid #e4e4e4;
        }

        td{
          border: none !important;
        }

        #clear-cart {
            font-family: 'gilroy-semibolduploaded_file';
            background: #ffe175;
            border: 1px solid #ffe175;
            color: #000;
        }

        .remove-item {
            font-family: 'gilroy-semibolduploaded_file';
            background: #ffe175;
            border: 1px solid #ffe175;
            color: #000;
            font-size: 16px;
        }

        .cart-total-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cart-total {
            font-family: 'gilroy-semibolduploaded_file';
            font-size: 24px;
        }

        .product-thumb {
            width: 27%;
        }

        td,th{
         width:20%;
        }

        .proceed-container{
            text-align: right;
            margin: 33px 0px;
        }

        #proceed-to-checkout {
            font-family: 'gilroy-bolduploaded_file';
            background: #ffe175;
            border: 1px solid #ffe175;
            color: #000;
            font-size: 21px;
            padding: 11px 20px;
        }





    </style>
@endsection
