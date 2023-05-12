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
        Schema::create('contact_info_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_info_id')
                ->constrained('contact_infos')
                ->onDelete('cascade');
            $table->string('title');
            $table->text('link');
            $table->string('locale')->index();
            $table->unique(['contact_info_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_info_translations');
    }
};
