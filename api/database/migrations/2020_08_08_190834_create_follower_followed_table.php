<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowerFollowedTable extends Migration{

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up(){
      Schema::create('follower_followed', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->bigInteger("follower_id")->unsigned();
         $table->bigInteger("followed_id")->unsigned();
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down(){
      Schema::dropIfExists('follower_followed');
   }
}
