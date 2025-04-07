@extends('layouts.app')

@section('title', 'Home Page')

@yield('title')

@section('content')

    <?php

    $site_url = env('SITE_URL');
    $home_url = env ('HOME_URL');
    ?>

    <section class="products-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Strength
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Regular</li>
                                        <li>Double</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
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

                <div class="col-sm-9">
                    <div class="banner">
                        <div class="heading-container">
                            <h4>CORRUGATED BOXES</h4>
                            <h2>Buy Boxes in <br/>Bulk & Save Big!</h2>
                            <p>We beat Uline pricing! Enjoy same-day local <br/> pickup or next-day delivery.</p>
                        </div>
                    </div>
                    <div class="bulk-orders">
                        <h3>For bigger bulk orders exceeding 100 boxes, reach out to our partnerships team at <a href="mailto:partnerships@boxcity.com">partnerships@boxcity.com</a></h3>
                    </div>
                    <table id="product-table">
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
                        </tbody>
                    </table>

                    <!-- Loading Indicator -->
                    <div id="loading" style="text-align: center; display: none;">
                        <p>Loading more products...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <a href="<?php echo $home_url?>cart">
        <div class="cart-icon"><i class="fa-solid fa-cart-shopping"></i>
            <div class="cart-counter">0</div>
        </div>
    </a>
    <!-- Cart Panel -->
    <div class="cart-panel">
        <h3>Shopping Cart</h3>
        <ul id="cart-list"></ul>
        <button id="clear-cart">Clear Cart</button>
    </div>

    <section class="quote" id="quote">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <h2>Get a Free quote</h2>
                    <p>We Can Help With All Your Packing &amp; Shipping Needs.</p>
                    <p>Fill out the form to inquire about our services and a team member will get back to you with a
                        free quote</p>

                    <form action="/location-van-nuys/#wpcf7-f122-o1" method="post" class="wpcf7-form init"
                          aria-label="Contact form" novalidate="novalidate" data-status="init">
                        <div style="display: none;">
                            <input type="hidden" name="_wpcf7" value="122">
                            <input type="hidden" name="_wpcf7_version" value="6.0.4">
                            <input type="hidden" name="_wpcf7_locale" value="en_US">
                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f122-o1">
                            <input type="hidden" name="_wpcf7_container_post" value="0">
                            <input type="hidden" name="_wpcf7_posted_data_hash" value="">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                    <span class="wpcf7-form-control-wrap" data-name="your-name"><input size="40"
                                                                                                       maxlength="400"
                                                                                                       class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                       aria-required="true" aria-invalid="false" placeholder="Full Name" value=""
                                                                                                       type="text" name="your-name"></span>

                            </div>
                            <div class="col-sm-6">
                                    <span class="wpcf7-form-control-wrap" data-name="your-company"><input size="40"
                                                                                                          maxlength="400"
                                                                                                          class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                          aria-required="true" aria-invalid="false"
                                                                                                          placeholder="Company Name (Optional)" value="" type="text"
                                                                                                          name="your-company"></span>

                            </div>
                            <div class="col-sm-6">
                                    <span class="wpcf7-form-control-wrap" data-name="your-email"><input size="40"
                                                                                                        maxlength="400"
                                                                                                        class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email"
                                                                                                        aria-required="true" aria-invalid="false" placeholder="Email" value=""
                                                                                                        type="email" name="your-email"></span>

                            </div>
                            <div class="col-sm-6">
                                    <span class="wpcf7-form-control-wrap" data-name="your-phone"><input size="40"
                                                                                                        maxlength="400"
                                                                                                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                        aria-required="true" aria-invalid="false" placeholder="Phone Number"
                                                                                                        value="" type="text" name="your-phone"></span>

                            </div>
                        </div>
                        <span class="wpcf7-form-control-wrap" data-name="select-service"><select
                                class="wpcf7-form-control wpcf7-select" aria-invalid="false" name="select-service">
                                        <option value="What Services Would You Want To Inquire About?">What Services Would
                                            You Want To Inquire About?</option>
                                        <option value="Moving Supplies in Van Nuys">Moving Supplies in Van Nuys</option>
                                        <option value="Corrugated Boxes in Van Nuys">Corrugated Boxes in Van Nuys</option>
                                        <option value="Packing Peanuts in Van Nuys">Packing Peanuts in Van Nuys</option>
                                        <option value="mailing Tubes in Van Nuys">mailing Tubes in Van Nuys</option>
                                        <option value="bubble Wrap in Van Nuys">bubble Wrap in Van Nuys</option>
                                        <option value="packing Supplies in Van Nuys">packing Supplies in Van Nuys</option>
                                    </select></span><br>
                        <span class="wpcf7-form-control-wrap" data-name="your-message"><textarea cols="40" rows="10"
                                                                                                 maxlength="2000" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"
                                                                                                 placeholder="Message" name="your-message"></textarea></span>

                        <div class="mobile-center">
                            <input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit"
                                   value="Submit Your Message"><span class="wpcf7-spinner"></span>

                        </div>
                        <div class="wpcf7-response-output" aria-hidden="true"></div>
                    </form>
                </div>

                <div class="col-sm-5">
                    <video width="" height="" autoplay="" muted="" loop="" __idm_id__="1835009">
                        <source
                            src="public/assets/video.mp4"
                            type="video/mp4">
                    </video>
                </div>

            </div>
        </div>

        </div>
    </section>


    <section class="testimonials-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Our Customers Love Us</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="customer-box">
                        <div class="slider">
                            <div class="customer-slide">
                                <div class="img-box">
                                    <img src="public/assets/customer-loves-1.png" alt="Logo">
                                </div>
                                <div class="rating-box">
                                    <img src="public/assets/star-review.png" alt="Star Review">
                                    <p>5 months ago</p>
                                </div>
                                <div class="content-box">
                                    <p>
                                        Workers very friendly and helpful. Variety of products. Free parking in back. FedEx pick-up.
                                    </p>
                                </div>
                                <div class="detail-bedge-box">
                                    <p>
                                        Gfire M.<span>Verified buyer</span>
                                    </p>
                                    <img src="public/assets/google-bedge.png" alt="Google Badge">
                                </div>
                            </div>
                            <div class="customer-slide">
                                <div class="img-box">
                                    <img src="public/assets/customer-loves-2.png" alt="Logo">
                                </div>
                                <div class="rating-box">
                                    <img src="public/assets/star-review.png" alt="Star Review">
                                    <p>6 months ago</p>
                                </div>
                                <div class="content-box">
                                    <p>
                                        They are so easy to design, process is seamless, and they are amazing quality.
                                    </p>
                                </div>
                                <div class="detail-bedge-box">
                                    <p>
                                        Syreeta B.<span>Verified buyer</span>
                                    </p>
                                    <img src="public/assets/yelp-bedge.png" alt="Yelp Badge">
                                </div>
                            </div>
                            <div class="customer-slide">
                                <div class="img-box">
                                    <img src="public/assets/customer-loves-3.png" alt="Logo">
                                </div>
                                <div class="rating-box">
                                    <img src="public/assets/star-review.png" alt="Star Review">
                                    <p>6 months ago</p>
                                </div>
                                <div class="content-box">
                                    <p>
                                        Variety of boxes and great customer service!!! 🫶 Customer parking available behind the building.
                                    </p>
                                </div>
                                <div class="detail-bedge-box">
                                    <p>
                                        Mellisa R.<span>Verified buyer</span>
                                    </p>
                                    <img src="public/assets/google-bedge.png" alt="Google Badge">
                                </div>
                            </div>
                            <div class="customer-slide">
                                <div class="img-box">
                                    <img src="public/assets/customer-loves-2.png" alt="Logo">
                                </div>
                                <div class="rating-box">
                                    <img src="public/assets/star-review.png" alt="Star Review">
                                    <p>6 months ago</p>
                                </div>
                                <div class="content-box">
                                    <p>
                                        They are so easy to design, process is seamless, and they are amazing quality.
                                    </p>
                                </div>
                                <div class="detail-bedge-box">
                                    <p>
                                        Syreeta B.<span>Verified buyer</span>
                                    </p>
                                    <img src="public/assets/yelp-bedge.png" alt="Yelp Badge">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="locations-sec">
        <div class="container">
            <div class="row">
                <!-- Locations List -->
                <div class="col-md-6">
                    <h1>
                        Our Locations
                    </h1>
                    <ul class="list-group">
                        <li class="list-group-item active" data-location="van-nuys">Van Nuys</li>
                        <li class="list-group-item" data-location="north-hollywood">North Hollywood</li>
                        <li class="list-group-item" data-location="west-la">West Los Angeles</li>
                        <li class="list-group-item" data-location="valencia">Valencia</li>
                        <li class="list-group-item" data-location="pasadena">Pasadena</li>
                        <li class="list-group-item" data-location="marina-del-rey">Marina Del Rey</li>
                        <li class="list-group-item" data-location="canoga-park">Canoga Park</li>
                        <li class="list-group-item" data-location="glendale">Glendale</li>
                        <li class="list-group-item" data-location="azusa">Azusa</li>
                    </ul>
                </div>
                <!-- Location Details -->
                <div class="col-md-6">
                    <div class="location-details">
                        <!-- Van Nuys Info -->
                        <div class="location-info active" id="van-nuys">
                            <div class="location-details-img">
                                <div class="location-details">
                                    <h2>Van Nuys, CA</h2>
                                    <p><span>Address:</span><br>16113 Sherman Way, Van Nuys, CA 91406</p>
                                    <p><span>Open Hours:</span><br>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 5:00 PM<br>Sunday: 10:00 AM - 4:00 PM</p>
                                    <p><span>Contact Info:</span></p>
                                    <a href="tel:8189388327">
                                        <p class="number">818-938-8327</p>
                                    </a>
                                    <a href="mailto:vannuys@boxcity.com">
                                        <p>vannuys@boxcity.com</p>
                                    </a>
                                </div>
                                <div class="location-img">
                                    <img src="public/assets/Van-Nuys-Img.png" alt="Van Nuys Location">
                                </div>
                            </div>
                            <div class="location-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6599.685108490089!2d-118.48429!3d34.201499!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c297582574910f%3A0xa211d65f8f346cd7!2s16113%20Sherman%20Way%2C%20Van%20Nuys%2C%20CA%2091406!5e0!3m2!1sen!2sus!4v1736975505697!5m2!1sen!2sus" width="100%" height="357" style="border:0; border-radius:20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="location-info" id="north-hollywood">
                            <div class="location-details-img">
                                <div class="location-details">
                                    <h2>North Hollywood, CA</h2>
                                    <p><span>Address:</span><br>12800 Victory Blvd North Hollywood, CA 91606</p>
                                    <p><span>Open Hours:</span><br>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 5:00 PM<br>Sunday: 10:00 AM - 4:00 PM</p>
                                    <p><span>Contact Info:</span></p>
                                    <a href="tel:8189381936">
                                        <p class="number">818-938-1936</p>
                                    </a>
                                    <a href="mailto:northhollywood@boxcity.com">
                                        <p>northhollywood@boxcity.com</p>
                                    </a>
                                </div>
                                <div class="location-img">
                                    <img src="public/assets/North-Hollywood.png" alt="Van Nuys Location">
                                </div>
                            </div>
                            <div class="location-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13986.800034444543!2d-118.4220051493121!3d34.18609557420965!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c29715aa9f2bed%3A0x7bbd18b56afdfe38!2sBox%20City!5e0!3m2!1sen!2sus!4v1736973847529!5m2!1sen!2sus" width="100%" height="357" style="border:0; border-radius:20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="location-info" id="west-la">
                            <div class="location-details-img">
                                <div class="location-details">
                                    <h2>West Los Angeles, CA</h2>
                                    <p><span>Address:</span><br>2056 Westwood Blvd Los Angeles, CA 90025</p>
                                    <p><span>Open Hours:</span><br>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 5:00 PM<br>Sunday: 10:00 AM - 4:00 PM</p>
                                    <p><span>Contact Info:</span></p>
                                    <a href="tel:3105043812">
                                        <p class="number">310-504-3812</p>
                                    </a>
                                    <a href="mailto:westla@boxcity.com">
                                        <p>westla@boxcity.com</p>
                                    </a>
                                </div>
                                <div class="location-img">
                                    <img src="public/assets/West-Los-Angeles.png" alt="Van Nuys Location">
                                </div>
                            </div>
                            <div class="location-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d41979.422198360546!2d-118.47558681377659!3d34.05227422461479!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bb99572d9987%3A0xbea3e7dedc804a21!2sBox%20City!5e0!3m2!1sen!2sus!4v1736973739185!5m2!1sen!2sus" width="100%" height="357" style="border:0; border-radius:20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="location-info" id="valencia">
                            <div class="location-details-img">
                                <div class="location-details">
                                    <h2>Valencia, CA</h2>
                                    <p><span>Address:</span><br>23750 Lyons Ave Valencia, CA 9132</p>
                                    <p><span>Open Hours:</span><br>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 5:00 PM<br>Sunday: 10:00 AM - 4:00 PM</p>
                                    <p><span>Contact Info:</span></p>
                                    <a href="tel:6163104335">
                                        <p class="number">616-310-4335</p>
                                    </a>
                                    <a href="mailto:valencia@boxcity.com">
                                        <p>valencia@boxcity.com</p>
                                    </a>
                                </div>
                                <div class="location-img">
                                    <img src="public/assets/Valencia.png" alt="Van Nuys Location">
                                </div>
                            </div>
                            <div class="location-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6585.789506720767!2d-118.550695!3d34.378597!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c28694a9cb1efd%3A0x5d82ed3da618d718!2s23750%20Lyons%20Ave%2C%20Newhall%2C%20CA%2091321!5e0!3m2!1sen!2sus!4v1736976449105!5m2!1sen!2sus" width="100%" height="357" style="border:0; border-radius:20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="location-info" id="pasadena">
                            <div class="location-details-img">
                                <div class="location-details">
                                    <h2>Pasadena, CA</h2>
                                    <p><span>Address:</span><br>1230 E Colorado Blvd Pasadena, CA 91106</p>
                                    <p><span>Open Hours:</span><br>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 5:00 PM<br>Sunday: 10:00 AM - 4:00 PM</p>
                                    <p><span>Contact Info:</span></p>
                                    <a href="tel:6266188607">
                                        <p class="number">626-618-8607</p>
                                    </a>
                                    <a href="mailto:pasadena@boxcity.com">
                                        <p>pasadena@boxcity.com</p>
                                    </a>
                                </div>
                                <div class="location-img">
                                    <img src="public/assets/Pasadena.png" alt="Van Nuys Location">
                                </div>
                            </div>
                            <div class="location-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d40745.22874419687!2d-118.14017942344513!3d34.133509165319786!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c35a6433cf7d%3A0x3981e2f9081936d7!2sBox%20City!5e0!3m2!1sen!2sus!4v1736973648810!5m2!1sen!2sus" width="100%" height="357" style="border:0; border-radius:20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="location-info" id="marina-del-rey">
                            <div class="location-details-img">
                                <div class="location-details">
                                    <h2>Marina Del Rey, CA</h2>
                                    <p><span>Address:</span><br>4051 Lincoln Blvd Marina Del Rey, CA 90292</p>
                                    <p><span>Open Hours:</span><br>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 5:00 PM<br>Sunday: 10:00 AM - 4:00 PM</p>
                                    <p><span>Contact Info:</span></p>
                                    <a href="tel:3105043907">
                                        <p class="number">310-504-3907</p>
                                    </a>
                                    <a href="mailto:marina@boxcity.com">
                                        <p>marina@boxcity.com</p>
                                    </a>
                                </div>
                                <div class="location-img">
                                    <img src="public/assets/Marina-Del-Rey.png" alt="Van Nuys Location">
                                </div>
                            </div>
                            <div class="location-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13232.72191675709!2d-118.45519996900559!3d33.98789774319579!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2ba863d4f7119%3A0xbfe5d23f222fbaba!2sBox%20City!5e0!3m2!1sen!2sus!4v1736973566040!5m2!1sen!2sus" width="100%" height="357" style="border:0; border-radius:20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="location-info" id="canoga-park">
                            <div class="location-details-img">
                                <div class="location-details">
                                    <h2>Canoga Park, CA</h2>
                                    <p><span>Address:</span><br>7008 Topanga Canyon Blvd Canoga Park, CA 91303</p>
                                    <p><span>Open Hours:</span><br>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 5:00 PM<br>Sunday: 10:00 AM - 4:00 PM</p>
                                    <p><span>Contact Info:</span></p>
                                    <a href="tel:8188044069">
                                        <p class="number">818-804-4069</p>
                                    </a>
                                    <a href="mailto:canogapark@boxcity.com">
                                        <p>canogapark@boxcity.com</p>
                                    </a>
                                </div>
                                <div class="location-img">
                                    <img src="public/assets/Canoga-Park.png" alt="Van Nuys Location">
                                </div>
                            </div>
                            <div class="location-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6599.960237051793!2d-118.60797253155526!3d34.19798438844048!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c29c3e61249923%3A0x759170cb3cb66118!2sBox%20City!5e0!3m2!1sen!2sus!4v1736973493138!5m2!1sen!2sus" width="100%" height="357" style="border:0; border-radius:20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="location-info" id="glendale">
                            <div class="location-details-img">
                                <div class="location-details">
                                    <h2>Glendale, CA</h2>
                                    <p><span>Address:</span><br><a href="https://maps.app.goo.gl/GiGwsvZFyAw3u6rR8">456 W Broadway, Glendale, CA, 91204</a></p>
                                    <p><span>Open Hours:</span><br>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 5:00 PM<br>Sunday: 10:00 AM - 4:00 PM</p>
                                    <p><span>Contact Info:</span></p>
                                    <a href="tel:8188044122">
                                        <p class="number">818-804-4122</p>
                                    </a>
                                    <a href="mailto:glendale@boxcity.com">
                                        <p>glendale@boxcity.com</p>
                                    </a>
                                </div>
                                <div class="location-img">
                                    <img src="public/assets/Glendale.png" alt="Van Nuys Location">
                                </div>
                            </div>
                            <div class="location-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1651.0079096823806!2d-118.26504053050958!3d34.14593739613534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c29752b796dabf%3A0xd4c75b75663f04dd!2sBox%20City!5e0!3m2!1sen!2s!4v1736973427237!5m2!1sen!2s" width="100%" height="357" style="border:0; border-radius:20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="location-info" id="azusa">
                            <div class="location-details-img">
                                <div class="location-details">
                                    <h2>Azusa, CA</h2>
                                    <p><span>Address:</span><br><a href="https://maps.app.goo.gl/5WYnCwEubG9izXfg9">850 W Foothill Blvd Unit 1 & 35 Azusa, CA 91702</a></p>
                                    <p><span>Open Hours:</span><br>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 5:00 PM<br>Sunday: 10:00 AM - 4:00 PM</p>
                                    <p><span>Contact Info:</span></p>
                                    <a href="tel:6267210331">
                                        <p class="number">626-721-0331</p>
                                    </a>
                                    <a href="mailto:azusa@boxcity.com">
                                        <p>azusa@boxcity.com</p>
                                    </a>
                                </div>
                                <div class="location-img">
                                    <img src="public/assets/AZUSA.png" alt="Van Nuys Location">
                                </div>
                            </div>
                            <div class="location-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3302.5181549683266!2d-117.9177722!3d34.1330834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c3278c1f1fd1e9%3A0x4d813a96147bf201!2s850%20W%20Foothill%20Blvd%2C%20Azusa%2C%20CA%2091702%2C%20USA!5e0!3m2!1sen!2s!4v1739806970257!5m2!1sen!2s" width="100%" height="357" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
