<?php

use Illuminate\Database\Seeder;

class UserProfilePicturesTableSeeder extends Seeder{

    /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run(){

      DB::table('user_profile_pictures')->truncate();

      DB::table('user_profile_pictures')->insert([
         "url" => "public/avatars/defaultUserPhoto.jpg",
         "size" => 5229
      ]);
   }
}
