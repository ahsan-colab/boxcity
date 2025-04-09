@extends('layouts.app')

@section('title', 'Checkout')

@section('content')



    <div class="container checkout-container">
        <h2>Checkout</h2>
        <div class="row">
            <div class="col-md-7">
                <h3>Billing Details</h3>
                <form id="checkout-form">
                    <div class="form-group">
                        <label for="full-name">Full Name</label>
                        <input type="text" id="full-name" name="full-name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control" required>
                    </div>
                    <div class="row form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <select id="country" name="country" class="form-control" required>
                                    <option value="" disabled selected>Select Country</option>
                                    <option value="US">United States</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="state">State</label>
                                <select id="state" name="state" class="form-control" required>
                                    <option value="" disabled selected>Select State</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">City</label>
                                <select id="city" name="city" class="form-control" required>
                                    <option value="" disabled selected>Select City</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">Postal Code</label>
                                <input type="text" id="postal-code" name="postal-code" class="form-control" required>
                            </div>
                        </div>
                    </div>

                        <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" class="form-control" required></textarea>
                    </div>

                    <div class="btn-container">
                        <h4 class="checkout-total">Total: $0.00</h4>
                        <button id="place-order" type="submit" class="btn btn-success btn-lg">Place Order</button>
                    </div>
                </form>
            </div>

            <div class="col-md-5">
                <h3>Order Summary</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody id="checkout-cart-list">
                    <tr><td colspan="3">Loading cart...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            let $cartList = $("#checkout-cart-list");
            let total = 0;

            $cartList.empty();
            if (cart.length === 0) {
                $cartList.append("<tr><td colspan='3'>Your cart is empty</td></tr>");
            } else {
                cart.forEach(item => {
                    let itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    $cartList.append(`
                    <tr>
                        <td>${item.product}</td>
                        <td>${item.quantity}</td>
                        <td>$${itemTotal.toFixed(2)}</td>
                    </tr>
                `);
                });
            }
            $(".checkout-total").text(`Total: $${total.toFixed(2)}`);


            $("#place-order").click(function () {
                event.preventDefault();
                let fullName = $("#full-name").val();
                let email = $("#email").val();
                let phone = $("#phone").val();
                let address = $("#address").val();
                let country = $("#country").val();
                let state = $("#state").val();
                let city = $("#city").val();
                let postcode = $("#postal-code").val();

                if (!fullName || !email || !phone || !address || !country || !state || !city || !postcode) {
                    alert("Please fill all fields before placing the order.");
                    return;
                }

                // Retrieve cart items from localStorage
                let cartItems = JSON.parse(localStorage.getItem("cart")) || [];

                if (cartItems.length === 0) {
                    alert("Your cart is empty. Add items before placing an order.");
                    return;
                }

                let totalAmount = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);

                let orderData = {
                    subtotal: totalAmount,
                    subtotalWithoutTax: totalAmount,
                    total: totalAmount,
                    totalWithoutTax: totalAmount,
                    giftCardRedemption: 0,
                    totalBeforeGiftCardRedemption: totalAmount,
                    giftCardDoubleSpending: false,
                    email: email,
                    paymentMethod: "Phone order",
                    paymentSubtype: "manual",
                    tax: 0,
                    customerTaxExempt: false,
                    customerTaxId: "",
                    customerTaxIdValid: false,
                    b2b_b2c: "b2c",
                    reversedTaxApplied: false,
                    customerRequestedInvoice: false,
                    customerFiscalCode: "",
                    electronicInvoicePecEmail: "",
                    electronicInvoiceSdiCode: "",
                    paymentStatus: "AWAITING_PAYMENT",
                    fulfillmentStatus: "AWAITING_PROCESSING",
                    createDate: new Date().toISOString(),
                    updateDate: new Date().toISOString(),
                    createTimestamp: Math.floor(Date.now() / 1000),
                    updateTimestamp: Math.floor(Date.now() / 1000),
                    items: cartItems.map(item => ({

                            productId: item.productId,
                            name: item.product,
                            categoryId: item.categoryId || null,
                            price: item.price,
                            priceWithoutTax: item.price,
                            productPrice: item.price,
                            sku: item.sku || "",
                            quantity: item.quantity,
                            shortDescription: item.shortDescription || "",
                            shortDescriptionTranslated: {
                                en: item.shortDescription || "",
                                es: ""
                            },

                        tax: 0,
                        shipping: 0,
                        quantityInStock: item.quantityInStock || 0,
                        name: item.product,
                        nameTranslated: {
                            en: item.name,
                            es: ""
                        },
                        isShippingRequired: true,
                        weight: item.weight || 1,
                        trackQuantity: true,
                        fixedShippingRateOnly: false,
                        imageUrl: item.imageUrl || "",
                        smallThumbnailUrl: item.smallThumbnailUrl || "",
                        hdThumbnailUrl: item.hdThumbnailUrl || "",
                        fixedShippingRate: 0,
                        digital: false,
                        productAvailable: true,
                        couponApplied: false,
                        taxes: [],
                        dimensions: {
                            length: item.length || 0,
                            width: item.width || 0,
                            height: item.height || 0
                        },
                        discounts: [],
                        discountsAllowed: true,
                        taxable: true,
                        giftCard: false,
                        recurringTaxIds: [],
                        isCustomerSetPrice: false,
                        externalReferenceId: item.externalReferenceId || "",
                        attributes: item.attributes || []
                    })),
                    billingPerson: {
                        name: fullName,
                        firstName: fullName.split(" ")[0] || "",
                        lastName: fullName.split(" ").slice(1).join(" ") || "",
                        street: address,
                        phone: phone,
                        countryCode: "US",
                        postalCode: postcode,
                        city: city,
                        stateOrProvinceCode: "CA",
                        stateOrProvinceName: state
                    },
                    shippingPerson: {
                        name: fullName,
                        firstName: fullName.split(" ")[0] || "",
                        lastName: fullName.split(" ").slice(1).join(" ") || "",
                        phone: phone
                    },
                    shippingOption: {
                        shippingMethodName: "Standard Shipping",
                        shippingRate: 0,
                        shippingRateWithoutTax: 0,
                        isPickup: false,
                        fulfillmentType: "DELIVERY",
                        isShippingLimit: false
                    },
                    handlingFee: {
                        name: "Handling Fee",
                        value: 0,
                        valueWithoutTax: 0,
                        description: "",
                        taxes: []
                    },
                    predictedPackage: [],
                    shippingLabelAvailableForShipment: false,
                    shipments: [],
                    refunds: [],
                    hidden: false,
                    privateAdminNotes: "",
                    acceptMarketing: false,
                    disableAllCustomerNotifications: false,
                    externalFulfillment: false,
                    pricesIncludeTax: false,
                    orderExtraFields: [],
                    discountInfo: [],
                    creditCardStatus: {
                        avsMessage: "not checked",
                        cvvMessage: "not checked"
                    },
                    invoices: [],
                    lang: "en"
                };


                $.ajax({
                    url: "https://app.ecwid.com/api/v3/109333282/orders",
                    type: "POST",
                    data: JSON.stringify(orderData),
                    contentType: "application/json",
                    headers: {
                        "Authorization": "Bearer public_TKetLbQHRiCT4zFeDFBzzncr3rWjzA9E"
                    },
                    beforeSend: function () {
                        console.log("Sending order request to Ecwid API...");
                    },
                    success: function (response) {
                        console.log("Order placed successfully!", response);
                        window.location.href = "{{route('checkout.thankyou')}}}";
                        localStorage.removeItem("cart");
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        console.error("Full Error Response:", xhr.responseText);
                        alert("Error: " + (xhr.responseJSON?.error || "Something went wrong."));
                    }
                });

            });



            let citiesByState = {
                "Alabama": ["Birmingham", "Montgomery", "Mobile", "Huntsville"],
                "Alaska": ["Anchorage", "Juneau", "Fairbanks"],
                "Arizona": ["Phoenix", "Tucson", "Mesa"],
                "Arkansas": ["Little Rock", "Fort Smith", "Fayetteville"],
                "California": ["Los Angeles", "San Francisco", "San Diego", "Sacramento"],
                "Colorado": ["Denver", "Colorado Springs", "Aurora"],
                "Connecticut": ["Bridgeport", "New Haven", "Stamford"],
                "Delaware": ["Wilmington", "Dover"],
                "Florida": ["Miami", "Orlando", "Tampa", "Jacksonville"],
                "Georgia": ["Atlanta", "Savannah", "Augusta"],
                "Hawaii": ["Honolulu", "Hilo"],
                "Idaho": ["Boise", "Idaho Falls"],
                "Illinois": ["Chicago", "Springfield", "Naperville", "Rockford"],
                "Indiana": ["Indianapolis", "Fort Wayne", "Evansville"],
                "Iowa": ["Des Moines", "Cedar Rapids"],
                "Kansas": ["Wichita", "Topeka"],
                "Kentucky": ["Louisville", "Lexington"],
                "Louisiana": ["New Orleans", "Baton Rouge", "Shreveport"],
                "Maine": ["Portland", "Augusta"],
                "Maryland": ["Baltimore", "Annapolis"],
                "Massachusetts": ["Boston", "Worcester"],
                "Michigan": ["Detroit", "Grand Rapids", "Lansing"],
                "Minnesota": ["Minneapolis", "Saint Paul"],
                "Mississippi": ["Jackson", "Biloxi"],
                "Missouri": ["Kansas City", "St. Louis", "Springfield"],
                "Montana": ["Billings", "Missoula"],
                "Nebraska": ["Omaha", "Lincoln"],
                "Nevada": ["Las Vegas", "Reno"],
                "New Hampshire": ["Manchester", "Concord"],
                "New Jersey": ["Newark", "Jersey City", "Trenton"],
                "New Mexico": ["Albuquerque", "Santa Fe"],
                "New York": ["New York City", "Buffalo", "Rochester", "Albany"],
                "North Carolina": ["Charlotte", "Raleigh", "Durham"],
                "North Dakota": ["Fargo", "Bismarck"],
                "Ohio": ["Columbus", "Cleveland", "Cincinnati"],
                "Oklahoma": ["Oklahoma City", "Tulsa"],
                "Oregon": ["Portland", "Salem"],
                "Pennsylvania": ["Philadelphia", "Pittsburgh", "Harrisburg"],
                "Rhode Island": ["Providence"],
                "South Carolina": ["Charleston", "Columbia"],
                "South Dakota": ["Sioux Falls", "Rapid City"],
                "Tennessee": ["Nashville", "Memphis", "Knoxville"],
                "Texas": ["Houston", "Dallas", "Austin", "San Antonio"],
                "Utah": ["Salt Lake City", "Provo"],
                "Vermont": ["Burlington", "Montpelier"],
                "Virginia": ["Virginia Beach", "Richmond", "Norfolk"],
                "Washington": ["Seattle", "Spokane", "Tacoma"],
                "West Virginia": ["Charleston", "Huntington"],
                "Wisconsin": ["Milwaukee", "Madison"],
                "Wyoming": ["Cheyenne", "Casper"]
            };


            $(document).ready(function () {
                let stateDropdown = $("#state");
                let cityDropdown = $("#city");

                // Populate state dropdown
                Object.keys(citiesByState).forEach(function (state) {
                    stateDropdown.append(`<option value="${state}">${state}</option>`);
                });

                // On state change, update city dropdown
                stateDropdown.change(function () {
                    let selectedState = $(this).val();
                    cityDropdown.empty(); // Clear existing options
                    cityDropdown.append('<option value="" disabled selected>Select City</option>');

                    if (selectedState in citiesByState) {
                        citiesByState[selectedState].forEach(function (city) {
                            cityDropdown.append(`<option value="${city}">${city}</option>`);
                        });
                    }
                });
            });


        });




    </script>


    <style>
        .checkout-container {
            margin-top: 20px;
        }

        .btn-container{
            text-align: right;
            margin-top: 40px;
        }

        .checkout-container .row {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .checkout-container h3 {
            font-family: 'gilroy-semibolduploaded_file';
        }

        .checkout-total {
            font-size: 20px;
            font-weight: bold;
            margin-top: 15px;
            font-family: 'gilroy-mediumuploaded_file';
        }

        #place-order{
            font-family: 'gilroy-bolduploaded_file';
            background: #ffe175;
            border: 1px solid #ffe175;
            color: #000;
            font-size: 19px;
            padding: 11px 20px;
        }

        label {
            font-family: 'gilroy-semibolduploaded_file';
            font-size: 15px;
        }

        .form-group {
            margin-top: 15px;
        }

        .form-row{
           display: flex !important;
           margin-top: 0px !important;
           margin-bottom: 0px !important;
        }

        select{
            font-family: 'gilroy-mediumuploaded_file';
            font-size: 14px !important;
        }

        .form-control {
            font-family: 'gilroy-mediumuploaded_file' !important;
        }

    </style>
@endsection
