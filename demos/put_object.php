<?php
/**
 * $ID: put_object.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-02-14 by Spring MC
 * @todo TODO
 * @update Modified on 2012-06-19 by Spring MC
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';

/*
 * 新建object
 ×
 * 如果新建成功则返回true，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 *
 * 注意：重复创建相同名称的object将会覆盖已经存在的object内容！！！
 */
 
 
// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);  
 

function put_object_test($host,$bucket_name){

    global $storage;
    $storage->set_host($host);
    // 设定操作默认bucket
   $storage->set_bucket($bucket_name);
	try {
	    // put_object()方法可以接收一个文件路径
	    $object_name = 'grand_cloud_logo.jpg';
	    $local_file = dirname(__FILE__) . '/logo.jpg';
	
	    $storage->put_object($object_name, $local_file);
	
	    success("Put object success!");
	
	} catch (Exception $e) {
	    exception('Put object failed!', $e);
	}
	
	// 使用stream方式新建object
	// put_object()方法可以接收一个stream对象作为输入
	try {
	    $object_name = 'grand_cloud_logo.jpg';
	    $local_stream = fopen(dirname(__FILE__) . '/logo.jpg', 'rb');
	
	    $storage->put_object($object_name, $local_stream);
	
	    success("Put object success!");
	
	} catch (Exception $e) {
	    exception('Put object failed!', $e);
	}
	
	// 盛大云存储中的对象是文件类型无关的，可以指定为任意名称
	// 将一张jpg图片的存储为txt扩展名的对象
	try {
	    $object_name = 'grand_cloud_logo.txt';
	    $local_file = dirname(__FILE__) . '/logo.jpg';
	
	    $storage->put_object($object_name, $local_file);
	
	    success("Put object success!");
	
	} catch (Exception $e) {
	    exception('Put object failed!', $e);
	}
	
	// 新建object，同时添加自定义META信息
	try {
	    $object_name = 'grand_cloud_logo_with_meta.jpg';
	    $object_meta = 'x-snda-meta-project: grand cloud storage, x-snda-meta-user: demo, x-snda-meta-user: guest';
	    $local_file = dirname(__FILE__) . '/logo.jpg';
	
	    $storage->put_object($object_name, $local_file, $object_meta);
	
	    success("Put object success!");
	
	} catch (Exception $e) {
	    exception('Put object failed!', $e);
	}
	
	// 新建object，同时添加自定义META信息
	try {
		$object_name = 'emptyfile';
		$object_meta = 'x-snda-meta-project: grand cloud storage, x-snda-meta-user: demo, x-snda-meta-user: guest';
		$local_file = dirname(__FILE__) . '/emptyfile';
	
		$storage->put_object($object_name, $local_file, $object_meta);
	
		success("Put object success!");
	
	} catch (Exception $e) {
		exception('Put object failed!', $e);
	}
	
	//创建空的Object,用于创建目录 
	try{
		$object_name = 'emptyobject/';
		$storage->put_object($object_name, null);
		success("Create empty object success");
	} catch (Exception $e) {
		exception('Create empty object failed',$e);
	}
}


foreach($CONFIG_TEST as $region=>$config) {
	put_object_test($config['host'],$config['bucket']);
}