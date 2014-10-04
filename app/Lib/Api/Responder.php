<?php namespace Lib\Api;

/**
 * @author  Abed Halawi <halawi.abed@gmail.com>
 */

class Responder {

    /**
     * Format a response into an elegant Api response.
     *
     * @param  mixed  $data
     * @param  integer $status
     * @param  integer  $total
     * @param  integer  $page
     * @param  array   $headers
     * @param  integer $options
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $status = 200, $total = null, $page = null, $headers = [], $options = 0)
    {
        $response = [
            'status' => $status,
            // There should always be data regardless of it being null or not.
            'data'   => $data
        ];

        if ( ! is_null($total)) $response['total'] = $total;

        if ( ! is_null($page)) $response['page'] = $page;

        return Response::json($response, $status, $headers, $options);
    }
}
