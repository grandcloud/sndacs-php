<?php
/**
 * $ID: put_bucket_policy.php $
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
 * 设置bucket访问控制
 *
 * 如果创建成功则返回true，否则抛出异常
 * 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */
 
// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET); 

function put_bucket_policy_test($host,$bucket_name) {
	global $storage;	
	try {
        $storage->set_host($host);
	    $bucket_resouce = "{$bucket_name}/*";
	    $bucket_policy = array(
	        array(  // 允许匿名用户访问 $bucket_name
	            'Sid' => 'public-get-object',
	            'Effect' => 'Allow',
	            'Principal' => array(
	                'SNDA' => '*'
	            ),
	            'Action' => 'storage:GetObject',
	            'Resource' => "srn:snda:storage:::{$bucket_resouce}"
	        )
	    );
	
	    $storage->put_bucket_policy($bucket_name, $bucket_policy);
	    
	    success("Put bucket({$bucket_name}) policy success!");
	
	} catch (Exception $e) {
        printf($storage->get_response_code());
	    exception("Put bucket({$bucket_name}) policy failed!", $e);
	}
}

foreach($CONFIG_TEST as $region=>$config) {
	put_bucket_policy_test($config['host'],$config['bucket']);
}