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
    Schema::create('races', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();
        $table->string('circuit');
        $table->string('game'); // iRacing, ACC, F1, etc.
        $table->dateTime('race_date');
        $table->integer('max_participants')->default(20);
        $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');
        $table->timestamps();
        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
