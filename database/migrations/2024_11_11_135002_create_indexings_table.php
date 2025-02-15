<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('indexings', function (Blueprint $table) {
            $table->bigIncrements('indexing_id');
            $table->string('indexing_name');
            $table->string('indexing_url');
            $table->boolean("is_active")->default(true);
            $table->boolean("is_deleted")->default(false);
            $table->string("indexing_image_url");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indexings');
    }
};
