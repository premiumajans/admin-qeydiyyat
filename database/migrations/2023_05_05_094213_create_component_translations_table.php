<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('component_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('component_id')
                ->constrained('components')
                ->onDelete('cascade');
            $table->text('title');
            $table->string('locale')->index();
            $table->unique(['component_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('component_translations');
    }
};
