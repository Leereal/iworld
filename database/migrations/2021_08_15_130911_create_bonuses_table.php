<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');            
            $table->decimal('amount');  
            $table->unsignedBigInteger('investment_id');
            $table->integer('status')->default(1);
            $table->timestamps();            
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');             
            $table->foreign('investment_id')->references('id')->on('investments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonuses');
    }
}
