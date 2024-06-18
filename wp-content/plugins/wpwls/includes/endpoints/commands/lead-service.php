<?php

// Function to create JSON for new lead
function createJsonNewLead($formData, $existingNotes = null)
{
    // Determine the payment method kind and map accordingly
    $payment_method = array(
        'kind' => $formData['kind'],
        'reuseable' => true,
        'autopay_enabled' => true,
        'autopay_day' => isset($formData['autopay_day']) ? $formData['autopay_day'] : 5,
        'first_name' => $formData['first_name'],
        'last_name' => $formData['last_name'],
    );

    if ($formData['kind'] === 'credit_card') {
        $payment_method = array_merge($payment_method, array(
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
            )
        ));
    } elseif ($formData['kind'] === 'ach') {
        $payment_method = array_merge($payment_method, array(
            'bank_name' => $formData['ach_bank_name'],
            'routing_number' => $formData['ach_routing_number'],
            'account_number' => $formData['ach_account_number'],
            'account_type' => $formData['ach_account_type'],
            'billing_address_attributes' => array(
                'address1' => isset($formData['ach_address1']) ? $formData['ach_address1'] : $formData['address1'],
                'address2' => isset($formData['ach_address2']) ? $formData['ach_address2'] : (isset($formData['address2']) ? $formData['address2'] : ''),
                'city' => isset($formData['ach_city']) ? $formData['ach_city'] : $formData['city'],
                'state' => isset($formData['ach_state']) ? $formData['ach_state'] : $formData['state'],
                'postal' => isset($formData['ach_postal']) ? $formData['ach_postal'] : $formData['postal'],
                'country' => isset($formData['ach_country']) ? $formData['ach_country'] : (isset($formData['country']) ? $formData['country'] : 'US'),
            )
        ));
    }

    $noteText = 'Insurance amount -' . $formData['insurance_amount'] . ' | Insurance ID - ' . $formData['insurance_id'];
    $notes_attributes = array();
    $notes_attributes[] = array('note' => $noteText);

    return array(
        'payment_method' => $payment_method,
        'lead' => array(
            'notes_attributes' => $notes_attributes,
            'is_reservation' => isset($formData['is_reservation']) ? $formData['is_reservation'] : false,
            'desired_move_in_date' => $formData['desired_move_in_date'],
            'unit_id' => $formData['unit_id'],
            'discount_plans' => $formData['discount_plans'],
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

function geLeadDataFromAPI($url, $headers)
{
    try {
        $response = wp_remote_get($url, array(
            'headers' => $headers,
            'timeout' => 60
        ));

        if (is_wp_error($response)) {
            throw new Exception("Error occurred while making API request: " . $response->get_error_message());
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (!$data || !isset($data['lead'])) {
            return $data;
        }

        return $data['lead'];
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        error_log("Error: " . $error_message);
        return "[GETLeadService] Failed to GET Lead: " . $error_message;
    }
}

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

function fetchInitialLeadDataFromApi($formData, $url, $headers)
{
    try {
        $formDataArray = json_decode($formData, true);

        $validationError = validateFormData($formDataArray);
        if ($validationError) {
            throw new Exception($validationError);
        }

        // Ensure 'kind' is set or provide a default value
        if (!isset($formDataArray['kind'])) {
            $formDataArray['kind'] = 'default_value'; // Provide a sensible default or handle accordingly
        }

        $payload = json_encode(createJsonNewLead($formDataArray));
        error_log("Payload: " . $payload);

        $response = wp_remote_post($url, array(
            'headers' => $headers,
            'body' => $payload,
            'timeout' => 60 
        ));


        if (is_wp_error($response)) {
            throw new Exception("Error occurred while making API request: " . $response->get_error_message());
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (!$data || !isset($data['lead'])) {
            error_log("Response Body: " . $body);
            return $data;
        }

        return $data['lead'];
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        error_log("Error: " . $error_message);
        return "[NewLeadService] Failed to create a Lead: " . $error_message;
    }
}

function fetchPUTLeadDataFromApi($formData, $url, $headers)
{
    try {
        // Convert $formData object to an associative array
      
        $formDataArray = json_decode($formData, true);

        // Validate form data
        $validationError = validateFormData($formDataArray);
        if ($validationError) {
            throw new Exception($validationError);
        }

        // Fetch existing notes
        // $existingNotes = getExistingNotesFromAPI($facility_id, $formDataArray['tenant_id'], $plugin_instance);
        // // Check if the response from getExistingNotesFromAPI is an error or HTML
        // if (is_string($existingNotes) && strpos($existingNotes, '<') !== false) {
        //     throw new Exception("Error fetching existing notes: " . $existingNotes);
        // }

        // Create payload with existing notes
        $payload = json_encode(createJsonNewLead($formDataArray));

        // Make API request
        $response = wp_remote_request($url, array(
            'method' => 'PUT',
            'headers' => $headers,
            'body' => $payload,
            'timeout' => 60
        ));

        // Log the response for debugging

        if (is_wp_error($response)) {
            throw new Exception("Error occurred while making API request: " . $response->get_error_message());
        }

        $body = wp_remote_retrieve_body($response);

        // Log the response body
        error_log("Response Body: " . $body);

        $data = json_decode($body, true);

        if (!$data || !isset($data['lead'])) {
            // Log the response body if it doesn't contain expected data
            error_log("Response Body: " . $body);
            return $data;
        }

        return $data['lead'];
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        error_log("Error: " . $error_message);
        return "[NewLeadService] Failed to update a Lead: " . $error_message;
    }
}

// function getExistingNotesFromAPI($facility_id, $tenant_id, $plugin_instance)
// {
//     $url = "https://api.storedgefms.com/v1/$facility_id/tenants/$tenant_id/notes";
//     $headers = getRequestHeaders($url, 'GET', $plugin_instance);

//     try {
//         $response = wp_remote_get($url, array(
//             'headers' => $headers,
//             'timeout' => 60
//         ));

//         if (is_wp_error($response)) {
//             throw new Exception("Error occurred while fetching existing notes: " . $response->get_error_message());
//         }

//         $body = wp_remote_retrieve_body($response);
//         $data = json_decode($body, true);

//         if (!$data || !isset($data['notes'])) {
//             return array();
//         }

//         return $data['notes'];
//     } catch (Exception $e) {
   
//         $error_message = $e->getMessage();
//         error_log("Error: " . $error_message);
//         return array();
//     }
// }

