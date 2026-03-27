<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('admins');

        if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'role')) {
            return;
        }

        $driver = Schema::getConnection()->getDriverName();

        // Widen column before assigning values outside an old ENUM (e.g. 'user').
        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(20) NOT NULL DEFAULT 'patient'");
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE users ALTER COLUMN role TYPE VARCHAR(20) USING role::text');
            DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'patient'");
        }
    }

    public function down(): void
    {
        // Intentionally minimal: separate admin table is not restored.
    }
};
