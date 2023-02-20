<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Jeodns\PDNSManager\Models\Record;
use Jeodns\PDNSManager\Models\Location;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdns_records_data', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Record::class, 'record_id')
                ->constrained("pdns_records")
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedTinyInteger("weight")->nullable();
            $table->unsignedTinyInteger("priority")->nullable();
            

            $table->foreignIdFor(Location::class, 'location_id')
                ->nullable()
                ->constrained("pdns_locations")
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->json("content");

            $table->unsignedTinyInteger("status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pdns_records_data');
    }
};
