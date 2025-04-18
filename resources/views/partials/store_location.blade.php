<!-- LOCATIONS SECTION -->
<section class="locations-sec">
    <div class="container">
        <div class="row">

            <!-- LEFT COLUMN: Locations List -->
            <div class="col-md-6">
                <h1>Our Locations</h1>
                <ul class="list-group">
                    <!-- Clickable list items to switch location details -->
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

            <!-- RIGHT COLUMN: Location Details -->
            <div class="col-md-6">
                <div class="location-details">

                    <!-- Each .location-info represents one location block -->
                    <!-- VAN NUYS -->
                    <div class="location-info active" id="van-nuys">
                        @include('partials.location_template', [
                            'name' => 'Van Nuys, CA',
                            'address' => '16113 Sherman Way, Van Nuys, CA 91406',
                            'phone' => '8189388327',
                            'email' => 'vannuys@boxcity.com',
                            'img' => 'Van-Nuys-Img.png',
                            'map' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6599.685108490089!2d-118.48429!3d34.201499!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c297582574910f%3A0xa211d65f8f346cd7!2s16113%20Sherman%20Way%2C%20Van%20Nuys%2C%20CA%2091406!5e0!3m2!1sen!2sus!4v1736975505697!5m2!1sen!2sus'
                        ])
                    </div>

                    <!-- NORTH HOLLYWOOD -->
                    <div class="location-info" id="north-hollywood">
                        @include('partials.location_template', [
                            'name' => 'North Hollywood, CA',
                            'address' => '12800 Victory Blvd North Hollywood, CA 91606',
                            'phone' => '8189381936',
                            'email' => 'northhollywood@boxcity.com',
                            'img' => 'North-Hollywood.png',
                            'map' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13986.800034444543!2d-118.4220051493121!3d34.18609557420965!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c29715aa9f2bed%3A0x7bbd18b56afdfe38!2sBox%20City!5e0!3m2!1sen!2sus!4v1736973847529!5m2!1sen!2sus'
                        ])
                    </div>

                    <!-- WEST LA -->
                    <div class="location-info" id="west-la">
                        @include('partials.location_template', [
                            'name' => 'West Los Angeles, CA',
                            'address' => '2056 Westwood Blvd Los Angeles, CA 90025',
                            'phone' => '3105043812',
                            'email' => 'westla@boxcity.com',
                            'img' => 'West-Los-Angeles.png',
                            'map' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d41979.422198360546!2d-118.47558681377659!3d34.05227422461479!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bb99572d9987%3A0xbea3e7dedc804a21!2sBox%20City!5e0!3m2!1sen!2sus!4v1736973739185!5m2!1sen!2sus'
                        ])
                    </div>

                    <!-- VALENCIA -->
                    <div class="location-info" id="valencia">
                        @include('partials.location_template', [
                            'name' => 'Valencia, CA',
                            'address' => '23750 Lyons Ave Valencia, CA 9132',
                            'phone' => '6163104335',
                            'email' => 'valencia@boxcity.com',
                            'img' => 'Valencia.png',
                            'map' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6585.789506720767!2d-118.550695!3d34.378597!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c28694a9cb1efd%3A0x5d82ed3da618d718!2s23750%20Lyons%20Ave%2C%20Newhall%2C%20CA%2091321!5e0!3m2!1sen!2sus!4v1736976449105!5m2!1sen!2sus'
                        ])
                    </div>

                    <!-- PASADENA -->
                    <div class="location-info" id="pasadena">
                        @include('partials.location_template', [
                            'name' => 'Pasadena, CA',
                            'address' => '1230 E Colorado Blvd Pasadena, CA 91106',
                            'phone' => '6266188607',
                            'email' => 'pasadena@boxcity.com',
                            'img' => 'Pasadena.png',
                            'map' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d40745.22874419687!2d-118.14017942344513!3d34.133509165319786!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c35a6433cf7d%3A0x3981e2f9081936d7!2sBox%20City!5e0!3m2!1sen!2sus!4v1736973648810!5m2!1sen!2sus'
                        ])
                    </div>

                    <!-- MARINA DEL REY -->
                    <div class="location-info" id="marina-del-rey">
                        @include('partials.location_template', [
                            'name' => 'Marina Del Rey, CA',
                            'address' => '4051 Lincoln Blvd Marina Del Rey, CA 90292',
                            'phone' => '3105043907',
                            'email' => 'marina@boxcity.com',
                            'img' => 'Marina-Del-Rey.png',
                            'map' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13232.72191675709!2d-118.45519996900559!3d33.98789774319579!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2ba863d4f7119%3A0xbfe5d23f222fbaba!2sBox%20City!5e0!3m2!1sen!2sus!4v1736973566040!5m2!1sen!2sus'
                        ])
                    </div>

                    <!-- CANOGA PARK -->
                    <div class="location-info" id="canoga-park">
                        @include('partials.location_template', [
                            'name' => 'Canoga Park, CA',
                            'address' => '7008 Topanga Canyon Blvd Canoga Park, CA 91303',
                            'phone' => '8188044069',
                            'email' => 'canogapark@boxcity.com',
                            'img' => 'Canoga-Park.png',
                            'map' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6599.960237051793!2d-118.60797253155526!3d34.19798438844048!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c29c3e61249923%3A0x759170cb3cb66118!2sBox%20City!5e0!3m2!1sen!2sus!4v1736973493138!5m2!1sen!2sus'
                        ])
                    </div>

                    <!-- GLENDALE -->
                    <div class="location-info" id="glendale">
                        @include('partials.location_template', [
                            'name' => 'Glendale, CA',
                            'address' => '456 W Broadway, Glendale, CA, 91204',
                            'phone' => '8188044122',
                            'email' => 'glendale@boxcity.com',
                            'img' => 'Glendale.png',
                            'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1651.0079096823806!2d-118.26504053050958!3d34.14593739613534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c29752b796dabf%3A0xd4c75b75663f04dd!2sBox%20City!5e0!3m2!1sen!2s!4v1736973427237!5m2!1sen!2s'
                        ])
                    </div>

                    <!-- AZUSA -->
                    <div class="location-info" id="azusa">
                        @include('partials.location_template', [
                            'name' => 'Azusa, CA',
                            'address' => '850 W Foothill Blvd Unit 1 & 35 Azusa, CA 91702',
                            'phone' => '6267210331',
                            'email' => 'azusa@boxcity.com',
                            'img' => 'AZUSA.png',
                            'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3302.5181549683266!2d-117.9177722!3d34.1330834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c3278c1f1fd1e9%3A0x4d813a96147bf201!2s850%20W%20Foothill%20Blvd%2C%20Azusa%2C%20CA%2091702%2C%20USA!5e0!3m2!1sen!2s!4v1739806970257!5m2!1sen!2s'
                        ])
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
