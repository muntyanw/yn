<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_proposals', function (Blueprint $table) {
            $table->id(); // Поле ID
            $table->string('company_name'); // Назва компанії/ФОП
            $table->string('legal_address'); // Юридична адреса
            $table->string('contact_person_name'); // ПІБ контактної особи
            $table->string('contact_person_phone'); // Телефон контактної особи
            $table->timestamps(); // Created_at and updated_at

            $table->unsignedBigInteger('tender_id');

            $table->foreign('tender_id')
                  ->references('id')
                  ->on('tenders')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tender_proposals');
    }
}

