<?php
/**
 * $ID: complete multipart upload $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-07-24
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';

/*
 * 初始化一个MUltipart upload对象
 ×
 * 如果添加成功则返回该对象的基本信息（bucket,key,uploadid），否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 */
try {
    $bucket_name = GRAND_CLOUD_BUCKET_HUADONG;
    $key = "eclipse-jee-juno-linux-gtk-x86_64.tar.gz";
    $uploadid = "6FTJJKN4VWCTLJR294SLUXV5V";
    $result = $storage->complete_multipartupload($bucket_name, $key, $uploadid);
    //do something..
    success("Complete multipart upload({$bucket_name},{$key},{$uploadid}) success !",$result);

} catch (Exception $e) {
    exception("Complete multipart upload({$bucket_name},{$key},{$uploadid}) failed !", $e);
}
