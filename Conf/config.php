<?php
return array (
  'DB_HOST' => 'localhost',
  'DB_NAME' => 'hlpw',
  'DB_USER' => 'root',
  'DB_PORT' => '3306',
  'DB_PREFIX' => '',
  'URL_MODEL'=> 0,
  'DB_SQL_BUILD_CACHE' => true,
  'CONSOLE_ON' => true,
  'TMPL_PARSE_STRING'  =>array(
     '__PUBLIC__' => './Common', // 更改默认的/Public 替换规则
     '__JS__' => './Common/JS/', // 增加新的JS类库路径替换规则
     '__CSS__' => './Common/CSS/', // 增加新的JS类库路径替换规则
     '__UPLOAD__' => './Uploads', // 增加新的上传路径替换规则
   ) 
);