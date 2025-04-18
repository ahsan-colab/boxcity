<!-- Floating Cart Icon -->
<a href="{{ route('cart') }}">
    <div class="cart-icon">
        <!-- Cart SVG Icon -->
        <svg class="icon-default" width="36" height="30" viewBox="0 0 36 30" xmlns="http://www.w3.org/2000/svg">
            <g fill="none" fill-rule="evenodd">
                <!-- Bag Shape -->
                <path d="M7 7h22v18a4 4 0 0 1-4 4H11a4 4 0 0 1-4-4V7z" stroke="currentColor" stroke-width="2"></path>

                <!-- Lock Handle -->
                <path d="M13 10V6c0-2.993 2.009-5 5-5s5 2.026 5 5v4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </g>
        </svg>
        <!-- Cart Item Counter -->
        <div class="cart-counter">0</div>
    </div>
</a>
