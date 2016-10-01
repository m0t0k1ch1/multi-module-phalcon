<?php

namespace Multi\Backend\Controllers;

class ControllerBase extends \Phalcon\Mvc\Controller
{
    protected function sendValidationMessages($messages, $statusCode = 400)
    {
        $body = [];
        foreach ($messages as $message) {
            $body[] = $message->getMessage();
        }

        $this->sendJsonResponse([
            'message' => $body,
        ]);
    }

    protected function sendJsonResponse($body, $statusCode = 200)
    {
        $response = new \Phalcon\Http\Response;
        $response->setStatusCode($statusCode);
        $response->setJsonContent($body);
        $response->send();
    }
}
