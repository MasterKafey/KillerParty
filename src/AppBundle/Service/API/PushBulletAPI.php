<?php

namespace AppBundle\Service\API;


use AppBundle\Service\Business\RequestBusiness;
use Symfony\Component\HttpFoundation\Request;

class PushBulletAPI
{
    const PUSH_BULLET_API_URL = 'https://api.pushbullet.com/v2/';

    private $token;
    private $requestBusiness;
    private $mainPhone;

    public function __construct(RequestBusiness $requestBusiness, $pushBulletToken, $mainPhone)
    {
        $this->requestBusiness = $requestBusiness;
        $this->token = $pushBulletToken;
        $this->mainPhone = $mainPhone;
    }

    private function getAuthorizationHeaders()
    {
        return array('Access-Token: ' . $this->token);
    }

    private function getResponse($uri, $method = Request::METHOD_GET, $postParameter = array(), $headers = array())
    {

        return json_decode($this->requestBusiness->getResponse(self::PUSH_BULLET_API_URL . $uri, $method, $postParameter, array_merge($headers, $this->getAuthorizationHeaders())));
    }

    public function getCurrentUser()
    {
        return $this->getResponse('users/me');
    }

    public function getDevices()
    {
        return $this->getResponse('devices');
    }

    public function sendMessage($phoneNumber, $message)
    {
        return $this->getResponse('ephemerals', Request::METHOD_POST, json_encode(array(
            'type' => 'push',
            'push' => array(
                'type' => 'messaging_extension_reply',
                'package_name' => 'com.pushbullet.android',
                'source_user_iden' => $this->getCurrentUser()->iden,
                'target_device_iden' => $this->mainPhone,
                'conversation_iden' => $phoneNumber,
                'message' => $message,
            )
        )));
    }
}
