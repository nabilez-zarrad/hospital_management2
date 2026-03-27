<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        if (Schema::hasTable('doctors')) {
            foreach (DB::table('doctors')->pluck('user_id') as $userId) {
                DB::table('users')->where('id', $userId)->where('role', '!=', 'admin')->update(['role' => 'doctor']);
            }
        }

        if (Schema::hasTable('patients')) {
            foreach (DB::table('patients')->pluck('user_id') as $userId) {
                DB::table('users')->where('id', $userId)->whereNotIn('role', ['admin', 'doctor'])->update(['role' => 'patient']);
            }
        }

        DB::table('users')->where('role', 'user')->update(['role' => 'patient']);

        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(20) NOT NULL DEFAULT 'patient'");
        }
    }

    public function down(): void
    {
        //
    }
};
