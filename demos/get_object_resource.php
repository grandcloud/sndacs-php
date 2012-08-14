<?php
/**
 * $ID: get_object_resource.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-02-20 by Spring MC
 * @todo TODO
 * @update Modified on 2012-06-20 by Spring MC
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';




/*
 * 获取object资源链接
 ×
 * 如果获取成功则返回链接URL，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */
 
// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);
function get_object_resource_test($bucket_name,$cname){
	
	global $storage;
	// 设定默认bucket
	$storage->set_bucket($bucket_name);
	
	// 设定bucket cname
	$storage->set_bucket_cname($cname);
	
	try {
	    $object_name = 'grand_cloud_logo.jpg';
	
	    $resource_url = $storage->get_object_resource($object_name, 5*60); // 有效期 5 min
	
	    success('Resource is', $resource_url);
	
	} catch (Exception $e) {
	    exception('Get object resource failed!', $e);
	}
}


foreach($CONFIG_TEST as $region=>$config) {
	get_object_resource_test($config['bucket'],$config['cname']);
}