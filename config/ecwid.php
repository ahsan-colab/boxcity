<?php

return [
    /**
     * Ecwid API configuration
     */
    'api_base_url' => env('ECWID_API_BASE_URL', 'https://app.ecwid.com/api/v3/109333282'),
    'access_token' => env('ECWID_ACCESS_TOKEN', 'secret_Asd3RgYgyNkGaKhN3hke67RHyAkigTXG'),
    'category_id' => env('ECWID_CATEGORY_ID', 174055330), // Category ID for filtering (default as per Corrugated Category)
    'limit' => env('ECWID_API_LIMIT', 100), // Default limit of products per request
];
