<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

class ApiController
{

    const CREATED = 201;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const NOT_FOUND = 404;
    const INTERNAL_SERVER_ERROR = 500;

    protected function transformJsonBody(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        if ($data === null) {
            return $request;
        }

        return $data;
    }

}