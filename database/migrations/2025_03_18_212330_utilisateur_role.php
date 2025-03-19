<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    

    public function up()
    {
        Schema::create('utilisateur_role', function (Blueprint $table) {
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->primary(['utilisateur_id', 'role_id']);
        });
    }




    public function down()
    {
        Schema::dropIfExists('utilisateur_role');
    }

};