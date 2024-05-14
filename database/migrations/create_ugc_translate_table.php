<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ugc_translations', function (Blueprint $table) {
            $table->id();

            $table->morphs('linkable');
            $table->json('content');
            $table->string('field');
            $table->boolean('locked')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ugc_translations');
    }
};
