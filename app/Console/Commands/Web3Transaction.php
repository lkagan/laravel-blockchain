<?php

namespace App\Console\Commands;

use Web3\Web3;
use Web3\ValueObjects\Wei;
use Illuminate\Console\Command;
use Web3\ValueObjects\Transaction;

class Web3Transaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction {from} {to} {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $transaction = Transaction::between(
            $this->argument('from'),
            $this->argument('to')
        )->withValue(Wei::fromEth($this->argument('amount')));

        $web3 = new Web3('http://127.0.0.1:7545');

        $result = $web3->eth()->sendTransaction($transaction);

        $this->info("Transaction result: " . $result);
    }
}
