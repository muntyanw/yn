<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // Додаємо ім'я
            $table->string('middle_name')->nullable(); // Додаємо по-батькові
            $table->string('last_name'); // Додаємо прізвище
            $table->string('photo')->nullable(); // Фото
            $table->timestamp('registration_date')->useCurrent(); // Дата реєстрації
            $table->string('phone'); // Телефон
            $table->string('email')->unique(); // Емайл
            $table->text('address'); // Адреса проживання
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
        Schema::dropIfExists('volunteers');
    }
}
