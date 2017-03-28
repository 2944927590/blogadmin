<?php
/**
 * 获得sessionId
 */

function ss_logtime(){
	return session('loginLastTime');
}
/**
 * 字符串命名风格转换
 * 将字符串转变为（小）驼峰式写法
 * @param string $name 字符串
 * @return string
 */
function my_parse_name($name){
	return preg_replace_callback('/_([a-zA-Z])/',function($match){return strtoupper($match[1]);}, $name);
}