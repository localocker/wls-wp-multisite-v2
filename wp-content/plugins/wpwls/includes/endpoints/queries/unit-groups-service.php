<?php

/**
 * Fetch unit groups data from an API endpoint.
 *
 * @param string $url The URL of the API endpoint.
 * @param array $headers Headers to include in the request.
 * @return stdClass|null An object containing unit groups data, or null on failure.
 */
function fetchUnitGroupsDataFromApi($url, $headers)
{
    // Make the API request
    $response = wp_remote_get($url, array('headers' => $headers));

    // Check for errors
    if (is_wp_error($response)) {
        $responseObj = new stdClass;
        $responseObj->unit_groups = $response;
        $responseObj->status = 404;
        return $responseObj; // Handle error
    }

    // Get the response body
    $body = wp_remote_retrieve_body($response);

    // Decode JSON response
    $data = json_decode($body, true);

    // Check if decoding was successful
    if ($data === null) {
        $responseObj = new stdClass;
        $responseObj->unit_groups = $data;
        $responseObj->status = 404;
        return $responseObj; // Handle JSON decoding error
    }

    // Check if response contains unit_groups data
    if (!isset($data['unit_groups']) || !is_array($data['unit_groups'])) {
        $responseObj = new stdClass;
        $responseObj->unit_groups = $data;
        $responseObj->status = 404;
        return $responseObj;
    }

    // Process unit_groups data
    $processedData = [];
    foreach ($data['unit_groups'] as $unit_group) {
        $promo_text = null; // Initialize promo_text
        // Loop through discount_plans to find the first one with public_description filled
        foreach ($unit_group['discount_plans'] as $discount_plan) {
            if (!empty($discount_plan['public_description'])) {
                $promo_text = $discount_plan['public_description'];
                break; // Stop looping once public_description is found
            }
        }
        $processedData[] = [
            'id' => $unit_group['id'],
            'price' => number_format( $unit_group['price'], 2),
            'group_key' => $unit_group['group_key'],
            'name' => $unit_group['name'],
            'available_units_count' => $unit_group['available_units_count'],
            'total_units_count' => $unit_group['total_units_count'],
            'total_non_excluded_units_count' => $unit_group['total_non_excluded_units_count'],
            'size' => $unit_group['size'],
            'standard_rate' => number_format($unit_group['standard_rate'], 2),
            'floor' => $unit_group['floor'],
            'reduced_price' =>  number_format( $unit_group['reduced_price'], 2),
            'unit_description' => $unit_group['description'],
            'width' => $unit_group['width'],
            'height' => $unit_group['height'],
            'length' => $unit_group['length'],
            'area' => $unit_group['area'],
            'available_for_move_in' =>  $unit_group['available_units_count'] > 0 ? true : false,
            'reservation_fee' => $unit_group['reservation_fee'],
            'promo_text' => $promo_text, // Assign promo_text,
            'unit_type' => isset($unit_group['unit_type']['name']) ? $unit_group['unit_type']['name'] : "N/A",
        ];
    }

    // Create response object
    $responseObj = new stdClass;
    $responseObj->unit_groups = $processedData;
    $responseObj->status = 200;

    return $responseObj;
}
