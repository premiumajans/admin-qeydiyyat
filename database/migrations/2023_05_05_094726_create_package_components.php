<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('package_components', function (Blueprint $table) {
            $table->foreignId('component_id')
                ->constrained('packages')
                ->onDelete('cascade');
            $table->foreignId('package_id')
                ->constrained('components')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('package_components');
    }
};
