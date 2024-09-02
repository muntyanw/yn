<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToVolunteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('volunteers', function (Blueprint $table) {
            $table->text('about_me')->nullable(); // Обо мне
            $table->boolean('is_employee')->default(false); // Это Співробітник
            $table->boolean('public_access')->default(true); // Публичный доступ к информации обо мне
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropColumn('about_me');
            $table->dropColumn('is_employee');
            $table->dropColumn('public_access');
        });
    }
}
