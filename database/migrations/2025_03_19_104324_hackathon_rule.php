<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    
    
    public function up()
    {
        Schema::create('hackathon_rule', function (Blueprint $table) {
            $table->foreignId('hackathon_id')->constrained('hackathons')->onDelete('cascade');
            $table->foreignId('rule_id')->constrained('rules')->onDelete('cascade');
            $table->primary(['hackathon_id', 'rule_id']);
        });
}

    


    public function down()
    {
        Schema::dropIfExists('hackathon_rule');
    }
};
