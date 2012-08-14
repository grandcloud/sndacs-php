<?php
/**
 * $ID: folder_object.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-06-20 by Spring MC
 * @todo TODO
 * @update Modified on 2012-06-20 by Spring MC
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';




// 如果存储的对象数目众多，你可能会想如果有类似目录结构的组织方式就好了，这可以借助盛大云存储API对prefix和delimiter的支持来实现。

/*
 * 新建folder
 * folder就是一个特殊的object，如果调用put_object()方法时传递的$source参数为null值，则会创建一个名为“folder_name/”的object。
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

function foler_object_test($host,$bucket_name) {
    global $storage;
    // 设定操作默认bucket
    $storage->set_bucket($bucket_name);
    // 设定Host:必须根据Region设定准确的host
    $storage->set_host($host);
	try {
	    // 调用put_object()方法创建一个目录
	    // 注意：$source参数必须为null！！！
	    $folder_object_name = 'grand_cloud/';
	
	    $storage->put_object($folder_object_name, null);
	
	    success("Put folder object success!");
	
	} catch (Exception $e) {
	    exception('Put folder object failed!', $e);
	}
	
	// 创建folder后如何上传object呢？
	// 如果你想往某个folder下上传object，只需要将object的名称指定为“folder_name/object_name”格式即可，即以folder的名称作为前缀。
	try {
	    // 其实你可以直接创建“folder_name/object_name”名称的object，而无需先创建一个“folder_name”的object。
	    $object_name = 'grand_cloud/logo.jpg';
	    $local_file = dirname(__FILE__) . '/logo.jpg';
	
	    $storage->put_object($object_name, $local_file);
	
	    success("Put object success!");
	
	} catch (Exception $e) {
	    exception('Put object failed!', $e);
	}
	
	// 如何将bucket下的object按照folder方式操作呢？
	// 只需在调用get_allobjects()方法时传递$delimiter参数即可。
	try {
	    $maxkeys = 1000;
	    $marker = '';
	    $delimiter = '/';  // 将$delimiter设置为目录分隔符“/”
	    $prefix = '';
	
	    $folder_objects = $storage->get_allobjects($bucket_name, $maxkeys, $marker, $delimiter, $prefix);
	
	    success("Your folder objects", $folder_objects);
	
	} catch (Exception $e) {
	    exception('Get folder objects failed!', $e);
	}
	
	// 如何列出某个folder下的object呢？
	// 只需在调用get_allobjects()方法时传递$prefix参数即可
	// 注意：$prefix值必须为“folder_name/”格式！！！
	try {
	    $maxkeys = 1000;
	    $marker = '';
	    $delimiter = '/';  // 将$delimiter设置为目录分隔符“/”
	    $prefix = 'grand_cloud/';  // 将$prefix设置为目录“grand_cloud/"
	
	    $folder_objects = $storage->get_allobjects($bucket_name, $maxkeys, $marker, $delimiter, $prefix);
	
	    success("Your folder({$prefix}) objects", $folder_objects);
	
	} catch (Exception $e) {
	    exception("Get folder({$prefix}) objects failed!", $e);
	}
}

foreach($CONFIG_TEST as $region=>$config) {
	foler_object_test($config['host'],$config['bucket']);
}