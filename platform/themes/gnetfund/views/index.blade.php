<div class="container-fluid mbt15 no-fluid">
    <div class="row sm-gutters">
        <div class="col-md-12">
            <div class="favicon">
                <a href="{{ route('public.single') }}" class="page-logo">
                    @if (theme_option('logo'))
                        <img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}"
                             alt="{{ theme_option('site_title') }}" width="210">
                    @endif
                </a>
            </div>
        </div>
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
        <div class="col-md-3 order-md-1 order-2">
            <div class="market-pairs">
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#HOME" role="tab" aria-selected="true">ACTIVITY</a>
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
                                    <td>{{$signal->asset->name}}</td>
                                    <td>{{$signal->side}}</td>
                                    <td>{{$signal->price_open}}</td>
                                    @if($signal->status_signal == 'win')
                                        <td class="pricewin green">${{$signal->tp}}</td>
                                    @else
                                        <td class="priceloss red">-${{$signal->tp}}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="info-fund landing-info-one">
                            <h2 class="d-flex mb-3">
                                <div class="page-header__left">
                                    <a href="{{ route('public.single') }}" class="page-logo">
                                        @if (theme_option('logo'))
                                            <img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}"
                                                 alt="{{ theme_option('site_title') }}" width="210">
                                        @endif
                                    </a>
                                </div>
                            </h2>
                            <ul class="mb-5">
                                <li><i class="icon ion-ios-checkmark-circle"></i> Đòn bảy:1:400</li>
                                <li><i class="icon ion-ios-checkmark-circle"></i> Management fee:30.00%</li>
                                <li><i class="icon ion-ios-checkmark-circle"></i> MDD:10%</li>
                                <li><i class="icon ion-ios-checkmark-circle"></i> The early redemption fee:1.00%</li>
                                <li><i class="icon ion-ios-checkmark-circle"></i> Minimum balance:$1000.00</li>
                            </ul>
                            <div class="market-trade">
                                <button class="btn buy" type="button" data-toggle="modal" data-target="#popupSub">
                                    Subscribe to fund
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 pr-md-0 pl-md-0 order-md-2 order-1">
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
                <div class="dashboard-tabs">
                    <a href="#" class="Gain">
                        <b class="visual"><i class="icon ion-md-document"></i></b>
                        <p>
                            <strong>{{ theme_option('won') }} %</strong>
                            <em>Gain</em>
                        </p>
                    </a>
                    <a href="#Gain" class="Profit">
                        <b class="visual"><i class="icon icon-chart"></i></b>
                        <p>
                            <strong>{{ theme_option('profit') }} $</strong>
                            <em>Profit</em>
                        </p>
                    </a>
                </div>
            </div>

            <div class="market-trade">
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#pills-trade-limit" role="tab"
                           aria-selected="true">ADVANCED STATISTICS</a>
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
                                <p>Max Drawdown: <span class="text-danger">-{{ theme_option('max-drawdown') }} %</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 order-md-3 order-3">
            <div class="market-news">
                <h2 class="heading">Market News</h2>
                <ul class="mCustomScrollbar _mCS_11 mCS-autoHide" style="position: relative; overflow: visible;">
                    <div id="mCSB_11" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" tabindex="0"
                         style="max-height: none;">
                        <div id="mCSB_11_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
                        @foreach(get_all_wall_post(true,20) as $wall)
                            <li>
                                <a href="#!">
                                    <span><i class="icon ion-ios-timer pr15"></i>
                                    @if($wall->type != 0)
                                    <img class="img-country" src="{{$wall->country}}" alt="">
                                    @endif
                                    {{$wall->vn_pub_date}}
                                </span>
                                    <strong>{{$wall->description}}</strong>
                                @if($wall->type != 0)
                                <div class="row">
                                    <div class="col-4">Pre:{{$wall->previous}}</div>
                                    <div class="col-4">Exp:{{$wall->revised}}</div>
                                    <div class="col-4">
                                    @if($wall->influence == 1)
                                    <span class="green">Act:{{$wall->actual}}</span>
                                    @elseif($wall->influence == 2)
                                    <span class="text-von">Act:{{$wall->actual}}</span>
                                    @elseif($wall->influence == 3)
                                    <span class="red">Act:{{$wall->actual}}</span>
                                    @endif
                                    </div>
                                </div>
                                @endif
                                </a>
                            </li>
                            @endforeach
                        </div>
                    </div>
                </ul>
            </div>
            <div class="ads">
                <div id="adunit">
                    <img src="https://ad.doubleclick.net/ddm/trackimp/N39908.2006304TRADINGVIEW/B23966912.280884165;dc_trk_aid=474934378;dc_trk_cid=136857432;salesforce=SFS-7010e000001KpJiAAK;ord=[timestamp];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;gdpr=;gdpr_consent=;ltd=?" style="display:none">
                    <div class="image">
                        <a class="image-link" href="https://adclick.g.doubleclick.net/pcs/click?xai=AKAOjss-3yVRcUS219we96v6DOrblXkD93JXFIL-hD-DWqw2IFIgdpntMiH7qdh-r8Acxa4S8593vWZx1Sdbzpuo714-RHPrxousfLa3qRzXQIQFPxVS36XRNZulsQIaD3pkJfKrY1j43WIkFUnPJrV6-gE7aV8DAK5i5-tNmT2H7LmX--2UiY314vgGtAoZlnWsA7_2tuws2eIdwTGBGcdcRFqABW7zKpAMyF_o4X9sDb4hDQY5PxE-oWQvNvEINbQEtn0lpkBEj6UsNBXeTP4sC_9CDQNvS2pPRwc3rvE6KfLvTgHxRO3vU4bNkGf4QTUH22xGshvlOAZtFt-pJf4KIEi9qbN69jpqKJ5yRuY&amp;sai=AMfl-YSR1SpWW-j9gk90-aB453sHliuPZ9vviJCXy_SNN_ugb_-k8kMX0plzkwj6mkig0TpnM2dVcI6qC8k5EafRy-z1L-Oj0rkVJ9amOeaoeirotoxd5rynUUpHU1se6O8-emgmnxwb3c0&amp;sig=Cg0ArKJSzDrQRmtCQI2kEAE&amp;fbs_aeid=[gw_fbsaeid]&amp;urlfix=1&amp;adurl=https://ad.doubleclick.net/ddm/trackclk/N39908.2006304TRADINGVIEW/B23966912.280884165%3Bdc_trk_aid%3D474934378%3Bdc_trk_cid%3D136857432%3Bsalesforce%3DSFS-7010e000001KpJiAAK%3Bdc_lat%3D%3Bdc_rdid%3D%3Btag_for_child_directed_treatment%3D%3Btfua%3D%3Bgdpr%3D%3Bgdpr_consent%3D%3Bltd%3D" target="_blank"><img src="https://tpc.googlesyndication.com/simgad/14136323686721867516?"></a>
                    </div>
                    <div class="title">
                        <a class="title-link" href="https://adclick.g.doubleclick.net/pcs/click?xai=AKAOjss-3yVRcUS219we96v6DOrblXkD93JXFIL-hD-DWqw2IFIgdpntMiH7qdh-r8Acxa4S8593vWZx1Sdbzpuo714-RHPrxousfLa3qRzXQIQFPxVS36XRNZulsQIaD3pkJfKrY1j43WIkFUnPJrV6-gE7aV8DAK5i5-tNmT2H7LmX--2UiY314vgGtAoZlnWsA7_2tuws2eIdwTGBGcdcRFqABW7zKpAMyF_o4X9sDb4hDQY5PxE-oWQvNvEINbQEtn0lpkBEj6UsNBXeTP4sC_9CDQNvS2pPRwc3rvE6KfLvTgHxRO3vU4bNkGf4QTUH22xGshvlOAZtFt-pJf4KIEi9qbN69jpqKJ5yRuY&amp;sai=AMfl-YSR1SpWW-j9gk90-aB453sHliuPZ9vviJCXy_SNN_ugb_-k8kMX0plzkwj6mkig0TpnM2dVcI6qC8k5EafRy-z1L-Oj0rkVJ9amOeaoeirotoxd5rynUUpHU1se6O8-emgmnxwb3c0&amp;sig=Cg0ArKJSzDrQRmtCQI2kEAE&amp;fbs_aeid=[gw_fbsaeid]&amp;urlfix=1&amp;adurl=https://ad.doubleclick.net/ddm/trackclk/N39908.2006304TRADINGVIEW/B23966912.280884165%3Bdc_trk_aid%3D474934378%3Bdc_trk_cid%3D136857432%3Bsalesforce%3DSFS-7010e000001KpJiAAK%3Bdc_lat%3D%3Bdc_rdid%3D%3Btag_for_child_directed_treatment%3D%3Btfua%3D%3Bgdpr%3D%3Bgdpr_consent%3D%3Bltd%3D" target="_blank">Giao dịch với FXCM - $25 Tiền thưởng mở tài khoản</a>
                    </div>
                    <div class="body">
                        <a class="body-link" href="https://adclick.g.doubleclick.net/pcs/click?xai=AKAOjss-3yVRcUS219we96v6DOrblXkD93JXFIL-hD-DWqw2IFIgdpntMiH7qdh-r8Acxa4S8593vWZx1Sdbzpuo714-RHPrxousfLa3qRzXQIQFPxVS36XRNZulsQIaD3pkJfKrY1j43WIkFUnPJrV6-gE7aV8DAK5i5-tNmT2H7LmX--2UiY314vgGtAoZlnWsA7_2tuws2eIdwTGBGcdcRFqABW7zKpAMyF_o4X9sDb4hDQY5PxE-oWQvNvEINbQEtn0lpkBEj6UsNBXeTP4sC_9CDQNvS2pPRwc3rvE6KfLvTgHxRO3vU4bNkGf4QTUH22xGshvlOAZtFt-pJf4KIEi9qbN69jpqKJ5yRuY&amp;sai=AMfl-YSR1SpWW-j9gk90-aB453sHliuPZ9vviJCXy_SNN_ugb_-k8kMX0plzkwj6mkig0TpnM2dVcI6qC8k5EafRy-z1L-Oj0rkVJ9amOeaoeirotoxd5rynUUpHU1se6O8-emgmnxwb3c0&amp;sig=Cg0ArKJSzDrQRmtCQI2kEAE&amp;fbs_aeid=[gw_fbsaeid]&amp;urlfix=1&amp;adurl=https://ad.doubleclick.net/ddm/trackclk/N39908.2006304TRADINGVIEW/B23966912.280884165%3Bdc_trk_aid%3D474934378%3Bdc_trk_cid%3D136857432%3Bsalesforce%3DSFS-7010e000001KpJiAAK%3Bdc_lat%3D%3Bdc_rdid%3D%3Btag_for_child_directed_treatment%3D%3Btfua%3D%3Bgdpr%3D%3Bgdpr_consent%3D%3Bltd%3D" target="_blank">Giao dịch ngay bây giờ chỉ với tài khoản $50 và nhận về $25 tiền thưởng. *Điều khoản và điều kiện áp dụng. </a>
                    </div>
                    <div class="attribution">Ad</div>
                    <div class="call-to-action">
                        <a class="call-to-action-link" href="https://adclick.g.doubleclick.net/pcs/click?xai=AKAOjss-3yVRcUS219we96v6DOrblXkD93JXFIL-hD-DWqw2IFIgdpntMiH7qdh-r8Acxa4S8593vWZx1Sdbzpuo714-RHPrxousfLa3qRzXQIQFPxVS36XRNZulsQIaD3pkJfKrY1j43WIkFUnPJrV6-gE7aV8DAK5i5-tNmT2H7LmX--2UiY314vgGtAoZlnWsA7_2tuws2eIdwTGBGcdcRFqABW7zKpAMyF_o4X9sDb4hDQY5PxE-oWQvNvEINbQEtn0lpkBEj6UsNBXeTP4sC_9CDQNvS2pPRwc3rvE6KfLvTgHxRO3vU4bNkGf4QTUH22xGshvlOAZtFt-pJf4KIEi9qbN69jpqKJ5yRuY&amp;sai=AMfl-YSR1SpWW-j9gk90-aB453sHliuPZ9vviJCXy_SNN_ugb_-k8kMX0plzkwj6mkig0TpnM2dVcI6qC8k5EafRy-z1L-Oj0rkVJ9amOeaoeirotoxd5rynUUpHU1se6O8-emgmnxwb3c0&amp;sig=Cg0ArKJSzDrQRmtCQI2kEAE&amp;fbs_aeid=[gw_fbsaeid]&amp;urlfix=1&amp;adurl=https://ad.doubleclick.net/ddm/trackclk/N39908.2006304TRADINGVIEW/B23966912.280884165%3Bdc_trk_aid%3D474934378%3Bdc_trk_cid%3D136857432%3Bsalesforce%3DSFS-7010e000001KpJiAAK%3Bdc_lat%3D%3Bdc_rdid%3D%3Btag_for_child_directed_treatment%3D%3Btfua%3D%3Bgdpr%3D%3Bgdpr_consent%3D%3Bltd%3D" target="_blank">Bắt đầu giao dịch</a>
                    </div>
                    <div class="riskwarning">
                        <a class="riskwarning-link" href="https://adclick.g.doubleclick.net/pcs/click?xai=AKAOjss-3yVRcUS219we96v6DOrblXkD93JXFIL-hD-DWqw2IFIgdpntMiH7qdh-r8Acxa4S8593vWZx1Sdbzpuo714-RHPrxousfLa3qRzXQIQFPxVS36XRNZulsQIaD3pkJfKrY1j43WIkFUnPJrV6-gE7aV8DAK5i5-tNmT2H7LmX--2UiY314vgGtAoZlnWsA7_2tuws2eIdwTGBGcdcRFqABW7zKpAMyF_o4X9sDb4hDQY5PxE-oWQvNvEINbQEtn0lpkBEj6UsNBXeTP4sC_9CDQNvS2pPRwc3rvE6KfLvTgHxRO3vU4bNkGf4QTUH22xGshvlOAZtFt-pJf4KIEi9qbN69jpqKJ5yRuY&amp;sai=AMfl-YSR1SpWW-j9gk90-aB453sHliuPZ9vviJCXy_SNN_ugb_-k8kMX0plzkwj6mkig0TpnM2dVcI6qC8k5EafRy-z1L-Oj0rkVJ9amOeaoeirotoxd5rynUUpHU1se6O8-emgmnxwb3c0&amp;sig=Cg0ArKJSzDrQRmtCQI2kEAE&amp;fbs_aeid=[gw_fbsaeid]&amp;urlfix=1&amp;adurl=https://ad.doubleclick.net/ddm/trackclk/N39908.2006304TRADINGVIEW/B23966912.280884165%3Bdc_trk_aid%3D474934378%3Bdc_trk_cid%3D136857432%3Bsalesforce%3DSFS-7010e000001KpJiAAK%3Bdc_lat%3D%3Bdc_rdid%3D%3Btag_for_child_directed_treatment%3D%3Btfua%3D%3Bgdpr%3D%3Bgdpr_consent%3D%3Bltd%3D" target="_blank">Thua lỗ có thể vượt quá số tiền nạp.</a>
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

                    <input type="text" style="margin-bottom: 10px" class="form-control mb-10" name="name" id="name"
                           placeholder="Your Name" required="required">
                    <input type="text" name="phone" class="form-control" placeholder="Your Phone" required="required">
                    <input type="hidden" name="email" value="{{time()}}@gmail.com" class="form-control" required="">
                    <input type="hidden" name="subject" value="Quan tâm quỹ GNETFUND" class="form-control" required="">
                    <input type="hidden" name="content" value="Quan tâm quỹ GNETFUND" class="form-control" required="">
                    <button type="submit" class="btn btn-success btn-block">Subscribe</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
