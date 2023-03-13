<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id')->nullable();
            $table->string('customer_name', 50)->nullable();
            $table->integer('room_no')->nullable();
            $table->date('dob')->nullable();
            $table->date('anniversary')->nullable();
            $table->string('staff', 20)->nullable();
            $table->string('service', 20)->nullable();
            $table->string('vibe', 20)->nullable();
            $table->string('cleanliness', 20)->nullable();
            $table->string('food_quality', 20)->nullable();
            $table->string('delight_or_disapoint', 20)->nullable();
            $table->text('about_altius')->nullable();
            $table->text('staff_service_exp')->nullable();
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
        Schema::dropIfExists('customer_experiences');
    }
}