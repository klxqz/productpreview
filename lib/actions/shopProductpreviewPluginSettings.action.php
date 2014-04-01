<?php

class shopProductpreviewPluginSettingsAction extends waViewAction {

    protected $templates = array(
        'frontend' => array( 'tpl_path' => 'plugins/productpreview/templates/actions/frontend/Frontend.html'),
        'display' => array( 'tpl_path' => 'plugins/productpreview/templates/Display.html'),
        'css' => array( 'tpl_path' => 'plugins/productpreview/templates/Style.html'),
    );
    protected $plugin_id = array('shop', 'productpreview');

    public function execute() {
        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get($this->plugin_id);

        foreach ($this->templates as &$template) {
            $template['full_path'] = wa()->getDataPath($template['tpl_path'], false, 'shop', true);
            if (file_exists($template['full_path'])) {
                $template['change_tpl'] = true;
            } else {
                $template['full_path'] = wa()->getAppPath($template['tpl_path'], 'shop');
                $template['change_tpl'] = false;
            }
            $template['template'] = file_get_contents($template['full_path']);
        }

        $this->view->assign('settings', $settings);
        $this->view->assign('templates', $this->templates);
    }

}
