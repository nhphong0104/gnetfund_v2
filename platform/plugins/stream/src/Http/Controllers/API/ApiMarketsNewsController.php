<?php

namespace Botble\Stream\Http\Controllers\API;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Stream\Http\Requests\StreamRequest;
use Botble\Stream\Repositories\Interfaces\StreamInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Stream\Tables\StreamTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Stream\Forms\StreamForm;
use Botble\Base\Forms\FormBuilder;

class ApiMarketsNewsController extends BaseController
{
    /**
     * @var StreamInterface
     */
    protected $streamRepository;

    /**
     * MarketsNewsController constructor.
     * @param StreamInterface $streamRepository
     */
    public function __construct(StreamInterface $streamRepository)
    {
        $this->streamRepository = $streamRepository;
    }

    public function loadStream(Request $request)
    {
        if($request->ajax())
        {
            $page = $request->input('page');
            $limit = 12;
            $output = "";

            $data = $this->streamRepository->getModel()->select('*')
                ->with('category','country')
                ->where('streams.status', BaseStatusEnum::PUBLISHED)
                ->offset($limit + ($limit*$page-1))
                ->limit($limit)
                ->orderBy('streams.id_trading', 'desc')->get();

            if(!$data->isEmpty())
            {
                foreach($data as $stream) {
                    $class = "";
                    if($stream->importance == 1){
                        $class = 'bg-primary';
                    } else{
                        $class = 'bg-danger';
                    }
                    $output .= '<li style="background-color: #fff" class="list-group-item" id="'.$stream->id_trading.'">
                                    <span  class="label small '.$class.'" style="background-color: #858585; text-transform:capitalize;">'.$stream->country->name.'</span>&nbsp;
                                    <br>
                                    <span class="pt-2 pb-2" ><b>'.$stream->name.'</b></span>
                                    <br>'.$stream->description.'<br>
                                    <small>'.date_from_database($stream->created_at,"H:i d/m/Y").'</small>
                                </li>';
                }
            }
            echo $output;
        }
    }
}
