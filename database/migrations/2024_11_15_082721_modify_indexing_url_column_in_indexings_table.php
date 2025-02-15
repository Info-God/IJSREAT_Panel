<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIndexingUrlColumnInIndexingsTable extends Migration
{
    public function up()
    {
        Schema::table('indexings', function (Blueprint $table) {
            $table->text('indexing_url')->change(); // Change to text to allow for longer URLs
        });
    }

    public function down()
    {
        Schema::table('indexings', function (Blueprint $table) {
            $table->string('indexing_url', 255)->change(); // Revert back if you roll back the migration
        });
    }
}
