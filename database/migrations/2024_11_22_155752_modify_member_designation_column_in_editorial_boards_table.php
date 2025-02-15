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
        Schema::table('editorial_boards', function (Blueprint $table) {
            $table->text('member_designation')->change(); // Update to `text`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('editorial_boards', function (Blueprint $table) {
            $table->string('member_designation', 255)->change(); // Revert back to `string`
        });
    }
};
