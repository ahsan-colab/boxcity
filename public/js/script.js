jQuery(document).ready(function($) {
    $('.slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        responsive: [
          {
            breakpoint: 1100,
            settings: {
              slidesToShow: 2,
              arrows:false,
            }
          },
          {
            breakpoint: 821,
            settings: {
              slidesToShow: 1
            }
          }
        ]
      });

    });

    document.addEventListener('DOMContentLoaded', function () {
        const locationItems = document.querySelectorAll('.list-group-item');
        const locationInfos = document.querySelectorAll('.location-info');

        locationItems.forEach(item => {
          item.addEventListener('click', function () {
            // Remove active class from all items and details
            locationItems.forEach(i => i.classList.remove('active'));
            locationInfos.forEach(info => info.classList.remove('active'));

            // Add active class to clicked item and corresponding details
            const location = this.dataset.location;
            this.classList.add('active');
            document.getElementById(location).classList.add('active');
          });
        });
      });




let offset = 0; // Start at 0, update dynamically
let loading = false;
let hasMore = true; // Track if more products exist

function loadMoreProducts() {
    if (loading || !hasMore) return;

    console.log('Loading more products...'); // Debugging

    loading = true;
    $('#loading').show(); // Show loading indicator
    console.log(`Current offset: ${offset}`);

    $.ajax({
        url: '{{ url('/') }}',
        method: 'GET',
        data: { offset: offset },
        dataType: 'json',
        success: function(response) {
            console.log('AJAX request successful:', response); // Debugging

            if (response.products.length > 0) {
                response.products.forEach(product => {
                    console.log(`Adding product: ${product.id} - ${product.name}`);
                    $('#product-list').append(`
                            <tr>
                                <td>${product.id}</td>
                                <td>${product.name}</td>
                                <td>$${product.price.toFixed(2)}</td>
                                <td class="bulk-price">$${(product.price * 0.84).toFixed(2)}</td>
                                <td class="bulk-price">$${(product.price * 0.70).toFixed(2)}</td>
                                <td class="bulk-price">$${(product.price * 0.50).toFixed(2)}</td>
                                <td>
                                    <div class="quantity-container">
                                        <div class="qty-container">
                                            <button class="quantity-btn">−</button>
                                            <input type="text" class="quantity-input" value="1">
                                            <button class="quantity-btn">+</button>
                                        </div>
                                        <button class="add-btn">ADD</button>
                                    </div>
                                </td>
                            </tr>
                        `);
                });

                offset = response.newOffset; // Update offset
                console.log(`Updated offset: ${offset}`);
                hasMore = response.hasMore; // Update if more products exist
                console.log(`More products available: ${hasMore}`);
            } else {
                console.log('No more products to load.');
            }

            if (!hasMore) {
                $(window).off('scroll'); // Stop checking for scroll when all products are loaded
                console.log('Infinite scroll disabled.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading more products:', error);
        },
        complete: function() {
            loading = false;
            $('#loading').hide(); // Hide loading indicator
            console.log('Finished loading batch.');
        }
    });
}

// Infinite Scroll Listener
$(window).on('scroll', function() {
    console.log('Scroll event triggered.');

    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
        console.log('User reached bottom. Loading more products...');
        loadMoreProducts();
    }
});

$(document).ready(function () {
    $(".quantity-btn").click(function () {
        let $wrapper = $(this).closest(".quantity-container");
        let $input = $wrapper.find(".quantity-input");
        let value = Number($input.val()) || 1; // Use Number() to avoid skipping numbers
        console.log(value);
        if ($(this).hasClass("plus")) {
            $input.val(value + 1);
        } else if ($(this).hasClass("minus")) {
            $input.val(Math.max(1, value - 1)); // Prevents going below 1
        }
    });

    // Prevent manual entry of negative or invalid values
    $(".quantity-input").on("input", function () {
        let val = $(this).val().replace(/[^0-9]/g, ""); // Remove non-numeric characters
        $(this).val(val || 1); // Ensure at least 1 is set
    });
});



