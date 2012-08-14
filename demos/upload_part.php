<?php
/**
 * $ID: upload_part.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-07-23
 * @todo TODO
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';

// 设定操作默认bucket

/*
 * 上传Multipart upload的一个Part
 ×
 * 如果上传成功则返回true，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息
 *
 * 注意：同一MultipartUpload下相同partid的Part将会覆盖已经存在的Part内容！！！
 */

// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);
$bucket_name = "huadong_bucket_test";
try {
    // upload_part()方法还可以接收一个stream对象
    $key = 'eclipse-jee-juno-linux-gtk-x86_64.tar.gz';
    $local_stream = fopen(dirname(__FILE__) . '/logo.jpg', 'rb');
    $uploadid = "729AIZ5C5OVWNLBX5E9T4OK0P";
    $part_number =1;
    $storage->upload_part($bucket_name, $key, $uploadid, $part_number, $local_stream);

    success("Upload part success!");

} catch (Exception $e) {
    exception('Upload part failed!', $e);
}

// 使用文件路径方式新建Upload Part
// upload_part方法可以接收一个文件路径作为输入
try {
    // upload_part()方法还可以接收一个stream对象
    $key = 'eclipse-jee-juno-linux-gtk-x86_64.tar.gz';
    $filepath = dirname(__FILE__) . '/logo.jpg';
    $uploadid = "729AIZ5C5OVWNLBX5E9T4OK0P";
    $part_number =1;
    $storage->upload_part($bucket_name, $key, $uploadid, $part_number, $filepath);
    //do something..
    success("Upload part success!");

} catch (Exception $e) {
    exception('Upload part failed!', $e);
}



