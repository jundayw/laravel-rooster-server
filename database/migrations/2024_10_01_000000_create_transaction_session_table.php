<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Get the migration connection name.
     *
     * @return string|null
     */
    public function getConnection(): ?string
    {
        return $this->connection = config('rooster-server.default');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('rooster-server.schema.transaction_table', 'transaction_session'), function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->longText('transaction_rollback');
            $table->longText('transaction_recover');
            $table->enum('action', [
                'ACTION_START',
                'ACTION_END',
                'ACTION_PREPARE',
                'ACTION_PREPARE_COMMIT',
                'ACTION_PREPARE_ROLLBACK',
                'ACTION_COMMIT',
                'ACTION_ROLLBACK',
            ])->default('ACTION_START');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('rooster-server.schema.transaction_table', 'transaction_session'));
    }
};
