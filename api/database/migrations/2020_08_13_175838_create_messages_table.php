<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration{

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up(){
      Schema::create('messages', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->bigInteger("talk_id")->unsigned();
         $table->text("content");
         $table->boolean("deleted_by_sender")->default(0);
         $table->boolean("deleted_by_recipient")->default(0);
         $table->boolean("readed")->default(0);
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down(){
      Schema::dropIfExists('messages');
   }
}
