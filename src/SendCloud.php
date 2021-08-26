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
class SendCloud
{
    const BASE_URI = 'https://api.sendcloud.net/apiv2/';

    protected $apiUser;

    protected $apiKey;

    /**
     * @param string $apiUser
     * @param string $apiKey
     */
    public function __construct(string $apiUser, string $apiKey)
    {
        $this->apiUser = $apiUser;
        $this->apiKey = $apiKey;
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

    public function send()
    {
        echo 11;
    }

    public function sendTemplate()
    {

    }
}