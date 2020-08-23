<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalksTable extends Migration{

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up(){
      Schema::create('talks', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->bigInteger("sender_id")->unsigned();
         $table->bigInteger("recipient_id")->unsigned();
         $table->boolean("deleted_by_sender")->default(0);
         $table->boolean("deleted_by_recipient")->default(0);
         $table->integer("messages_number")->default(0);
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down(){
      Schema::dropIfExists('talks');
   }
}
