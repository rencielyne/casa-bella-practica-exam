<?php

namespace App\Exceptions;

use Exception;

class FailedToCreateException extends Exception
{
    public function render($request)
    {       
        return response()->json([
            'status'  => 'error', 
            'message' => $this->getMessage()
        ], 400);       
    }
}
