<?php

function fetchPromotionalCodeDataFromApi($url, $headers)
{


    $response = wp_remote_get($url, array(
        'headers' => $headers,
    ));

    if (is_wp_error($response)) {
        // Handle error
        return null;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);


    if ($data === null) {
        // Handle JSON decoding error
        return null;
    }

    return $data;
}