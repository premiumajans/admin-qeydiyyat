<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('statistic_id')
                ->constrained('statistics')
                ->onDelete('cascade');
            $table->string('title');
            $table->string('locale')->index();
            $table->unique(['statistic_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistic_translations');
    }
};
