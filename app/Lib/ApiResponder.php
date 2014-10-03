<?php namespace app\Lib;

use Illuminate\Support\Facades\Response;

/**
 * @author Mahmoud Zalt <mahmoud@vinelab.com>
 */

class ApiResponder
{

    /**
     * Handle all App responses
     *
     * @param $data
     * @param int $status
     * @param null $total
     * @param null $page
     * @param array $headers
     * @param int $potions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $status = 200, $total = null, $page = null, $headers = array(), $potions = 0)
    {
        $response = [
            'status' => $status,
        ];

        if ( ! is_null($total))
            $response['total'] = $total;

        if ( ! is_null($page))
            $response['page'] = $page;

        // keep the data at the end of the response
        if ( ! is_null($data))
            $response['data'] = $data;

        return Response::json([$response], $status, $headers, $potions);

    }


    /**
     * Handle all App Error responses
     *
     * @param $status
     * @param $message
     * @param array $headers
     * @param int $potions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($status, $message, $headers = array(), $potions = 0)
    {
        $response = [
            'status' => $status,
        ];

        // keep the data at the end of the response
        if ( ! is_null($message))
            $response['message'] = $message;


        return Response::json([$response], $status, $headers, $potions);
    }





}
