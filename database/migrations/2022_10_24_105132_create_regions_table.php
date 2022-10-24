<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('province_id')->constrained('provinces')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title_ar' , 255);
            $table->string('title_en' , 255);
            $table->enum('status', array('0', '1'))->default('1')->comment("Active = 1 , Not Active = 0");
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
        Schema::dropIfExists('regions');
    }
}
