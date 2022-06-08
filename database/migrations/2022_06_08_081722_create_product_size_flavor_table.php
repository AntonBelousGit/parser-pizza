<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_size_flavor', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained();
            $table->string('size_id', 50)->references('id')->on('sizes');
            $table->string('flavor_id', 50)->references('id')->on('flavors');
            $table->float('price')->nullable();
            $table->primary(['product_id', 'size_id', 'flavor_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_size_flavor');
    }
};
