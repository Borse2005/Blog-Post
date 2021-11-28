<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTablesTaggablesToPostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_tag', function (Blueprint $table) {
            $table->dropForeign(['posts_id']);
            $table->dropColumn('posts_id');
        });

        Schema::rename('post_tag', 'taggables');

        Schema::table('taggables', function(Blueprint $table){
            $table->morphs('taggable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taggables', function (Blueprint $table) {
            $table->dropMorphs('taggable');
        });

        Schema::rename('taggables','post_tag');

        Schema::disableForeignKeyConstraints();

        Schema::table('post_tag', function (Blueprint $table) {
            $table->unsignedInteger('posts_id');
            $table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }
}
