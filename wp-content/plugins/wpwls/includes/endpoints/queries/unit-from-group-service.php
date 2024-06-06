<?php

function fetchUnitDetailsFromGroupDataFromApi($url, $headers)
{
    $response = wp_remote_get($url, array(
        'headers' => $headers
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

    // Check if units data exists and is an array
    if (isset($data['units']) && is_array($data['units'])) {
        // Find the first unit with available_for_move_in: true
        foreach ($data['units'] as $unit) {
            if ($unit['available_for_move_in'] === true) {
                // Return the first available unit
                $returnUnit = new stdClass;
                $returnUnit->unit = $unit;
                $returnUnit->unit['standard_rate'] = number_format( $unit['standard_rate'],2);
                $returnUnit->unit['price'] = number_format( $unit['price'],2);
                $returnUnit->status = 200;
                return $returnUnit;
            }
        }
    }

    $returnUnit = new stdClass;
    $returnUnit->status = 404;
    $returnUnit->data = $data;
    // No available units found
    return $returnUnit;
}
