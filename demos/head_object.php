<?php
/**
 * $ID: head_object.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-02-14 by Spring MC
 * @todo TODO
 * @update Modified on 2012-06-19 by Spring MC
 * @update Modified on 2012-07-26 
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';



/*
 * 获取object meta
 ×
 * 如果object存在则返回array('name'=>'', 'meta'=>array(), 'size'=>'')数组，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */
 
// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);

function head_object_test($bucket_name) {
    global $storage;
    // 设定默认bucket
    $storage->set_bucket($bucket_name);
	
	try {
	    // 使用put_object.php创建的 grand_cloud_logo_with_meta.jpg
	    $object_name = 'grand_cloud_logo_with_meta.jpg';
	
	    $result = $storage->head_object($object_name);
	
	    success("Meta of {$object_name} is", $result);
	
	} catch (Exception $e) {
	    exception('Head object failed!', $e);
	}
}


foreach($CONFIG_TEST as $region=>$config) {
	head_object_test($config['bucket']);
}
