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
        Schema::table('event_documentations', function (Blueprint $table) {
            if (!Schema::hasColumn('event_documentations', 'caption')) {
                $table->string('caption')->nullable()->after('file_path');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_documentations', function (Blueprint $table) {
            if (Schema::hasColumn('event_documentations', 'caption')) {
                $table->dropColumn('caption');
            }
        });
    }
};
