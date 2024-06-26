<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('user_requests', function (Blueprint $table) {
            $table->id('request_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('concept')->nullable();
            $table->string('cost_center', 32)->nullable();
            $table->string('payee', 512)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('type', 32)->nullable();
            $table->string('bank', 32)->nullable();
            $table->string('card', 256)->nullable();
            $table->string('account', 256)->nullable();
            $table->string('branch', 512)->nullable();
            $table->string('reference', 512)->nullable();
            $table->string('covenant', 512)->nullable();
            $table->string('note')->nullable();
            $table->tinyInteger('status')->default(0);

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_requests');
    }
};
