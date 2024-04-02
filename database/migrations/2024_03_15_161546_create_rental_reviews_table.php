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
        Schema::create('rental_reviews', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('reviewed_by');
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('rental_id');
            $table->foreign('rental_id')->references('id')->on('house_rentals')->onDelete('cascade');

            $table->decimal('ratings', 3, 2);
            $table->text('comment');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_reviews');
    }
};
