<?php
/**
 * $ID: initiate multipart upload $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-07-20
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';

/*
 * 初始化一个MUltipart upload对象
 ×
 * 如果添加成功则返回该对象的基本信息（bucket,key,uploadid），否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */
// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);
 
function initiate_multipart_upload_test($bucket_name) {
	global $storage;
	try {
	    $key = "eclipse-jee-juno-linux-gtk-x86_64.tar.gz";
	    /**添加自定义META信息*/
	    $object_meta = 'x-snda-meta-project: grand cloud storage, x-snda-meta-user: demo, x-snda-meta-user: guest';
	    $result = $storage->initiate_multipart_upload($bucket_name, $key,$object_meta);
	    success("Initiate multipart upload({$bucket_name},{$key})",$result);
	
	} catch (Exception $e) {
	    exception("Initiate multipart upload({$bucket_name},{$key})  failed!", $e);
	}
}

foreach($CONFIG_TEST as $region=>$config) {
	initiate_multipart_upload_test($config['bucket']);
}