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
        Schema::create('product_reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('attributedPurchases14d');
            $table->integer('attributedDetailPageViewsClicks14d');
            $table->string('adGroupId');
            $table->string('advertiserName');
            $table->string('productName');
            $table->string('productCategory');
            $table->string('productSubcategory');
            $table->integer('brandHaloAttributedPurchases14d');
            $table->integer('brandHaloUnitsSold14d');
            $table->integer('attributedNewToBrandSales14d');
            $table->integer('attributedAddToCartClicks14d');
            $table->integer('brandHaloNewToBrandPurchases14d');
            $table->string('brandName');
            $table->string('marketplace');
            $table->float('brandHaloAttributedSales14d');
            $table->string('campaignId');
            $table->integer('brandHaloNewToBrandUnitsSold14d');
            $table->string('productAsin');
            $table->string('productConversionType');
            $table->integer('attributedNewToBrandUnitsSold14d');
            $table->integer('brandHaloAttributedAddToCartClicks14d');
            $table->integer('attributedNewToBrandPurchases14d');
            $table->integer('unitsSold14d');
            $table->string('productGroup');
            $table->float('brandHaloNewToBrandSales14d');
            $table->string('publisher');
            $table->integer('brandHaloDetailPageViewsClicks14d');
            $table->float('attributedSales14d');
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
        Schema::dropIfExists('product_reports');
    }
};
