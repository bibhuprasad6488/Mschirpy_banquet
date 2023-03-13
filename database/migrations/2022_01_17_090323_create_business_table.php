<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
            $table->string('business_name',50);
            $table->string('primary_contact',20);
            $table->string('secondary_contact',20);
            $table->string('admin_email',100);
            $table->string('staff_email',100);
            $table->text('business_address');
            $table->string('state',50)->nullable();
            $table->string('city',50)->nullable();
            $table->integer('avg_for')->nullable();
            $table->integer('avg_price')->nullable();
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();
            $table->integer('amenity')->nullable();
            $table->string('slug',200)->nullable();
            $table->integer('status')->default('1');
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
        Schema::dropIfExists('business');
    }
}
