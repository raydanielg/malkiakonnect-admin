<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mother_intakes', function (Blueprint $table) {
            $table->timestamp('approved_at')->nullable()->after('mk_number');
            $table->unsignedBigInteger('approved_by')->nullable()->after('approved_at');

            $table->index('approved_at');
            $table->index('approved_by');
        });
    }

    public function down(): void
    {
        Schema::table('mother_intakes', function (Blueprint $table) {
            $table->dropIndex(['approved_at']);
            $table->dropIndex(['approved_by']);

            $table->dropColumn(['approved_at', 'approved_by']);
        });
    }
};
