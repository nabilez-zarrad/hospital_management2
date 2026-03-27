<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            if (! Schema::hasColumn('doctors', 'username')) {
                $table->string('username')->nullable()->after('user_id');
            }
            if (! Schema::hasColumn('doctors', 'email')) {
                $table->string('email')->nullable()->after('username');
            }
            if (! Schema::hasColumn('doctors', 'gender')) {
                $table->enum('gender', ['male', 'female'])->nullable()->after('phone');
            }
            if (! Schema::hasColumn('doctors', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable()->after('gender');
            }
            if (! Schema::hasColumn('doctors', 'biography')) {
                $table->text('biography')->nullable()->after('date_of_birth');
            }
            if (! Schema::hasColumn('doctors', 'clinic_name')) {
                $table->string('clinic_name')->nullable()->after('biography');
            }
            if (! Schema::hasColumn('doctors', 'clinic_address')) {
                $table->string('clinic_address')->nullable()->after('clinic_name');
            }
            if (! Schema::hasColumn('doctors', 'address_line_1')) {
                $table->string('address_line_1')->nullable()->after('clinic_address');
            }
            if (! Schema::hasColumn('doctors', 'address_line_2')) {
                $table->string('address_line_2')->nullable()->after('address_line_1');
            }
            if (! Schema::hasColumn('doctors', 'city')) {
                $table->string('city')->nullable()->after('address_line_2');
            }
            if (! Schema::hasColumn('doctors', 'state')) {
                $table->string('state')->nullable()->after('city');
            }
            if (! Schema::hasColumn('doctors', 'country')) {
                $table->string('country')->nullable()->after('state');
            }
            if (! Schema::hasColumn('doctors', 'postal_code')) {
                $table->string('postal_code')->nullable()->after('country');
            }
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $columns = [
                'username',
                'email',
                'gender',
                'date_of_birth',
                'biography',
                'clinic_name',
                'clinic_address',
                'address_line_1',
                'address_line_2',
                'city',
                'state',
                'country',
                'postal_code',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('doctors', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
