
<?php
/**
 * $ID: copy_object.php $
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
 * 该操作将一个云存储上已存在的object拷贝为指定Bucket下的指定Object
 ×
 * 如果Copy成功则返回指定part的ETag，和Last Modify Time，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */
 
// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);

function copy_object_test($sbucket,$skey,$dbucket,$dkey) {
    global $storage;

	
	try {
	   
	    $result = $storage->copy_object($sbucket,$skey,$dbucket,$dkey);
	
	    success("Result of Copy Object from ({$sbucket},{$skey}) to ({$dbucket},{$dkey}) is", $result);
	
	} catch (Exception $e) {
	    exception("Copy Object from ({$sbucket},{$skey}) to ({$dbucket},{$dkey}) failed!", $e);
	}
}

$sbucket = "huadong_test_c";
$skey = "test_copy.sh";
$dbucket = "huadong_bucket_test_php";
$dkey = "test_copylala.sh";
copy_object_test($sbucket,$skey,$dbucket,$dkey);