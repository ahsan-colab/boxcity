@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

    <section class="products-container">
        <div class="container">
            <div class="row">
                <!-- Side Pane -->
                @include('partials.side_pane')

                <div class="col-lg-9 col-sm-12">
                    <!-- Top banner -->
{{--                    <div class="banner">--}}
{{--                        <div class="heading-container">--}}
{{--                            <h4>CORRUGATED BOXES</h4>--}}
{{--                            <h2>Buy Boxes in <br/>Bulk & Save Big!</h2>--}}
{{--                            <p>We beat Uline pricing! Enjoy same-day local <br/> pickup or next-day delivery.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                          <div class="banner-img">
                              <img src="{{asset('public/assets/Full-Banner.png')}}"/>
                          </div>

                    <div class="banner-img-mobile">
                        <img src="{{asset('public/assets/Mobile-Version.png')}}"/>
                    </div>
                    <!-- Bulk order section -->
                    <div class="bulk-orders">
                        <h3>
                            For bigger bulk orders exceeding 100 boxes, reach out to our partnerships team at
                            <a href="mailto:partnerships@boxcity.com">partnerships@boxcity.com</a>
                        </h3>
                    </div>

                    <!-- Product table -->
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
                            <!-- Data will populate here -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Loading Indicator -->
                    <div id="loading" style="text-align: center; display: none;">
                        <p>Loading more products...</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Cart Panel -->
    <div class="cart-panel">
        <h3>Shopping Cart</h3>
        <ul id="cart-list"></ul>
        <button id="clear-cart">Clear Cart</button>
    </div>

    <!-- Quote Request Form -->
    @include('partials.quote_from')

    <!-- Testimonials Section -->
    @include('partials.testimonial')

    <!-- Store Location Tabs -->
    @include('partials.store_location')
@endsection
