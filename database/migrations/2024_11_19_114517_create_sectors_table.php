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
//index, closing, change, change_percentage, high, low, volume, value, transactions, net_liquidity
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->string('index');//المؤشرات
            $table->decimal('closing',15,2);//الاغلاق
            $table->decimal('change', 15, 2); // التغير
            $table->decimal('change_percentage', 5, 2); // التغير %
            $table->bigInteger('high'); // أعلى
            $table->bigInteger('low'); // أدنى
            $table->bigInteger('volume'); // الحجم
            $table->bigInteger('value'); // القيمة
            $table->integer('transactions'); // الصفقات
            $table->bigInteger('net_liquidity'); // صافي السيولة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectors');
    }
};
