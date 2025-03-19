<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    

    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->text('commentaire')->nullable();
            $table->foreignId('membre_id')->constrained('memberjuries')->onDelete('cascade');
            $table->foreignId('equipe_id')->constrained('equipes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    


    public function down()
    {
        Schema::dropIfExists('notes');
    }
};
