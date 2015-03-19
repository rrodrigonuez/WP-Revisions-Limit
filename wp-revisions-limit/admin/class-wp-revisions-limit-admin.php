<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wp_Revisions_Limit
 * @subpackage Wp_Revisions_Limit/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Revisions_Limit
 * @subpackage Wp_Revisions_Limit/admin
 * @author     Your Name <email@example.com>
 */
class Wp_Revisions_Limit_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Holds the default value of revisions number
     */
    private $default_revisions_limit;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $wp_revisions_limit       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->default_revisions_limit = 5;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Revisions_Limit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Revisions_Limit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-revisions-limit-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Revisions_Limit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Revisions_Limit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-revisions-limit-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function init() {

		//register our settings
		register_setting(
			'wp_revisions_limit_group', // Option group
			'revisions_limit_option', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'revisions_limit_section', // ID
			__( 'Revisions Options' ), // Title
			array( $this, 'print_section_info' ), // Callback
			$this->plugin_name // Page
		);

		add_settings_field(
			'revisions_limit', // ID
			__( 'Number of Revisions:' ), // Title 
			array( $this, 'revisions_limit_callback' ), // Callback
			$this->plugin_name, // Page
			'revisions_limit_section' // Section ID
		);   

	}

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {

        $new_input = array();
        if( isset( $input['revisions_limit'] ) )
            $new_input['revisions_limit'] = absint( $input['revisions_limit'] );

        return $new_input;

    }

    /** 
     * Print the Section text
     */
    public function print_section_info() {

        print __( 'Enter the number of revisions that you want to save, enter 0 to disable revisions:' );

    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function revisions_limit_callback() {

        printf(
            '<input type="text" id="revisions_limit" name="revisions_limit_option[revisions_limit]" value="%s">',
            isset( $this->options['revisions_limit'] ) ? esc_attr( $this->options['revisions_limit'] ) : ''
        );

    }

	public function wp_revisions_limit_menu() {

		add_options_page( __( 'Revisions Limit' ), __( 'Revisions Limit' ), 'manage_options', $this->plugin_name, array( $this, 'admin_page' ) );
	
	}

	public function admin_page() {

		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		require_once 'partials/wp-revisions-limit-admin-display.php';

	}


	public function add_action_links( $links ) {

  		$settings_link = '<a href="' . esc_url( $this->get_page_url() ) . '">' . __( 'Settings' ) . '</a>';
  		array_unshift( $links, $settings_link );

		return $links;

	}


	public function define_post_revisions() {

		$this->load_options();
		
		if ( isset( $this->options['revisions_limit'] ) && $this->options['revisions_limit'] != '' ) {
			if ( is_numeric( $this->options['revisions_limit'] ) ) {
				define( 'WP_POST_REVISIONS', (int)$this->options['revisions_limit'] + 1 );
			} else {
				define( 'WP_POST_REVISIONS', $this->default_revisions_limit );
			}
		} else {
			define( 'WP_POST_REVISIONS', $this->default_revisions_limit );
		}

	}

	public function load_options() {

		if ( !$this->options )
			$this->options = get_option( 'revisions_limit_option' );

		return $this->options;

	}

	private function get_page_url() {

		return admin_url( 'options-general.php?page=' . $this->plugin_name );

	}
}
