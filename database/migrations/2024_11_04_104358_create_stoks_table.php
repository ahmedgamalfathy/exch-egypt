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
//code, stock_name, closing_price_year, closing_price_today,annual_growth_rate,internal_liquidity_volume
//internal_liquidity_value ,external_liquidity_volume ,external_liquidity_value, net_liquidity
//liquidity_ratio, trading_volume
        Schema::create('stoks', function (Blueprint $table) {
            $table->id();
            $table->string('code',10);//الكود
            $table->string('stock_name',255);//اسم السهم
            $table->decimal('closing_price_year',15,2);//سعر الاغلاق السنوي
            $table->decimal('closing_price_today',15,2);//سعر الاغلاق اليومي
            $table->decimal('annual_growth_rate', 5, 2);//نسبة الارتفاع خلال العام
            $table->bigInteger('internal_liquidity_volume')->nullable();//حجم السيولة الداخلة
            $table->bigInteger('internal_liquidity_value')->nullable();//قيمة السيولة الداخلة
            $table->bigInteger('external_liquidity_volume')->nullable();//حجم السيولة الخارجة
            $table->bigInteger('external_liquidity_value')->nullable();//قيمة السيولة الخارجة
            $table->bigInteger('net_liquidity');//صافي السيولة
            $table->decimal('liquidity_ratio', 5, 2);//نسبة السيولة
            $table->bigInteger('trading_volume');//حجم التداول
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoks');
    }
};
