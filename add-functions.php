<?php
/**
*Author: Ashuwp
*Author url: http://www.ashuwp.com
*Version: 4.2
**/

/**Add the cod into your functions.php**/
require get_template_directory() . '/include/ashuwp_framework_core.php'; //必须 加载核心类
require get_template_directory() . '/include/ashuwp_options_feild.php'; //可选 设置页面
require get_template_directory() . '/include/ashuwp_termmeta_feild.php'; //可选 分类字段
require get_template_directory() . '/include/ashuwp_postmeta_feild.php'; //可选 文字字段
require get_template_directory() . '/include/import_export.php'; //可选 设置选项导入导出
require get_template_directory() . '/include/config.php'; //配置文件-按需配置
?>