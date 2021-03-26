<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name')->nullable();
            $table->text('phone')->nullable();
            $table->text('nam_sinh')->nullable();
            $table->text('email')->nullable();
            $table->text('thongtin_congtrinh')->nullable();
            $table->text('goi_dich_vu')->nullable();
            $table->text('hang_muc')->nullable();
            $table->text('phong_cach')->nullable();
            $table->text('hang_muc_khac')->nullable();
            $table->text('dien_tich_dat')->nullable();
            $table->text('dientich_xaydung')->nullable();
            $table->text('so_tang')->nullable();
            $table->text('hang_muc_dau_tu')->nullable();
            $table->text('ngay_khoi_cong')->nullable();
            $table->text('ngay_hoan_thanh')->nullable();
            $table->text('mau_thich')->nullable();
            $table->text('mau_khongthich')->nullable();
            $table->text('lat_san')->nullable();
            $table->text('van_san')->nullable();
            $table->text('da_tu_nhien')->nullable();
            $table->text('op_tuong')->nullable();
            $table->text('op_tran')->nullable();
            $table->text('vach_ngan')->nullable();
            $table->text('thiet_bi_ve_sinh')->nullable();
            $table->text('cua')->nullable();
            $table->text('thiet_bi_dien')->nullable();
            $table->text('den_chieu_sang')->nullable();
            $table->text('son_va_chong_tham')->nullable();
            $table->text('noi_that')->nullable();
            $table->text('van_phong_tu_van')->nullable();
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
        Schema::dropIfExists('contact');
    }
}
