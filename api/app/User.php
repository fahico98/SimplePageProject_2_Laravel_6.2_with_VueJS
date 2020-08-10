<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
      "role_id",
      "username",
      "name",
      "lastname",
      "country",
      "city",
      "phone_number",
      'email',
      'password',
      "biography"
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
      "role_id",
      'password',
      'remember_token',
      "email_verified_at",
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
    * The accessors to append to the model's array form.
    *
    * @var array
    */
   protected $appends = [
      "following"
   ];

   /**
    * Return true if the authenticated user follow the current user.
    *
    * @return Boolean
    */
   public function getFollowingAttribute(){
      return DB::table("follower_followed")
         ->where("follower_id", Auth::user()->id)
         ->where("followed_id", $this->attributes["id"])
         ->exists();
   }

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

   public function profile_picture(){
      return $this->hasOne(UserProfilePicture::class);
   }

   public function posts(){
      return $this->hasMany(Post::class);
   }

   public function liked_posts(){
      return $this->belongsToMany(Post::class, "user_like_post");
   }

   public function disliked_posts(){
      return $this->belongsToMany(Post::class, "user_dislike_post");
   }

   public function followers(){
      return $this->belongsToMany(User::class, 'follower_followed', 'followed_id', 'follower_id');
   }

   public function followed(){
      return $this->belongsToMany(User::class, 'follower_followed', 'follower_id', 'followed_id');
   }

   // public function isAdmin(){
   //    return $this->role->name === "administrator";
   // }

   // public function isSeller(){
   //    return $this->role->name === "seller";
   // }
}
