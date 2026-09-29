<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->integer('returned_quantity_normal')->nullable()->default(0)->after('condition_when_returned');
            $table->integer('returned_quantity_damaged')->nullable()->default(0)->after('returned_quantity_normal');
            $table->integer('returned_quantity_lost')->nullable()->default(0)->after('returned_quantity_damaged');
            $table->text('return_notes')->nullable()->after('returned_quantity_lost');
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['returned_quantity_normal', 'returned_quantity_damaged', 'returned_quantity_lost', 'return_notes']);
        });
    }
};
