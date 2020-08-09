<?php

use App\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder{

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run(){

      // Make empty the "posts" table before seed it...
      // DB::table("posts")->truncate();

      // $users = User::select("id")->all()->get();

      DB::table("posts")->insert([
         "user_id" => 1,
         "post_permission_id" => 1,
         "title" => "Continuidad desordenada",
         "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam non ea totam quos voluptatem deleniti, officiis aperiam at vel numquam iusto dolores quidem cum corporis alias harum et assumenda nemo!",
      ]);

      DB::table("posts")->insert([
         "user_id" => 1,
         "post_permission_id" => 1,
         "title" => "Remedio casero",
         "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam non ea totam quos voluptatem deleniti, officiis aperiam at vel numquam iusto dolores quidem cum corporis alias harum et assumenda nemo!",
      ]);

      DB::table("posts")->insert([
         "user_id" => 1,
         "post_permission_id" => 1,
         "title" => "Realidad virtual",
         "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam non ea totam quos voluptatem deleniti, officiis aperiam at vel numquam iusto dolores quidem cum corporis alias harum et assumenda nemo!",
      ]);

      DB::table("posts")->insert([
         "user_id" => 1,
         "post_permission_id" => 1,
         "title" => "Prestaciones de servicio",
         "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam non ea totam quos voluptatem deleniti, officiis aperiam at vel numquam iusto dolores quidem cum corporis alias harum et assumenda nemo!",
      ]);

      DB::table("posts")->insert([
         "user_id" => 1,
         "post_permission_id" => 1,
         "title" => "Cuenta de credito revolvente",
         "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam non ea totam quos voluptatem deleniti, officiis aperiam at vel numquam iusto dolores quidem cum corporis alias harum et assumenda nemo!",
      ]);

      DB::table("posts")->insert([
         "user_id" => 1,
         "post_permission_id" => 1,
         "title" => "Teorias de conspiracion verdaderas",
         "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam non ea totam quos voluptatem deleniti, officiis aperiam at vel numquam iusto dolores quidem cum corporis alias harum et assumenda nemo!",
      ]);

      DB::table("posts")->insert([
         "user_id" => 1,
         "post_permission_id" => 1,
         "title" => "Camuflaje optico",
         "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam non ea totam quos voluptatem deleniti, officiis aperiam at vel numquam iusto dolores quidem cum corporis alias harum et assumenda nemo!",
      ]);

      DB::table("posts")->insert([
         "user_id" => 1,
         "post_permission_id" => 1,
         "title" => "Resolucion de problemas con el metodo presocratico",
         "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam non ea totam quos voluptatem deleniti, officiis aperiam at vel numquam iusto dolores quidem cum corporis alias harum et assumenda nemo!",
      ]);

      DB::table("posts")->insert([
         "user_id" => 1,
         "post_permission_id" => 1,
         "title" => "Confesiones de un gangster económico",
         "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam non ea totam quos voluptatem deleniti, officiis aperiam at vel numquam iusto dolores quidem cum corporis alias harum et assumenda nemo!",
      ]);

      DB::table("posts")->insert([
         "user_id" => 1,
         "post_permission_id" => 1,
         "title" => "Cooperación empresarial",
         "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam non ea totam quos voluptatem deleniti, officiis aperiam at vel numquam iusto dolores quidem cum corporis alias harum et assumenda nemo!",
      ]);

      DB::table("posts")->insert([
         "user_id" => 1,
         "post_permission_id" => 1,
         "title" => "Asociaciones sin animo de lucro",
         "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam non ea totam quos voluptatem deleniti, officiis aperiam at vel numquam iusto dolores quidem cum corporis alias harum et assumenda nemo!",
      ]);

      DB::table("posts")->insert([
         "user_id" => 1,
         "post_permission_id" => 1,
         "title" => "Corazon delator",
         "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam non ea totam quos voluptatem deleniti, officiis aperiam at vel numquam iusto dolores quidem cum corporis alias harum et assumenda nemo!",
      ]);
   }
}
