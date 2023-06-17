<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('list_id')->constrained('todo_lists', 'id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tag_id')->constrained('tags', 'id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_tags');
    }
}
