<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    | Rute atau jalur yang akan mengaktifkan CORS. Gunakan wildcard seperti `*`
    | atau tetapkan rute spesifik, seperti `api/*`.
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    /*
    |--------------------------------------------------------------------------
    | Allowed Methods
    |--------------------------------------------------------------------------
    |
    | Metode HTTP yang diizinkan. Gunakan `['*']` untuk mengizinkan semua metode.
    |
    */

    'allowed_methods' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Allowed Origins
    |--------------------------------------------------------------------------
    |
    | Domain asal yang diizinkan. Gunakan `['*']` untuk mengizinkan semua domain.
    | Gunakan daftar domain spesifik jika perlu.
    |
    */

    'allowed_origins' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Allowed Origins Patterns
    |--------------------------------------------------------------------------
    |
    | Pola asal menggunakan ekspresi reguler. Misalnya: `['*.example.com']`
    |
    */

    'allowed_origins_patterns' => [],

    /*
    |--------------------------------------------------------------------------
    | Allowed Headers
    |--------------------------------------------------------------------------
    |
    | Header yang diizinkan dalam permintaan CORS. Gunakan `['*']` untuk mengizinkan semua.
    |
    */

    'allowed_headers' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Exposed Headers
    |--------------------------------------------------------------------------
    |
    | Header tambahan yang dapat diakses oleh klien.
    |
    */

    'exposed_headers' => [],

    /*
    |--------------------------------------------------------------------------
    | Max Age
    |--------------------------------------------------------------------------
    |
    | Lama waktu cache CORS di sisi klien (dalam detik).
    |
    */

    'max_age' => 0,

    /*
    |--------------------------------------------------------------------------
    | Supports Credentials
    |--------------------------------------------------------------------------
    |
    | Apakah mengizinkan pengiriman cookie lintas asal.
    |
    */

    'supports_credentials' => false,

];
