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
        Schema::create('maid_requests', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete("restrict");
            $table->unsignedBigInteger('maid_id');
            $table->foreign('maid_id')->on('maids')->references('id')->onDelete("restrict");
            $table->enum('status', ['pending', 'payed', 'closed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maid_requests');
    }
};
