<?php
	return [
		/* 阿里云 */
		// 查看accessKey：https://usercenter.console.aliyun.com/#/manage/ak
		'accessKeyId' => '',
		'accessKeySecret' => '',
		// 短信签名：https://dysms.console.aliyun.com/dysms.htm?spm=5176.8195934.907839.sms8.43514183nirfVn#/develop/sign
		'sign'	=>	'',
		// 短信模板：https://dysms.console.aliyun.com/dysms.htm?spm=5176.8195934.907839.sms8.43514183nirfVn#/develop/template
		'templeteCode' => [
			'register' => '',		// 注册模板ID
			'mobile'   => '',		// 修改绑定手机模板ID
			'password' => ''		// 忘记密码模板ID
		]
	];
?>