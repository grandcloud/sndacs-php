<?php
/**
 * $ID: put_bucket.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-02-14 by Spring MC
 * @todo TODO
 * @update Modified on 2012-06-19 by Spring MC
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';

/*
 * 新建bucket
 *
 * 如果创建成功则返回true，否则抛出异常
 * 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 *
 * 注意：bucket名称全局唯一，当名称已存在时则抛出异常
 */
 
// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET); 

function put_bucket_test($bucket_name,$idc) {
    global $storage;
	try {
	    $storage->put_bucket($bucket_name,$idc);
	    success("Put bucket({$bucket_name},{$idc}) success!");
	
	} catch (Exception $e) {
	    exception("Put bucket({$bucket_name},{$idc}) failed!", $e);
	}
}

foreach($CONFIG_TEST as $idc=>$config) {
	put_bucket_test($config['bucket'],$idc);
}
