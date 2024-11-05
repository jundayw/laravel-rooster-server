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
        Schema::create(config('rooster-server.schema.undo_table', 'undo_session'), function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->text('request_id');
            $table->text('chain_id');
            $table->string('name');
            $table->longText('sql');
            $table->longText('query');
            $table->longText('bindings');
            $table->text('connection');
            $table->bigInteger('rows')->default(0);
            $table->tinyInteger('confirmation')->default(0);
            $table->enum('status', [
                'START',
                'COMMIT',
                'ROLLBACK',
            ])->default('START');
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
        Schema::dropIfExists(config('rooster-server.schema.undo_table', 'undo_session'));
    }
};
