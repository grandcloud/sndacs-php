<?php
/**
 * $ID: abort_multipartupload.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-07-23
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';




/*
 * 终止一个MultipartUpload
 ×
 * 如果成功则返回true，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */
 
// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);

function abort_multipart_uploadtest($bucket_name) {
	global $storage;
	try {
	    $key = "testmultipart";
	    $uploadId = "EZ05MD0O8D1DIYVEIO8BUUW44";
	
	    $storage->abortMultipartUpload($bucket_name, $key, $uploadId);
	    // do something ..
	    success("Abort multipartupload success!");
	
	} catch (Exception $e) {
	    exception('Abort multipartupload failed!', $e);
	}
	
	/**
	 * 终止一个Bucket下的前十个MultipartUpload
	 */
	try {
		$entity = $storage->get_all_multipart_upload($bucket_name);
	    $multipart_uploads = $entity->get_upload();
	    foreach($multipart_uploads as $multipart_upload) {
	    	$key = $multipart_upload -> get_key();
	    	$uploadid = $multipart_upload -> get_uploadid();
	    	$storage->abortMultipartUpload($bucket_name, $key,$uploadid);
	    	success("Abort multipartupload ({$bucket_name},{ $key },{ $uploadid })success!");
	    }
	    
	}catch (Exception $e) {
	    exception('Abort multipartupload failed!', $e);
	}
}

foreach($CONFIG_TEST as $region=>$config) {
	abort_multipart_uploadtest($config['bucket']);
}