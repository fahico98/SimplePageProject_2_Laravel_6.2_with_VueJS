<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{

   /**
    * Seed the application's database.
    *
    * @return void
    */
   public function run(){
      $this->call(UsersTableSeeder::class);
      $this->call(RolesTableSeeder::class);
      $this->call(PostsTableSeeder::class);
      $this->call(PostPermissionsTableSeeder::class);
      $this->call(ServerMessagesTableSeeder::class);
      $this->call(PostImagesTableSeeder::class);
      $this->call(UserProfileImagesTableSeeder::class);
   }
}
