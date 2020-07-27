<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration{

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up(){
      Schema::create('users', function (Blueprint $table) {
         $table->bigIncrements("id");
         $table->string("username");
         $table->string("name");
         $table->string("lastname");
         $table->string("country")->nullable();
         $table->string("city")->nullable();
         $table->string("phone_number")->nullable();
         $table->string("email")->unique();
         $table->string('biography')->nullable();
         $table->string("password");
         $table->string("profile_picture")->default("public/avatars/defaultUserPhoto.jpg");
         $table->bigInteger("role_id")->unsigned()->default(1);
         $table->timestamp("email_verified_at")->nullable();
         $table->rememberToken();
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
      Schema::dropIfExists('users');
   }
}
