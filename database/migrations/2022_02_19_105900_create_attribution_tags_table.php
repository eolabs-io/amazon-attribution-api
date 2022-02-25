<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Migrations\AmazonAttributionApiMigration;

return new class extends AmazonAttributionApiMigration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribution_tags', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('tag');
            $table->string('publisher_identifier')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribution_tags');
    }
};
