<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Publishers\Command;

use Illuminate\Console\Command;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Publisher;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Events\FetchPublisher;

class PublisherCommand extends Command
{
    protected $signature = 'amazon-attribution-api:publishers';


    protected $description = 'Gets Publishers from Amazon Attribution API';


    public function handle()
    {
        $this->info('Geting Publishers from Amazon Attribution API...');


        $publisher = new Publisher;

        FetchPublisher::dispatch($publisher);
    }
}
