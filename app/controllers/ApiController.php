<?php

/**
 * @author Mahmoud Zalt <inbox@mahmoudzalt.com>
 * @author Abed Halawi <halawi.abed@gmail.com>
 */

use Traversable;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Lib\Api\Mappers\MapperInterface;

class ApiController extends BaseController {

    private $mappers_base_namespace = 'Lib\Api\Mappers\\';

    protected $api;

    public function __construct()
    {
        $this->api = App::make('Lib\Api\Api');
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
     * @param int $options
     *
     * @internal param $mapper
     * @return Illuminate\Http\JsonResponse
     */
    protected function respond($mapper, $data)
    {
        // We will check whether we've been passed an actual mapper instance, otherwise we'll have to
        // resolve the mapper class name into an actual mapper instance.
        if ( ! is_object($mapper)) $mapper = $this->resolveMapperClassName($mapper);

        // All mappers must implement or extend the mapper interface.
        if ( ! $mapper instanceof MapperInterface) dd('throw Exception...');

        // Check whether we should be iterating through data and mapping each item
        // or we've been passed an instance so that we pass it on as is.
        // We also have support for paginators so where we extract the required data as needed,
        // which helps dev pass in a paginator instance without messing around with it.
        // When we get a paginator we format the args of the ApiResponder as needed.
        if ($data instanceof Paginator)
        {
            $data = $data->toArray();
            $args = [$status, $data->getTotal(), $data->getCurrentPage()];
        }
        // Otherwise we take the arguments passed to this function and pass them as is.
        else
        {
            $args = array_slice(func_get_args(), 2);
        }
        // In the case of a collection all we need is the data as a Traversable so that we
        // iterate and map each iterm.
        if ($data instanceof Collection) $data = $data->all();
        // Leave traversing data till the end of the pipeline so that any transformation
        // that happened so far must have transformed them into an array.
        if ($data instanceof Traversable) $data = array_map([$mapper, 'map'], $data);
        // In this case we got an object so we'll map it right away so that when we return it
        // it ends up being an object not an array with one object.
        else $data = $mapper->map($data);

        // Finally, respond.
        return call_user_func([$this->api, 'respond'], array_merge($data, $args));
    }

    /**
     * An error occurred, respond accordingly.
     *
     * @return Illuminate\Http\JsonResponse
     */
    protected function error()
    {
        return call_user_func([$this->error, 'handle'], func_get_args());
    }

    /**
     * Resolve a class name of a mapper into the actual instance.
     *
     * @param  string $classname
     *
     * @return mixed
     */
    protected function resolveMapperClassName($classname)
    {
        return App::make($this->mappers_base_namespace . $classname);
    }

}
