<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ConsumePayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:consume-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $consumer = \Junges\Kafka\Facades\Kafka::createConsumer()->withAutoCommit();
        $consumer->subscribe('payment')
            ->withHandler(function(\Junges\Kafka\Contracts\KafkaConsumerMessage $message) {
                Log::info($message->getTopicName());
                Log::info($message->getBody());
                return 0;
            });

        $consume = $consumer->build();
        $consume->consume();
    }
}
