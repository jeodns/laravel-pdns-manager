<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Jeodns\Models\Zone;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jeodns_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        
            $table->foreignIdFor(Zone::class, 'zone_id')
                ->constrained("jeodns_zones")
                ->onUpdate('cascade')
                ->onDelete('cascade');
    
            $table->string("name", 253);
            $table->string("type", 10);
            $table->unsignedInteger("ttl");
            $table->boolean("geobase");
            $table->unsignedTinyInteger("strategy");
            $table->unsignedTinyInteger("status");

            $table->unique(['name', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jeodns_records');
    }
};
