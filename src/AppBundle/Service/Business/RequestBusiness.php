<?php

namespace AppBundle\Service\Business;


use Symfony\Component\HttpFoundation\Request;

class RequestBusiness
{
    public function getResponse($uri, $method = Request::METHOD_GET, $postParameters = array(), $headers = array())
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_FOLLOWLOCATION => true,
        );

        if(Request::METHOD_POST === $method) {
            if(is_array($postParameters)) {
                $options[CURLOPT_POSTFIELDS] = http_build_query($postParameters);
            } else {
                $options[CURLOPT_POSTFIELDS] = $postParameters;
            }
        }

        $ch = curl_init($uri);
        curl_setopt_array($ch, $options);

        $content  = curl_exec($ch);
        curl_close($ch);

        return $content;
    }
}
