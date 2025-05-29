<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\GenerateInvoice;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Throwable;

class SendMonthlyInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:send';

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
        $jobs = [];
        User::chunk(100, function($users) use(&$jobs){
            foreach($users as $user){
                $jobs[] = new GenerateInvoice($user);
            }
        });

        Bus::batch($jobs)
            ->onQueue('invoices')
            ->then(function (Batch $batch) {
                info("All jobs dispatched");
            })->catch(function (Batch $batch, Throwable $e) {
               info("current batch failed". $e->getMessage());
            })->dispatch();
    }
}
