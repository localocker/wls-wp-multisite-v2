<?php


namespace Wpwls;

/**
 * Get request headers for the API request
 *
 * @param string $endpoint     The URL for the API request
 * @param string $method  The HTTP method for the API request (default: GET)
 * @param Wpwls  $plugin  The Wpwls plugin instance
 *
 * @return array          The headers for the API request
 */
function getRequestHeaders($endpoint, $method = 'GET', Wpwls $plugin)
{
    $options = $plugin->get_options_for_json_endpoint();

    $timestamp = time();
    $nonce = md5(uniqid(rand(), true));

    $base_string = rawurlencode($method) . '&' . rawurlencode($endpoint) . '&';

    $params = array(
        'oauth_consumer_key' => $options['api_access_key'],
        'oauth_nonce' => $nonce,
        'oauth_signature_method' => 'HMAC-SHA1',
        'oauth_timestamp' => $timestamp,
        'oauth_version' => '1.0',
    );

    // Sort the parameters alphabetically by key
    ksort($params);

    // Generate parameter string
    $param_string = '';
    foreach ($params as $key => $value) {
        $param_string .= rawurlencode($key) . '=' . rawurlencode($value) . '&';
    }
    $param_string = rtrim($param_string, '&');

    // Build the base string
    $base_string .= rawurlencode($param_string);

    // Generate the signature
    $signature_key = rawurlencode($options['api_access_secret']) . '&';
    $signature = base64_encode(hash_hmac('sha1', $base_string, $signature_key, true));

    // Construct the authorization header
    $authorization = 'OAuth oauth_consumer_key="' . rawurlencode($options['api_access_key']) . '", ' .
                     'oauth_nonce="' . rawurlencode($nonce) . '", ' .
                     'oauth_signature="' . rawurlencode($signature) . '", ' .
                     'oauth_signature_method="HMAC-SHA1", ' .
                     'oauth_timestamp="' . rawurlencode($timestamp) . '", ' .
                     'oauth_version="1.0"';

    // Prepare headers
    $headers = array(
        'Authorization' => $authorization,
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    );

    return $headers;
}