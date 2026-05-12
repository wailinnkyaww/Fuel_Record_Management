<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fuel_records', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->string('plate_prefix');
            $table->string('plate_letter');
            $table->string('plate_number');
            $table->string('oil_type');
            $table->decimal('liter', 8, 2); // ဓာတ်ဆီက decimal ဖြစ်နိုင်လို့ decimal ပြောင်းထားပါတယ်
            $table->integer('total_price');
            $table->integer('times')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fuel_records');
    }
};
