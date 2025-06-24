<!-- Quote Section -->
<section class="quote" id="quote">
    <div class="container">
        <div class="row">

            <!-- Quote Form Column -->
            <div class="col-sm-7">
                <h2>Get a Free Quote</h2>
                <p>We Can Help With All Your Packing &amp; Shipping Needs.</p>
                <p>Fill out the form to inquire about our services and a team member will get back to you with a free quote</p>

                <!-- Contact Form (WordPress CF7 Style) -->
                <form action="{{ route('submit.contact') }}" method="post" class="wpcf7-form init"
                      aria-label="Contact form"  data-status="init">
                    @csrf
                    <div style="display: none;">
                        <input type="hidden" name="_wpcf7" value="122">
                        <input type="hidden" name="_wpcf7_version" value="6.0.4">
                        <input type="hidden" name="_wpcf7_locale" value="en_US">
                        <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f122-o1">
                        <input type="hidden" name="_wpcf7_container_post" value="0">
                        <input type="hidden" name="_wpcf7_posted_data_hash" value="">
                    </div>

                    <!-- Input Fields -->
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="wpcf7-form-control-wrap" data-name="your-name">
                                <input type="text" name="your-name" maxlength="400" size="40"
                                       class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                       aria-required="true" aria-invalid="false" placeholder="Full Name" required>
                            </span>
                        </div>

                        <div class="col-sm-6">
                            <span class="wpcf7-form-control-wrap" data-name="your-company">
                                <input type="text" name="your-company" maxlength="400" size="40"
                                       class="wpcf7-form-control wpcf7-text"
                                       aria-invalid="false" placeholder="Company Name (Optional)" required>
                            </span>
                        </div>

                        <div class="col-sm-6">
                            <span class="wpcf7-form-control-wrap" data-name="your-email">
                                <input type="email" name="your-email" maxlength="400" size="40"
                                       class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email"
                                       aria-required="true" aria-invalid="false" placeholder="Email" required>
                            </span>
                        </div>

                        <div class="col-sm-6">
                            <span class="wpcf7-form-control-wrap" data-name="your-phone">
                                <input type="text" name="your-phone" maxlength="400" size="40"
                                       class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                       aria-required="true" aria-invalid="false" placeholder="Phone Number" required>
                            </span>
                        </div>
                    </div>

                    <!-- Services Dropdown -->
                    <span class="wpcf7-form-control-wrap" data-name="select-service">
                        <select name="select-service" class="wpcf7-form-control wpcf7-select" aria-invalid="false" required>
                            <option value="What Services Would You Want To Inquire About?">What Services Would You Want To Inquire About?</option>
                            <option value="Moving Supplies in Van Nuys">Moving Supplies in Van Nuys</option>
                            <option value="Corrugated Boxes in Van Nuys">Corrugated Boxes in Van Nuys</option>
                            <option value="Packing Peanuts in Van Nuys">Packing Peanuts in Van Nuys</option>
                            <option value="mailing Tubes in Van Nuys">Mailing Tubes in Van Nuys</option>
                            <option value="bubble Wrap in Van Nuys">Bubble Wrap in Van Nuys</option>
                            <option value="packing Supplies in Van Nuys">Packing Supplies in Van Nuys</option>
                        </select>
                    </span>
                    <br>

                    <!-- Message Box -->
                    <span class="wpcf7-form-control-wrap" data-name="your-message">
                        <textarea name="your-message" cols="40" rows="10" maxlength="2000"
                                  class="wpcf7-form-control wpcf7-textarea"
                                  aria-invalid="false" placeholder="Message"></textarea>
                    </span>

                    <!-- Submit Button -->
                    <div class="mobile-center">
                        <input type="submit" value="Submit Your Message"
                               class="wpcf7-form-control wpcf7-submit has-spinner">
                        <span class="wpcf7-spinner"></span>
                    </div>

                    <!-- Form Response Placeholder -->
                    <div class="wpcf7-response-output" aria-hidden="true"></div>
                </form>
            </div>

            <!-- Video Column -->
            <div class="col-sm-5">
                <video autoplay muted loop>
                    <source src="{{ asset('public/assets/video.mp4') }}" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</section>
