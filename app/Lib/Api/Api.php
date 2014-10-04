<?php namespace Lib\Api;

/**
 * @author  Abed Halawi <abed.halawi@vinelab.com>
 */

class Api {

    /**
     * @var \Lib\Api\Responder
     */
    protected $responder;

    /**
     * @var \Lib\Api\ErrorHandler
     */
    protected $error;

    public function __construct(Responder $responder, Error $error)
    {
        $this->error = $error;
        $this->responder = $responder;
    }

    public function respond()
    {
        // Call the Responder's respond() with any args passed to this function.
        return call_user_func_array([$this->responder, 'respond'], func_get_args());
    }

    public function respondWithError()
    {
        // Call the ErrorHandler's handle() with any args passed to this function.
        return call_user_func_array([$this->error, 'handle'], func_get_args());
    }
}
