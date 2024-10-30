<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * HILFE_API_GUIDE API 
 *
 * @since 1.0.0
 */
class HILFE_API_GUIDE extends HILFE_API_Base
{

    /**
     * Init shortcode model
     * 
     * @since 1.0.0
     */
    private $guideModel;

    /**
     * Constructor.
     * 
     * @since 1.0.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->guideModel = new HILFE_Model_Guide;
    }

    /**
     * Register rounte.
     * 
     * @since 1.0.0
     * @return void
     */
    public function register_rest_route()
    {
        register_rest_route(
            $this->namespace,
            '/api/guide/reset-data-default',
            array(
                array(
                    'methods'  => WP_REST_Server::CREATABLE,
                    'callback' => array($this, 'resetDataDefault'),
                    'permission_callback' => '__return_true',
                ),
            )
        );
    }

    /**
     * Reset data
     * 
     * @since 1.0.0
     */
    public function resetDataDefault()
    {
        try {
            // is admin?
            if (!$this->isLogin()) {
                throw new Exception(__("You must login!", 'hilfe'));
            }

            $defaults   = $this->guideModel->getDataDefaults();

            // proccess main
            update_site_option(HILFE_GUIDE_OPTION, $defaults);

            // result
            $result = array(
                'status' => true,
                'data'   => array(),
            );

            return new WP_REST_Response($result, 200);
        } catch (Exception $err) {
            $result = array(
                'message' => 'error',
                'data'    => $err->getMessage()
            );
            return new WP_REST_Response($result, 406);
        }
    }
}
