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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string("year")->nullable();
            $table->string("maker")->nullable();
            $table->string("model")->nullable();
            $table->string("chassis")->nullable();
            $table->string("engine")->nullable();
            $table->string("cno")->nullable();
            $table->date('date')->nullable();
            $table->string("auction")->nullable();
            $table->float("price")->default(0);
            $table->float("tax")->default(0);
            $table->float("rikuso")->default(0);
            $table->float("total")->default(0);
            $table->float("recycle")->default(0);
            $table->date('adate')->nullable();
            $table->date('sdate')->nullable();
            $table->text('notes')->nullable();
            $table->string("status")->default("Available");
            $table->bigInteger('refID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
