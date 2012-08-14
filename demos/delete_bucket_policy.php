<?php
/**
 * $ID: delete_bucket_policy.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-07-20
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';

/*
 * 删除Bucket的Policy
 *
 * 如果删除成功则返回true，否则抛出异常
 * 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 *
 */
// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET); 
function delete_bucket_policy_test($bucket_name) {
	global $storage;
	try {
	   
	    $storage->delete_bucket_policy($bucket_name);
	
	    success("Delete bucket({$bucket_name}) success!");
	
	} catch (Exception $e) {
	    exception("Delete bucket({$bucket_name}) policy failed!", $e);
	}
}

foreach($CONFIG_TEST as $region=>$config) {
	delete_bucket_policy_test($config['bucket']);
}