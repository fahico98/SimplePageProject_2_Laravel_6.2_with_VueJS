<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder{

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run(){

      // Make empty the "posts" table before seed it...
      DB::table("posts")->truncate();

      // ...
   }
}
