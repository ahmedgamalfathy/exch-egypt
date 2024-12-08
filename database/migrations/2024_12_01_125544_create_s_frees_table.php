<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //title, distrip, entitle_date, dis_date
        Schema::create('s_frees', function (Blueprint $table) {
            $table->id();
            $table->string('title');//اسم الشركة
            $table->string('distrip');//التوزيع
            $table->timestamp('entitle_date');//تاريخ الاستحقاق
            $table->timestamp('dis_date');//تاريخ التوزيع
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_frees');
    }
};
