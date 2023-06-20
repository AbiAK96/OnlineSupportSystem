<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->string('description');
            $table->string('ticket_number');
            $table->string('status');
            $table->bigInteger('followed_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            
            $table->foreign('customer_id')
            ->references('id')
            ->on('customers');

            $table->foreign('followed_by')
            ->references('id')
            ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
