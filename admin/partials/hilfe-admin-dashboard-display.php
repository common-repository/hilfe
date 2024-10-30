<?php

/**
 * Provide a admin dashboard area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://fswa-net.com
 * @since      1.0.0
 *
 * @package    HILFE
 * @subpackage HILFE/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<!-- Start wrap -->
<div class="hilfe__wrap">
    <div class="hilfe-dashboard">
        <div class="hilfe-dashboard--tools">
            <a href="https://fswa-net.com/" class="hilfe-btn-primary" target="_blank"><?php echo (__('Visit FSWA-NET', 'hilfe')) ?></a>
            <a href="https://contractor.fswa-net.com/" class="hilfe-btn-primary" target="_blank"><?php echo (__('Contractor login', 'hilfe')) ?></a>
            <a href="https://fswa-net.com/contractor/register" class="hilfe-btn-primary" target="_blank"><?php echo (__('Contractor register', 'hilfe')) ?></a>
        </div>
        <iframe src="https://fswa-net.com" frameborder="0" width="100%" height="1000px"></iframe>
    </div>
</div>
<!-- End wrap -->