<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custmer_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('worker_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('quality');
            $table->tinyInteger('speed');
            $table->tinyInteger('price');
            $table->double('overall_assessment');
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
        Schema::dropIfExists('reviews');
    }
}
