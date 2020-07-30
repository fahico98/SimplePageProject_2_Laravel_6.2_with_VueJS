<?php

use Illuminate\Database\Seeder;

class PostImagesTableSeeder extends Seeder{

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run(){

      DB::table('post_images')->truncate();

      DB::table('post_images')->insert([
         "url" => "public/posts/defaultPostImage.png",
         "size" => 14480
      ]);
   }
}
