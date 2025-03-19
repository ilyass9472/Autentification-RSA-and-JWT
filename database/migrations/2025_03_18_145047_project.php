<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    

    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->text('description')->nullable();
            $table->foreignId('hackathon_id')->constrained('hackathons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    
    
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
