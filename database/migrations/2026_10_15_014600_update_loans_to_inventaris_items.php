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
        Schema::table('loans', function (Blueprint $table) {
            if (Schema::hasColumn('loans', 'item_id')) {
                $table->dropForeign(['item_id']);
                $table->dropColumn('item_id');
            }

            if (!Schema::hasColumn('loans', 'inventaris_item_id')) {
                $table->foreignId('inventaris_item_id')
                    ->after('external_borrower_origin')
                    ->constrained('inventaris_items')
                    ->onDelete('cascade');
            }

            if (!Schema::hasColumn('loans', 'purpose')) {
                $table->string('purpose')->nullable()->after('inventaris_item_id');
            }

            if (!Schema::hasColumn('loans', 'returned_quantity_normal')) {
                $table->unsignedInteger('returned_quantity_normal')->default(0)->after('condition_when_returned');
            }

            if (!Schema::hasColumn('loans', 'returned_quantity_damaged')) {
                $table->unsignedInteger('returned_quantity_damaged')->default(0)->after('returned_quantity_normal');
            }

            if (!Schema::hasColumn('loans', 'returned_quantity_lost')) {
                $table->unsignedInteger('returned_quantity_lost')->default(0)->after('returned_quantity_damaged');
            }

            if (!Schema::hasColumn('loans', 'return_notes')) {
                $table->text('return_notes')->nullable()->after('returned_quantity_lost');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            if (Schema::hasColumn('loans', 'purpose')) {
                $table->dropColumn('purpose');
            }
            if (Schema::hasColumn('loans', 'inventaris_item_id')) {
                $table->dropForeign(['inventaris_item_id']);
                $table->dropColumn('inventaris_item_id');
            }
        });
    }
};
