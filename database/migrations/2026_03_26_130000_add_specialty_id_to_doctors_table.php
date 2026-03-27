<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            if (! Schema::hasColumn('doctors', 'specialty_id')) {
                $table->foreignId('specialty_id')->nullable()->constrained('specialties')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            if (Schema::hasColumn('doctors', 'specialty_id')) {
                $table->dropConstrainedForeignId('specialty_id');
            }
        });
    }
};
