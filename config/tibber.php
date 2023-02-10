<?php

// config for Arnebr/Tibber
return [
    /* Get token from developer.tibber.com
    */
    'api_url' => 'https://api.tibber.com/v1-beta/gql',
    'token' => env('TIBBER_TOKEN', '5K4MVS-OjfWhK_4yrjOlFe1F6kJXPVf7eQYggo8ebAE'),
    'homeId' => env('TIBBER_HOMEID', null),
];
