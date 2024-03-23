<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('house_rentals', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('landowner_id')->nullable();
            $table->foreign('landowner_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->text('description');
            $table->string('address');
            $table->decimal('price', 11, 2);
            $table->integer('maximum_occupants');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();  
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_rentals');
    }
};
