<?php

// Function to create JSON for move-in review cost
function createJsonMoveInReviewCost($formData)
{
    return array(
        'move_in' => array(
            'unit_id' => $formData['unit_id'],
            'invoice_period' => 'monthly' ,
            'insurance_id' => $formData['insurance_id'],
            'discount_plans' => $formData['discount_plans'],
            'services' => $formData['services'],
            // 'move_in_date' => $formData['desired_move_in_date'],
            'lead' => null
        )
    );
}

// Function to make HTTP POST request for move-in review cost
function fetchMoveInReviewCostDataFromApi($formData, $url, $headers)
{
    // try {
        // Create payload
        $payload = json_encode(createJsonMoveInReviewCost(json_decode($formData,true)));

        // Make API request
        $response = wp_remote_post($url, array(
            'headers' => $headers,
            'body' => $payload,
            'timeout' => 600,
        ));

        if (is_wp_error($response)) {
            echo $response->get_error_message();

            throw new Exception("Error occurred while making API request");
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (!$data || !isset($data['move_in_unit_event'])) {
            return $data;
        }

        // return $data['move_in_unit_event'];
        return $data;
    // } catch (Exception $e) {
    //     $error_message = $e->getMessage();
    //     error_log("Error: " . $error_message);
    //     echo $error_message;
    //     return "[MoveInReviewCostService] Failed to fetch move-in review cost: " . $error_message;
    // }
}
