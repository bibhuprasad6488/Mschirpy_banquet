<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('ingredient_cat_id')->unsigned();
            $table->string('item_name',50)->nullable();
            $table->string('unit',10)->nullable();
            $table->json('brand')->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->string('status',10)->default('active');
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
        Schema::dropIfExists('ingredient_items');
    }
}
