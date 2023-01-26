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
        Schema::create('jeodns_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger("continent");
            $table->string("country", 2)
                ->collation("latin1_general_ci");
            $table->string("state", 100)
                ->nullable()
                ->collation("latin1_general_ci");
            $table->unique(['continent', 'country', 'state']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jeodns_locations');
    }
};
