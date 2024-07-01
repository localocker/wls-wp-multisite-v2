<?php

namespace Wpwls;

// Require necessary files
$includes_path = dirname(__FILE__);
require_once $includes_path . '/oauth.php';
require_once $includes_path . '/endpoints/queries/units-service.php';
require_once $includes_path . '/endpoints/queries/unit-details-service.php';
require_once $includes_path . '/endpoints/queries/insurances-service.php';
require_once $includes_path . '/endpoints/queries/promo-code-service.php';
require_once $includes_path . '/endpoints/queries/unit-from-group-service.php';
require_once $includes_path . '/endpoints/queries/unit-groups-service.php';
require_once $includes_path . '/endpoints/commands/lead-service.php';
require_once $includes_path . '/endpoints/commands/move-in-service.php';
require_once $includes_path . '/endpoints/commands/review-cost-service.php';
require_once $includes_path . '/endpoints/queries/units-from-group-service.php';

class Wpwls_JSON_Endpoint
{
    private $plugin_instance;
    private $default_base_url;

    public function __construct(Wpwls $plugin_instance)
    {
        $this->default_base_url = 'https://api.storedgefms.com/v1/';
        $this->plugin_instance = $plugin_instance;


        // Register AJAX actions
        add_action('wp_ajax_units_api', array($this, 'units_api'));
        add_action('wp_ajax_nopriv_units_api', array($this, 'units_api'));
        add_action('wp_ajax_unit_groups_api', array($this, 'unit_groups_api'));
        add_action('wp_ajax_nopriv_unit_groups_api', array($this, 'unit_groups_api'));
        add_action('wp_ajax_unit_details_api', array($this, 'unit_details_api'));
        add_action('wp_ajax_nopriv_unit_details_api', array($this, 'unit_details_api'));
        add_action('wp_ajax_insurances_api', array($this, 'insurances_api'));
        add_action('wp_ajax_nopriv_insurances_api', array($this, 'insurances_api'));
        add_action('wp_ajax_promotional_code_api', array($this, 'promotional_code_api'));
        add_action('wp_ajax_nopriv_promotional_code_api', array($this, 'promotional_code_api'));
        add_action('wp_ajax_lead_api', array($this, 'lead_api'));
        add_action('wp_ajax_nopriv_lead_api', array($this, 'lead_api'));
        add_action('wp_ajax_crm_api', array($this, 'crm_api'));
        add_action('wp_ajax_nopriv_crm_api', array($this, 'crm_api'));
        add_action('wp_ajax_move_in_api', array($this, 'move_in_api'));
        add_action('wp_ajax_nopriv_move_in_api', array($this, 'move_in_api'));
        add_action('wp_ajax_review_cost_api', array($this, 'review_cost_api'));
        add_action('wp_ajax_nopriv_review_cost_api', array($this, 'review_cost_api'));
        add_action('wp_ajax_random_available_unit_from_group_api', array($this, 'random_available_unit_from_group_api'));
        add_action('wp_ajax_nopriv_random_available_unit_from_group_api', array($this, 'random_available_unit_from_group_api'));
        add_action('wp_ajax_units_from_group_api', array($this, 'units_from_group_api'));
        add_action('wp_ajax_nopriv_units_from_group_api', array($this, 'units_from_group_api'));
        add_action('wp_ajax_days_in_future_api', array($this, 'days_in_future_api'));
        add_action('wp_ajax_nopriv_days_in_future_api', array($this, 'days_in_future_api'));
        add_action('wp_ajax_gate_code_check', array($this, 'gate_code_check'));
        add_action('wp_ajax_nopriv_gate_code_check', array($this, 'gate_code_check'));
    }

    private function send_json_response($data, $status_code = 200)
    {
        wp_send_json($data, $status_code);
    }

    private function send_json_error_response($message, $status_code = 400)
    {
        wp_send_json_error($message, $status_code);
    }

    public function units_api()
    {
        if (isset($_GET['units_api']) && $_GET['units_api'] === '1') {
            $options = $this->plugin_instance->get_options_for_json_endpoint();

            $endpoint = '/units';

            $url = $this->default_base_url . $options['api_facility_id'] . $endpoint;
            $headers = getRequestHeaders($url, 'GET', $this->plugin_instance);

            $data = fetchUnitsDataFromApi($url, $headers);
            $this->send_json_response($data, $data->status === 200 ? 200 : 400);
        }
    }

