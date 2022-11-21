<div class="container-fluid mtb15 no-fluid">
    <div class="row sm-gutters">
        <div class="col-md-12 mb5">
            <div class="header d-flex">

                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                            src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js"
                            async>
                        {
                            "colorTheme"
                        :
                            "dark"
                        }
                    </script>
                </div>
                <!-- TradingView Widget END -->
            </div>
        </div>
        <div class="col-md-9 pr-md-0">
            <div class="main-chart">
                <div class="markets-container">
                    <div class="markets-content">
                        <h2>GAIN CHART</h2>
                        <p>Profit: $786.78</p>
                        <span class="green"> Gain + 11.29%</span>
                    </div>
                    <div class="porlet-body">
                        <div id="container"></div>
                    </div>
                </div>
            </div>
            <div class="market-trade">
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#pills-trade-limit" role="tab" aria-selected="true">ADVANCED STATISTICS</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-trade-limit" role="tabpanel">
                        <div class="d-flex justify-content-between">
                            <div class="market-trade-buy">
                                <p>Balance: <span class="text-balance">$ {{ theme_option('balance') }}</span></p>
                                <p>Tiền vốn: <span class="text-von">$ {{ theme_option('equity') }}</span></p>
                                <p>Floating PL: <span>$ 0</span></p>
                                <p>Deposits: <span>$ {{ theme_option('deposits') }}</span></p>
                                <p>Withdrawals: <span>$ -{{ theme_option('withdrawals') }}</span></p>
                            </div>
                            <div class="market-trade-sell">

                                <p>Trades: <span>{{ theme_option('trades') }}</span></p>
                                <p>Pips: <span>{{ theme_option('pips') }}</span></p>
                                <p>Won: <span class="text-balance">{{ theme_option('won') }} %</span></p>
                                <p>Lots: <span>{{ theme_option('lots') }}</span></p>
                                <p>Max Drawdown: <span class="text-danger">-{{ theme_option('max-drawdown') }} %</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="market-pairs">
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#HOME" role="tab" aria-selected="true">Tổng
                            quan</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="HOME" role="tabpanel">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Symvbol</th>
                                <th>Buy/Sell</th>
                                <th>Open</th>
                                <th>Pips</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(get_signal(10) as $signal)
                                <tr>
                                    <td><i class="icon ion-md-star"></i> {{$signal->asset->name}}</td>
                                    <td>{{$signal->side}}</td>
                                    <td>{{$signal->price_open}}</td>
                                    @if($signal->status_signal == 'win')
                                        <td class="green">${{$signal->tp}}</td>
                                    @else
                                        <td class="red">-${{$signal->tp}}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="info-fund landing-info-one">
                            <h2 class="d-flex mb-3">
{{--                                <div class="page-header__left">--}}
{{--                                    <a href="{{ route('public.single') }}" class="page-logo">--}}
{{--                                        @if (theme_option('logo'))--}}
{{--                                            <img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" alt="{{ theme_option('site_title') }}" height="50">--}}
{{--                                        @endif--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                                GNET FUND
                            </h2>
                            <ul class="mb-5">
                                <li><i class="icon ion-ios-checkmark-circle"></i> Đòn bảy:1:400</li>
                                <li><i class="icon ion-ios-checkmark-circle"></i> Management fee:30.00%</li>
                                <li><i class="icon ion-ios-checkmark-circle"></i> MDD:10%</li>
                                <li><i class="icon ion-ios-checkmark-circle"></i> The early redemption fee:1.00%</li>
                                <li><i class="icon ion-ios-checkmark-circle"></i> Minimum balance:$1000.00</li>
                            </ul>
                            <div class="market-trade">
                                <button class="btn buy" type="button" data-toggle="modal" data-target="#popupSub">Subscribe to fund</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="popupSub" tabindex="-1" role="dialog" aria-labelledby="popupSubLabel" aria-hidden="true">
    <div class="modal-dialog modal-newsletter">
        <div class="modal-content">
            {!! Form::open(['route' => 'public.send.contact', 'method' => 'POST', 'class' => 'contact-form']) !!}
                <div class="modal-header">
                    <h4>Subscribe to fund</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span>×</span></button>
                </div>
                <div class="modal-body text-center">
                    <p>Bạn vui lòng để lại thông tin để GNETFUND có thể tư vấn cho bạn</p>
                    <div class="form-group">
                        <input type="text"  name="name" class="form-control" value="Họ tên khách hàng" required="required">
                        <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại để được tư vấn" required="required">
                        <input type="hidden" name="email" value="{{time()}}@gmail.com"required="">
                        <input type="hidden"  name="subject" value="Quan tâm quỹ">
                        <input type="submit" class="btn btn-success btn-block" value="Subscribe">
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
