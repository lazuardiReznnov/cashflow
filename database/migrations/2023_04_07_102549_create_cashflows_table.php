<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cashflows', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('acount_id')
                ->constrained('acounts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->date('tgl');
            $table->string('slug')->unique();
            $table->string('description');
            $table->integer('debet');
            $table->integer('credit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashflows');
    }
};
