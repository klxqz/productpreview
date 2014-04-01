<?php

return array(
    'name' => 'Предпросмотр товаров',
    'description' => 'Быстрый просмотр товаров в каталоге',
    'vendor' => '985310',
    'version' => '1.0.0',
    'img' => 'img/productpreview.png',
    'shop_settings' => true,
    'frontend' => true,
    'handlers' => array(
        'frontend_head' => 'frontendHead',
    ),
);
//EOF
