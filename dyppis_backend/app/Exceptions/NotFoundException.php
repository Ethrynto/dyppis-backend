<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\App;

class NotFoundException extends Exception
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
            'error' => "Not Found",
            'message' => $this->data['message'] ?? 'Resource not found',
            'code' => $this->data['code'] ?? null,
            'details' => $this->data['details'] ?? null,
        ], 404);
    }
}
