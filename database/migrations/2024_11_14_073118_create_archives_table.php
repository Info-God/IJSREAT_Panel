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
        Schema::create('archives', function (Blueprint $table) {
            $table->bigIncrements("paper_id");
            $table->string("paper_title");
            $table->text("paper_abstract");
            $table->string("issue");
            $table->string("volume");
            $table->string("paper_month");
            $table->string("paper_author");
            $table->string("year");
            $table->string("paper_url");
            $table->string("paper_doi");
            $table->boolean("is_deleted")->default(false);
            $table->string("paper_articletype");
            $table->string("paper_pages");
            $table->string("paper_uniqueid")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.  
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
