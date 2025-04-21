@extends('layouts.app')

@section('title', 'Cart')

@section('content')

    <div class="container cart-container">
        <h2>Your Cart</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="cart-page-list">
            <tr><td colspan="5">Loading cart...</td></tr>
            </tbody>
        </table>
        <div class="cart-total-container">
        <button id="clear-cart" class="btn btn-danger">Clear Cart</button>
            <h3 class="cart-total">Sub Total :</h3>
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
                        <td ><a href="${window.location.origin}/product/${item.productId}" target="_blank">${item.productId}</a></td>
                        <td><a href="${window.location.origin}/product/${item.productId}" target="_blank">${item.product}</a></td>
                        <td>
                            <div class="quantity-container">
                            <div class="qty-container">
                                <button class="quantity-btn minus" data-product="${item.product}">−</button>
                                <input type="text" class="cart-quantity text-center" data-product="${item.product}" value="${item.quantity}" min="1" style="width: 40px;">
                                <button class="quantity-btn plus" data-product="${item.product}">+</button>
                            </div>
                            </div>
                        </td>
                        <td class="cart-price">$${item.price}</td>
                        <td class="cart-price total-unit">$${(item.price * item.quantity).toFixed(2)}</td>
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

            function updateCartTotal() {
                let total = 0;

                $(".total-unit").each(function () {
                    let priceText = $(this).text().replace("$", "").trim()
                    console.log(priceText);
                    let price = parseFloat(priceText) || 0;
                    total += price;
                });

                $(".cart-total").text(`Sub Total : $${total.toFixed(2)}`);
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
            });


            function updateCartQuantity(productName, newQuantity, $row) {
                let item = cart.find(item => item.product === productName);

                if (item) {
                    item.quantity = newQuantity;

                    let retailPrice = parseFloat(item.retailPrice) || 0;
                    let priceBulkOne = parseFloat(item.priceBulkOne) || retailPrice;
                    let priceBulkTwo = parseFloat(item.priceBulkTwo) || priceBulkOne;
                    let priceBulkThree = parseFloat(item.priceBulkThree) || priceBulkTwo;

                    if (newQuantity >= 100) {
                        item.price = priceBulkThree;
                    } else if (newQuantity >= 50) {
                        item.price = priceBulkTwo;
                    } else if (newQuantity >= 12) {
                        item.price = priceBulkOne;
                    } else {
                        item.price = retailPrice;
                    }

                    // Save to localStorage
                    localStorage.setItem("cart", JSON.stringify(cart));

                    // 🔁 Recalculate and update all total-units
                    $(".cart-quantity").each(function () {
                        let product = $(this).data("product");
                        let qty = parseInt($(this).val());
                        let row = $(this).closest("tr");

                        let productItem = cart.find(p => p.product === product);
                        if (productItem) {
                            let unitTotal = productItem.price * qty;
                            row.find(".total-unit").text(`$${unitTotal.toFixed(2)}`);
                        }
                    });

                    // ✅ Now update the full cart total
                    updateCartTotal();
                }
            }



            updateTotalPrice();

            function updateTotalPrice() {
                let total = 0;

                cart.forEach(item => {
                    total += item.price * item.quantity;
                });

                $(".cart-total").text(`Sub Total : $${total.toFixed(2)}`);
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
            background: #ffe175 !important;
            border: 1px solid #ffe175 !important;
            color: #000 !important;
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

        td, th {
            width: 16.6%;
        }

        td a{
         color: #000;
         text-decoration: none;
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
