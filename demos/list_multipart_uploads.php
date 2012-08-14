<?php
/**
 * $ID: list_multipart_uploads.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-07-23
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';

/*
 * 获取bucket下所有MultipartUploads列表
×
* 如果成功则返回GCBucket列表，否则抛出异常
× 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
*/

// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);  

function list_multipart_upload_test($bucket) {
	global $storage;
	try {
		$maxuploads = 1000;
		$keymarker = '';
		$uploadidmarker = '';
		$delimiter = '';
		$prefix = '';
	
		$result = $storage->get_all_multipart_upload($bucket, $keymarker, $uploadidmarker, $maxuploads, $prefix,$delimiter);
	    $multipart_uploads = $result->get_object();
	  
		success("Your multipartuploads of {$bucket}", $result);
	
	} catch (Exception $e) {
		exception("Get all multipartuploads of {$bucket} failed!", $e);
	}
	
	// object分页
	try {
		$maxuploads = 2;
		$keymarker = '';
		$uploadidmarker = '';
		$delimiter = '';
		$prefix = '';
	
		$first_page_result =$storage->get_all_multipart_upload($bucket, $keymarker, $uploadidmarker, $maxuploads, $prefix,$delimiter);
		
	
		success("Your multipartuploads of {$bucket} (first page)", $first_page_result);
	
		// 获取分页marker
		$keymarker = $first_page_result->get_nextKeyMarker();
		$uploadidmarker = $first_page_result -> get_nextUploadIdMarker();
		if ($keymarker !== '') {
			$second_page_result = $storage->get_all_multipart_upload($bucket, $keymarker, $uploadidmarker, $maxuploads, $prefix,$delimiter);
	
			success("Your multipartuploads of {$bucket} (second page)", $second_page_result);
			
		} else {
			info('There is no more multipartuploads.');
		}
	
	} catch (Exception $e) {
		exception("Get all multipartuploads of {$bucket} failed!", $e);
	}
}


foreach($CONFIG_TEST as $region=>$config) {
	list_multipart_upload_test($config['bucket']);
}