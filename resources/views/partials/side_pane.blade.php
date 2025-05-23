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
                        <li>3" - 8" (173)</li>
                        <li>9" - 11" (175)</li>
                        <li>12" - 13" (198)</li>
                        <li>14" - 17" (323)</li>
                        <li>18" - 23" (374)</li>
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
    $(document).on('click', '.filters', function () {
        const categoryId = $(this).data('category-id');

        $.ajax({
            url: "{{ route('category.Level') }}",
            method: "GET",
            data: { categoryId },
            success: function (response) {
                $('#product-list').html(response.product_html);
            },
            error: function () {
                $('#product-list').html('<div style="display: block; text-align: center; margin-left: 222% !important; margin: 20px 0px;  width: 100%;">No Products Found</div>');

            }
        });
    });

</script>
