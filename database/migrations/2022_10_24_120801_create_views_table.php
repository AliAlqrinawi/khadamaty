<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('count')->default(0);
            $table->timestamp('month')->nullable()->default(null);
            $table->enum('type', array('1', '2'))->nullable()->comment("worker = 1 , orders = 2");
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
        Schema::dropIfExists('views');
    }
}
