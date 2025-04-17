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

let cart = JSON.parse(localStorage.getItem("cart")) || [];

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


$(window).on('scroll', function() {
    var tableBody = $('#product-list');
    var bottomOfTableBody = tableBody.offset().top + tableBody.height();
    var bottomOfWindow = $(window).scrollTop() + $(window).height();

    if (bottomOfWindow >= bottomOfTableBody - 100) {
        loadMoreProducts();
    }
});

$(document).ready(function() {
    loadMoreProducts();
});

function updateCartPage() {
    let $cartPageList = $("#cart-page-list");
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let $checkoutBtn = $("#proceed-to-checkout");

    if ($cartPageList.length) {
        $cartPageList.empty();

        if (cart.length === 0) {
            $cartPageList.append("<tr><td colspan='6'>Cart is empty</td></tr>");
            $checkoutBtn.prop("disabled", true);
        } else {
            cart.forEach(item => {
                $cartPageList.append(`
                    <tr>
                        <td><a href="${window.location.origin}/product/${item.productId}">${item.productId}</a></td>
                        <td><a href="${window.location.origin}/product/${item.productId}">${item.product}</a></td>
                        <td>
                            <div class="quantity-container">
                            <div class="qty-container">
                                <button class="quantity-btn minus" data-product="${item.product}">−</button>
                                <input type="text" class="cart-quantity text-center" data-product="${item.product}" value="${item.quantity}" min="1" style="width: 40px;">
                                <button class="quantity-btn plus" data-product="${item.product}">+</button>
                            </div>
                            </div>
                        </td>
                        <td>$${item.price}</td>
                        <td class="cart-price total-unit">$${(item.price * item.quantity).toFixed(2)}</td>
                        <td>
                            <button class="remove-item btn btn-danger btn-sm" data-product="${item.product}">Remove</button>
                        </td>
                    </tr>
                `);
            });

            if ($checkoutBtn.length) {
                $checkoutBtn.prop("disabled", false); // Enable if cart is not empty
            }
        }
    }
}


function updateCartUI() {
    let $cartList = $("#cart-list");
    let $cartCounter = $(".cart-counter");
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

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




$(document).ready(function () {
    $(document).on("click", ".quantity-btn", function () {
        let $wrapper = $(this).closest(".quantity-container");
        let $input = $wrapper.find(".quantity-input");
        let value = Number($input.val()) || 1; // Use Number() to avoid skipping numbers
        if ($(this).hasClass("plus")) {
            $input.val(value + 1);
        } else if ($(this).hasClass("minus")) {
            $input.val(Math.max(1, value - 1)); // Prevents going below 1
        }

        updateCartPage();
    });

    // Prevent manual entry of negative or invalid values
    $(document).on("input", ".quantity-input", function () {
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
    $(document).on("click", ".add-btn", function () {
        let $container = $(this).closest(".quantity-container");
        let productName = $(this).data("product-name");
        let price = $(this).data("product-retail-price");
        let priceBulkOne = $(this).data("product-bulk-price-12");
        let priceBulkTwo = $(this).data("product-bulk-price-50");
        let priceBulkThree = $(this).data("product-bulk-price-100");
        let productThumb = $(this).data("product-image");
        let productId = $(this).data("product-id");
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

        finalPrice = finalPrice ? parseFloat(finalPrice) : 0;
        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        if (quantity > 0) {
            let existingItem = cart.find(item => item.product === productName);

            if (existingItem) {
                existingItem.quantity += quantity;
                existingItem.price = finalPrice; // Optional: Only update if price should change
            } else {
                cart.push({
                    product: productName,
                    quantity: quantity,
                    price: finalPrice,
                    priceBulkOne: priceBulkOne,
                    priceBulkTwo: priceBulkTwo,
                    priceBulkThree: priceBulkThree,
                    retailPrice: price,
                    productThumb: productThumb,
                    productId: productId
                });
            }

            localStorage.setItem("cart", JSON.stringify(cart));
            updateCartUI();
            updateCartPage();
            updateCartDrawer();
            openCartDrawer();
        } else {
            alert("Quantity must be at least 1");
        }
    });









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


    function runCartUpdate() {
        updateCartUI();
    }

    window.addEventListener('load', runCartUpdate);
    window.addEventListener('pageshow', runCartUpdate);




    // Clear Cart
    $("#clear-cart").on("click", function () {
        sessionStorage.removeItem("cart");
        cart = [];
        updateCartUI();
        updateCartPage();
    });

    // Reset cart counter when tab is closed
    $(window).on("unload", function () {
        sessionStorage.removeItem("cart");
    });



    function applyDataLabels() {
        const headers = [
            "Product ID :", "Name :", "Retail Price :", "12+ :", "50+ :", "100+ :",
        ];

        $("#product-list tr").each(function () {
            $(this).find("td").each(function (index) {
                $(this).attr("data-label", headers[index]);
            });
        });
    }

    setTimeout(function () {
        applyDataLabels();
    }, 1000); // 200ms delay, adjust as needed




});


$(document).ready(function () {
    $('#hamburger-btn').on('click', function () {
        $('#mobile-menu').addClass('active');
        $('body').addClass('menu-open');
    });

    $('#close-menu').on('click', function () {
        $('#mobile-menu').removeClass('active');
        $('body').removeClass('menu-open');
    });

    // Optional: Close menu when clicking outside
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#mobile-menu, #hamburger-btn').length) {
            $('#mobile-menu').removeClass('active');
            $('body').removeClass('menu-open');
        }
    });

    $(document).ready(function () {
        $('li').has('.primary-sub-menu').addClass('menu-item-has-children');
    });

    $('li').has('.primary-sub-menu').hover(

        function () {
            // Mouse enter: show submenu
            $(this).find('.primary-sub-menu').stop(true, true).slideDown(5);
        },
        function () {
            // Mouse leave: hide submenu
            $(this).find('.primary-sub-menu').stop(true, true).slideUp(5);
        }
    );

});




function updateCartDrawer() {
    let $cartDrawerList = $("#cart-drawer-list");
    $cartDrawerList.empty();
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    if (cart.length === 0) {
        $cartDrawerList.append("<tr><td colspan='3'>Cart is empty</td></tr>");
    } else {
        cart.forEach(item => {
            $cartDrawerList.append(`
                <tr>
                    <td style="width: 60px;">
                        <img src="${item.productThumb}" alt="${item.product}" style="width: 50px; height: 50px; object-fit: cover;">
                    </td>
                    <td>
                        <strong>${item.product}</strong><br>
                        <small>Qty: ${item.quantity}</small><br>
                        <small>Price: $${item.price.toFixed(2)}</small>
                    </td>

                </tr>
            `);
        });
    }
}


// Open drawer
function openCartDrawer() {
    $("#cartDrawer").addClass("active");
    $("#cartBackdrop").addClass("active");
    updateCartDrawer();

    // Auto close after 10 seconds (10,000 milliseconds)
    setTimeout(() => {
        closeCartDrawer();
    }, 2500);
}

// Close drawer
function closeCartDrawer() {
    $("#cartDrawer").removeClass("active");
    $("#cartBackdrop").removeClass("active");
}

$(document).on("click", "#closeCartDrawer, #cartBackdrop", function() {
    closeCartDrawer();
});