    public function random_available_unit_from_group_api()
    {
        if (isset($_GET['random_available_unit_from_group_api']) && $_GET['random_available_unit_from_group_api'] === '1' && isset($_GET['unit_group_id'])) {
            $options = $this->plugin_instance->get_options_for_json_endpoint();
            $unitGroupId = $_GET['unit_group_id'];

            // Construct the endpoint URL with unit_group_id
            $endpoint = '/unit_groups/';
            $url = $this->default_base_url . $options['api_facility_id'] . $endpoint . $unitGroupId . '/units';

            // Fetch data from the API
            $headers = getRequestHeaders($url, 'GET', $this->plugin_instance);
            $data = fetchUnitDetailsFromGroupDataFromApi($url, $headers);

            // Send JSON response
            $statusCode = $data ? ($data->status === 200 ? 200 : 400) : 400;
            $this->send_json_response($data, $statusCode);
        }
    }

    public function units_from_group_api()
    {
        if (isset($_GET['units_from_group_api']) && $_GET['units_from_group_api'] === '1' && isset($_GET['unit_group_id'])) {
            $options = $this->plugin_instance->get_options_for_json_endpoint();
            $unitGroupId = $_GET['unit_group_id'];

            // Construct the endpoint URL with unit_group_id
            $endpoint = '/unit_groups/';
            $url = $this->default_base_url . $options['api_facility_id'] . $endpoint . $unitGroupId . '/units';

            // Fetch data from the API
            $headers = getRequestHeaders($url, 'GET', $this->plugin_instance);
            $data = fetchUnitsFromGroupDataFromApi($url, $headers);

            // Send JSON response
            $statusCode = $data ? ($data->status === 200 ? 200 : 400) : 400;
            $this->send_json_response($data, $statusCode);
        }
    }

    public function unit_groups_api()
    {
        if (isset($_GET['unit_groups_api']) && $_GET['unit_groups_api'] === '1') {
            //if we dont have the facility_id from url we get from the plugin settings
            $options = $this->plugin_instance->get_options_for_json_endpoint();
            $facilityId = isset($_GET['facility_id']) ? $_GET['facility_id'] : $options['api_facility_id'];

            $endpoint = '/unit_groups';
            $url = $this->default_base_url . $facilityId . $endpoint;
            $headers = getRequestHeaders($url, 'GET', $this->plugin_instance);

            $data = fetchUnitGroupsDataFromApi($url, $headers);
            $this->send_json_response($data, $data->status === 200 ? 200 : 400);
        }
    }

    public function unit_details_api()
    {
        if (isset($_GET['unit_details_api']) && $_GET['unit_details_api'] === '1' && isset($_GET['unit_id'])) {
            $options = $this->plugin_instance->get_options_for_json_endpoint();
            $endpoint = '/units';
            $url = $this->default_base_url . $options['api_facility_id'] . $endpoint . '/' . $_GET['unit_id'];
            $headers = getRequestHeaders($url, 'GET', $this->plugin_instance);

            $data = fetchUnitDetailsDataFromApi($url, $headers);
            $this->send_json_response($data);
        }
    }

    public function insurances_api()
    {
        if (isset($_GET['insurances_api']) && $_GET['insurances_api'] === '1') {
            $options = $this->plugin_instance->get_options_for_json_endpoint();
            $endpoint = '/invoiceable_items/insurance';
            $url = $this->default_base_url . $options['api_facility_id'] . $endpoint;
            $headers = getRequestHeaders($url, 'GET', $this->plugin_instance);

            $data = fetchInsurancesDataFromApi($url, $headers);
            $this->send_json_response($data);
        }
    }

