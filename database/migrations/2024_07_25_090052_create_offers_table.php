<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id(); // Поле ID
            $table->string('title'); // Назва
            $table->string('image')->nullable(); // Зображення запису
            $table->text('description')->nullable(); // Опис, можливо з зображеннями
            $table->integer('vacancies_number')->default(1); // Кількість вакансій
            $table->boolean('is_active')->default(true); // Активність пропозиції
            $table->timestamps(); // Automatically adds created_at and updated_at columns
        });

        Schema::create('offer_time_periods', function (Blueprint $table) {
            $table->id(); // Поле ID
            $table->foreignId('offer_id')->constrained('offers')->onDelete('cascade'); // Зовнішній ключ до offers
            $table->date('start_date'); // Дата початку періоду
            $table->date('end_date'); // Дата закінчення періоду
            $table->time('start_time'); // Час початку події
            $table->time('end_time'); // Час закінчення події
            $table->timestamps(); // Automatically adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_time_periods');
        Schema::dropIfExists('offers');
    }
}



