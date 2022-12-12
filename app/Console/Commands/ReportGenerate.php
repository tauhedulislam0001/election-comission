<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class ReportGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $str            = rand(000000, 999999);
        $pdf    = PDF::loadHTML('<h1>Test</h1>');
        $pdf_name = 'e-ticket_test_report'.$str .'.pdf';


        Storage::put('app/public/tickets/' . $pdf_name, $pdf->output());
    }
}
