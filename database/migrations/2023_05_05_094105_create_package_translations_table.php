<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('package_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')
                ->constrained('packages')
                ->onDelete('cascade');
            $table->string('title');
            $table->string('monthlyPrice');
            $table->string('annualyPrice');
            $table->string('exchange');
            $table->string('alt');
            $table->string('locale')->index();
            $table->unique(['package_id', 'locale']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('package_translations');
    }
};
