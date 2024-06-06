<?php

function fetchUnitsDataFromApi($url, $headers)
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
        $return_data = new stdClass();
        $return_data->status = 400;
        $return_data->units = Array();
        return $return_data;
    }

    $processedData = array();

    if (isset($data['units']) && is_array($data['units'])) {
        foreach ($data['units'] as $unit) {
            $unit_amenities = array();
            if (isset($unit['unit_amenities']) && is_array($unit['unit_amenities'])) {
                foreach ($unit['unit_amenities'] as $amenity) {
                    $unit_amenities[] = $amenity['name'];
                }
            }
            $processedData[] = array(
                'id' => $unit['id'],
                'name' => $unit['name'],
                'description' => $unit['description'],
                'size' => $unit['size'],
                'price' => $unit['price'],
                'unit_amenities' => implode(', ', $unit_amenities),
                'available_for_move_in' => $unit['available_for_move_in'],
                'status' => $unit['status'],
                'unit_type' => $unit['unit_type'],
                'length' => $unit['length'],
                'width' => $unit['width'],
                'height' => $unit['height'],
                'original_price' =>   $unit['original_price'] ?? 0,
                'standard_rate' => $unit['standard_rate'],
                'managed_rate' => $unit['managed_rate'],
            );
        }
    }

    $response = new stdClass();
    $response->units = $processedData;

    if(count($response->units) == 0){
        $response->status = 404;
        return $response;
    }

    $response->status = 200;
    return $response;
}
