<?php

class HILFE_Model_Shortcode extends HILFE_Model_Base
{
    public function getDataDefaults()
    {
        $defaults = array(
            array(
                "name" => __("Car Booking", 'hilfe'),
                "code" => HILFE_SERVICE_CAR_BOOKING,
                "banner" => HILFE_ASSETS_URL . "/images/banner/HILFE_SERVICE_CAR_BOOKING.jpg",
                "link" => "https://fswa-net.com/booking-transportation-car"
            ),
            array(
                "name" => __("Accommodation Booking", 'hilfe'),
                "code" => HILFE_SERVICE_ACCOMMODATION_BOOKING,
                "banner" => HILFE_ASSETS_URL . "/images/banner/HILFE_SERVICE_ACCOMMODATION_BOOKING.jpg",
                "link" => "https://fswa-net.com/booking-hotel-accommodation"
            ),
            array(
                "name" => __("Venue Booking", 'hilfe'),
                "code" => HILFE_SERVICE_VENUE_BOOKING,
                "banner" => HILFE_ASSETS_URL . "/images/banner/HILFE_SERVICE_VENUE_BOOKING.jpg",
                "link" => "https://fswa-net.com/booking-hotel-venue"
            ),
            array(
                "name" => __("Hearse Booking", 'hilfe'),
                "code" => HILFE_SERVICE_HEARSE_BOOKING,
                "banner" => HILFE_ASSETS_URL . "/images/banner/HILFE_SERVICE_HEARSE_BOOKING.jpg",
                "link" => "https://fswa-net.com/booking-hearse"
            ),
            array(
                "name" => __("Resting Place Booking", 'hilfe'),
                "code" => HILFE_SERVICE_RESTING_PLACE_BOOKING,
                "banner" => HILFE_ASSETS_URL . "/images/banner/HILFE_SERVICE_RESTING_PLACE_BOOKING.jpg",
                "link" => "https://fswa-net.com/booking-resting-place"
            ),
            array(
                "name" => __("Hearse and Resting Place Booking", 'hilfe'),
                "code" => HILFE_SERVICE_HEARSE_AND_RESTING_PLACE_BOOKING,
                "banner" => HILFE_ASSETS_URL . "/images/banner/HILFE_SERVICE_HEARSE_AND_RESTING_PLACE_BOOKING.jpg",
                "link" => "https://fswa-net.com/booking-hearse-resting-place"
            ),
            array(
                "name" => __("Funeral Hall Booking", 'hilfe'),
                "code" => HILFE_SERVICE_FULNERAL_HALL_BOOKING,
                "banner" => HILFE_ASSETS_URL . "/images/banner/HILFE_SERVICE_FULNERAL_HALL_BOOKING.jpg",
                "link" => "https://fswa-net.com/booking-funeral"
            ),
            array(
                "name" => __("Religious Service Booking", 'hilfe'),
                "code" => HILFE_SERVICE_RELIGIOUS_BOOKING,
                "banner" => HILFE_ASSETS_URL . "/images/banner/HILFE_SERVICE_RELIGIOUS_BOOKING.jpg",
                "link" => "https://fswa-net.com/booking-religious"
            ),
            array(
                "name" => __("Cemetery Booking", 'hilfe'),
                "code" => HILFE_SERVICE_CEMETERY_BOOKING,
                "banner" => HILFE_ASSETS_URL . "/images/banner/HILFE_SERVICE_CEMETERY_BOOKING.jpg",
                "link" => "https://fswa-net.com/booking-cemetery"
            ),
        );

        return $defaults;
    }

    public function getAll()
    {
        $data = $this->getSiteOption(HILFE_SHORTCODE_OPTION, true);

        // If not information, stored default and return default data
        if (empty($data)) {
            $defaults = $this->getDataDefaults();
            update_site_option(HILFE_SHORTCODE_OPTION, $defaults);
            $data = $defaults;
        }

        return $data;
    }

    public function getOneByCode($code)
    {
        if (empty($code)) {
            throw new Exception(__("Empty code", 'hilfe'));
        }

        $configs = $this->getAll();
        if (empty($configs)) {
            throw new Exception(__("Empty config", 'hilfe'));
        }

        $item = array_reduce($configs, function ($result, $config) use ($code) {
            return $config['code'] == $code ? $config : $result;
        }, []);

        return $item;
    }


    /**
     * Update database shortcode
     *
     * @since 1.0.0
     * @param string $code code of service want to search.
     * @return mixed
     */
    public function updateShortcode($configs, $data)
    {
        $code = $data['code'];
        $link = $data['link'];
        $banner = $data['banner'];

        foreach ($configs as $key => $value) {
            if ($value['code'] === $code) {
                if (isset($data['link'])) {
                    $configs[$key]['link'] = $link;
                }
                if (isset($data['banner'])) {
                    $configs[$key]['banner'] = $banner;
                }
                break;
            }
        }

        update_site_option(HILFE_SHORTCODE_OPTION, $configs);
    }
}
