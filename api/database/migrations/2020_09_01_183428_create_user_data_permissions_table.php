<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDataPermissionsTable extends Migration{

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up(){
      Schema::create('user_data_permissions', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->bigInteger("user_id")->unsigned();
         $table->bigInteger("birthday_permission_id")->unsigned();
         $table->bigInteger("email_permission_id")->unsigned();
         $table->bigInteger("phone_number_permission_id")->unsigned();
         $table->bigInteger("location_permission_id")->unsigned();
         $table->bigInteger("default_post_permission_id")->unsigned();
         $table->boolean("private_account")->default(0);
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down(){
      Schema::dropIfExists('user_data_permissions');
   }
}
