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
        Schema::create('why_choose_us_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('why_choose_us_id')
                ->constrained('why_choose_us')
                ->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->string('locale')->index();
            $table->unique(['why_choose_us_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('why_choose_us_translations');
    }
};
