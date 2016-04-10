<?php
/**
 * @Author: chensi
 * @Date:   2016-04-10 01:53:36
 * @Last Modified by:   anchen
 * @Last Modified time: 2016-04-10 01:59:59
 */
require './response.php';

$arr=[
    'id'=>1,
    'name'=>'chensi',
];

Response::json(200,'数据返回成功',$arr);
