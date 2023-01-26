<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Jeodns\Models\Location;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jeodns_locations_weights', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Location::class, 'src_id')
                ->constrained("jeodns_locations")
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignIdFor(Location::class, 'dst_id')
                ->constrained("jeodns_locations")
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedFloat("weight");

            $table->timestamp('updated_at')
                ->useCurrent()
                ->useCurrentOnUpdate();

            $table->unique(['src_id', 'dst_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jeodns_locations_weights');
    }
};
