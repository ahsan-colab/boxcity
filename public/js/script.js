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


let nextPageUrl = 'load-more-products';
let loading = false;
let hasMore = true;

function loadMoreProducts() {
    if (loading || !hasMore) return;
    loading = true;
    $('#loading').show();
    $.ajax({
        url: nextPageUrl,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.product_html) {
                // Append the rendered HTML for the products
                $('#product-list').append(response.product_html);
                nextPageUrl = response.next_page_url;
                hasMore = response.has_more;
            }
            if (!hasMore) {
                $(window).off('scroll');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading more products:', error);
        },
        complete: function() {
            loading = false;
            $('#loading').hide();
        }
    });
}

// Trigger load more on scroll
$(window).on('scroll', function() {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
        loadMoreProducts();
    }
});

// Initial load on page load if necessary (can be skipped if infinite scroll is used right away)
$(document).ready(function() {
    loadMoreProducts();
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


