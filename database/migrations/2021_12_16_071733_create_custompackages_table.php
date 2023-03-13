<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustompackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custompackages', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('package_id')->unsigned();
            $table->json('items')->nullable();
            $table->float('total_price')->nullable();
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
        Schema::dropIfExists('custompackages');
    }
}
