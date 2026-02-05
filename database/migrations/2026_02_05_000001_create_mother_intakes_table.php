<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mother_intakes', function (Blueprint $table) {
            $table->id();

            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();

            $table->string('journey_stage')->nullable();
            $table->unsignedInteger('pregnancy_weeks')->nullable();
            $table->unsignedInteger('baby_weeks_old')->nullable();

            $table->string('hospital_planned')->nullable();
            $table->string('hospital_alternative')->nullable();
            $table->string('delivery_hospital')->nullable();
            $table->string('birth_hospital')->nullable();

            $table->string('ttc_duration')->nullable();

            $table->boolean('agree_comms')->default(false);
            $table->boolean('disclaimer_ack')->default(false);

            $table->string('email')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->string('pregnancy_stage')->nullable();
            $table->date('due_date')->nullable();
            $table->string('location')->nullable();
            $table->unsignedInteger('previous_pregnancies')->nullable();
            $table->text('concerns')->nullable();
            $table->json('interests')->nullable();

            $table->string('status')->default('pending');
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('notes')->nullable();
            $table->string('priority')->default('medium');

            $table->unsignedBigInteger('user_id')->nullable();

            $table->timestamps();

            $table->index(['phone']);
            $table->index(['full_name']);
            $table->index(['status']);
            $table->index(['user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mother_intakes');
    }
};
