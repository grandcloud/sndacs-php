<?php
/**
 * $ID: get_bucket_policy.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-06-21 by Spring MC
 * @todo TODO
 * @update Modified on 2012-06-21 by Spring MC
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';

/*
 * 获取bucket访问控制信息
 *
 * 如果成功返回Bucket policy的信息（json），否则抛出异常
 * 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 *
 */
 
// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET); 

function get_bucket_policy($bucket_name) {
	global $storage;
	try {
	    $bucket_policy = $storage->get_bucket_policy($bucket_name);
	
	    success("Your bucket({$bucket_name}) policy", json_decode($bucket_policy, true));
	
	} catch (Exception $e) {
	    exception("Get bucket({$bucket_name}) policy failed!", $e);
	}
}

foreach($CONFIG_TEST as $region=>$config) {
	get_bucket_policy($config['bucket']);
}