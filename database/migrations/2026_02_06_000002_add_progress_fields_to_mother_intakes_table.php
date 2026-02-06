<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mother_intakes', function (Blueprint $table) {
            if (!Schema::hasColumn('mother_intakes', 'completed_by')) {
                $table->unsignedBigInteger('completed_by')->nullable()->after('completed_at');
                $table->index('completed_by');
            }

            if (!Schema::hasColumn('mother_intakes', 'progress_comment')) {
                $table->text('progress_comment')->nullable()->after('notes');
            }
        });
    }

    public function down(): void
    {
        Schema::table('mother_intakes', function (Blueprint $table) {
            if (Schema::hasColumn('mother_intakes', 'completed_by')) {
                $table->dropIndex(['completed_by']);
                $table->dropColumn('completed_by');
            }

            if (Schema::hasColumn('mother_intakes', 'progress_comment')) {
                $table->dropColumn('progress_comment');
            }
        });
    }
};
