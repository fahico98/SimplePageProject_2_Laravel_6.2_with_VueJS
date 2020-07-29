<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration{

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up(){
      Schema::create('posts', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->bigInteger("user_id")->unsigned();
         $table->bigInteger("post_permission_id")->unsigned();
         $table->string("title", 120);
         $table->string("content", 255);
         // $table->string("post_picture")->default("public/posts/defaultPostImage.png");
         $table->integer("likes")->default(0);
         $table->integer("dislikes")->default(0);
         $table->softDeletes();
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down(){
      Schema::dropIfExists('posts');
   }
}
