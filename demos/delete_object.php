<?php
/**
 * $ID: delete_object.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-02-14 by Spring MC
 * @todo TODO
 * @update Modified on 2012-06-20 by Spring MC
 * @update Modified on 2012-07-26
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';



/*
 * 删除object
 ×
 * 如果删除成功则返回true，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */
 
// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);

function delete_object_test($bucket) {
	global $storage;
	$storage->set_bucket($bucket);
	try {
	    $object_name = 'grand_cloud_logo.txt';
	
	    $storage->delete_object($object_name);
	
	    success("Delete object success!");
	
	} catch (Exception $e) {
	    exception('Delete object failed!', $e);
	}
}

foreach($CONFIG_TEST as $region=>$config) {
	delete_object_test($config['bucket']);
}
