<?php

/**
 * @author Mahmoud Zalt <inbox@mahmoudzalt.com>
 */

use Illuminate\Support\Collection;

class ApiController extends BaseController
{

    private $mapper_dir = 'app\Lib\Mappers\\';

    protected $api_responder;
    protected $api_exception;

    public function __construct()
    {
        $this->api_responder = App::make('app\Lib\ApiResponder');
        $this->api_exception = App::make('app\Lib\Exceptions\ApiException');
    }

    /**
     * Map and respond
     *
     * @param $model the model name
     * @param $data
     * @param int $status
     * @param null $total
     * @param null $page
     * @param array $headers
     * @param int $potions
     *
     * @internal param $mapper
     * @return mixed
     */
    protected function respond($model, $data, $status = 200, $total = null, $page = null, $headers = array(), $potions = 0)
    {
        // create an instance of the mapper of the provided model (ex: Post ==> path/to/PostsMapper)
        $mapper = App::make($this->mapper_dir . $model . 'sMapper');

        // validate the mapper is an object and is of type MapperInterface
        if ( ! is_object($mapper) or ! $mapper instanceof app\Lib\Mappers\MapperInterface )
           dd('throw Exception...');

        // if the data is a single objs (not a collection of objs) then convert it a collection of objs
        if ( ! $data instanceof Illuminate\Support\Collection and ! is_array($data) )
             $data = Collection::make([$data]);

        // call the map function of this mapper for each model object in the $data array for mapping
        foreach ($data as $obj)
            $mapped_data[] = $mapper->map($obj);

        return $this->respondOnly($mapped_data, $status, $total, $page, $headers, $potions);
    }


    /**
     * @param $data
     * @param int $status
     * @param null $total
     * @param null $page
     * @param array $headers
     * @param int $potions
     *
     * @return mixed
     */
    protected function respondOnly($data, $status = 200, $total = null, $page = null, $headers = array(), $potions = 0)
    {
        return $this->api_responder->respond($data, $status, $total, $page, $headers, $potions);
    }



}
