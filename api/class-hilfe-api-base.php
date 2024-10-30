<?php
if (!defined('ABSPATH')) {
  exit;
}

/**
 * HILFE_API_Base
 *
 * @since 1.0.0
 */
abstract class HILFE_API_Base extends WP_REST_Controller
{

  /**
   * The name space and prefix API name
   *
   * @var Dashboard
   * @since 1.0.0
   */
  protected $namespace   = 'hilfe';

  /**
   * The single instance of the class.
   *
   * @var Dashboard
   * @since 1.0.0
   */
  protected static $_instance = null;

  /**
   * Main HILFE_API_Base Instance.
   *
   * Ensures only one instance of HILFE_API_Base is loaded or can be loaded.
   *
   * @since 1.0.0
   * @static
   * @return HILFE_API_Base - Main instance.
   */
  public static function instance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  /**
   * Constructor.
   * 
   * @since 1.0.0
   */
  public function __construct()
  {
  }

  //================================================
  // request function
  //================================================
  /**
   * Function authentication.
   */
  protected function isLogin()
  {
    $user_id = apply_filters('determine_current_user', false);

    if (!$user_id) {
      return false;
    }

    return true;
  }

  /**
   * Function get request data.
   */
  protected function getRequest($request)
  {
    // is has data
    if (empty($request->get_body())) {
      // throw new Exception("Empty data");
    }
    $requestAll = json_decode($request->get_body());

    // is has content
    if (empty($requestAll)) {
      // throw new Exception("Empty content");
    }

    return $requestAll;
  }

  /**
   * Get user detail
   */
  protected function getUserDetail()
  {
    $user_id = apply_filters('determine_current_user', false);
    $user    = wp_set_current_user($user_id);

    return $user;
  }
}
