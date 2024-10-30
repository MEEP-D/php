<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shirt_id')->constrained()->onDelete('cascade'); 
            $table->integer('quantity')->default(1); 
            $table->string('manufacturer')->nullable(); // Thêm trường manufacturer
            $table->string('size')->nullable(); // Thêm trường size
            $table->string('material')->nullable(); // Thêm trường material
            $table->decimal('price', 10, 2); // Thêm trường price
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
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['manufacturer', 'size', 'material', 'price']);
        });
    }
}
