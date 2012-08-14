<?php
/**
 * $ID: list parts.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-07-24
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';

/*
 * 该操作用来列出一个MUltipart Upload中已经上传的Part
×
* 如果成功则返回Part列表，否则抛出异常
× 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
*/
// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);

$bucket = "huadong_bucket_test";
$key = "eclipse-jee-juno-linux-gtk-x86_64.tar.gz";
$uploadId = "729AIZ5C5OVWNLBX5E9T4OK0P";
try {
	$result = $storage->list_parts($bucket, $key, $uploadId);
	
	success("Your parts of ({$bucket},{$key},{$uploadId})", $result);

} catch (Exception $e) {
	exception("Get all parts of ({$bucket},{$key},{$uploadId}) failed!", $e);
}

// parts分页
try {
	$max_parts = 10;
	$part_number_marker = 40;

	$first_page_result = $storage->list_parts($bucket, $key, $uploadId,$max_parts,$part_number_marker);
		
	success("Your parts of ({$bucket},{$key},{$uploadId})(first page)", $first_page_result);

	$part_number_marker = $first_page_result->get_nextpartnumbermarker();
	if ($part_number_marker !== '') {
		$second_page_result = $storage->list_parts($bucket, $key, $uploadId,$max_parts,$part_number_marker);
		success("Your parts of ({$bucket},{$key},{$uploadId}) (second page)", $second_page_result);
		
	} else {
		info('There is no more parts.');
	}

} catch (Exception $e) {
	exception("Get parts of ({$bucket},{$key},{$uploadId}) failed!", $e);
}

