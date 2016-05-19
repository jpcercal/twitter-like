<?php

namespace Cekurte\TwitterLike\Response;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * ConstraintViolationResponse
 */
class ConstraintViolationResponse extends Response
{
    /**
     * @inheritdoc
     */
    public function __construct(ConstraintViolationList $errors, $status = 400, $headers = [])
    {
        $messages = [];

        foreach ($errors as $error) {
            $messages[] = sprintf('%s', $error->getMessage());
        }

        parent::__construct(json_encode($messages), $status, array_merge($headers, [
            'Content-Type' => 'application/json'
        ]));
    }
}
