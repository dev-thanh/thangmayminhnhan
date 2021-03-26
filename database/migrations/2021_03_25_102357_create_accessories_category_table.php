<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessoriesCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessories_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_category')->unsigned();
            $table->bigInteger('id_accessories')->unsigned();
            $table->foreign('id_category')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            $table->foreign('id_accessories')
                ->references('id')->on('accessories')
                ->onDelete('cascade');
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
        Schema::dropIfExists('accessories_category');
    }
}
