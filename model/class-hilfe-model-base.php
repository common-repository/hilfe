<?php

/**
 * The admin-base functionality of the plugin.
 *
 * @link       https://fswa-net.com
 * @since      1.0.0
 *
 * @package    HILFE
 * @subpackage HILFE/admin
 */

abstract class HILFE_Model_Base
{
    /**
     * Returns an option from the database for
     * the admin settings page.
     *
     * @since 1.0.0
     * @param string $key The option key.
     * @return mixed
     */
    protected function getSiteOption($key, $network_override = true)
    {
        $value = get_site_option($key);
        return $value;
    }
}
