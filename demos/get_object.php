<?php
/**
 * $ID: get_object.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-02-14 by Spring MC
 * @todo TODO
 * @update Modified on 2012-06-20 by Spring MC
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';



/*
 * 获取object
 ×
 * 如果获取成功则返回true，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 *
 * 注意：首先，确保脚本对本地文件系统具有可写权限；其次，如果本地已存在同名文件，该操作将会覆盖本地文件内容！！！
 */
 

// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);
 
function get_object_test($bucket_name) {
	
	global $storage;
	// 设定默认bucket
    $storage->set_bucket($bucket_name);
	try {
	    // 这里我们将put_object.php示例中创建的grand_cloud_logo.txt对象保存为本地tmp_logo.jpg文件，
	    // 这样就能正确的浏览本地文件了。
	    $object_name = 'grand_cloud_logo.txt';
	    $local_file = dirname(__FILE__) . '/tmp_logo.jpg';
	
	    $storage->get_object($object_name, $local_file);
	
	    success("Get object success!");
	
	} catch (Exception $e) {
	    exception('Get object failed!', $e);
	}
	
	// 使用stream方式新建object
	// get_object()方法可以接收一个stream对象作为输出
	try {
	    $object_name = 'grand_cloud_logo.txt';
	    $local_file = dirname(__FILE__) . '/tmp_logo_stream.jpg';
	
	    $local_fp = fopen($local_file, 'wb');
	    if ($local_fp) {
	        $auto_close_stream = false;
	
	        $storage->get_object($object_name, $local_fp, $auto_close_stream);
	
	        // close the stream manual
	        fclose($local_fp);
	
	        success("Get object success!");
	    } else {
	        info("Oops~, cannot open {$local_file}");
	    }
	
	} catch (Exception $e) {
	    exception('Get object failed!', $e);
	}

}

foreach($CONFIG_TEST as $region=>$config) {
	get_object_test($config['bucket']);
}