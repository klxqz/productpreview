<?php

$plugin_id = array('shop', 'productpreview');
$app_settings_model = new waAppSettingsModel();
$app_settings_model->set($plugin_id, 'status', '1');
$app_settings_model->set($plugin_id, 'include_fancybox', '1');
$app_settings_model->set($plugin_id, 'template_type', 'shop');
$app_settings_model->set($plugin_id, 'template_name', 'product.html');
$app_settings_model->set($plugin_id, 'include_css', '1');
