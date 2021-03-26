<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_category')->unsigned();
            $table->bigInteger('id_services')->unsigned();
            $table->foreign('id_category')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            $table->foreign('id_services')
                ->references('id')->on('services')
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
        Schema::dropIfExists('services_category');
    }
}
