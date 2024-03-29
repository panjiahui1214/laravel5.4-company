<?php

namespace App\Libs\Aliyun;

use Config;
use Aliyun\Core\SmsConfig;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\SendBatchSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;

// 加载区域结点配置
SmsConfig::load();

class Sms
{
    /**
     * 取得AcsClient
     *
     * @return DefaultAcsClient
     */
    public function __construct() {
        //产品名称:云通信流量服务API产品,开发者无需替换
        $product = "Dysmsapi";

        //产品域名,开发者无需替换
        $domain = "dysmsapi.aliyuncs.com";

        $accessKeyId = Config::get('sms.accessKeyId');
        $accessKeySecret = Config::get('sms.accessKeySecret');

        // 暂时不支持多Region
        $region = "cn-hangzhou";

        // 服务结点
        $endPointName = "cn-hangzhou";

        //初始化acsClient,暂不支持region化
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

        // 增加服务结点
        DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);

        // 初始化AcsClient用于发起请求
        $this->acsClient = new DefaultAcsClient($profile);
    }

    /**
     * 发送短信
     * @return stdClass
     */
    public function sendSms($phoneNumber, $templeteCode, $smsCode) {

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();

        //可选-启用https协议
        //$request->setProtocol("https");

        // 必填，设置短信接收号码
        $request->setPhoneNumbers($phoneNumber);

        // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $request->setSignName(Config::get('sms.sign'));

        // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $request->setTemplateCode($templeteCode);

        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        $request->setTemplateParam(json_encode(array(  // 短信模板中字段的值
            "code"=>$smsCode
        ), JSON_UNESCAPED_UNICODE));

        // 可选，设置流水号
        //$request->setOutId("yourOutId");

        // 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
        //$request->setSmsUpExtendCode("1234567");

        // 发起访问请求
        $acsResponse = $this->acsClient->getAcsResponse($request);

        return $acsResponse;
    }


    /**
     * 短信发送记录查询
     * @return stdClass
     */
    public function querySendDetails($phoneNumber, $sendDate, $pageSize, $currentPage) {

        // 初始化QuerySendDetailsRequest实例用于设置短信查询的参数
        $request = new QuerySendDetailsRequest();

        //可选-启用https协议
        //$request->setProtocol("https");

        // 必填，短信接收号码
        $request->setPhoneNumber($phoneNumber);

        // 必填，短信发送日期，格式Ymd，支持近30天记录查询
        $request->setSendDate($sendDate);

        // 必填，分页大小
        $request->setPageSize($pageSize);

        // 必填，当前页码
        $request->setCurrentPage($currentPage);

        // 选填，短信发送流水号
        //$request->setBizId("yourBizId");

        // 发起访问请求
        $acsResponse = $this->acsClient->getAcsResponse($request);

        return $acsResponse;
    }

}