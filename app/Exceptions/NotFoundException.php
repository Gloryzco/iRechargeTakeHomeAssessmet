<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public $is_success;
    public $message;
    public $code;

    public function __construct($is_success, $message, $code)
    {
        $this->is_success = $is_success;
        $this->message = $message;
        $this->code = $code;
    }

    public function render()
    {
        return response()->json([
            'success' => $this->is_success,
            'message' => $this->message,
        ], $this->code);
    }
}