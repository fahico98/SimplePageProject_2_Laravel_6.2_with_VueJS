<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DefineForeignKeys extends Migration{

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up(){

      Schema::table('users', function(Blueprint $table){
         $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
      });

      Schema::table('posts', function(Blueprint $table){
         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
      });

      Schema::table("post_images", function(Blueprint $table){
         $table->foreign("post_id")->references("id")->on("posts")->onDelete("cascade");
      });

      Schema::table("user_profile_pictures", function(Blueprint $table){
         $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
      });

      Schema::table("user_like_post", function(Blueprint $table){
         $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
         $table->foreign("post_id")->references("id")->on("posts")->onDelete("cascade");
      });

      Schema::table("user_dislike_post", function(Blueprint $table){
         $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
         $table->foreign("post_id")->references("id")->on("posts")->onDelete("cascade");
      });

      Schema::table("follower_followed", function(Blueprint $table){
         $table->foreign("follower_id")->references("id")->on("users")->onDelete("cascade");
         $table->foreign("followed_id")->references("id")->on("users")->onDelete("cascade");
      });

      Schema::table("talks", function(Blueprint $table){
         $table->foreign("sender_id")->references("id")->on("users")->onDelete("cascade");
         $table->foreign("recipient_id")->references("id")->on("users")->onDelete("cascade");
      });

      Schema::table("messages", function(Blueprint $table){
         $table->foreign("sender_id")->references("id")->on("users")->onDelete("cascade");
         $table->foreign("talk_id")->references("id")->on("talks")->onDelete("cascade");
      });

      Schema::table("user_data_permissions", function(Blueprint $table){
         $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
         $table->foreign('birthday_permission_id')->references('id')->on('permissions')->onDelete('cascade');
         $table->foreign('email_permission_id')->references('id')->on('permissions')->onDelete('cascade');
         $table->foreign('phone_number_permission_id')->references('id')->on('permissions')->onDelete('cascade');
         $table->foreign('location_permission_id')->references('id')->on('permissions')->onDelete('cascade');
         $table->foreign('default_post_permission_id')->references('id')->on('permissions')->onDelete('cascade');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down(){

      Schema::table('users', function(Blueprint $table){
         $table->dropForeign("users_role_id_foreign");
      });

      Schema::table('posts', function(Blueprint $table){
         $table->dropForeign("posts_user_id_foreign");
         $table->dropForeign("posts_permission_id_foreign");
      });

      Schema::table("post_images", function(Blueprint $table){
         $table->dropForeign("post_images_post_id_foreign");
      });

      Schema::table("user_profile_pictures", function(Blueprint $table){
         $table->dropForeign("user_profile_pictures_user_id_foreign");
      });

      Schema::table("user_like_post", function(Blueprint $table){
         $table->dropForeign("user_like_post_user_id_foreign");
         $table->dropForeign("user_like_post_post_id_foreign");
      });

      Schema::table("user_dislike_post", function(Blueprint $table){
         $table->dropForeign("user_dislike_post_user_id_foreign");
         $table->dropForeign("user_dislike_post_post_id_foreign");
      });

      Schema::table("talks", function(Blueprint $table){
         $table->dropForeign("talks_sender_id_foreign");
         $table->dropForeign("talks_recipient_id_foreign");
      });

      Schema::table("messages", function(Blueprint $table){
         $table->dropForeign("messages_sender_id_foreign");
         $table->dropForeign("messages_talk_id_foreign");
      });

      Schema::table("user_data_permissions", function(Blueprint $table){
         $table->dropForeign("user_data_permissions_user_id_foreign");
         $table->dropForeign("user_data_permissions_birthday_permission_id_foreign");
         $table->dropForeign("user_data_permissions_email_permission_id_foreign");
         $table->dropForeign("user_data_permissions_phone_number_permission_id_foreign");
         $table->dropForeign("user_data_permissions_location_permission_id_foreign");
         $table->dropForeign("user_data_permissions_default_post_permission_id_foreign");
      });
   }
}
