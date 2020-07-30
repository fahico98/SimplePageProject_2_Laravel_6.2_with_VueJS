<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileImagesTable extends Migration{

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up(){
      Schema::create('user_profile_images', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->bigInteger("user_id")->unsigned()->nullable();
         $table->string("url");
         $table->integer("size");
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
      Schema::dropIfExists('user_profile_images');
   }
}
