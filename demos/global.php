<?php
require_once dirname(__FILE__).'/../sdk/GrandCloudStorage.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Shanghai');

define('ACCESS_KEY', ''); // 请在此处输入您的AccessKey
define('ACCESS_SECRET', ''); // 请在此处输入您的AccessSecret
define('GRAND_CLOUD_HOST_DEFAULT', 'http://storage.grandcloud.cn');

$CONFIG_TEST = array('huabei-1' => array(  //此处为测试用的配置信息
					        'bucket' => 'huabei_bucket_test_php',
					        'cname' => 'http://storage-huabei-1.sdcloud.cn',
					        'host' => 'http://storage-huabei-1.grandcloud.cn'
					         ),
					  'huadong-1' => array(
					        'bucket' => 'huadong_bucket_test_php',
					        'cname' => 'http://storage-huadong-1.sdcloud.cn',
					        'host' => 'http://storage-huadong-1.grandcloud.cn'
					        )
					    );
					    
function info($title) {
    echo "========= {$title} =========\n";
}

function success($message, $data=null) {
    $dt = date('c');
    if ($data === null) {
        echo "[{$dt}] - {$message}\n\n";
    } else {
        echo "[{$dt}] - {$message} => ";
        print_r($data);
        echo "\n";
    }
}

function exception($message, $e) {
    $dt = date('c');
    $space = str_pad('', (strlen("[{$dt}] - ") - strlen("[Errno] - ")));

    echo "[{$dt}] - {$message}\n";
    echo "{$space}[Errno] - " . $e->getCode() . "\n";
    echo "{$space}[Error] - " . $e->getMessage() . "\n\n";
}
