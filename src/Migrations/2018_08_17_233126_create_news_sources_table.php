<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsSourcesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('news_sources', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->nullable()->default(null);

            $table->string('name');

            $table->string('slug');

            $table->string('url');

            $table->string('logo_url')->nullable();

            $table->tinyInteger('status')->default(1);

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('news_sources');
    }
}
