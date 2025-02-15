<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('editorial_boards', function (Blueprint $table) {
            $table->bigIncrements("member_id");
            $table->boolean('is_active')->default(true);
            $table->boolean('is_deleted')->default(false);
            $table->string('member_role');
            $table->string('member_address');
            $table->string('member_image_url');
            $table->text('member_researcharea');
            $table->string('member_email');
            $table->string('member_website')->nullable();
            $table->string('member_country');
            $table->string('member_name');
            $table->string('member_designation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editorial_boards');
    }
};
