<?php

use Illuminate\Database\Seeder;

class UserProfileImagesTableSeeder extends Seeder{

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run(){

      DB::table('user_profile_images')->truncate();

      DB::table('user_profile_images')->insert([
         "url" => "public/avatars/defaultUserPhoto.jpg",
         "size" => 5229
      ]);
   }
}
