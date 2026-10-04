<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->string('gpu_driver')->nullable()->after('threads');
            $table->string('gpu_devices')->nullable()->after('gpu_driver');
        });
    }

    public function down(): void
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->dropColumn(['gpu_driver', 'gpu_devices']);
        });
    }
};
