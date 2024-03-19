<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\BotTelegramController;

class sendDailyPdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-daily-pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim laporan daily dalam bentuk Pdf via telegram';

    /**
     * Execute the console command.
     */

    protected $controller;
    public function __construct(BotTelegramController $controller)
    {
        parent::__construct();

        $this->controller = $controller;
    }

    public function handle()
    {
        //
        $this->controller->sendPdf();

        $this->info('File Laporan Daily sudah terkirim.');
    }
}
