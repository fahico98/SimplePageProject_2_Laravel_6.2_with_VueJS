<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder{

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run(){

      DB::table("permissions")->insert([
         "name" => "public"
      ]);

      DB::table("permissions")->insert([
         "name" => "followers"
      ]);

      DB::table("permissions")->insert([
         "name" => "only_me"
      ]);
   }
}
