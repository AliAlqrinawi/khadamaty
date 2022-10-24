<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('mobile_number')->nullable()->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('description_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->enum('type', array('1', '2' , '3'))->default('2')->comment("Admin = 1 , Custmer = 2 , Worker = 3");
            $table->string('num_whats');
            $table->timestamp('end_at')->nullable()->default(null);
            $table->string('count_view')->nullable();
            $table->enum('status', array('0', '1'))->default('1')->comment("Active = 1 , Not Active = 0");
            $table->foreignId('cat_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('regino_id')->constrained('regions')->onUpdate('cascade')->onDelete('cascade');
            $table->string('otp')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
