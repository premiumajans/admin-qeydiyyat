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
        Schema::create('portfolio_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')
                ->constrained('portfolios')
                ->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('alt')->nullable();
            $table->string('locale')->index();
            $table->unique(['portfolio_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_translations');
    }
};
