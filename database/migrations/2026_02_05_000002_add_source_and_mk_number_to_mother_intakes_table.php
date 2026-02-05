<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('mother_intakes', function (Blueprint $table) {
            $table->unsignedBigInteger('source_id')->nullable()->after('id');
            $table->string('mk_number')->nullable()->after('source_id');

            $table->unique('source_id');
            $table->unique('mk_number');
        });
    }

    public function down(): void
    {
        Schema::table('mother_intakes', function (Blueprint $table) {
            $table->dropUnique(['source_id']);
            $table->dropUnique(['mk_number']);
            $table->dropColumn(['source_id', 'mk_number']);
        });
    }
};
