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
        Schema::create('tenant_applications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('rental_id');
            $table->foreign('rental_id')->references('id')->on('house_rentals')->onDelete('cascade');

            $table->integer('occupants_number');
            $table->date('move_in_date');
            $table->integer('lease_term');
            $table->string('employment_status');
            $table->decimal('monthly_income', 11, 2);
            $table->string('application_status');
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_applications');
    }
};
