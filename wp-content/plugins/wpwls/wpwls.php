<?php

/**
 * Plugin Name: WPStoreEdge Plugin
 * Description: Facility Level integration for multisite wp
 * Version: 1.0
 * Author: Fredd Bezerra @freddneos
 * Text Domain: wpwls
 */

namespace Wpwls;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


// Include the JSON endpoint handler
require_once plugin_dir_path(__FILE__) . 'includes/json-endpoint.php';



/**
 * White Label Storage Plugin class.
 */
class Wpwls
{

    /**
     * Plugin options.
     *
     * @var array
     */
    private $options;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->options = $this->get_options();
        add_action('admin_menu', array($this, 'add_plugin_page'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_footer', array($this, 'add_integration_test'));

    }

    /**
     * Add plugin page to the admin menu.
     */
    public function add_plugin_page()
    {
        add_menu_page(
            __('WPStoreEdge ', 'wpwls'),
            __('WPStoreEdge ', 'wpwls'),
            'manage_options',
            'wpwls',
            array($this, 'render_settings_page'),
            'dashicons-admin-plugins',
            null
        );
    }

    /**
     * Get plugin options.
     *
     * @return array The plugin options.
     */
    public function get_options()
    {
        return get_option('wpwls_settings', array());
    }

    /**
     * Get plugin options for the JSON endpoint.
     *
     * @return array The plugin options.
     */
    public function get_options_for_json_endpoint()
    {
        return $this->get_options();
    }


    /**
     * Render the settings page.
     */
    public function render_settings_page()
    {
?>
        <div class="wrap">
            <h1><?php esc_html_e('WPStoreEdge Plugin', 'wpwls'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('wpwls_settings');
                do_settings_sections('wpwls_settings');
                submit_button(__('Save Settings', 'wpwls'));
                ?>
            </form>
        </div>
    <?php
    }

    /**
     * Register plugin settings.
     */
    public function register_settings()
    {
        register_setting(
            'wpwls_settings',
            'wpwls_settings',
            array(
                'sanitize_callback' => array($this, 'sanitize_settings'),
            )
        );

        add_settings_section(
            'wpwls_settings_section',
            __('API Settings', 'wpwls'),
            null,
            'wpwls_settings'
        );

        add_settings_field(
            'api_access_key',
            __('API Access Key', 'wpwls'),
            array($this, 'render_api_access_key_field'),
            'wpwls_settings',
            'wpwls_settings_section'
        );

        add_settings_field(
            'api_access_secret',
            __('API Access Secret', 'wpwls'),
            array($this, 'render_api_access_secret_field'),
            'wpwls_settings',
            'wpwls_settings_section'
        );

        add_settings_field(
            'api_facility_id',
            __('API Facility ID', 'wpwls'),
            array($this, 'render_api_facility_id_field'),
            'wpwls_settings',
            'wpwls_settings_section'
        );

        add_settings_field(
            'facility_slug',
            __('Facility Slug', 'wpwls'),
            array($this, 'render_facility_slug_field'),
            'wpwls_settings',
            'wpwls_settings_section'
        );

        // add_settings_field(
        //     'api_endpoint',
        //     __('Api Endpoint', 'wpwls'),
        //     array($this, 'render_api_endpoint_field'),
        //     'wpwls_settings',
        //     'wpwls_settings_section'
        // );
        add_settings_field(
            'crm_list_id',
            __('CRM List ID', 'wpwls'),
            array($this, 'render_crm_list_id_field'),
            'wpwls_settings',
            'wpwls_settings_section'
        );

        add_settings_field(
            'allowed_days_in_future',
            __('Allowed Days in Future to Move-In', 'wpwls'),
            array($this, 'render_allowed_days_in_future_field'),
            'wpwls_settings',
            'wpwls_settings_section'
        );
    }

    /**
     * Render the API Access Key field.
     */
    public function render_api_access_key_field()
    {
        $value = isset($this->options['api_access_key']) ? $this->options['api_access_key'] : '';
    ?>
        <input type="text" name="wpwls_settings[api_access_key]" id="api_access_key" value="<?php echo esc_attr($value); ?>" />
        <?php
        if (!empty($value)) {
            echo '<p class="description">' . esc_html__('Current Value: ', 'wpwls') . esc_html($value) . '</p>';
        }
    }

    /**
     * Render the API Access Secret field.
     */
    public function render_api_access_secret_field()
    {
        $value = isset($this->options['api_access_secret']) ? $this->options['api_access_secret'] : '';
        ?>
        <input type="text" name="wpwls_settings[api_access_secret]" id="api_access_secret" value="<?php echo esc_attr($value); ?>" />
        <?php
        if (!empty($value)) {
            echo '<p class="description">' . esc_html__('Current Value: ', 'wpwls') . esc_html($value) . '</p>';
        }
    }

    /**
     * Render the API Facility ID field.
     */
    public function render_api_facility_id_field()
    {
        $value = isset($this->options['api_facility_id']) ? $this->options['api_facility_id'] : '';
        ?>
        <input type="text" name="wpwls_settings[api_facility_id]" id="api_facility_id" value="<?php echo esc_attr($value); ?>" />
        <?php
        if (!empty($value)) {
            echo '<p class="description">' . esc_html__('Current Value: ', 'wpwls') . esc_html($value) . '</p>';
        }
    }

    /**
     * Render the Facility Slug field.
     */
    public function render_facility_slug_field()
    {
        $value = isset($this->options['facility_slug']) ? $this->options['facility_slug'] : '';
        ?>
        <input type="text" name="wpwls_settings[facility_slug]" id="facility_slug" value="<?php echo esc_attr($value); ?>" />

        <?php
        if (!empty($value)) {
            echo '<p class="description">' . esc_html__('Current Value: ', 'wpwls') . esc_html($value) . '</p>';
        }
        echo '<br/><br/><button id="test_integration_button" class="button" type="button">Test StoreEdge Integration</button>';
    }

    // /**
    //  * Render the Main Api endpoint.
    //  */
    // public function render_api_endpoint_field()
    // {
    //     $value = isset($this->options['api_endpoint']) ? $this->options['api_endpoint'] : '';
        
       // <input type="text" name="wpwls_settings[api_endpoint]" id="api_endpoint" value="<?php echo esc_attr($value); 
        
    //     if (!empty($value)) {
    //         echo '<p class="description">' . esc_html__('Current Value: ', 'wpwls') . esc_html($value) . '</p>';
    //     }
    // }

    /**
     * Render the CRM List ID field.
     */
    public function render_crm_list_id_field()
    {
        $value = isset($this->options['crm_list_id']) ? $this->options['crm_list_id'] : '';
        ?>
        <input type="text" name="wpwls_settings[crm_list_id]" id="crm_list_id" value="<?php echo esc_attr($value); ?>" />
        <?php
        if (!empty($value)) {
            echo '<p class="description">' . esc_html__('Current Value: ', 'wpwls') . esc_html($value) . '</p>';
        }
        echo '<br/><br/><button id="test_crm_integration_button" class="button" type="button">Test CRM Integration</button>';

    }

    /**
     * Render the Allowed Days in Future to Book field.
     */
    public function render_allowed_days_in_future_field()
    {
        $value = isset($this->options['allowed_days_in_future']) ? $this->options['allowed_days_in_future'] : '';
        ?>
        <input type="number" min="1" max="7" name="wpwls_settings[allowed_days_in_future]" id="allowed_days_in_future" value="<?php echo esc_attr($value); ?>" />
        <?php
        if (!empty($value)) {
            echo '<p class="description">' . esc_html__('Current Value: ', 'wpwls') . esc_html($value) . '</p>';
        }
    }


    /**
     * Sanitize plugin settings before saving.
     *
     * @param array $input The input data to sanitize.
     *
     * @return array The sanitized data.
     */
    public function sanitize_settings($input)
    {
        $sanitized_input = array();

        if (isset($input['api_access_key'])) {
            $sanitized_input['api_access_key'] = sanitize_text_field($input['api_access_key']);
        }

        if (isset($input['api_access_secret'])) {
            $sanitized_input['api_access_secret'] = sanitize_text_field($input['api_access_secret']);
        }

        if (isset($input['api_facility_id'])) {
            $sanitized_input['api_facility_id'] = sanitize_text_field($input['api_facility_id']);
        }

        if (isset($input['facility_slug'])) {
            $sanitized_input['facility_slug'] = sanitize_text_field($input['facility_slug']);
        }
        if (isset($input['api_endpoint'])) {
            $sanitized_input['api_endpoint'] = sanitize_text_field($input['api_endpoint']);
        }
        if (isset($input['crm_list_id'])) {
            $sanitized_input['crm_list_id'] = sanitize_text_field($input['crm_list_id']);
        }

        if (isset($input['allowed_days_in_future'])) {
            $sanitized_value = intval($input['allowed_days_in_future']);
            $sanitized_input['allowed_days_in_future'] = ($sanitized_value >= 1 && $sanitized_value <= 7) ? $sanitized_value : 1; // Default to 1 if out of range
        }

        return $sanitized_input;
    }

    public function add_integration_test()
    {
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const apiEndpoint = '<?php echo admin_url('admin-ajax.php'); ?>';

                document.getElementById('test_integration_button').addEventListener('click', function() {
                    //prevent default os reloading the page below :
                    
                    var accessKey = document.getElementById('api_access_key').value;
                    var accessSecret = document.getElementById('api_access_secret').value;
                    var facilityId = document.getElementById('api_facility_id').value;

                    if (accessKey === '' || accessSecret === '' || facilityId === '') {
                        alert('Please fill in all the required fields.');
                        return;
                    }

                    fetch(apiEndpoint + '?action=units_api&units_api=1', {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(function(response) {
                            if (response.ok) {
                                return response.json();
                            }
                            throw new Error('Network response was not ok.');
                        })
                        .then(function(data) {
                            if (data.status === 200) {
                                alert('Integration working');
                                // Display green check icon
                            } else {
                                alert('Configuration not working, check the API key/secret');
                                // Display error icon
                            }
                        })
                        .catch(function(error) {
                            console.error('There has been a problem with your fetch operation:', error.message);
                        });
                });

                document.getElementById('test_crm_integration_button').addEventListener('click', function() {
                    //prevent default os reloading the page below :
                    
                   
                    var crmListId = document.getElementById('crm_list_id').value;
                    var facilitySlug = document.getElementById('facility_slug').value;

                    if (crmListId === '' ) {
                        alert('Please fill in all the required fields.');
                        return;
                    }

                    fetch(apiEndpoint + '?action=crm_api', {
                            method: 'POST',
                            headers: {
                            'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                'first_name': 'test-from-plugin',
                                'last_name': 'test-from-plugin',
                                'email': 'teste-from-plugin@test.com',
                                'phone': '351913873999',
                                'unit_id': 'test-unit-x'
                            })
                        }).then(async function(response) {
                            if (response.ok) {
                                alert('Sent a test lead to CRM. Check your CRM.');
                            }else {
                                alert('Configuration not working, check the List ID');
                                // Display error icon
                            }
                        })
                        .catch(function(error) {
                            console.error('There has been a problem with your fetch operation:', error.message);
                        });
                });
            });
        </script>
<?php
    }
}

// Initialize the JSON endpoint handler
$plugin_instance = new Wpwls();
$json_endpoint_handler = new Wpwls_JSON_Endpoint($plugin_instance);
