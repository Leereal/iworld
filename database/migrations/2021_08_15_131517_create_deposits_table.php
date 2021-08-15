<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount'); 
            $table->unsignedBigInteger('bank_id');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('user_id');
            $table->string('pop')->nullable();
            $table->integer('status')->default(2);
            $table->ipAddress('ipaddress');
            $table->timestamps();
            $table->softDeletes();   

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposits');
    }
}
