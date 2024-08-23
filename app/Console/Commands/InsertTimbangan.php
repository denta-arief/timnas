<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\TimbanganController;

class InsertTimbangan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:insert-timbangan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert data timbangan TBS untuk SIMOGA setiap 5 menit ';

    protected $controller;
    
    public function __construct(TimbanganController $controller)
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
        $this->controller->insertTicket();
        $this->info('data inserted successfully.');
    }
}
