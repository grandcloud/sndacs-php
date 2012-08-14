<?php
/**
 * $ID: get_allobjects.php $
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

/*
 * 获取bucket下所有object列表
 ×
 * 如果成功则返回GCBucket列表，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */

// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);  

function get_allobjects_test($bucket) {
	global $storage;
	try {
	    $maxkeys = 1000;
	    $marker = '';
	    $delimiter = '';
	    $prefix = '';
	
	    $result = $storage->get_allobjects($bucket, $maxkeys, $marker, $delimiter, $prefix);
	
	    success("Your objects of {$bucket}", $result);
	
	} catch (Exception $e) {
	    exception("Get objects of {$bucket} failed!", $e);
	}
	
	// object分页
	try {
	    
	    $maxkeys = 2;  // 每次获取2个object
	    $marker = '';  // 初始marker为空
	    $delimiter = '';
	    $prefix = '';
	
	    $first_page_result = $storage->get_allobjects($bucket, $maxkeys, $marker, $delimiter, $prefix);
	
	    success("Your objects of {$bucket} (first page)", $first_page_result);
	
	    // 获取分页marker
	    $marker = $first_page_result->get_marker();
	    if ($marker !== '') {
	        $second_page_result = $storage->get_allobjects($bucket, $maxkeys, $marker, $delimiter, $prefix);
	
	        success("Your objects of {$bucket} (second page)", $second_page_result);
	    } else {
	        info('There is no more objects.');
	    }
	
	} catch (Exception $e) {
	    exception("Get objects of {$bucket} failed!", $e);
	}

}

foreach($CONFIG_TEST as $region=>$config) {
	get_allobjects_test($config['bucket']);
}