    public function promotional_code_api()
    {
        $request_body = file_get_contents('php://input');
        $request_data = json_decode($request_body, true);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($request_data['promotional_code'])) {
            $options = $this->plugin_instance->get_options_for_json_endpoint();
            $endpoint = '/discount_plans';
            $url = $this->default_base_url . $options['api_facility_id'] . $endpoint;
            $headers = getRequestHeaders($url, 'GET', $this->plugin_instance);

            $promo_code = sanitize_text_field($request_data['promotional_code']);

            $data = fetchPromotionalCodeDataFromApi($url, $headers);

            if ($data === null || !isset($data['discount_plans'])) {
                $this->send_json_error_response('Invalid response from API.');
            }

            $discount_plan = array_filter($data['discount_plans'], function ($discount_plan) use ($promo_code) {
                return $discount_plan['name'] === $promo_code;
            });

            if (empty($discount_plan)) {
                $this->send_json_error_response('Promotional code not found.');
            }

            $discount_plan = array_values($discount_plan);
            $discount_plan_data = $discount_plan[0];
            $this->send_json_response(array('discount_plan' => $discount_plan_data));
        } else {
            $this->send_json_error_response('Invalid request method or missing promotional code.');
        }
    }

    public function crm_api()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $request_body = file_get_contents('php://input');
            $request_data = json_decode($request_body, true);

            $required_fields = array('first_name', 'last_name', 'email', 'phone');
            foreach ($required_fields as $field) {
                if (!isset($request_data[$field]) || empty($request_data[$field])) {
                    $this->send_json_error_response('Required field ' . $field . ' is missing or empty');
                    return;
                }
            }

            $first_name = sanitize_text_field($request_data['first_name']);
            $last_name = sanitize_text_field($request_data['last_name']);
            $email = sanitize_email($request_data['email']);
            $phone = sanitize_text_field($request_data['phone']);
            $unit_id = sanitize_text_field($request_data['unit_id']);

            // First request
            $crm_request_body = json_encode(array(
                'data' => array(
                    'type' => 'profile',
                    'attributes' => array(
                        'email' => $email,
                        'phone_number' => $phone,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                    ),
                    'properties' => array(
                        'unit_id' => $unit_id
                    ),
                )
            ));

            $options = $this->plugin_instance->get_options_for_json_endpoint();
            $crm_api_key = $options['crm_api_key'] ?? 'pk_1aff5e61787722224da71e4994d5bc64ce';
            $crm_endpoint = 'https://a.klaviyo.com/api/profile-import/';

            $request_args = array(
                'body' => $crm_request_body,
                'headers' => array(
                    'Authorization' => 'Klaviyo-API-Key '. $crm_api_key,
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'revision' => '2024-05-15',
                ),
            );

            $response = wp_remote_post($crm_endpoint, $request_args);
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);

            if (is_wp_error($response)) {
                $this->send_json_error_response('Error occurred while making API request: ' . $response->get_error_message(), 400);
            } elseif (!isset($data['data']['id'])) {
                $this->send_json_error_response(array('message' => $data['errors'][0]['detail']), 400);
            }

            $profile_id = $data['data']['id'];

            // Second request
            $crm_list_id = $options['crm_list_id'];
            $crm_endpoint = 'https://a.klaviyo.com/api/lists/' . $crm_list_id . '/relationships/profiles/';

            $crm_request_body = json_encode(array(
                'data' => array(
                    array('type' => 'profile', 'id' => $profile_id)
                )
            ));

            $request_args = array(
                'body' => $crm_request_body,
                'headers' => array(
                    'Authorization' => 'Klaviyo-API-Key '. $crm_api_key,
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'revision' => '2024-05-15',
                ),
            );

            $response = wp_remote_post($crm_endpoint, $request_args);


            if (is_wp_error($response)) {
                $this->send_json_error_response('Error occurred while making API request: ' . $response->get_error_message(), 400);
            } else {
                $response_body = wp_remote_retrieve_body($response);
                $this->send_json_response($response_body, 200);
            }
        } else {
            $this->send_json_error_response('Invalid request method invalid', 400);
        }
    }

    public function lead_api()
    {
        $body = file_get_contents('php://input');
        $options = $this->plugin_instance->get_options_for_json_endpoint();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $endpoint = '/leads';
            $url = $this->default_base_url . $options['api_facility_id'] . $endpoint;
            $headers = getRequestHeaders($url, 'POST', $this->plugin_instance);
    
            $data = fetchInitialLeadDataFromApi($body, $url, $headers);
            $this->send_json_response($data);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
         
            // Extract lead_id from the URL
            if (!isset($_GET['lead_id'])) {
                $this->send_json_error_response('Missing lead_id parameter for PUT request');
                return;
            }
            
            $endpoint = "/leads";
            $facility_id = $options['api_facility_id'];
            $url = $this->default_base_url . $options['api_facility_id'] . $endpoint .  '/' . $_GET['lead_id'];;
        
            $headers = getRequestHeaders($url, 'PUT', $this->plugin_instance);
           
            $data = fetchPUTLeadDataFromApi($body, $url, $headers);

            $this->send_json_response($data);
        } else {
            $this->send_json_error_response('Invalid request method');
        }
    }
    


    public function move_in_api()
    {
        $request_body = file_get_contents('php://input');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!isset($_GET['lead_id'])) {
                $this->send_json_error_response('Missing lead_id parameter for PUT request');
                return;
            }

            $options = $this->plugin_instance->get_options_for_json_endpoint();
            $lead_id = $_GET['lead_id'];
            // $endpointLead = '/leads';
            // $urlLead = $this->default_base_url . $options['api_facility_id'] . $endpoint .  '/' . $_GET['lead_id'];;
            // $headersLead = getRequestHeaders($urlLead, 'PUT', $this->plugin_instance);

            // $lead_data = fetchPUTLeadDataFromApi($request_body, $urlLead, $headersLead);


            // if (!isset($lead_data['id'])) {
            //     return $this->send_json_error_response($lead_data);
            // }

            $endpoint = '/move_ins/process_move_in';
            $url = $this->default_base_url . $options['api_facility_id'] . $endpoint;
            $headers = getRequestHeaders($url, 'POST', $this->plugin_instance);


            $form_data = json_decode($request_body, true);
            $form_data['lead_id'] = $lead_data['id'];
           

            $modified_body = json_encode($form_data);
            $move_in_result = fetchMoveInDataFromApi($modified_body, $url, $headers);

            // Decode the JSON string into an associative array
            $move_in_result_array = json_decode($move_in_result, true);

            // Check if decoding was successful
            if ($move_in_result_array === null) {
                // Handle JSON decoding error
                $this->send_json_error_response('Error decoding JSON response', 500);
            }

            // Check if move_in_unit_event key exists
            if (!array_key_exists('move_in_unit_event', $move_in_result_array)) {
                // Send error response with the error data from the fetch function and custom message
                $this->send_json_error_response(
                    $move_in_result_array,
                    400
                );
            }

            // Access the 'status' key from the decoded array
            if (isset($move_in_result_array['status']) && $move_in_result_array['status'] !== 200) {
                // Send error response with the decoded array and appropriate status code
                $this->send_json_error_response($move_in_result_array, $move_in_result_array['status']);
            }

            // If status is 200 and move_in_unit_event exists, continue with success response
            return $this->send_json_response($move_in_result_array, 200);
        } else {
            $this->send_json_error_response('Request method invalid');
        }
    }

    public function review_cost_api()
    {
        $body = file_get_contents('php://input');


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $options = $this->plugin_instance->get_options_for_json_endpoint();
            $endpoint = '/move_ins/review_cost';
            $url = $this->default_base_url . $options['api_facility_id'] . $endpoint;
            $headers = getRequestHeaders($url, 'POST', $this->plugin_instance);

            $review_cost_result = fetchMoveInReviewCostDataFromApi($body, $url, $headers);

            $this->send_json_response($review_cost_result);
        } else {
            $this->send_json_error_response('Invalid request method invalid');
        }
    }

    public function days_in_future_api()
    {
        //allowed_days_in_future
        $options = $this->plugin_instance->get_options_for_json_endpoint();
        // this or zero $this->send_json_response($options['allowed_days_in_future']);
        if (isset($options['allowed_days_in_future'])) {
            $this->send_json_response($options['allowed_days_in_future']);
        } else {
            $this->send_json_response(0);
        }
    }

    public function gate_code_check()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $options = $this->plugin_instance->get_options_for_json_endpoint();
            $endpoint = 'gate_codes/availability_check';
            $url = $this->default_base_url . $options['api_facility_id'] . '/' . $endpoint;
            $headers = getRequestHeaders($url, 'POST', $this->plugin_instance);
    
            $maxTries = 5;
            $isValid = false;
            $gateCode = '';
    
            for ($i = 0; $i < $maxTries; $i++) {
                $gateCode = $this->generate_random_gate_code();
                $data = fetch_gate_code_check_data_from_api($gateCode, $url, $headers);
    
                if (isset($data['availability_check']['available']) && $data['availability_check']['available']) {
                    $isValid = true;
                    break;
                }
            }
    
            if ($isValid) {
                $this->send_json_response(['gate_code' => $gateCode]);
            } else {
                $this->send_json_error_response('Unable to generate a valid gate code after ' . $maxTries . ' attempts.');
            }
        } else {
            $this->send_json_error_response('Invalid request method.');
        }
    }
    
    private function generate_random_gate_code()
    {
        return str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
    }
    
}
