<?php

// Function to create JSON for new lead
function createJsonNewLead($formData)
{
    $discount_plans = (!empty($formData['discount_plan_id'])) ? array(array('id' => $formData['discount_plan_id'])) : array();

    return array(
        'payment_method' => array(
            'kind' => $formData['kind'],
            'reuseable' => true,
            'autopay_enabled' => true,
            'autopay_day' => isset($formData['autopay_day']) ? $formData['autopay_day'] : 5,
            'first_name' => $formData['first_name'],
            'last_name' => $formData['last_name'],
            'card_type' => $formData['card_type'],
            'card_number' => $formData['card_number'],
            'security_code' => $formData['security_code'],
            'expiration_date' => $formData['expiration_date'],
            'billing_address_attributes' => array(
                'address1' => $formData['address1'],
                'city' => $formData['city'],
                'state' => $formData['state'],
                'postal' => $formData['postal'],
                'country' => isset($formData['country']) ? $formData['country'] : 'US',
            ),
        ),
        'lead' => array(
            'notes_attributes' => array(
                array(
                    'note' => 'desired move in date -> ' . $formData['desired_move_in_date'] . ' |  expected time to stay -> ' . $formData['expect_move_in'],
                )
            ),
            'is_reservation' => false,
            'desired_move_in_date' => $formData['desired_move_in_date'],
            'unit_id' => $formData['unit_id'],
            'discount_plans' => $discount_plans,
            'tenant_attributes' => array(
                'first_name' => $formData['first_name'],
                'last_name' => $formData['last_name'],
                'email' => $formData['email'],
                'password' => $formData['password'],
                'is_military' => isset($formData['is_military']) ? $formData['is_military'] : false,
                'is_business' => isset($formData['is_business']) ? $formData['is_business'] : false,
                'date_of_birth' => $formData['drivers_license_date_of_birth'],
                'phone_numbers_attributes' => array(
                    array(
                        'number' => $formData['phone'],
                        'sms_opt_in' => true
                    )
                ),
                'mailing_address_attributes' => array(
                    'address1' => $formData['address1'],
                    'address2' => isset($formData['address2']) ? $formData['address2'] : '',
                    'city' => $formData['city'],
                    'state' => $formData['state'],
                    'postal' => $formData['postal']
                )
            )
        )
    );
}

// Function to validate form data
function validateFormData($formData)
{
    $requiredFields = array(
        'first_name', 'last_name', 'email', 'phone', 'desired_move_in_date',
    );

    foreach ($requiredFields as $field) {

        if (!isset($formData[$field])) {
            return (str_replace("_", " ", $field) . " is required");
        }
    }
}

// Function to make HTTP POST request
// Function to make HTTP POST request
function fetchLeadDataFromApi($formData, $url, $headers)
{

    try {
        // Convert $formData object to an associative array
        $formDataArray = json_decode($formData, true);

        // Validate form data
        $validationError = validateFormData($formDataArray);
        if ($validationError) {
            throw new Exception($validationError);
        }

        // Create payload
        $payload = json_encode(createJsonNewLead($formDataArray));

        // Make API request
        $response = wp_remote_post($url, array(
            'headers' => $headers,
            'body' => $payload
        ));

        if (is_wp_error($response)) {
            throw new Exception("Error occurred while making API request");
        }

        $body = wp_remote_retrieve_body($response);

        $data = json_decode($body, true);


        if (!$data || !isset($data['lead'])) {
            // echo $body;
            return ($data);
        }

        return isset($data['lead']['tenant']) ? $data['lead']['tenant'] : $data['lead'];
    } catch (Exception $e) {

        $error_message = $e->getMessage();

        error_log("Error: " . $error_message);
        return ("[NewLeadService] Failed to create a Lead: " . $error_message);
    }
}
