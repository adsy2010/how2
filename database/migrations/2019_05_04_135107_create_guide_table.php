<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guide', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->integer('publisher');
            $table->integer('category');
            $table->integer('draft')->default('1');
            $table->integer('published')->default('0');
            $table->integer('helpful')->default('0');
            $table->integer('unhelpful')->default('0');
            $table->timestamp('publishedTimestamp')->nullable();
            $table->text('tags')->nullable();
            $table->integer('restrictedGroup')->nullable();
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
        Schema::dropIfExists('guide');
    }
}
