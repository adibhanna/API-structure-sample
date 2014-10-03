<?php namespace app\Lib\Exceptions;

/**
 * @author Mahmoud Zalt <mahmoud@vinelab.com>
 */

use app\Lib\ApiResponder;

class ApiException{

    protected $api_responder;

    public function __construct(ApiResponder $api_responder)
    {
        $this->api_responder = $api_responder;
    }


    public function error($status, $message = null)
    {

        switch ($status)
        {
            case 401:
                $default_message = 'Invalid something.';
                break;
            case 401:
                $default_message = 'Another message.';
                break;
            default:
                $default_message = 'Default message here.';
                break;
        }

        $message = (isset($message)) ? $message : $default_message;

        return $this->api_responder->error($status, $message);
    }

}
