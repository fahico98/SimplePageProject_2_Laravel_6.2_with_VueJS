<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model{

   protected $fillable = ['name'];

   protected $hidden = ['id'];

   public function users(){
      return $this->hasMany(User::class);
   }
}
