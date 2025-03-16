<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration

{
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {      
            $table->string('url_title')->after('title')->unique();
        });
    }

    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {      
            $table->dropColumn('url_title');
        });
    }
}


?>
