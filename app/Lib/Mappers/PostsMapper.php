<?php namespace app\Lib\Mappers;

use \Post;

class PostsMapper implements MapperInterface
{
    /**
     * Turn this item object into a generic array
     *
     * @param \Post $post
     *
     * @return array
     */
    public function map(Post $post)
    {
        return [
            'id'        => (int)        $post->id,
            'title'     => (string)     $post->title,
            'text'      => (string)     $post->text,
            'active'    => (boolean)    $post->active
        ];
    }
}
