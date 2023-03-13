<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalDataToSupplierPriceCharts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_price_charts', function (Blueprint $table) {
            $table->decimal('mrp',10,2)->nullable();
            $table->integer('qty')->nullable();
            $table->string('is_submit',10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_price_charts', function (Blueprint $table) {
            //
        });
    }
}
