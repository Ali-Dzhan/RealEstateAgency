<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Viewing table update
        Schema::table('viewings', function (Blueprint $table) {
            // Add new columns if missing
            if (!Schema::hasColumn('viewings', 'status')) {
                $table->enum('status', ['pending', 'completed', 'cancelled'])
                    ->default('pending')
                    ->after('scheduled_on');
            }

            if (!Schema::hasColumn('viewings', 'client_review')) {
                $table->text('client_review')->nullable()->after('status');
            }

            if (!Schema::hasColumn('viewings', 'rating')) {
                $table->unsignedTinyInteger('rating')->nullable()->after('client_review');
            }

            if (Schema::hasColumn('viewings', 'result')) {
                $table->renameColumn('result', 'agent_notes');
            }
        });

        // Offer table update
        Schema::table('offers', function (Blueprint $table) {
            if (!Schema::hasColumn('offers', 'status')) {
                $table->enum('status', ['pending', 'accepted', 'rejected'])
                    ->default('pending')
                    ->after('price');
            }

            if (!Schema::hasColumn('offers', 'notes')) {
                $table->text('notes')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('viewings', function (Blueprint $table) {
            if (Schema::hasColumn('viewings', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('viewings', 'client_review')) {
                $table->dropColumn('client_review');
            }
            if (Schema::hasColumn('viewings', 'rating')) {
                $table->dropColumn('rating');
            }
            if (Schema::hasColumn('viewings', 'agent_notes')) {
                $table->renameColumn('agent_notes', 'result');
            }
        });

        Schema::table('offers', function (Blueprint $table) {
            if (Schema::hasColumn('offers', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('offers', 'notes')) {
                $table->dropColumn('notes');
            }
        });
    }
};
