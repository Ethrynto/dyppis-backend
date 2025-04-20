<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\App;

class BadRequestException extends Exception
{
    protected $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
        parent::__construct();
    }

    public function render($request)
    {
        return response()->json([
            'error' => 'Bad request',
            'message' => $this->data['messages'] ?? 'Bad request',
            'code' => $this->data['code'] ?? null,
            'details' => $this->data['details'] ?? null,
        ], 404);
    }
}
