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
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained()->onDelete('cascade');
            //constrained() is used so that material will be a foreign key
            // But because the material has soft-delete, when the material is deleted, 
            // the stock entry will stay there, but will be deleted
            //as soon as material or related category row is hard-deleted from database through mysql server (eg from phpmyadmin)
            $table->date('transaction_date');
            $table->decimal('quantity', 15, 2); // Accepts positive and negative values
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};
