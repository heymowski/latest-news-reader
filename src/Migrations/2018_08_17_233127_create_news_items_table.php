<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('news_items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('news_source_id');

            $table->string('title');

            $table->text('description');

            $table->text('content');

            $table->string('category');

            $table->string('categories');

            $table->string('author');

            $table->string('contributor');

            $table->string('contributors');

            $table->string('authors');

            $table->string('copyright');

            $table->string('date');

            $table->string('updated_date');

            $table->string('link');

            $table->string('source');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('news_items');
    }
}
