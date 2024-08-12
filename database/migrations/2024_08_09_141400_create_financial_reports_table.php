<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialReportsTable extends Migration
{
    public function up()
    {
        Schema::create('financial_reports', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->text('comment')->nullable();
            $table->timestamps();
        });

        Schema::create('financial_report_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_report_id')->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_report_files');
        Schema::dropIfExists('financial_reports');
    }
}
