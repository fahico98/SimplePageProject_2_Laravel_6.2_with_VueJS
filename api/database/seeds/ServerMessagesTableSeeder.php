<?php

use Illuminate\Database\Seeder;

class ServerMessagesTableSeeder extends Seeder{

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run(){

      // DB::table('server_messages')->truncate();

      DB::table('server_messages')->insert([
         "user_id" => 3,
         "content" => "Que buena plataforma, me brinda un constante flujo de información y entretenimiento XD.",
         "is_testimonial" => true
      ]);

      DB::table('server_messages')->insert([
         "user_id" => 4,
         "content" => "Excelente, me encanta la comunidad y las facilidades que me brinda y a mi empresa.",
         "is_testimonial" => true
      ]);

      DB::table('server_messages')->insert([
         "user_id" => 5,
         "content" => "Ya no tengo que trabajar tanto gracias a esta plataforma, Saludos desde Colombia.",
         "is_testimonial" => true
      ]);

      DB::table('server_messages')->insert([
         "user_id" => 6,
         "content" => "Gracias a todo el equipo de desarrollo por entregarnos esta fantastica red social.",
         "is_testimonial" => true
      ]);
   }
}
