<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1"
          name="viewport"/>

    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family={{ urlencode(theme_option('primary_font', 'Roboto')) }}"
          rel="stylesheet" type="text/css">
    <!-- CSS Library-->

    <style>
        :root {
            --primary-color: {{ theme_option('primary_color', '#ff2b4a') }};
            --primary-font: '{{ theme_option('primary_font', 'Roboto') }}', sans-serif;
        }
    </style>

    {!! Theme::header() !!}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>
<body id="dark">
{!! apply_filters(THEME_FRONT_BODY, null) !!}

{!! Theme::content() !!}

{!! Theme::footer() !!}
<script>
    Highcharts.theme = {
        colors: ['#ff7200', '#26de81', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066',
            '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
        chart: {
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                stops: [
                    [0, '#131722'],
                    [1, '#131722']
                ]
            },
            style: {
                fontFamily: '\'Overpass\', sans-serif'
            },
            plotBorderColor: '#606063',
            height: 555
        },
        title: {
            style: {
                color: '#E0E0E3',
                textTransform: 'uppercase',
                fontSize: '20px'
            }
        },
        subtitle: {
            style: {
                color: '#E0E0E3',
                textTransform: 'uppercase'
            }
        },
        xAxis: {
            gridLineColor: '#707073',
            labels: {
                style: {
                    color: '#E0E0E3'
                }
            },
            lineColor: '#707073',
            minorGridLineColor: '#505053',
            tickColor: '#707073',
            title: {
                style: {
                    color: '#A0A0A3'
                }
            },
            reversed: false,
            maxPadding: 0.05,
            showLastLabel: true

        },
        yAxis: {
            gridLineColor: '#707073',
            labels: {
                style: {
                    color: '#E0E0E3'
                }
            },
            lineColor: '#707073',
            minorGridLineColor: '#505053',
            tickColor: '#707073',
            tickWidth: 1,
            title: {
                style: {
                    color: '#A0A0A3'
                }
            }
        },
        tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.85)',
            style: {
                color: '#F0F0F0'
            }
        },
        plotOptions: {
            series: {
                dataLabels: {
                    color: '#F0F0F3',
                    style: {
                        fontSize: '13px'
                    }
                },
                marker: {
                    lineColor: '#333'
                }
            },
            boxplot: {
                fillColor: '#505053'
            },
            candlestick: {
                lineColor: 'white'
            },
            errorbar: {
                color: 'white'
            }
        },
        legend: {
            backgroundColor: 'rgba(0, 0, 0, 0.5)',
            itemStyle: {
                color: '#E0E0E3'
            },
            itemHoverStyle: {
                color: '#FFF'
            },
            itemHiddenStyle: {
                color: '#606063'
            },
            title: {
                style: {
                    color: '#C0C0C0'
                }
            }
        },
        credits: {
            style: {
                color: '#666'
            }
        },
        labels: {
            style: {
                color: '#707073'
            }
        },
        drilldown: {
            activeAxisLabelStyle: {
                color: '#F0F0F3'
            },
            activeDataLabelStyle: {
                color: '#F0F0F3'
            }
        },
        navigation: {
            buttonOptions: {
                symbolStroke: '#DDDDDD',
                theme: {
                    fill: '#505053'
                }
            }
        },
        // scroll charts
        rangeSelector: {
            buttonTheme: {
                fill: '#505053',
                stroke: '#000000',
                style: {
                    color: '#CCC'
                },
                states: {
                    hover: {
                        fill: '#707073',
                        stroke: '#000000',
                        style: {
                            color: 'white'
                        }
                    },
                    select: {
                        fill: '#000003',
                        stroke: '#000000',
                        style: {
                            color: 'white'
                        }
                    }
                }
            },
            inputBoxBorderColor: '#505053',
            inputStyle: {
                backgroundColor: '#333',
                color: 'silver'
            },
            labelStyle: {
                color: 'silver'
            }
        },
        navigator: {
            handles: {
                backgroundColor: '#666',
                borderColor: '#AAA'
            },
            outlineColor: '#CCC',
            maskFill: 'rgba(255,255,255,0.1)',
            series: {
                color: '#7798BF',
                lineColor: '#A6C7ED'
            },
            xAxis: {
                gridLineColor: '#505053'
            }
        },
        scrollbar: {
            barBackgroundColor: '#808083',
            barBorderColor: '#808083',
            buttonArrowColor: '#CCC',
            buttonBackgroundColor: '#606063',
            buttonBorderColor: '#606063',
            rifleColor: '#FFF',
            trackBackgroundColor: '#404043',
            trackBorderColor: '#404043'
        }
    };

    Highcharts.setOptions(Highcharts.theme);

    Highcharts.chart('container', {

        title: {
            text: 'GAIN CHART'
        },

        subtitle: {
            text: 'Gain: {{ theme_option('won') }}'
        },

        yAxis: {
            title: {
                text: null
            },
            maxPadding: 0.05,
            showLastLabel: true
        },

        xAxis: {
            reversed: false,
            title: {
                enabled: true,
            },
            categories: ['2022-07-13',
                '2022-07-14',
                '2022-07-15',
                '2022-07-18',
                '2022-07-19',
                '2022-07-20',
                '2022-10-19',
                '2022-10-20',
                '2022-10-21',
                '2022-10-24',
                '2022-10-25',
                '2022-10-26',
                '2022-10-27',
                '2022-10-28',
                '2022-10-31',
                '2022-11-01',
                '2022-11-02',
                '2022-11-03',
                '2022-11-04',
                '2022-11-07',
                '2022-11-09',
                '2022-11-10',
                '2022-11-14',
                '2022-11-15',
                '2022-11-16',
                '2022-11-17',
                '2022-11-18'],
            maxPadding: 0.05,
            showLastLabel: true
        },

        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
            }
        },

        legend: {
            backgroundColor: 'rgba(0, 0, 0, 0.5)'
        },
        chart: {

        },
        series: [{
            name: 'Tiền vốn',
            data: [
                2010.16,
                2008.08,
                2007.32,
                2012.58,
                2016.98,
                -11.51,
                2010.41,
                2014.77,
                2016.46,
                2022.53,
                2027.21,
                2026.36,
                2120.78,
                2076.04,
                1.48,
                1990.46,
                2146.06,
                1592.42,
                2115.86,
                2007.76,
                8392.49,
                8793.86,
                11396.18,
                11711.43,
                11873.13,
                12546.51,
                12718.57]
        },
        {
            name: 'Balance',
            data: [
                2006.7,
                2006.7,
                2006.7,
                2009.02,
                2013,
                0,
                2010.41,
                2010.41,
                2010.41,
                2016.47,
                2021.84,
                2024.1,
                2072.44,
                2074.24,
                0,
                1989.16,
                2073.78,
                1833.1,
                1974.48,
                1991.12,
                8392.49,
                8392.49,
                11396.18,
                11553.81,
                11713.47,
                12631.62,
                12628.82]
        }
        ],


        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
</script>
</body>
</html>
