<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('comments_id');
            $table->string('comments_track_id')->nullable();
            $table->string('comments_users_id')->nullable();
            $table->string('comments_posts_id')->nullable();
            $table->string('comments_title')->nullable();
            $table->text('comments_body')->nullable();
            $table->string('comments_picture')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('comments');
    }

}
