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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            // company_name ,currency,payer,coupon_number,coupon_value,maturity_date,transaction_date
            $table->string('company_name'); // اسم الشركة
            $table->string('currency', 10); // العملة
            $table->string('payer'); // جهة الصرف
            $table->integer('coupon_number'); // رقم الكوبون
            $table->decimal('coupon_value', 10, 2); // قيمة الكوبون
            $table->date('maturity_date'); // تاريخ الاستحقاق
            $table->date('transaction_date'); // تاريخ الصرف
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
