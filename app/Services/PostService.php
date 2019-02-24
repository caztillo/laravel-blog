<?php
namespace App\Services;

use App\Post;
use App\Tag;

class PostService
{
    protected $post;
    protected $tag;

    public function __construct(Post $post, Tag $tag)
    {
        $this->post = $post;
        $this->tag = $tag;
    }

    public function getPosts($count)
    {
        $posts = $this->post->paginate($count);
        
        return $posts;
    }

    public function create($attributes)
    {

        $post = $this->post->newInstance();
        
        $attributes['slug'] = str_slug($attributes['title'], '-');
        $attributes['user_id'] = auth()->user()->id;
        $post->fill($attributes);
        $post->save();

        if($post && !empty($attributes['tags']))
        {


            foreach($attributes['tags'] as $tag_value)
            {
                $tag = $this->tag->find($tag_value);
                if(!$tag)
                {
                    $tag = $this->tag->newInstance();
                    $tag->name = $tag_value;
                    $tag->save();
                }

                
                if(!$tag->posts()->save($post))
                {
                    return false;
                }
            }

            
        }

        return $post;
    }

    public function update($attributes)
    {

        $post = $this->post->find($attributes['id']);

        $attributes['slug'] = str_slug($attributes['title'], '-');
        
        $post->update($attributes);

        // get post tags
        $post_tags = $post->tags->pluck('id')->toArray();
        

        if(empty($attributes['tags']))
        {
            

            if(!empty($post_tags))
            {
                if(!$post->tags()->detach())
                {

                    return false;
                }
            }
        }
        else
        {
            // get selected tags
            $tags_selected = $attributes['tags'];

            $tags_to_add = array_diff($tags_selected, $post_tags);
            $tags_to_delete = array_diff($post_tags, $tags_selected);


            // tags to add
            foreach ($tags_to_add as $tag_to_add) 
            {


                $tag = $this->tag->find($tag_to_add);
                if(!$tag)
                {
                    $tag = $this->tag->newInstance();
                    $tag->name = $tag_to_add;
                    $tag->save();
                }

                if (!$tag->posts()->save($post)) 
                {
                    return false;
                }
            }

            // tags to delete
            foreach ($tags_to_delete as $tag_to_delete) 
            {
                if (!$post->tags()->detach($tag_to_delete)) 
                {
                    return false;
                }
            }

        }

        
        
        return $post;
    }

    public function find($id)
    {
        $post = $this->post->find($id);

        return $post;
    }

    public function findBySlug($slug)
    {
        $post = $this->post->where('slug', $slug)->first();
        return $post;
    }

    public function delete($id)
    {
        $post = $this->post->find($id);
        $post->tags()->detach();
        $post->delete();

        return $post;
    }

    public function getTags($query)
    {

        $tags = Tag::where('name','LIKE',"%{$query}%")->select('id', 'name AS text')->get();
        return $tags;
    }
}