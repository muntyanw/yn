<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('publication_date')->nullable();
            $table->timestamp('submission_deadline')->nullable();
            $table->timestamp('delivery_date_range_start')->nullable();
            $table->timestamp('delivery_date_range_end')->nullable();
            $table->string('product_service_name', 191);
            $table->integer('quantity');
            $table->string('delivery_address', 191);
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
        Schema::dropIfExists('tenders');
    }
}