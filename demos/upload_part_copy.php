<?php
/**
 * $ID: upload part copy.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-08-13 
 * @todo TODO
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';



/*
 * 通过Copy一个云存储中已存在的object,将其作为指定Multipart的一个part
 ×
 * 如果Copy成功则返回指定part的ETag，和Last Modify Time，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */
 
// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);

function upload_part_copy_test($sbucket,$skey,$dbucket,$dkey,$uploadid,$part_number) {
    global $storage;	
	try {
	    $result = $storage->upload_part_copy($sbucket,$skey,$dbucket,$dkey,$uploadid,$part_number);
	
	    success("Result of upload part copy from ({$sbucket},{$skey}) to ({$dbucket},{$dkey},{$uploadid},{$part_number}) is", $result);
	
	} catch (Exception $e) {
	    exception("Upload part copy from ({$sbucket},{$skey}) to ({$dbucket},{$dkey},{$uploadid},{$part_number}) failed!", $e);
	}
}

$sbucket = "huadong_test_c";
$skey = "test_copy.sh";
$dbucket = "huadong_bucket_test_php";
$dkey = "eclipse-jee-juno-linux-gtk-x86_64.tar.gz";
$uploadId = "481PZF5HNZEF7OO3EV0ZI9KAM";
upload_part_copy_test($sbucket,$skey,$dbucket,$dkey,$uploadId,1);