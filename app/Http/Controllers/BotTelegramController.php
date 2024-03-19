<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;
use App\Models\MonitoringTransaction;
use App\Models\Site;
use Illuminate\Support\Arr;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Storage;
use SnappyPDF;
use App\Models\User;

class BotTelegramController extends Controller
{
    //
    private $nama;
    private $chatId;
    private $pesan;
    private $tglKirim;
    private $telegram;

    public function setWebHook(){
        $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);
        dd($response);
    }
    protected $controller;

    public function __construct(ReportController $reportController)
    {
        
        $this->controller = $reportController;
    }

    public function sendPdf(){
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        $tanggal = Carbon::now()->format('d-m-Y');
        // Path file PDF
        $pdfPath = storage_path('app/public/example.pdf');
        $request = new Request();
        $user = User::select('name','chat_id')
                ->get();
        $this->controller->rpt_daily($request);
        $isiFile = Storage::get('/storage/dailyReport.html');
        $output = null;
        $output = SnappyPDF::loadHTML($isiFile)->output();
        
        $disk = Storage::disk('public');

        // Save the file with the PDF output.
        if ($disk->put('example.pdf', $output)) {
            $document = InputFile::create($pdfPath, 'Daily Report '. $tanggal . '.pdf');
            foreach ($user as $key => $value) {
                # code...
                $response = $telegram->sendDocument([
                    'chat_id' => $value->chat_id, // Ganti dengan ID obrolan target
                    'document' => $document,
                    'caption' => 'Laporan Network Site PTPN 1 Reg 7 periode ' . $tanggal,
                ]);
            }

        }
        // Kirim file PDF ke bot Telegram

        return  $response->getMessageId();
    }

    public function testDevelop(){
        $jamterakhir = MonitoringTransaction::max('trans_tanggal');
        $state = null;
        $result = MonitoringTransaction::select('devices.device_site_kode', 'trans_status', 'trans_result','trans_tanggal','trans_waktu', 'sites.site_wilayah')
                    ->leftjoin('devices','devices.id','=','trans_device_id')
                    ->leftjoin('sites','sites.site_kode','=','devices.device_site_kode')
                    // ->where('devices.device_site_kode','BAJA')
                    ->where('trans_tanggal','=', $jamterakhir)
                    ->orderBy('sites.site_wilayah', 'ASC')
                    ->get();
        foreach ($result as $key => $value) {
            # code...
            // $state = $state . $value->device_site_kode . PHP_EOL;
            $state = $state . '-  ' . $value->device_site_kode .'  ' . $value->trans_status . PHP_EOL;
        }
        // dd( explode(' ',trim(explode(',',$result['trans_result'])[2]) )[0]);
        $state = 'Laporan Status Jaringan PTPN 1 Reg 7, hari ini pukul ' . substr($jamterakhir, -8) . ' :'. PHP_EOL . $state;

        dd($state);
        return $result;
    }

    public function commandHandlerWebHook(Request $request){
        $update = Telegram::getWebhookUpdate();
        $message = $update->getMessage();
        

        // $this->nama = $message['chat']['first_name'];
        $this->nama = 'All';
        $this->chatId = $message['from']['id'];
        $this->pesan = $message['text'];
        $this->tglKirim = $message['date'];

        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        $daftarPerintah = ['help','status', 'start'];

        if ($this->pesan[0] <> "/") {
            # code...
            $this->about();
        } else {
            $matchFound = preg_match_all("/\b(" . implode('|', $daftarPerintah ) . ")\b/i", $this->pesan , $matches);
            // dd($matches);
            if ($matchFound) {
                # code...

                $commands = array_unique($matches[0]);

                foreach ($commands as $key => $value) {
                    # code...
                    if($value == "help"){
                        if (str_word_count($this->pesan)== 1) {
                            # code...
                            $array = preg_split('#\s+#', $this->pesan, 3);
                            $this->bantuan();
                        } else {
                            return $this->telegram->sendMessage([
                                'chat_id' => $this->chatId,
                                'text' => 'Maaf mohon sesuaikan dengan format perintah dibawah ini :' . PHP_EOL .
                                          '/help' 
                            ]);
                        }
                        
                    } elseif ($value == "status") {
                        # code...
                        if (str_word_count($this->pesan)== 3) {
                            # code...
                            $this->status();
                        } else {
                            return $this->telegram->sendMessage([
                                'chat_id' => $this->chatId,
                                'text' => 'Maaf mohon sesuaikan dengan format perintah dibawah ini :' . PHP_EOL .
                                            '/status all terkini    : cek status jaringan semua site terkini' . PHP_EOL .
                                            '/status [site] terkini : cek status jaringan terkini hanya di [site]', 
                            ]);
                        }
                    } elseif ($value == "start") {
                        $this->bantuan();
                    }
                    ;
                }
            } else {
                $this->about();
            }
        };
    }

    public function about(){
        // $update = Telegram::commandsHandler(true);
        return $this->telegram->sendMessage([
            'chat_id' => $this->chatId,
            'text' => 'Dear '. $this->nama . ','.PHP_EOL.  'fyi yach, harap maklum saya cuma bot yg kerja nya ngasih laporan.' . PHP_EOL . 'Gak usah sok asik ngajak ngobrol lah ya...' . PHP_EOL . 'Ketik /help untuk manual bot ini' ,
        ]);
    }

    public function status() {
        $array = preg_split('#\s+#', $this->pesan, 3);
        $site = $array[1];
        $keterangan = $array[2];
        
        switch (strtolower($site)) {
            case 'all':
                switch (strtolower($keterangan)) {
                    
                    case 'terkini':
                        $statement = null;
                        $jamterakhir = MonitoringTransaction::max('trans_tanggal');  
                        $query = MonitoringTransaction::select('devices.device_site_kode', 'trans_status', 'trans_result','trans_tanggal','trans_waktu','sites.site_wilayah')
                                    ->leftjoin('devices','devices.id','=','trans_device_id')
                                    ->leftjoin('sites','sites.site_kode','=','devices.device_site_kode')
                                    ->where('trans_tanggal','=', $jamterakhir)
                                    ->orderBy('trans_tanggal', 'DESC')
                                    ->get();
                        foreach ($query as $key => $value) {
                            if ($value->trans_status == 'DOWN') {
                                $statement = $statement . '-  *' . $value->device_site_kode .'   ' . $value->trans_status.'* ' . PHP_EOL;
                            } else {
                                $statement = $statement . '-  ' . $value->device_site_kode .'  ' . $value->trans_status . PHP_EOL;
                            }
                            
                        };
                        $statement = 'Laporan Status Jaringan PTPN 1 Reg 7, hari ini pukul ' . substr($jamterakhir, -8) . ' :'. PHP_EOL . $statement;
                        return $this->telegram->sendMessage([
                            'chat_id' => $this->chatId,
                            'text' => $statement,
                            'parse_mode' => 'Markdown'
                        ]);

                    case 'down':
                        $statement = null;
                        $jamterakhir = MonitoringTransaction::max('trans_tanggal');
                        $query = MonitoringTransaction::select('devices.device_site_kode', 'trans_status', 'trans_result','trans_tanggal','trans_waktu')
                                    ->leftjoin('devices','devices.id','=','trans_device_id')
                                    ->where('trans_tanggal','=', $jamterakhir)
                                    ->where('trans_status','=','DOWN')
                                    ->orderBy('trans_tanggal', 'DESC')
                                    ->get();
                        foreach ($query as $key => $value) {
                            $statement = $statement . '- ' . $value->device_site_kode . PHP_EOL;
                        };
                        $statement = 'Update hari ini pada pukul :'. substr($jamterakhir, -8) . PHP_EOL . 'berikut link status DOWN :' . PHP_EOL . $statement;
                        return $this->telegram->sendMessage([
                            'chat_id' => $this->chatId,
                            'text' => $statement, 
                        ]);
                    default:
                        return $this->telegram->sendMessage([
                            'chat_id' => $this->chatId,
                            'text' => 'Maaf mohon sesuaikan dengan format perintah dibawah ini :' . PHP_EOL .
                                        '/status all terkini    : cek status jaringan semua site terkini' . PHP_EOL .
                                        '/status [site] terkini : cek status jaringan terkini hanya di [site]', 
                        ]);
                } 
            default:
                if (Site::where('site_kode', '=', $site)->exists()) {
                    switch (strtolower($keterangan)) {
                        case 'terkini':
                            $query = MonitoringTransaction::select('devices.device_site_kode', 'trans_status', 'trans_result','trans_tanggal','trans_waktu')
                                        ->leftjoin('devices','devices.id','=','trans_device_id')
                                        ->where('devices.device_site_kode', $site)
                                        ->whereDate('trans_tanggal','=', Carbon::now())
                                        ->orderBy('trans_tanggal', 'DESC')
                                        ->first();
                                $loss = explode(' ',trim(explode(',',$query['trans_result'])[2]) )[0];
                                return $this->telegram->sendMessage([
                                    'chat_id' => $this->chatId,
                                    'text' => '<b>Kondisi Jaringan Unit '. strtoupper($site) .' terkini :</b>' . PHP_EOL .
                                            'Link   : '. $query['trans_status'] . PHP_EOL .
                                            'Packet Loss :' . $loss . PHP_EOL .
                                            'Waktu  : '. $query['trans_tanggal'] ,
                                    'parse_mode' => 'HTML'
                                ]);
                        default:
                            return $this->telegram->sendMessage([
                                'chat_id' => $this->chatId,
                                'text' => 'Maaf mohon sesuaikan dengan format perintah dibawah ini :' . PHP_EOL .
                                            '/status all terkini : cek status terkini link jaringan semua site ' . PHP_EOL .
                                            '/status all down    : cek status terkini DOWN di site ' . PHP_EOL .
                                            '/status [site] terkini : cek status jaringan terkini di [site] ',
                            ]);
                    }
                }else {
                    return $this->telegram->sendMessage([
                        'chat_id' => $this->chatId,
                        'text' => 'Site : ' . $site . ' tidak ada dalam Master Data kami' ,
                    ]);
                };
        }

    }

    public function bantuan() {
        return $this->telegram->sendMessage([
            'chat_id' => $this->chatId,
            'text' => '*MANUAL COMMAND BOT*' . PHP_EOL .
                      '/help : daftar perintah di bot ini ' . PHP_EOL .
                      '/status all terkini : cek status terkini link jaringan semua site ' . PHP_EOL .
                      '/status all down    : cek status terkini DOWN di site ' . PHP_EOL .
                      '/status [site] terkini : cek status jaringan terkini di [site] ',
            'parse_mode' => 'Markdown'
        ]);
    }


}
