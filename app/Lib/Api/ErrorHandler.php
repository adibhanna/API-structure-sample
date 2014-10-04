<?php namespace Lib\Api;

class ErrorHandler {

    public function handle($exception, $code = 1000, $status = 500, $headers = [], $options = 0)
    {
        // If the exception is on of ours then treat it as implemented.
        if ($exception instanceof ApiException)
        {
            $code = $exception->getCode();
            $message = $exception->messages();
        }
        // This is a generic, non-supported exception so we'll just treat it as so.
        elseif ($exception instanceof Exception or $exception instanceof RuntimeException)
        {
            $code = $exception->getCode();
            $message = $exception->getMessage();
        }

        return Response::json([
            'status' => $status,
            'error'  => compact('message', 'code')
        ], $status, $headers, $options);
    }
}
