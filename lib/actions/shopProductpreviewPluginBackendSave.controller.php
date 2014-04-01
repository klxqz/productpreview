<?php

class shopProductpreviewPluginBackendSaveController extends waJsonController {

    protected $templates = array(
        'frontend' => array('tpl_path' => 'plugins/productpreview/templates/actions/frontend/Frontend.html'),
        'display' => array('tpl_path' => 'plugins/productpreview/templates/Display.html'),
        'css' => array('tpl_path' => 'plugins/productpreview/templates/Style.html'),
    );
    protected $plugin_id = array('shop', 'productpreview');

    public function execute() {
        try {
            $app_settings_model = new waAppSettingsModel();
            $shop_productpreview = waRequest::post('shop_productpreview');

            foreach ($shop_productpreview as $key => $value) {
                $app_settings_model->set($this->plugin_id, $key, $value);
            }


            $post_templates = waRequest::post('templates');
            $reset_tpls = waRequest::post('reset_tpls');

            foreach ($this->templates as $id => $template) {
                if (isset($reset_tpls[$id])) {
                    $template_path = wa()->getDataPath($template['tpl_path'], false, 'shop', true);
                    @unlink($template_path);
                } else {

                    if (!isset($post_templates[$id])) {
                        throw new waException('Не определён шаблон');
                    }
                    $post_template = $post_templates[$id];

                    $template_path = wa()->getDataPath($template['tpl_path'], false, 'shop', true);
                    if (!file_exists($template_path)) {
                        $template_path = wa()->getAppPath($template['tpl_path'], 'shop');
                    }

                    $template_content = file_get_contents($template_path);
                    if ($template_content != $post_template) {
                        $template_path = wa()->getDataPath($template['tpl_path'], false, 'shop', true);

                        $f = fopen($template_path, 'w');
                        if (!$f) {
                            throw new waException('Не удаётся сохранить шаблон. Проверьте права на запись ' . $template_path);
                        }
                        fwrite($f, $post_template);
                        fclose($f);
                    }
                }
            }

            $this->response['message'] = "Сохранено";
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

}
