<?php
/**
 * $ID: put object by multipart upload.php $
 +------------------------------------------------------------------
 * @project Grand Cloud Storage
 * @create Created on 2012-07-23
 * @todo TODO
 +------------------------------------------------------------------
 * @copyright SNDA @2012
 * @link http://www.grandcloud.cn
 */
require_once dirname(__FILE__).'/global.php';


/*
 * 通过Multipart Upload上传一个文件
 ×
 * 如果上传成功则返回true，否则抛出异常
 × 可以通过异常对象的getCode()方法和getMessage()方法获取对应的错误码和错误信息

 * 以流的方式分块上传文件
 */

// 实例化GrandCloudStorage对象
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST_DEFAULT);
// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);

function put_object_by_multipart_upload_test($host,$bucket_name) {
    global $storage;
    $storage->set_host($host);
	try {
		// upload_part()方法还可以接收一个stream对象
		$part_size = 5*1024*1024;//除最后一个part之外，其它每个part至少5M
		$key = 'eclipse-jee-juno-linux-gtk-x86_64.tar.gz';
		$localfile = '/home/fun/Downloads/eclipse-jee-juno-linux-gtk-x86_64.tar.gz';
		$init_result = $storage -> initiate_multipart_upload($bucket_name, $key);
		success("init multipart upload({$bucket_name},{$key}) success!",$init_result);
		
		$local_stream = fopen($localfile, 'rb');
		$filelength = filesize($localfile);
		$uploadid = $init_result["UploadId"];
		$part_number =1;
		$cur = 0;
		while($cur < $filelength) {
		   $next = $cur+$part_size;
		   if($next> $filelength) {
		   	$next = $filelength;
		   }
		   $part_size = $next - $cur;
		   try{
		       $storage->upload_part($bucket_name, $key, $uploadid, $part_number, $local_stream,$part_size);
		   	   success("upload part {$part_number} success!");
		   } catch (Exception $e) {
	          exception("Upload part {$part_number} failed!", $e);
	          throw $e;
	       }
	       
	       $cur = $next;
	       $part_number += 1;
	       if(false  === is_resource($local_stream)) {  //注意：经过upload_part的调用后，$local_stream会被关闭
	       	$local_stream = fopen($localfile,"rb");
	       }
	       fseek($local_stream, $cur,0);
	     //  break;
		}
		fclose($local_stream);
		success("Upload success!");
		
		$result = $storage->complete_multipartupload($bucket_name, $key, $uploadid);
		
		success("Complete multipart upload({$bucket_name},{$key},{$uploadid}) success !",$result);
	} catch (Exception $e) {
		exception('Upload part failed!', $e);
	}

}

foreach($CONFIG_TEST as $region=>$config) {
	put_object_by_multipart_upload_test($config['host'],$config['bucket']);
}
