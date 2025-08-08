<div class="location-details-img">
    <div class="location-details">
        <h2>{{ $name }}</h2>
        <p><span>Address:</span><br><a href="{{$url}}">{{ $address }}</a></p>
        <p><span>Open Hours:</span><br>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00
            AM - 5:00 PM<br>Sunday: 10:00 AM - 4:00 PM</p>
        <p><span>Contact Info:</span></p>
        <a href="tel:{{ $phone }}">
            <p class="number">{{ $phone }}</p>
        </a>
        <a href="mailto:{{ $email }}">
            <p>{{ $email }}</p>
        </a>
    </div>
    <div class="location-img">
        <img src="{{ asset('public/assets/' . $img) }}" alt="{{ $name }} Location">
    </div>
</div>
<div class="location-map">
    <iframe src="{{ $map }}" width="100%" height="357" style="border:0; border-radius:20px;" allowfullscreen=""
            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