$(document).ready(function () {
    let cart = JSON.parse(sessionStorage.getItem("cart")) || [];
    updateCartUI();
    updateCartPage();

    // Toggle Cart Panel
    $(".cart-icon").on("click", function () {
        $(".cart-panel").fadeToggle();
    });

    // Add to Cart Functionality
    $(".add-btn").on("click", function () {
        let $container = $(this).closest(".quantity-container");
        let productName = $(this).data("product-name");
        let price = $(this).data("product-retail-price");
        let priceBulkOne = $(this).data("product-bulk-price-12");
        let priceBulkTwo = $(this).data("product-bulk-price-50");
        let priceBulkThree = $(this).data("product-bulk-price-100");
        let productThumb = $(this).data("product-image");
        console.log(productThumb);
        let quantity = parseInt($container.find(".quantity-input").val()) || 1;

        let finalPrice;
        if (quantity >= 100) {
            finalPrice = priceBulkThree;
        } else if (quantity >= 50) {
            finalPrice = priceBulkTwo;
        } else if (quantity >= 12) {
            finalPrice = priceBulkOne;
        } else {
            finalPrice = price;
        }

        // Convert price to float to avoid issues with string values
        finalPrice = finalPrice ? parseFloat(finalPrice) : 0;

        if (quantity > 0) {
            let existingItem = cart.find(item => item.product === productName);

            if (existingItem) {
                existingItem.quantity += quantity;
                existingItem.price = finalPrice; // Update price if quantity changes
            } else {
                cart.push({ product: productName, quantity: quantity, price: finalPrice, priceBulkOne: priceBulkOne, priceBulkTwo: priceBulkTwo, priceBulkThree: priceBulkThree, retailPrice : price, productThumb: productThumb});
            }

            localStorage.setItem("cart", JSON.stringify(cart));
            updateCartUI();
            updateCartPage();
        } else {
            alert("Quantity must be at least 1");
        }
    });


    // Update Cart UI (Header & Sidebar)
    function updateCartUI() {
        let $cartList = $("#cart-list");
        let $cartCounter = $(".cart-counter");
        $cartList.empty();
        let totalItems = 0;

        if (cart.length === 0) {
            $cartList.append("<li>Cart is empty</li>");
            $cartCounter.hide(); // Hide counter if empty
        } else {
            cart.forEach(item => {
                $cartList.append(`
                    <li>${item.product} - ${item.quantity}
                        <button class="remove-item" data-product="${item.product}">❌</button>
                    </li>
                `);
                totalItems += item.quantity;
            });

            $cartCounter.text(totalItems).show(); // Update and show counter
        }
    }

    // Update Cart Page (cart.blade.php)
    function updateCartPage() {
        let $cartPageList = $("#cart-page-list");
        if ($cartPageList.length) { // Only run if the cart page exists
            $cartPageList.empty();
            if (cart.length === 0) {
                $cartPageList.append("<tr><td colspan='3'>Cart is empty</td></tr>");
            } else {
                cart.forEach(item => {
                    $cartPageList.append(`
                        <tr>
                            <td>${item.product}</td>
                            <td>
                                <input type="number" class="cart-quantity" data-product="${item.product}" value="${item.quantity}" min="1">
                            </td>
                            <td>
                                <button class="remove-item btn btn-danger btn-sm" data-product="${item.product}">❌ Remove</button>
                            </td>
                        </tr>
                    `);
                });
            }
        }
    }

    // Remove Item from Cart (For Both Sidebar & Cart Page)
    $(document).on("click", ".remove-item", function () {
        let productName = $(this).data("product");
        cart = cart.filter(item => item.product !== productName); // Remove item
        sessionStorage.setItem("cart", JSON.stringify(cart)); // Save changes
        updateCartUI();
        updateCartPage();
    });

    // Update Quantity in Cart Page
    $(document).on("change", ".cart-quantity", function () {
        let productName = $(this).data("product");
        let newQuantity = parseInt($(this).val());

        if (newQuantity < 1) {
            alert("Quantity must be at least 1");
            $(this).val(1);
            return;
        }

        let item = cart.find(item => item.product === productName);
        if (item) {
            item.quantity = newQuantity; // Update quantity
        }

        sessionStorage.setItem("cart", JSON.stringify(cart)); // Save changes
        updateCartUI();
    });

    // Clear Cart
    $("#clear-cart").on("click", function () {
        sessionStorage.removeItem("cart");
        cart = [];
        updateCartUI();
        updateCartPage();
        alert("Cart cleared!");
    });

    // Reset cart counter when tab is closed
    $(window).on("unload", function () {
        sessionStorage.removeItem("cart");
    });
});


