<?php
return array(
    // 自动加载静态资源（HyFrameController）
    'LOAD_ASSETS' =>array(
        'PAGES'		=>	array(
            'CSS'	=>	array(
            ),
            'JS'	=>	array(
                'Category/all' => array(
                    'category.js'
                ),
                'Detail/all'=>array(
                    'couse-fullscreen.js'
                )
            )
        ),
        'PLUGINS'	=>	array(
            'JS'	=>	array(
                'Detail/all'	=>	array(
                    'ueditor/ueditor.config.js',
                    'ueditor/ueditor.all.min.js',
                    'ueditor/lang/zh-cn/zh-cn.js'
                )
            )
        ),

    ),

);