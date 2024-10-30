<?php

class HILFE_Model_Guide extends HILFE_Model_Base
{
    public function getDataDefaults()
    {
        $defaults = array(
            // ui
            'space_vertical'   => 90,
            'space_horizon'    => 20,
            'position'         => 'right',
            'background_color' => '#2b8383',
            'is_show'          => true,
            // description
            'mini_title'                => __('Download here', 'hilfe'),
            'mini_description'          => __('Available on smartphone, iPad and tablets', 'hilfe'),
            'show_title'                => __('Download here', 'hilfe'),
            'show_description'          => __('We provide the following services, you can download them below.', 'hilfe'),
            // services
            'services'         => array(
                [
                    'code'        => HILFE_APP_SERVICE_HILFE,
                    'is_show'     => true,
                    'name'        => __('HILFE', 'hilfe'),
                    'description' => __('HILFE is a platform for accommodations, venues, cars and funeral services, hearse booking online.', 'hilfe'),
                    'logo'        => HILFE_ASSETS_URL . "/images/logo/SERVICE_LOGO_HILFE.png",
                    'apps'        => [
                        [
                            'index'   => 1,
                            'label'   => __('For User', 'hilfe'),
                            'icon'    => HILFE_ASSETS_URL . "/images/icon/ic-user.svg",
                            'ios'     => 'https://apps.apple.com/jp/app/hilfe-city/id1466903961',
                            'android' => 'https://play.google.com/store/apps/details?id=com.fnet.app'
                        ],
                        [
                            'index'   => 2,
                            'label'   => __('For Contractor', 'hilfe'),
                            'icon'    => HILFE_ASSETS_URL . "/images/icon/ic-contactors.svg",
                            'ios'     => 'https://apps.apple.com/us/app/hilfe-iot/id6504023639',
                            'android' => 'https://play.google.com/store/apps/details?id=com.fnet.contractor'
                        ]
                    ]
                ],
                [
                    'code'        => HILFE_APP_SERVICE_HILFE_AR,
                    'is_show'     => true,
                    'name'        => __('HILFE AR', 'hilfe'),
                    'description' => __('HILFE AR is an app for buying convenience store products and ordering items for home and hall funerals.', 'hilfe'),
                    'logo'        => HILFE_ASSETS_URL . "/images/logo/SERVICE_LOGO_HILFE_AR.png",
                    'apps'        => [
                        [
                            'index'   => 1,
                            'label'   => __('For User', 'hilfe'),
                            'icon'    => HILFE_ASSETS_URL . "/images/icon/ic-user.svg",
                            'ios'     => 'https://apps.apple.com/jp/app/ar%E5%AE%B6%E6%97%8F%E8%91%ACfnet/id1548258604',
                            'android' => 'https://play.google.com/store/apps/details?id=com.fnet.aruser'
                        ],
                        [
                            'index'   => 2,
                            'label'   => __('For Contractor', 'hilfe'),
                            'icon'    => HILFE_ASSETS_URL . "/images/icon/ic-contactors.svg",
                            'ios'     => 'https://apps.apple.com/jp/app/ar%E5%A5%91%E7%B4%84%E8%80%85fnet/id1526415578',
                            'android' => 'https://play.google.com/store/apps/details?id=com.fnet.arcontractor'
                        ]
                    ]
                ],
                [
                    'code'        => HILFE_APP_SERVICE_HILFE_AI,
                    'is_show'     => true,
                    'name'        => __('HILFE AI', 'hilfe'),
                    'description' => __('HILFE AI lets users create videos, use AI for evaluation, and improve their skills.', 'hilfe'),
                    'logo'        => HILFE_ASSETS_URL . "/images/logo/SERVICE_LOGO_HILFE_AI.png",
                    'apps'        => [
                        [
                            'index'   => 1,
                            'label'   => '',
                            'icon'    => '',
                            'ios'     => 'https://apps.apple.com/jp/app/hilfe-ai/id6480042500',
                            'android' => 'https://play.google.com/store/apps/details?id=com.hilfeai_app'
                        ]
                    ]
                ],
            ),
        );

        return $defaults;
    }

    public function getAll()
    {
        $data = $this->getSiteOption(HILFE_GUIDE_OPTION, true);

        // If not information, stored default and return default data
        if (empty($data)) {
            $defaults = $this->getDataDefaults();
            update_site_option(HILFE_GUIDE_OPTION, $defaults);
            $data = $defaults;
        }

        return $data;
    }

    /**
     * Update database guide
     *
     * @since 1.0.0
     */
    public function updateAll($data)
    {
        // validate
        update_site_option(HILFE_GUIDE_OPTION, $data);
    }
}
