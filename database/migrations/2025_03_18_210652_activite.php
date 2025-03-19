<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    

    public function up()
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    
    


    public function down()
    {
        Schema::dropIfExists('activites');
    }
};
