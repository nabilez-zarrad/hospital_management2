<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (! Schema::hasColumn('appointments', 'consulting_fee')) {
                $table->decimal('consulting_fee', 10, 2)->default(0)->after('appointment_time');
            }

            if (! Schema::hasColumn('appointments', 'booking_fee')) {
                $table->decimal('booking_fee', 10, 2)->default(0)->after('consulting_fee');
            }

            if (! Schema::hasColumn('appointments', 'video_fee')) {
                $table->decimal('video_fee', 10, 2)->default(0)->after('booking_fee');
            }
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $toDrop = [];

            if (Schema::hasColumn('appointments', 'consulting_fee')) {
                $toDrop[] = 'consulting_fee';
            }

            if (Schema::hasColumn('appointments', 'booking_fee')) {
                $toDrop[] = 'booking_fee';
            }

            if (Schema::hasColumn('appointments', 'video_fee')) {
                $toDrop[] = 'video_fee';
            }

            if ($toDrop !== []) {
                $table->dropColumn($toDrop);
            }
        });
    }
};
