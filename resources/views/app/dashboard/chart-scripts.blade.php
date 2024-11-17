<script>
    /**
     * Dashboard Analytics
     */

    'use strict';

    (function() {
        let cardColor, headingColor, labelColor, shadeColor, grayColor;
        if (isDarkStyle) {
            cardColor = config.colors_dark.cardColor;
            labelColor = config.colors_dark.textMuted;
            headingColor = config.colors_dark.headingColor;
            shadeColor = 'dark';
            grayColor = '#5E6692'; // gray color is for stacked bar chart
        } else {
            cardColor = config.colors.cardColor;
            labelColor = config.colors.textMuted;
            headingColor = config.colors.headingColor;
            shadeColor = '';
            grayColor = '#817D8D';
        }

        // Revenue Generated Area Chart
        // --------------------------------------------------------------------
        const revenueGeneratedEl = document.querySelector('#revenueGenerated'),
            revenueGeneratedConfig = {
                chart: {
                    height: {{ $revenue > 0 ? 130 : 50 }},
                    type: 'area',
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                markers: {
                    colors: 'transparent',
                    strokeColors: 'transparent'
                },
                grid: {
                    show: false
                },
                colors: [config.colors.success],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: shadeColor,
                        shadeIntensity: 0.8,
                        opacityFrom: 0.6,
                        opacityTo: 0.1
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    data: [300, 350, 330, 380, 340, 400, 380]
                }],
                xaxis: {
                    show: true,
                    lines: {
                        show: false
                    },
                    labels: {
                        show: false
                    },
                    stroke: {
                        width: 0
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    stroke: {
                        width: 0
                    },
                    show: false
                },
                tooltip: {
                    enabled: false
                }
            };
        if (typeof revenueGeneratedEl !== undefined && revenueGeneratedEl !== null) {
            const revenueGenerated = new ApexCharts(revenueGeneratedEl, revenueGeneratedConfig);
            revenueGenerated.render();
        }
    })();

    /**
     * Charts Apex
     */

    (function() {
        let cardColor, headingColor, labelColor, borderColor, legendColor;

        if (isDarkStyle) {
            cardColor = config.colors_dark.cardColor;
            headingColor = config.colors_dark.headingColor;
            labelColor = config.colors_dark.textMuted;
            legendColor = config.colors_dark.bodyColor;
            borderColor = config.colors_dark.borderColor;
        } else {
            cardColor = config.colors.cardColor;
            headingColor = config.colors.headingColor;
            labelColor = config.colors.textMuted;
            legendColor = config.colors.bodyColor;
            borderColor = config.colors.borderColor;
        }

        // Color constant
        const chartColors = {
            column: {
                series1: '#826af9',
                series2: '#d2b0ff',
                bg: '#f8d3ff'
            },
            donut: {
                series1: '#ffcc00',
                series2: '#28C76F',
                series3: '#7367F0',
                series4: '#db0b0b',
                series5: '#28BD6C'
            },
            area: {
                series1: '#29dac7',
                series2: '#60f2ca',
                series3: '#a5f8cd'
            }
        };

        // Heat chart data generator
        function generateDataHeat(count, yrange) {
            let i = 0;
            let series = [];
            while (i < count) {
                let x = 'w' + (i + 1).toString();
                let y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

                series.push({
                    x: x,
                    y: y
                });
                i++;
            }
            return series;
        }

        // Order Chart
        // Donut Chart
        const donutChartOrderEl = document.querySelector('#donutChartOrder'),
            donutChartOrderConfig = {
                chart: {
                    height: 340,
                    type: 'donut'
                },
                labels: ['Pending', 'Completed', 'Cancelled'],
                series: [{!! $pendingOrders !!}, {!! $cancelledOrder !!}, {!! $paidOrder !!}],
                colors: [
                    chartColors.donut.series1,
                    chartColors.donut.series5,
                    chartColors.donut.series4,
                    chartColors.donut.series2
                ],
                stroke: {
                    show: false,
                    curve: 'straight'
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opt) {
                        return parseInt(val, 10) + '%';
                    }
                },
                legend: {
                    show: true,
                    position: 'bottom',
                    markers: {
                        offsetX: -3
                    },
                    itemMargin: {
                        vertical: 3,
                        horizontal: 10
                    },
                    labels: {
                        colors: legendColor,
                        useSeriesColors: false
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    fontSize: '2rem',
                                    fontFamily: 'Open Sans'
                                },
                                value: {
                                    fontSize: '1.2rem',
                                    color: legendColor,
                                    fontFamily: 'Open Sans',
                                    formatter: function(val) {
                                        return parseInt(val, 10) + '%';
                                    }
                                },
                                total: {
                                    show: true,
                                    fontSize: '1.5rem',
                                    color: headingColor,
                                    label: @if ($totalOrders > 0)
                                        'Orders'
                                    @else
                                        'No Orders'
                                    @endif ,
                                    formatter: function(w) {
                                        return
                                        @if ($totalOrders > 0)
                                            '100%'
                                        @else
                                            '0%'
                                        @endif ;
                                    }
                                }
                            }
                        }
                    }
                },
                responsive: [{
                        breakpoint: 992,
                        options: {
                            chart: {
                                height: 380
                            },
                            legend: {
                                position: 'bottom',
                                labels: {
                                    colors: legendColor,
                                    useSeriesColors: false
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 576,
                        options: {
                            chart: {
                                height: 320
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        labels: {
                                            show: true,
                                            name: {
                                                fontSize: '1.5rem'
                                            },
                                            value: {
                                                fontSize: '1rem'
                                            },
                                            total: {
                                                fontSize: '1.5rem'
                                            }
                                        }
                                    }
                                }
                            },
                            legend: {
                                position: 'bottom',
                                labels: {
                                    colors: legendColor,
                                    useSeriesColors: false
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 420,
                        options: {
                            chart: {
                                height: 280
                            },
                            legend: {
                                show: false
                            }
                        }
                    },
                    {
                        breakpoint: 360,
                        options: {
                            chart: {
                                height: 250
                            },
                            legend: {
                                show: false
                            }
                        }
                    }
                ]
            };
        if (typeof donutChartOrderEl !== undefined && donutChartOrderEl !== null) {
            const donutChart = new ApexCharts(donutChartOrderEl, donutChartOrderConfig);
            donutChart.render();
        }
        // --------------------------------------------------------------------

        // Vehicle Medaia Chart
        // Donut Chart
        const donutChartVehicleMediaEl = document.querySelector('#donutChartVehicleMedia'),
            donutChartConfigVehicleMedia = {
                chart: {
                    height: 340,
                    type: 'donut'
                },
                labels: ['Pending', 'Completed', 'Cancelled'],
                series: [
                    {!! $pendingEvents ?? 0 !!},
                    {!! $completedEvents ?? 0 !!},
                    {!! $cancelledEvents ?? 0 !!}
                ],
                colors: [
                    chartColors.donut.series1,
                    chartColors.donut.series5,
                    chartColors.donut.series4,
                    chartColors.donut.series3,
                ],
                stroke: {
                    show: false,
                    curve: 'straight'
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opt) {
                        return parseInt(val, 10) + '%';
                    }
                },
                legend: {
                    show: true,
                    position: 'bottom',
                    markers: {
                        offsetX: -3
                    },
                    itemMargin: {
                        vertical: 3,
                        horizontal: 10
                    },
                    labels: {
                        colors: legendColor,
                        useSeriesColors: false
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    fontSize: '2rem',
                                    fontFamily: 'Open Sans'
                                },
                                value: {
                                    fontSize: '1.2rem',
                                    color: legendColor,
                                    fontFamily: 'Open Sans',
                                    formatter: function(val) {
                                        return parseInt(val, 10) + '%';
                                    }
                                },
                                total: {
                                    show: true,
                                    fontSize: '1.5rem',
                                    color: headingColor,
                                    label: @if ($totalEvents > 0)
                                        'Events',
                                    @else
                                        'No Events',
                                    @endif
                                    formatter: function(w) {
                                        return
                                        @if ($totalEvents > 0)
                                            '100%'
                                        @else
                                            '0%'
                                        @endif ;
                                    }
                                }
                            }
                        }
                    }
                },
                responsive: [{
                        breakpoint: 992,
                        options: {
                            chart: {
                                height: 380
                            },
                            legend: {
                                position: 'bottom',
                                labels: {
                                    colors: legendColor,
                                    useSeriesColors: false
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 576,
                        options: {
                            chart: {
                                height: 320
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        labels: {
                                            show: true,
                                            name: {
                                                fontSize: '1.5rem'
                                            },
                                            value: {
                                                fontSize: '1rem'
                                            },
                                            total: {
                                                fontSize: '1.5rem'
                                            }
                                        }
                                    }
                                }
                            },
                            legend: {
                                position: 'bottom',
                                labels: {
                                    colors: legendColor,
                                    useSeriesColors: false
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 420,
                        options: {
                            chart: {
                                height: 280
                            },
                            legend: {
                                show: false
                            }
                        }
                    },
                    {
                        breakpoint: 360,
                        options: {
                            chart: {
                                height: 250
                            },
                            legend: {
                                show: false
                            }
                        }
                    }
                ]
            };
        if (typeof donutChartVehicleMediaEl !== undefined && donutChartVehicleMediaEl !== null) {
            const donutChart = new ApexCharts(donutChartVehicleMediaEl, donutChartConfigVehicleMedia);
            donutChart.render();
        }
        // --------------------------------------------------------------------


    })();
</script>
