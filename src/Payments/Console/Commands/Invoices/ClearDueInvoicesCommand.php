<?php

namespace eKutivaSolutions\Payments\Commands\Invoices;

use App\Invoice;
use Illuminate\Console\Command;

class ClearDueInvoicesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ekuschool:clear-invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear unpaid Due Invoices';

    protected $invoice;

    /**
     * Create a new command instance.
     *
     * @param \App\Invoice $invoice
     */
    public function __construct(Invoice $invoice)
    {
        parent::__construct();

        $this->invoice = $invoice;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dues = $this->invoice->unpaidDues()->get();

        if ($i = $dues->count()) {
            $bar = $this->output->createProgressBar($i);

            foreach ($dues as $due) {
                $due->delete();

                $bar->advance();
            }


            $bar->finish();
            $this->info('');
            $this->info('Invoices cleared with success!');
        } else {
            $this->error('No due invoices found!');
        }
    }
}
