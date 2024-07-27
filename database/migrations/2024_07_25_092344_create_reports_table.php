<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id(); // Поле ID
            $table->integer('month'); // Місяць
            $table->integer('year'); // Рік
            $table->text('text'); // Текст звіту
            $table->timestamps(); // Created_at and updated_at
        });

        Schema::create('report_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->onDelete('cascade');
            $table->string('photo');
            $table->string('html_link');
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
        Schema::dropIfExists('reports');
        Schema::dropIfExists('report_photos');
    }
}
