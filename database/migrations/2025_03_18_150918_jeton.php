<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    

    public function up()
    {
        Schema::create('jetons', function (Blueprint $table) {
            $table->id();
            $table->string('status', 50);
            $table->foreignId('equipe_id')->constrained('equipes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    
    

    public function down()
    {
        Schema::dropIfExists('jetons');
    }
};
