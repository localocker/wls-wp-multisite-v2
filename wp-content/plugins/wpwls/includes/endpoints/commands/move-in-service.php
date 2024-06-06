<?php
function createJsonMoveIn($formData)
{
    $payment_method = array(
        'kind' => $formData['kind'],
        'reuseable' => true,
        'autopay_enabled' => true,
        'autopay_day' => isset($formData['autopay_day']) ? $formData['autopay_day'] : 5,
        'first_name' => $formData['first_name'],
        'last_name' => $formData['last_name'],
        'billing_address_attributes' => array(
            'address1' => (isset($formData['address1_ach']) && $formData['kind'] === 'ach' && $formData['address1_ach'] !== null) ? $formData['address1_ach'] : $formData['address1'],
            'address2' => (isset($formData['address2_ach']) && $formData['kind'] === 'ach' && $formData['address2_ach'] !== null) ? $formData['address2_ach'] : $formData['address2'],
            'city' => (isset($formData['city_ach']) && $formData['kind'] === 'ach' && $formData['city_ach'] !== null) ? $formData['city_ach'] : $formData['city'],
            'state' => (isset($formData['state_ach']) && $formData['kind'] === 'ach' && $formData['state_ach'] !== null) ? $formData['state_ach'] : $formData['state'],
            'postal' => (isset($formData['postal_ach']) && $formData['kind'] === 'ach' && $formData['postal_ach'] !== null) ? $formData['postal_ach'] : $formData['postal'],
            'country' => (isset($formData['country_ach']) && $formData['kind'] === 'ach' && $formData['country_ach'] !== null) ? $formData['country_ach'] : (isset($formData['country']) ? $formData['country'] : 'US'),
        ),
    );

    if ($formData['kind'] === 'credit_card') {
        $payment_method['card_type'] = $formData['card_type'];
        $payment_method['card_number'] = $formData['card_number'];
        $payment_method['security_code'] = $formData['security_code'];
        $payment_method['expiration_date'] = $formData['expiration_date'];
    } elseif ($formData['kind'] === 'ach') {
        $payment_method['account_number'] = isset($formData['ach_account_number']) ? $formData['ach_account_number'] : null;
        $payment_method['account_number_confirmation'] = isset($formData['ach_account_number_confirmation']) ? $formData['ach_account_number_confirmation'] : $formData['ach_account_number'];
        $payment_method['account_type'] = isset($formData['ach_account_type']) ? $formData['ach_account_type'] : null;
        $payment_method['bank_name'] = isset($formData['ach_bank_name']) ? $formData['ach_bank_name'] : null;
        $payment_method['routing_number'] = isset($formData['ach_routing_number']) ? $formData['ach_routing_number'] : null;
    }

    return array(
        'payment_method' => $payment_method,
        'move_in' => array(
            'unit_id' => $formData['unit_id'],
            'insurance_id' => $formData['insurance_id'],
            'gate_access_code' => $formData['gate_access_code'],
            'insurance_id' => $formData['insurance_id'],
            'discount_plans' => $formData['discount_plans'],
            'tenant_id' => isset($formData['tenant_id']) ? $formData['tenant_id'] : (isset($formData['id']) ? $formData['id'] : null),
            'tenant' => array(
                'first_name' => $formData['first_name'],
                'last_name' => $formData['last_name'],
                'password' => $formData['password'],
                'email' => $formData['email'],
                'is_military' => $formData['is_military'],
                'date_of_birth' => $formData['drivers_license_date_of_birth'],
                'drivers_license_number' => $formData['drivers_license_number'],
                'drivers_license_state' => $formData['drivers_license_state'],
                'mailing_address_attributes' => array(
                    'address1' => $formData['address1'],
                    'address2' => $formData['address2'],
                    'city' => $formData['city'],
                    'state' => $formData['state'],
                    'postal' => $formData['postal'],
                    'country' => isset($formData['country']) ? $formData['country'] : 'US',
                ),
                'military_information' => array(
                    'branch_of_service' => $formData['branch_of_service'],
                ),
                'phone_numbers_attributes' => array(
                    array(
                        'number' => $formData['phone'],
                        'sms_opt_in' => true,
                    ),
                ),
                'contact_attributes' => array(
                    'first_name' => $formData['first_name'],
                    'last_name' => $formData['last_name'],
                    'email' => $formData['email'],
                    'primary' => true,
                ),
            ),
        ),
    );
}

// Function to validate form data
function validateMoveInFormData($formData)
{
    if ($formData['kind'] === 'ach') {
        $requiredFields = array(
            'first_name', 'last_name', 'kind', 'ach_account_number', 'ach_account_type', 'ach_bank_name', 'ach_routing_number',
        );
    } else {

        $requiredFields = array(
            'first_name', 'last_name', 'card_type', 'card_number', 'security_code', 'expiration_date',
            'address1', 'city', 'state', 'postal', 'unit_id', 'gate_access_code', 'password',
        );
    }

    foreach ($requiredFields as $field) {
        if (!isset($formData[$field])) {
            return ucfirst(str_replace("_", " ", $field)) . " is required";
        }
    }
}
// Function to make HTTP POST request
function fetchMoveInDataFromApi($formData, $url, $headers)
{
    try {
        // Decode form data
        $formDataArray = json_decode($formData, true);

        // Validate form data
        $validationError = validateMoveInFormData($formDataArray);

        if ($validationError) {
            throw new Exception($validationError);
        }

        // Create payload
        $payload = json_encode(createJsonMoveIn($formDataArray));

        // Make API request
        $response = wp_remote_post($url, array(
            'headers' => $headers,
            'body' => $payload,
            'timeout' => 60,
        ));

        if (is_wp_error($response)) {
            // Send status 400 with the error message and data in the response body
            $error_message = 'Error occurred while making API request';
            $error_details = array(
                'status' => 400,
                'error' => $error_message,
                'data' => $formDataArray,
                'original_response' => $response
            );
            return json_encode(array_merge(json_decode($response->get_error_message(), true), $error_details));
        }

        $body = wp_remote_retrieve_body($response);
        // Return the response body directly
        return $body;
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        error_log("Error: " . $error_message);
        // Send status 400 with the error message and data in the response body
        return json_encode(array('status' => 400, 'error' => "[NewMoveInService] Failed to Move-In " . $error_message, 'data' => $formDataArray));
    }
}
