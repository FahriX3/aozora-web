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
        Schema::dropIfExists('loans');
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            
            // Borrower details
            $table->string('borrower_type')->default('internal'); // internal, external
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('external_borrower_name')->nullable();
            $table->string('external_borrower_origin')->nullable();
            
            // Item details
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->date('borrow_date');
            $table->date('return_date')->nullable();
            
            // New strict tracking fields
            $table->string('status')->default('borrowed'); // borrowed, returned, late, damaged, lost
            $table->string('condition_when_borrowed')->default('good');
            $table->string('condition_when_returned')->nullable();
            $table->string('borrow_proof_image')->nullable();
            $table->string('return_proof_image')->nullable();
            
            $table->foreignId('recorded_by_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('recorder_ip')->nullable();
            $table->string('recorder_location')->nullable(); // Lat, Long
            
            $table->foreignId('return_recorded_by_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('return_recorder_ip')->nullable();
            $table->string('return_recorder_location')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
