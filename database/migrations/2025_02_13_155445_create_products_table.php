<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('admin_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('name');
            $table->string('price');
            $table->string('qty')->nullable();
            $table->string('total')->nullable();
            $table->string('color')->nullable();
            $table->string('type')->nullable();
            $table->string('image')->nullable();
            $table->string('brand')->nullable();
            $table->string('description')->nullable();
            $table->string('material')->nullable();
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
        Schema::dropIfExists('products');
    }
}
