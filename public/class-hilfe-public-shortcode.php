<?php

/**
 * The public-shortcode-specific functionality of the plugin.
 *
 * @package    HILFE
 * @subpackage HILFE/public
 * @author     FSWA-NET <wordpress-developer@fswa-net.com>
 */
class HILFE_Public_Shortcode extends HILFE_Public_Base
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $hilfe    The ID of this plugin.
     */
    private $hilfe;

    /**
     * Shortcode model
     *
     * @since    1.0.0
     * @access   private
     */
    private $shortCodeModel;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $hilfe       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($hilfe)
    {
        $this->hilfe         = $hilfe;
        $this->shortCodeModel = new HILFE_Model_Shortcode();
    }

    /**
     * Handle render shortcode.
     * Select your option. It will build the banner corresponding
     *
     * @since 1.0.0
     */
    public function render_shortcode($atribute)
    {
        // get data from client shortcode
        extract(shortcode_atts(array(
            'code' => '',
        ), $atribute));

        // init variable
        $html = "";

        // get data config
        try {
            $data = $this->shortCodeModel->getOneByCode($code);
        } catch (Exception $error) {
            $html .= $error->getMessage();
        }

        if (!empty($data)) {
            // render html
            $html .= "<!-- START HILFE BANNER -->";
            $html .= "<div class='hilfe-shortcode-wrap'>";
            $html .= "  <a href='" . esc_url($data['link']) . "' target='_blank' title='" . esc_url($data['name']) . "' class='hilfe-shortcode-href'>";
            $html .= "    <img src='" . esc_url($data['banner']) . "' alt='" . esc_url($data['name']) . "' class='hilfe-shortcode-image'>";
            $html .= "  </a>";
            $html .= "</div>";
            $html .= "<!-- END HILFE BANNER -->";
        }

        return $html;
    }
}
