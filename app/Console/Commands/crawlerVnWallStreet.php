<?php

namespace App\Console\Commands;

use App\Helper\Functions;
use Botble\Stream\Models\WallStreet;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Statickidz\GoogleTranslate;

class crawlerVnWallStreet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:vnwallstreet';

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
     * @return mixed
     */
    public function handle()
    {
        $page = 1;
        do {
            $continue = $this->getData($page);
            echo "\n xong trang " . $page ."\n";
            $page++;
        } while ($continue);

        echo "\n KET THUC";
    }

    public function curlRequest($url, $header = [], $post = [], $get = [], $basicAuth = '')
    {
        // $url = 'https://batdongsan.com.vn/tags/ban/ban-chung-cu-saigon-pearl';
        $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36';
        $ch = curl_init();

        if ($get) {
            $url .= '?' . http_build_query($get);
        }
        curl_setopt($ch, CURLOPT_URL, $url);

        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_COOKIEJAR, storage_path('logs/cookie.txt'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_CAINFO, storage_path('cacert.pem'));
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);

        if ($post) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        }

        if ($basicAuth != '') {
            curl_setopt($ch, CURLOPT_USERPWD, $basicAuth);
        }

        //curl_setopt($ch, CURLOPT_HEADER, TRUE);
        //curl_setopt($ch, CURLOPT_VERBOSE, true);

        $return = curl_exec($ch);

        if ($return) {
            return $return;
        } else {
            var_dump($url, $return, http_build_query($post), curl_getinfo($ch), curl_error($ch));
            throw new \Exception(curl_error($ch), 1);

        }
    }


    public function getData($page){

        $url = 'https://www.fxtin.com/page/finance/information';

        $header = [
            'cookie' =>  'fblo_394220287958534=y'
        ];
        $post = [
            'limit' => 40,
            'page' => 1
        ];
        $responses = $this->curlRequest($url,$header,$post);
        $responses = json_decode($responses, 1);
        //dd($responses);
        foreach ($responses['data']['list'] as $respone){
            //Kiêm tra xem id đã lưu vào db chưa

            $crawler =  WallStreet::where('id_wall',$respone['id'])->first();

            if($crawler){
                echo "Đã tồn tại id:" . $respone['id'] ."\n";
            } else{
                if(isset($respone['translate'])){
                    $content = $respone['translate'];
                } else{
                    if(isset($respone['tran_title'])){
                        $content = $respone['tran_title'];
                    } else{
                        $content = $respone['content'];
                    }
                }

                $content = html_entity_decode( $content);
                $content = str_replace("<b>","",$content);
                $content = str_replace("</b>","",$content);
                $content = preg_replace('/<iframe[^>]+>.*?<\/iframe>/', '', $content);

                $star = 0;
                $consensus = 0;
                $actual = '';
                $country = '';
                $type = 0;
                $revised = '';
                $important = '';
                $influence = 0;
                $is_important = 'false';
                $is_pub = '';
                $unit = '';
                $name = 'Invest318';
                $tag = '';
                $country = '';

                if(isset($respone['star'])){
                    $star = $respone['star'];
                }
                if(isset($respone['consensus'])){
                    $consensus = $respone['consensus'];
                }
                if(isset($respone['actual'])){
                    $actual = $respone['actual'];
                }

                if(isset($respone['tran_country'])){
                    $country = $respone['tran_country'];
                }
                if(isset($respone['type'])){
                    $type = $respone['type'];
                }
                if(isset($respone['revised'])){
                    $revised = $respone['revised'];
                }
                if(isset($respone['important'])){
                    $important = $respone['important'];
                }

                if(isset($respone['is_pub'])){
                    $is_pub = $respone['is_pub'];
                }

                if(isset($respone['influence'])){
                    $influence = $respone['influence'];
                }
                if(isset($respone['tran_title'])){
                    $name = $respone['tran_title'];
                }
                if(isset($respone['tag'])){
                    $tag = $respone['tag'];
                }

                if(isset($respone['country'])){
                    $country = $respone['country'];
                }

                $data = [
                    'vn_pub_date'       => $respone['time'],
                    'id_wall'           => $respone['id'],
                    'description'       => $content,
                    'star'              => $star,
                    'tag'               => $tag,
                    'consensus'         => $consensus,
                    'actual'            => $actual,
                    'country'           => $country,
                    'type'              => $type,
                    'revised'           => $revised,
                    'important'         => $important,
                    'influence'         => $influence,
                    'is_pub'            => $is_pub,
                    'jid'               => "1",
                    'unit'              => $unit,
                    'name'              => $name,
                ];

                $create = WallStreet::create($data);
                if($create){
                    echo "Đã cập nhật xong id: " .$respone['id'] ."\n";
                } else{
                    echo "Thêm mới id " .$respone['id'] ." không thành công \n";
                }
            }
        }
    }

}
