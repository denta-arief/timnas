<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\MonitoringTransaction;
use App\Models\Device;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\MonitoringTransactionController;

class PingHost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ping:host';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Memanggil function ping() dari MonitoringTransaction dijalankan setiap 1 jam ';

    protected $controller;
    
    public function __construct(MonitoringTransactionController $controller)
    {
        parent::__construct();

        $this->controller = $controller;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->controller->ping();

        $this->info('Command executed successfully.');
    }
}
