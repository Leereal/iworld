<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            $table->unsignedBigInteger('bank_id');
            $table->string('account');
            $table->unsignedBigInteger('investment_id');
            $table->unsignedBigInteger('user_id');         
            $table->integer('status')->default(2);
            $table->ipAddress('ipAddress');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');   
            $table->foreign('investment_id')->references('id')->on('investments')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
}
