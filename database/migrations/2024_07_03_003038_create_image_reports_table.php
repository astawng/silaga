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
        Schema::create('image_reports', function (Blueprint $table) {
            $table->string('image_report_id', 10)->primary();
            $table->string('report_id', 10);
            $table->foreign('report_id')->references('report_id')->on('reports')->onDelete('cascade');
            $table->string('filename')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_reports');
    }
};
