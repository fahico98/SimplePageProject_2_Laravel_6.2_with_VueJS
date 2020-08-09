<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{

   /**
    * Seed the application's database.
    *
    * @return void
    */
   public function run(){
      $this->call(RolesTableSeeder::class);
      $this->call(PostPermissionsTableSeeder::class);
      $this->call(UsersTableSeeder::class);
      $this->call(PostsTableSeeder::class);
      $this->call(ServerMessagesTableSeeder::class);
   }
}
