<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('shirts', function (Blueprint $table) {
        $table->id();
        $table->string('manufacturer'); 
        $table->string('size');         
        $table->string('material');     
        $table->decimal('price', 8, 2); 
        $table->string('quantity');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shirts');
    }
};
