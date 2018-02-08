<?php

namespace App\Policies;

use App\User;
use App\Post;

use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy {

    use HandlesAuthorization;

    /*
     * Before Filter to allow admins model-wide actions
     */
    public function before($user) {
        if ($user->roles()->where('name', 'admin')->first()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view posts list.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function listing(User $user) {

        $roles = ['admin', 'manager', 'editor'];
        return $user->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Determine whether the user can create the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function create(User $user) {

        $roles = ['admin', 'manager', 'editor'];
        return $user->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Determine whether the user can edit the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function edit(User $user, Post $post) {


        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user) {

        $roles = ['admin', 'manager', 'editor'];
        return $user->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post) {

        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can deleteMany the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function deleteMany(User $user) {

        $roles = ['admin', 'manager'];
        return $user->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Determine whether the user can upload-update  the post images.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function postImages(User $user) {

        $roles = ['admin', 'manager', 'editor'];
        return $user->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Determine whether the user can reorder posts.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function reorder(User $user) {

        $roles = ['admin', 'manager', 'editor'];
        return $user->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Determine whether the user can activate posts.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function activate(User $user) {

        $roles = ['admin', 'manager', 'editor'];
        return $user->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Determine whether the user can search posts in admin.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function adminSearchPosts(User $user) {

        $roles = ['admin', 'manager', 'editor'];
        return $user->roles()->whereIn('name', $roles)->first();
    }

}
