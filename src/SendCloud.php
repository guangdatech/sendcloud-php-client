<?php

/**
 * SendCloud.php
 *
 * @copyright  2021 opencart.cn - All Rights Reserved
 * @link       http://www.guangdawangluo.com
 * @author     Edward Yang <yangjin@opencart.cn>
 * @created    2021-08-26 20:55:39
 * @modified   2021-08-26 20:55:39
 */

namespace Guangda\SendCloud;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class SendCloud
{
    const BASE_URI = 'https://api.sendcloud.net/apiv2/';

    private $apiUser;
    private $apiKey;
    private $from;
    private $fromName;
    private $client;

    /**
     * @param string $apiUser
     * @param string $apiKey
     */
    public function __construct(string $apiUser, string $apiKey)
    {
        $this->apiUser = $apiUser;
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'timeout' => 5.0
        ]);
    }

    /**
     * @param $apiUser
     * @param $apiKey
     * @return SendCloud
     */
    public static function getInstance($apiUser, $apiKey): SendCloud
    {
        return new self($apiUser, $apiKey);
    }

    /**
     * 设置发送来源邮件
     *
     * @param $fromEmail
     * @return $this
     */
    public function setFrom($fromEmail): SendCloud
    {
        $this->from = $fromEmail;
        return $this;
    }

    /**
     * 设置发送来源名称
     *
     * @param $fromName
     * @return $this
     */
    public function setFromName($fromName): SendCloud
    {
        $this->fromName = $fromName;
        return $this;
    }

    /**
     * 发送普通邮件
     * @see https://www.sendcloud.net/doc/email_v2/send_email/#_1
     *
     * @param $data
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function sendMail($data): ResponseInterface
    {
        $uri = 'mail/send';
        if (is_array($data['to'])) {
            $to = implode(';', $data['to']);
        } else {
            $to = $data['to'];
        }
        $useAddressList = (isset($data['useAddressList']) && $data['useAddressList']) ? 'true' : 'false';
        $param = array(
            'apiUser' => $this->apiUser,
            'apiKey' => $this->apiKey,
            'from' => $this->from,
            'fromName' => $this->fromName,
            'to' => $to,
            'subject' => $data['subject'] ?? '',
            'plain' => $data['plain'] ?? '',
            'html' => $data['html'] ?? '',
            'respEmailId' => 'true',
            'useAddressList' => $useAddressList
        );

        $requestData = [
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'form_params' => $param
        ];
        return $this->client->post($uri, $requestData);
    }

    /**
     * 通过 SendCloud 模板发送邮件
     * @see https://www.sendcloud.net/doc/email_v2/send_email/#_2
     *
     * @param $data
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function sendTemplate($data): ResponseInterface
    {
        $uri = 'mail/sendtemplate';
        if (is_array($data['to'])) {
            $to = implode(';', $data['to']);
        } else {
            $to = $data['to'];
        }
        $useAddressList = (isset($data['useAddressList']) && $data['useAddressList']) ? 'true' : 'false';
        $param = array(
            'apiUser' => $this->apiUser,
            'apiKey' => $this->apiKey,
            'from' => $this->from,
            'fromName' => $this->fromName,
            'to' => $to,
            'subject' => $data['subject'] ?? '',
            'templateInvokeName' => $data['templateInvokeName'] ?? '',
            'contentSummary' => $data['contentSummary'] ?? '',
            'useAddressList' => $useAddressList
        );

        $requestData = [
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'form_params' => $param
        ];
        return $this->client->post($uri, $requestData);
    }
}
