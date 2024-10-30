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

abstract class HILFE_Admin_Base
{

    /**
     * The page slug for the sidebar.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $pageSlug = null;

    /**
     * Index in menu hilfe
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $menuPosition = null;

    /**
     * The code that allows access to this function
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $capability = null;

    /**
     * Number used once CSRF
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $csrfKey = null;

    /**
     * Renders the update message.
     *
     * @since 1.0.0
     * @return void
     */
    public function notifyUpdate()
    {
        $hilfe_message = $this->get_alert();

        if (empty($hilfe_message) || !isset($hilfe_message['status']) || !isset($hilfe_message['message'])) {
            return;
        }
        $status = $hilfe_message['status'];
        $message = $hilfe_message['message'];

        switch ($status) {
            case 'ERROR':
                echo '<div class="error"><p>' . esc_html($message) . '</p></div>';
                break;
            case 'SUCCESS':
                echo '<div class="updated"><p>' . esc_html($message) . '</p></div>';
                break;
            default:
                return;
        }
    }

    public function create_alert($data)
    {
        set_transient('hilfe_alert', $data, 5); // Lưu trữ trong 1 giờ
    }
    
    public function get_alert()
    {
        $data = get_transient('hilfe_alert');
        if ($data === false) {
            return;
        }
        $this->create_alert([]);
        return $data;
    }
    /**
     * Check valid URL
     *
     * @since 1.0.0
     * @return void
     */
    public function validateURL($url)
    {
        $pattern = '/^(https?:\/\/)?([a-z0-9-]+\.)+[a-z]{2,}(\/[^\s]*)?$/i';

        if (!preg_match($pattern, $url)) {
            return false;
        }

        return true;
    }

    /**
     * Redirect site admin
     *
     * @since 1.0.0
     * @return void
     */
    public function redirectAdminSite($page, $params = [])
    {
?>
        <script>
            let url = "<?php
                        echo admin_url("admin.php?page=" . esc_attr($page))
                        ?>";

            let code = "<?php
                        if (isset($params['code'])) {
                            echo "&code=" . esc_html($params['code']);
                        } else {
                            echo "";
                        }
                        ?>";

            let status = "<?php
                            if (isset($params['status'])) {
                                echo "&hilfe-notify-status=" . esc_html($params['status']);
                            } else {
                                echo "";
                            }
                            ?>";

            let message = "<?php
                            if (isset($params['message'])) {
                                echo "&hilfe-notify-message=" . esc_html($params['message']);
                            } else {
                                echo "";
                            }
                            ?>";

            window.location = url + code + status + message;
        </script>
<?php
        exit;
    }
}
