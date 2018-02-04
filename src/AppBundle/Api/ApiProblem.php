<?php

namespace AppBundle\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * A wrapper for holding data to be used for a application/problem+json response
 */
class ApiProblem
{
    private $title;
    private $type;
    private $statusCode;
    private $errors;
    private $message;
    private $detail;

    const VALIDATION_TYPE = 'validation_error';
    const INVALID_BODY_FORMAT_TYPE = 'invalid_body_format';

    private $titles = [
        self::VALIDATION_TYPE => 'There was a validation error',
        self::INVALID_BODY_FORMAT_TYPE => 'There was an error in passing data',
    ];

    public function __construct($statusCode, $type = null, $errors = null, $detail = null)
    {
        $this->statusCode = $statusCode;
        $this->errors['errors'] = $errors;
        $this->detail = $detail;
        if (empty($type)) {
            $this->type = 'about:blank';
            $this->title = Response::$statusTexts[$statusCode];
        } else {
            $this->title = $this->titles[$type];
            $this->type = $type;
        }

        $this->prepareMessage();
    }

    private function prepareMessage()
    {
        $message = [
            'type' => $this->type,
            'title' => $this->title,
            'detail' => $this->detail,
        ];
        $json = json_encode(array_merge($message, $this->errors));

        $this->message = $json;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getMessage()
    {
        return $this->message;
    }

}
