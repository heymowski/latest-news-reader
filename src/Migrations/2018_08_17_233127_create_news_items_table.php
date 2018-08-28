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

            $table->string('category')->nullable();

            $table->text('categories')->nullable();

            $table->string('author')->nullable();

            $table->text('authors')->nullable();

            $table->string('contributor')->nullable();

            $table->text('contributors')->nullable();

            $table->string('copyright')->nullable();

            $table->dateTime('date');

            $table->dateTime('updated_date');

            $table->string('link');

            $table->string('source')->nullable();

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
