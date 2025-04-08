<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') </title>
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('public/js/script.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

<?php

$site_url = env('SITE_URL');
$home_url = env ('HOME_URL');
?>

<header>
    <div class="container-fluid">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-2 col-6">
                <a href="#">
                    <img src="<?php echo $home_url?>/public/assets/header-logo.png" alt="logo">
                </a>
            </div>

            <div class="col-md-10 col-6 d-flex justify-content-end align-items-center">
                <!-- Hamburger Button -->
                <button class="hamburger d-md-none" id="hamburger-btn">
                    ☰
                </button>

                <div class="mobile-menu d-md-none" id="mobile-menu">
                    <button class="close-btn" id="close-menu">✕</button>
                    <ul class="mobile-sub-menu">
                        <li><a href="https://boxcityweb.colabwebdemo.com/b2b-incentives/">Services</a></li>
                        <li><a href="https://boxcityweb.colabwebdemo.com/custom-boxes/">Shop Products</a></li>
                        <li><a href="https://boxcityweb.colabwebdemo.com/custom-tape/">Locations</a></li>
                        <li><a href="https://boxcityweb.colabwebdemo.com/b2b-incentives/">Wholesale / Bulk Orders</a></li>
                        <li><a href="https://boxcityweb.colabwebdemo.com/custom-boxes/">Contact</a></li>
                        <li class="menu-btn"><a href="tel:8009926924">(800) 992-6924</a></li>
                    </ul>
                </div>

                <!-- Full Menu -->
                <nav class="main-nav" id="main-nav">
                    <ul class="sub-menu d-md-flex">
                        <li><a href="https://boxcityweb.colabwebdemo.com/b2b-incentives/">Services</a></li>
                        <li><a href="https://boxcityweb.colabwebdemo.com/custom-boxes/">Shop Products</a></li>
                        <li><a href="https://boxcityweb.colabwebdemo.com/custom-tape/">Locations</a></li>
                        <li><a href="https://boxcityweb.colabwebdemo.com/b2b-incentives/">Wholesale / Bulk Orders</a></li>
                        <li><a href="https://boxcityweb.colabwebdemo.com/custom-boxes/">Contact</a></li>
                        <li class="menu-btn"><a href="tel:8009926924">(800) 992-6924</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-detail">
                    <a href="https://boxcityweb.colabwebdemo.com"><img src="<?php echo $home_url?>/public/assets/footer-logo.png" alt="Logo" width="auto" height="auto">	</a>						 <div class="social-icons">
                        <a href="https://www.facebook.com/OfficialBoxCity/"><img src="<?php echo $home_url?>/public/assets/fb-icon.png" alt="Logo" width="auto" height="auto"></a>
                        <a href="https://www.instagram.com/officialboxcity/?hl=en"><img src="<?php echo $home_url?>/public/assets/insta-icon.png" alt="Logo" width="auto" height="auto"></a>
                        <a href="https://www.linkedin.com/company/boxcitystores/"><img src="<?php echo $home_url?>/public/assets/linkedin-icon.png" alt="Logo" width="auto" height="auto"></a>
                    </div>
                    <p>
                        Box City is L.A.’s premier packing and shipping service for businesses and consumers. Contact us today to pack and ship any item.
                    </p>
                    <div class="phone-numer">
                        <a href="tel:8009926924"><img src="<?php echo $home_url?>/public/assets/phone-icon-1.png" alt="Logo" width="auto" height="auto"> <span>(800) 992-6924</span></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <!--	<div class="col-md-4">-->
                    <!--		<h1>-->
                    <!--			Quick Links-->
                    <!--		</h1>-->
                    <!--		<ul>-->
                    <!--			<li><a href="javascript:void(0)">About Us</a></li>-->
                    <!--			<li><a href="https://boxcityweb.colabwebdemo.com/custom-boxes/">Custom Boxes</a></li>-->
                    <!--			<li><a href="javascript:void(0)">Blog</a></li>-->
                    <!--			<li><a href="javascript:void(0)">Partners</a></li>-->
                    <!--			<li><a href="javascript:void(0)">Affiliate Program</a></li>-->
                    <!--			<li><a href="mailto:info@boxcity.com">Contact Us</a></li>-->
                    <!--			<li><a href="javascript:void(0)">Partnerships</a></li>-->
                    <!--			<li><a href="javascript:void(0)">Shipping & Freight</a></li>-->
                    <!--		</ul>-->
                    <!--</div>-->

                    <div class="col-md-4">
                        <h1>
                            Locations
                        </h1>
                        <ul>
                            <li><a href="https://boxcityweb.colabwebdemo.com/location-van-nuys/">Van Nuys</a></li>
                            <li><a href="https://boxcityweb.colabwebdemo.com/location-north-hollywood/">North Hollywood</a></li>
                            <li><a href="https://boxcityweb.colabwebdemo.com/location-west-los-angeles/">West Los Angeles</a></li>
                            <li><a href="https://boxcityweb.colabwebdemo.com/location-valencia/">Valencia</a></li>
                            <li><a href="https://boxcityweb.colabwebdemo.com/location-pasadena/">Pasadena</a></li>
                            <li><a href="https://boxcityweb.colabwebdemo.com/location-marina-del-rey/">Marina Del Rey</a></li>
                            <li><a href="https://boxcityweb.colabwebdemo.com/location-canoga-park/">Canoga Park</a></li>
                            <li><a href="https://boxcityweb.colabwebdemo.com/location-glendale/">Glendale</a></li>

                            <li><a href="https://boxcityweb.colabwebdemo.com/location-azusa/">Azusa</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h1>
                            Products &amp; Services
                        </h1>
                        <ul>
                            <li><a href="https://boxcityweb.colabwebdemo.com/corrugated-boxes">Corrugated Boxes and Pads</a></li>
                            <li><a href="https://boxcityweb.colabwebdemo.com/moving-boxes-and-supplies/">Moving Boxes and Supplies</a></li>
                            <li><a href="https://boxcityweb.colabwebdemo.com/gift-supplies">Gift Supplies</a></li>
                            <li><a href="https://boxcityweb.colabwebdemo.com/mailing-items/">Mailing Items</a></li>
                            <li><a href="https://boxcityweb.colabwebdemo.com/packing-supplies/">Packing Supplies</a></li>
                            <li><a href="https://boxcityweb.colabwebdemo.com/bags-and-pouches/">Bags &amp; Pouches</a></li>
                        </ul>
                    </div>

                </div>
                <h2>
                    Sign up for tips &amp; tricks
                </h2>
                <div class="emaillist" id="es_form_f3-n1"><form action="/#es_form_f3-n1" method="post" class="es_subscription_form es_shortcode_form  es_ajax_subscription_form" id="es_subscription_form_67cad1bc73b49" data-source="ig-es" data-form-id="3"><input type="hidden" name="esfpx_form_id" value="3"><input type="hidden" name="esfpx_lists[]" value="16874e0f3d36"><input type="hidden" name="es" value="subscribe">
                        <input type="hidden" name="esfpx_es_form_identifier" value="f3-n1">
                        <input type="hidden" name="esfpx_es_email_page" value="8">
                        <input type="hidden" name="esfpx_es_email_page_url" value="https://boxcityweb.colabwebdemo.com/">
                        <input type="hidden" name="esfpx_status" value="Unconfirmed">
                        <input type="hidden" name="esfpx_es-subscribe" id="es-subscribe-67cad1bc73b49" value="6667762871">
                        <label style="position:absolute;top:-99999px;left:-99999px;z-index:-99;" aria-hidden="true"><span hidden="">Please leave this field empty.</span><input type="email" name="esfpx_es_hp_email" class="es_required_field" tabindex="-1" autocomplete="-1" value=""></label><style>form.es_subscription_form[data-form-id="3"] * { box-sizing: border-box; } body {margin: 0;}#esfpx_email_0fe74ada6116e{color:#ffffff;}form[data-form-id="3"] .es-form-field-container .gjs-row{display:flex;justify-content:flex-start;align-items:stretch;flex-wrap:nowrap;}form[data-form-id="3"] .es-form-field-container .gjs-cell{flex-grow:1;flex-basis:100%;}form[data-form-id="3"] .es-form-field-container .gjs-cell[data-highlightable="1"]:empty{border-top-width:1px;border-right-width:1px;border-bottom-width:1px;border-left-width:1px;border-top-style:dashed;border-right-style:dashed;border-bottom-style:dashed;border-left-style:dashed;border-top-color:rgb(204, 204, 204);border-right-color:rgb(204, 204, 204);border-bottom-color:rgb(204, 204, 204);border-left-color:rgb(204, 204, 204);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;height:30px;}form[data-form-id="3"] .es-form-field-container .gjs-row .gjs-cell input[type="checkbox"], form[data-form-id="3"] .es-form-field-container .gjs-row .gjs-cell input[type="radio"]{margin-top:0px;margin-right:5px;margin-bottom:0px;margin-left:0px;width:auto;}form[data-form-id="3"] .es-form-field-container .gjs-row{margin-bottom:0.6em;}form[data-form-id="3"] .es-form-field-container label.es-field-label{display:block;}@media only screen and (max-width: 576px){.gjs-row{display:flex;flex-direction:column;}.gjs-cell img{width:100%;height:auto;}}@media (max-width: 320px){form[data-form-id="3"] .es-form-field-container{padding-top:1rem;padding-right:1rem;padding-bottom:1rem;padding-left:1rem;}}</style><div class="es-form-field-container"><div class="gjs-row"></div><div class="gjs-row"><div class="gjs-cell"><input type="email" required="" class="es-email" name="esfpx_email" autocomplete="email" placeholder="Your email" id="esfpx_email_0fe74ada6116e"><input type="submit" name="submit" value=""></div></div><div class="gjs-row"></div></div><span class="es_spinner_image" id="spinner-image"><img src="https://boxcityweb.colabwebdemo.com/wp-content/plugins/email-subscribers/lite/public/images/spinner.gif" alt="Loading"></span></form><span class="es_subscription_message " id="es_subscription_message_67cad1bc73b49" role="alert" aria-live="assertive"></span></div>
            </div>
        </div>
    </div>
</footer>


<style>

    /* Basic mobile styles */
    .hamburger {
        font-size: 28px;
        background: none;
        border: none;
        cursor: pointer;
        z-index: 1001;
    }

    /* Hide nav by default on small screens */
    #main-nav {
        display: none;
        position: absolute;
        top: 80px; /* adjust depending on your header height */
        right: 0;
        background: #fff;
        width: 100%;
        padding: 20px;
        z-index: 1000;
    }

    #main-nav.open {
        display: block;
    }

    @media (min-width: 1100px) {
        .hamburger {
            display: none;
        }

        #main-nav {
            display: block !important;
            position: static;
            background: transparent;
            width: auto;
            padding: 0;
        }

        .sub-menu {
            flex-direction: row;
            gap: 20px;
            list-style: none;
        }
    }

    .sub-menu li {
        list-style: none;
        margin-bottom: 10px;
    }


</style>

</body>

</html>
