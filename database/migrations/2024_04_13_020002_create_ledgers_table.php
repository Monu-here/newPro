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
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('amount');
            $table->string('item_id')->nullable();
            $table->decimal('rate',18 ,2);
            $table->unsignedBigInteger('user_id');
            $table->string('decive_id');
            $table->integer('type');
            $table->string('remote_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledgers');
    }
};
