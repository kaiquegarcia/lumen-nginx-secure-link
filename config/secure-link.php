<?php

return [
    'secret' => env('NGINX_SECURE_LINK_SECRET', 'adeepsecret'),
    'ttl' => env('NGINX_SECURE_LINK_TTL', 21600),
];
