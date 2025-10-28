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
        Schema::create('excel_export_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('excel_export_id')->constrained('excel_export')->cascadeOnDelete();
            $table->string('description');
            $table->string('weight_ltr', 15,2)->nullable();
            $table->string('grade')->nullable();
            $table->integer('qty')->default(0);
            $table->decimal('price', 15,2)->default(0);
            $table->decimal('price_pkr', 15,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excel_export_parts');
    }
};
