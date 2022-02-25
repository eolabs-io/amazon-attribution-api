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
        Schema::create('performance_reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('attributedAddToCartClicks14d');
            $table->string('campaignId');
            $table->integer('attributedPurchases14d');
            $table->integer('attributedDetailPageViewsClicks14d');
            $table->integer('attributedTotalAddToCartClicks14d');
            $table->integer('attributedTotalPurchases14d');
            $table->string('adGroupId');
            $table->string('advertiserName');
            $table->string('creativeId');
            $table->integer('totalUnitsSold14d');
            $table->integer('unitsSold14d');
            $table->integer('Click-throughs');
            $table->string('publisher');
            $table->integer('attributedTotalDetailPageViewsClicks14d');
            $table->float('attributedSales14d');
            $table->float('totalAttributedSales14d');
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
        Schema::dropIfExists('performance_reports');
    }
};
