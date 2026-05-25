<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table){
            $table->string('remember_token')->nullable();
            $table->string('role')->default('user');
        });
    }

    public function down(): void
    {
        Schema::dropColumnIfExists('remember_token');
        Schema::dropColumnIfExists('role');
    }
};
