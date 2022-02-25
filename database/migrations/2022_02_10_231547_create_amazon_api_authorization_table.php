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
        Schema::create('amazon_api_authorizations', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->unique();
            $table->string('scope');
            $table->text('refresh_token');
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
        Schema::dropIfExists('amazon_api_authorizations');
    }
};
