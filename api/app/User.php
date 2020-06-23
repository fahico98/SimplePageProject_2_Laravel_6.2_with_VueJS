<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject{

   use Notifiable;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
      "id",
      "username",
      "name",
      "lastname",
      "country",
      "city",
      "phone_number",
      'email',
      'password',
      "role_id",
      "profile_picture",
      "occupation",
      "biography"
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
      'password',
      'remember_token',
      "email_verified_at",
      "remember_token",
      "deleted_at",
      "created_at",
      "updated_at"
   ];

   /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
   protected $casts = [
      'email_verified_at' => 'datetime',
   ];

   /**
    * Get the identifier that will be stored in the subject claim of the JWT.
    *
    * @return mixed
    */
   public function getJWTIdentifier(){
      return $this->getKey();
   }

    /**
    * Return a key value array, containing any custom claims to be added to the JWT.
    *
    * @return array
    */
   public function getJWTCustomClaims(){
      return [];
   }

   public function getRouteKeyName(){
      return 'username';
   }

   public function role(){
      return $this->belongsTo(Role::class);
   }

   public function posts(){
      return $this->hasMany(Post::class);
   }

   public function likedPosts(){
      return $this->belongsToMany(Post::class, "user_like_post");
   }

   public function dislikedPosts(){
      return $this->belongsToMany(Post::class, "user_dislike_post");
   }

   /*
   public function isAdmin(){
      return $this->role->name === "administrator";
   }

   public function isSeller(){
      return $this->role->name === "seller";
   }

   public function followers(){
      return $this->belongsToMany(User::class, 'follower_followed', 'followed_id', 'follower_id');
   }

   public function following(){
      return $this->belongsToMany(User::class, 'follower_followed', 'follower_id', 'followed_id');
   }
   */
}
