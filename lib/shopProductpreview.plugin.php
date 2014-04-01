<?php

class shopProductpreviewPlugin extends shopPlugin {

    public function frontendHead() {
        $plugin_id = array('shop', 'productpreview');
        $app_settings_model = new waAppSettingsModel();
        if ($app_settings_model->get($plugin_id, 'status')) {
            $html = '';
            if ($app_settings_model->get($plugin_id, 'include_fancybox')) {
                waSystem::getInstance()->getResponse()->addJs('plugins/productpreview/js/fancybox/jquery.fancybox.pack.js', 'shop');
                waSystem::getInstance()->getResponse()->addCss('plugins/productpreview/js/fancybox/jquery.fancybox.css', 'shop');

                $html .= <<<HTML
        <script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
		});
	</script>
HTML;
            }
            if ($app_settings_model->get($plugin_id, 'include_css')) {
                
                $view = wa()->getView();
                $template_path = wa()->getDataPath('plugins/productpreview/templates/Style.html', false, 'shop', true);
                if (!file_exists($template_path)) {
                    $template_path = wa()->getAppPath('plugins/productpreview/templates/Style.html', 'shop');
                }
                $html .= $view->fetch($template_path);
            }
            return $html;
        }
    }

    public static function display($product_id) {
        $plugin_id = array('shop', 'productpreview');
        $app_settings_model = new waAppSettingsModel();

        if ($app_settings_model->get($plugin_id, 'status')) {
            $view = wa()->getView();
            $view->assign('product_id', $product_id);
            $template_path = wa()->getDataPath('plugins/productpreview/templates/Display.html', false, 'shop', true);
            if (!file_exists($template_path)) {
                $template_path = wa()->getAppPath('plugins/productpreview/templates/Display.html', 'shop');
            }
            $html = $view->fetch($template_path);
            return $html;
        }
    }

}
