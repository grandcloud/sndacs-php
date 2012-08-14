<?php
/**
 * $ID: head_bucket.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-07-10 by Spring MC
 * @todo TODO
 * @update Modified on 2012-07-10 by Spring MC
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';

/*
 * 删除bucket
 ×
 * 如果删除成功则返回true，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 *
 * 注意：如果bucket内容非空则无法删除！！！
 */

// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET); 

function head_bucket_test($bucket_name) {
	global $storage;
	try {
	    $result = $storage->head_bucket($bucket_name);
	    success("Meta of {$bucket_name} is", $result);
	
	} catch (Exception $e) {
	    exception('Head bucket failed!', $e);
	}
}

foreach($CONFIG_TEST as $region=>$config) {
	head_bucket_test($config['bucket']);
}
