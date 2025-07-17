<!-- Side pane -->
<?php
use App\Models\Category;
?>

<div class="col-sm-3">

    <!-- Side filter -->
    <div class="accordion" id="accordionExample">
        <!-- Length filter -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Length
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                <div class="accordion-body">
                    <ul>
                        @foreach ($sizes as $size)
                            @if ($size['count'] > 0)
                                <li
                                    data-min="{{ $size['min'] }}"
                                    data-max="{{ $size['max'] }}"
                                    style="cursor: pointer;"
                                >
                                    <span class="length">
                                    {{ $size['label'] }} ({{ $size['count'] }})</span>

                                    <span class="remove-length" style="display: none;">&times;</span>

                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Strength filter -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Type
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                <div class="accordion-body">
                    @include('partials.category-accordion', ['categories' => $categories])
                </div>
            </div>
        </div>
    </div>

    <!-- Side banner -->
    <div class="offer">
        <h3>Why Choose<br/>Box City? </h3>
        <ul>
            <li>Lowest Price Guarantee</li>
            <li>Same-Day Local Pickup</li>
            <li>Next Day Delivery</li>
            <li>Trusted By Business Owners</li>
        </ul>

        <h4>Call Us For All Your Packing & Shipping Needs</h4>
        <h3><a href="tel:8009926924">(800) 992-6924</a></h3>
    </div>

</div>


<script>
    $(document).on('click', '.filters, .length, .remove-filter, .remove-length', function (e) {
        const $clicked = $(this);

        setTimeout(function () {


            if ($clicked.hasClass('filters')) {
                // Remove active class from all filters
                $('.filters').removeClass('active');
                $('.filters').each(function () {
                    const $this = $(this);
                    const btn = $this.closest('.accordion-button');
                    btn.removeClass('active-highlight');
                    if (!$this.is($clicked)) {
                        btn.css('background-color', '');
                        btn.find('.remove-filter').hide();
                    }
                });

                // Set active class on clicked filter
                $clicked.addClass('active');
                const $btn = $clicked.closest('.accordion-button');
                $btn.addClass('active-highlight');

                $btn.find('.remove-filter').show();
            }


            if ($clicked.hasClass('remove-filter')) {
                const $btn = $clicked.closest('.accordion-button');
                $btn.find('.filters').removeClass('active');
                $btn.removeClass('active-highlight');

                $clicked.hide();
            }


            if ($clicked.hasClass('length')) {
                $('.length').removeClass('active');
                $('.length').each(function () {
                    $(this).closest('li').css('background-color', '');
                    $(this).siblings('.remove-length').hide();
                });

                $clicked.addClass('active');
                $clicked.closest('.accordion-item').find('.accordion-button').addClass('active-highlight');
                $clicked.closest('li').css('background-color', '#FFE175');
                $clicked.siblings('.remove-length').show();
            }


            if ($clicked.hasClass('remove-length')) {
                const $li = $clicked.closest('li');
                $li.find('.length').removeClass('active');
                $li.removeClass('active-highlight');
                $li.css('background-color', '');
                $clicked.hide();
            }


            const activeFilter = $('.filters.active');
            const categoryId = activeFilter.length ? activeFilter.data('category-id') : null;

            const activeLength = $('.length.active');
            const min = activeLength.length ? activeLength.parent('li').data('min') : null;
            const max = activeLength.length ? activeLength.parent('li').data('max') : null;


            $.ajax({
                url: "{{ route('category.level') }}",
                method: "GET",
                data: { categoryId, min, max },
                success: function (response) {
                    if (Array.isArray(response) && response.length === 0) {
                        $('#product-list').html('');
                        loadMoreProducts();
                    }
                    $('#product-list').html(response.product_html);
                },
                error: function () {
                    $('#product-list').html('<div style="display: block; text-align: center; margin-left: 162% !important; margin: 20px 0px; width: 100%;">No Products Found</div>');
                }
            });

        }, 100);
    });









    /*$(document).on('click', '.remove-filter', function (e) {
        e.stopPropagation(); // prevent parent .filters click

        const $filter = $(this).siblings('.filters');

        // Remove active styles
        $filter.removeClass('active');
        $filter.closest('.accordion-button').removeClass('active-highlight');
        $(this).hide();

        // Reset the table (unfiltered)
        $.ajax({
            url: "{{ route('category.level') }}",
            method: "GET",
            data: {}, // no categoryId
            success: function (response) {
                $('#product-table tbody').html(response.product_rows);
            },
            error: function () {
                $('#product-table tbody').html('<tr><td colspan="100%" style="text-align:center;">No Products Found</td></tr>');
            }
        });
    });*/





    /*$(document).on('click', '.length', function (e) {
        // Prevent action if clicking the X
        if ($(e.target).hasClass('remove-length')) return;

        const min = $(this).data('min');
        const max = $(this).data('max');

        // Remove active from all
        $('.length').removeClass('active');

        // Add active to this
        $(this).addClass('active');

        $.ajax({
            url: "{{ route('product.length') }}",
            method: "GET",
            data: { min, max },
            success: function (response) {
                $('#product-list').html(response.product_html);
            },
            error: function () {
                $('#product-list').html('<div style="display: block; text-align: center; margin-left: 162% !important; margin: 20px 0px; width: 100%;">No Products Found</div>');
            }
        });
    });*/


    /*$(document).on('click', '.remove-length', function (e) {
        e.stopPropagation();

        const $parent = $(this).closest('.length');
        $parent.removeClass('active');

        // Reset product list (no filter)
        $.ajax({
            url: "{{ route('product.length') }}",
            method: "GET",
            data: {}, // no min/max
            success: function (response) {
                $('#product-list').html(response.product_html);
            },
            error: function () {
                $('#product-list').html('<div style="display: block; text-align: center; margin-left: 162% !important; margin: 20px 0px; width: 100%;">No Products Found</div>');
            }
        });
    });*/

</script>
