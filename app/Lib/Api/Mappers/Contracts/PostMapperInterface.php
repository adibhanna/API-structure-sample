<?php namespace Lib\Api\Mappers\Contracts;

use Post;

interface PostMapperInterface extends MapperInterface {

    public function map(Post $post);
}
