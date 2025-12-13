@extends('user.menu')
@section('content')
@if($plan->type == 'project')
@livewire('plans.project-details', ['user' => $user, 'plan' => $plan, 'type' => $type, 'settings' => $set])
@else
@livewire('plans.mutual-details', ['user' => $user, 'plan' => $plan, 'type' => $type, 'settings' => $set])
@endif
@stop
@section('script')
<script>
  "use strict"

  var currencySymbol = '{{$currency->currency_symbol}}';
  var currencyCode = '{{$currency->currency}}';
  var balance = parseFloat('{{$user->getFirstBalance()->amount}}');

  function buyUnits(amountInput) {
    if (amountInput.val().trim() == "") {
      amountInput.val(null);
    } else {
      var num = amountInput.val();
      var pre = parseFloat(convertToFloat(num)) * parseFloat("{{($plan->type == 'project') ? $plan->price : $plan->first()->amount}}");
      var formatted = formatNumber(amountInput.val());
      var waiver = '{{$user->getFirstBalance()->waivers}}';
      if (waiver != 0) {
        var fee = parseFloat(calculateFee(pre, '{{$plan->fee_type}}', 0, 0));
      } else {
        var fee = parseFloat(calculateFee(pre, '{{$plan->fee_type}}', '{{$plan->fiat_pc}}', '{{$plan->percent_pc}}'));
      }
      amountInput.val(formatted);
      $('#amount').text(currencySymbol + pre.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
      $('#fee').text(currencySymbol + fee.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
      if (parseFloat(fee + pre) <= balance) {
        $('#balanceAfter').text(currencySymbol + parseFloat(balance - fee - pre).toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
      } else {
        $('#balanceAfter').text('Insufficient Balance');
      }
    }
  }

  var payoutInput = $("#unit-amount");
  payoutInput.on("input", function() {
    buyUnits(payoutInput);
  });

  var sellInput = $("#sell-amount");
  sellInput.on("input", function() {
    sellUnits(sellInput);
  });
</script>

@if($plan->type == 'mutual')
<script>
  function sellUnits(amountInput) {
    if (amountInput.val().trim() == "") {
      amountInput.val(null);
    } else {
      var num = amountInput.val();
      var pre = parseFloat(convertToFloat(num)) * parseFloat("{{$plan->first()?->amount}}");
      var formatted = formatNumber(amountInput.val());
      var units = parseFloat("{{$user->followed($plan->id)->sum('units')}}");
      var fee = parseFloat(calculateFee(pre, 'percent', 0, '{{$plan->sale_percent}}'));
      amountInput.val(formatted);
      $('#amountSell').text(currencySymbol + pre.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
      $('#feeSell').text(currencySymbol + fee.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
      $('#balanceAfterSell').text(currencySymbol + parseFloat(balance - fee + pre).toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
      if (parseFloat(convertToFloat(num)) <= units) {
        $('#unitAfterSell').text(parseFloat(units - convertToFloat(num)));
      } else {
        $('#unitAfterSell').text('Insufficient Unit');
      }
    }
  }
</script>
@endif

@if($plan->type == 'project')
<script type="text/javascript">
  function portfolio() {
    var element = document.getElementById('kt_chart_earning');

    var height = parseInt(KTUtil.css(element, 'height'));
    var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
    var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
    var baseColor = KTUtil.getCssVariableValue('--bs-warning');
    var lightColor = 'transparent';

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Bought',
        data: [<?php foreach ($user->planUnits($plan->id) as $val) {
                  echo $val->units . ',';
                } ?>]
      }],
      chart: {
        fontFamily: 'inherit',
        type: 'area',
        height: height,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: true
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {

      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false,
        style: {
          fontSize: '12px',
          colors: ['#000']
        },
        formatter: function(val, opts) {
          return '+' + val + ' units'
        },
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 1,
        colors: [baseColor]
      },
      xaxis: {
        categories: [<?php foreach ($user->planUnits($plan->id) as $val) {
                        echo "'" . date("M j, Y h:i", strtotime($val->updated_at)) . "'" . ',';
                      } ?>],
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: '#000000',
            fontSize: '12px'
          }
        },
        crosshairs: {
          position: 'front',
          stroke: {
            color: baseColor,
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: false,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px'
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: labelColor,
            fontSize: '12px'
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px'
        },
        y: {
          formatter: function(val) {
            return val + ' units'
          }
        }
      },
      colors: [lightColor],
      grid: {
        borderColor: borderColor,
        strokeDashArray: 4,
        yaxis: {
          lines: {
            show: true
          }
        }
      },
      markers: {
        strokeColor: baseColor,
        strokeWidth: 3
      }
    };

    var chart = new ApexCharts(element, options);
    chart.render();
  }
  portfolio()

  window.livewire.on('chart', function() {
    portfolio()
  });
</script>
@endif
@endsection