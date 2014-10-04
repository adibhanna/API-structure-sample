<?php namespace Lib\Mappers;

use Post;

class PostsMapper implements Contracts\PostMapperInterface {
    /**
     * Map a post into an Api response for a Post.
     *
     * @param \Post $post
     *
     * @return array
     */
    public function map(Post $post)
    {
        return [
            'id'     => (int) $post->id,
            'title'  => $post->title,
            'text'   => $post->text,
            'active' => (boolean) $post->active
        ];
    }
}
