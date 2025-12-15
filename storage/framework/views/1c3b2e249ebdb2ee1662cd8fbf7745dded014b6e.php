<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('balance', ['val' => $user->getFirstBalance()->getCurrency, 'user' => $user, 'settings' => $set, 'trx' => Str::random(16), 'type' => $type])->html();
} elseif ($_instance->childHasBeenRendered('pbztFfN')) {
    $componentId = $_instance->getRenderedChildComponentId('pbztFfN');
    $componentTag = $_instance->getRenderedChildComponentTagName('pbztFfN');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('pbztFfN');
} else {
    $response = \Livewire\Livewire::mount('balance', ['val' => $user->getFirstBalance()->getCurrency, 'user' => $user, 'settings' => $set, 'trx' => Str::random(16), 'type' => $type]);
    $html = $response->html();
    $_instance->logRenderedChild('pbztFfN', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
  "use strict"

  function withdrawType() {
    var withdraw_type = $("#withdraw_type").find(":selected").val();
    if (withdraw_type == "bank") {
      $("#bank_account").show();
      $("#other").hide();
      $('#pct').val('<?php echo e($set->pct); ?>');
      $('#fc').val('<?php echo e($set->fiat_pc); ?>');
      $('#pc').val('<?php echo e($set->percent_pc); ?>');
    } else if (withdraw_type == "other") {
      $("#bank_account").hide();
      $("#other").show();;
    }
  }
  $("#withdraw_type").change(withdrawType);
  withdrawType();

  function withdrawMethod() {
    var method = $("#changeMethod").find(":selected").val();
    if (method.trim() == "") {
      $('#pct').val('<?php echo e($set->pct); ?>');
      $('#fc').val('<?php echo e($set->fiat_pc); ?>');
      $('#pc').val('<?php echo e($set->percent_pc); ?>');
    } else {
      $('#pct').val('both');
      $('#fc').val($('#changeMethod').find('option:selected').attr('data-fc'));
      $('#pc').val($('#changeMethod').find('option:selected').attr('data-pc'));
      $("#requirements").show();
      $("#requirements").attr('placeholder', $('#changeMethod').find('option:selected').attr('data-requirements'));
      if ($("#payout-amount").val().trim() != "") {
        checkAmount($("#payout-amount"), 'payout');
      }
    }
  }
  $("#changeMethod").change(withdrawMethod);
  withdrawMethod();

  function checkAmount(amountInput, type = null) {
    var currencySymbol = '<?php echo e($currency->currency_symbol); ?>';
    var currencyCode = '<?php echo e($currency->currency); ?>';
    var balance = parseFloat('<?php echo e($user->getFirstBalance()->amount); ?>');
    var pct = $('#pct').val();
    var fc = $('#fc').val();
    var pc = $('#pc').val();
    if (amountInput.val().trim() == "") {
      amountInput.val(null);
    } else {
      var num = amountInput.val();
      var pre = parseFloat(convertToFloat(num));
      var formatted = formatNumber(amountInput.val());
      amountInput.val(formatted);
      if (type == 'payout') {
        var fee = parseFloat(calculateFee(pre, pct, fc, pc));
        $('#fee').text(currencySymbol + fee.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
        if (parseFloat(fee + pre) <= balance) {
          $('#balanceAfter').text(currencySymbol + parseFloat(balance - fee - pre).toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
        } else {
          $('#balanceAfter').text('Insufficient Balance');
        }
      } else {
        var fee = parseFloat(calculateFee(pre, '<?php echo e($set->tct); ?>', '<?php echo e($set->fiat_tc); ?>', '<?php echo e($set->percent_tc); ?>'));
        $('#feeBen').text(currencySymbol + fee.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
        if (parseFloat(fee + pre) <= balance) {
          $('#balanceAfterBen').text(currencySymbol + parseFloat(balance - fee - pre).toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
        } else {
          $('#balanceAfterBen').text('Insufficient Balance');
        }
      }
    }
  }

  var amountBankInput = $("#bank_amount");
  amountBankInput.on("input", function() {
    var num = $('#bank_amount').val();
    var pre = parseFloat(convertToFloat(num));
    var formatted = formatNumber(amountBankInput.val());
    $('#bank_amount').val(formatted);
  });

  var payoutInput = $("#payout-amount");
  payoutInput.on("input", function() {
    checkAmount(payoutInput, 'payout');
  });

  var benInput = $("#ben-amount");
  benInput.on("input", function() {
    checkAmount(benInput, 'ben');
  });

  window.livewire.on('closeModal', function() {
    $('#bank_deposit').modal('hide');
  });

  window.livewire.on('drawer', data => {
    KTDrawer.createInstances();
  });

  $('#ggglogin').on('click', function() {
    $(this).text('Please wait ...').attr('disabled', 'disabled');
    $('#payment-form').submit();
  });

  "use strict"
  $('#hide_balance').on('click', function() {
    $('#main_balance').text('************');
    $('#reveal_balance').show();
    $('#hide_balance').hide();
  });
  $('#reveal_balance').on('click', function() {
    $('#main_balance').text("<?php echo e(currencyFormat(number_format($user->getBalance($user->getFirstBalance()->getCurrency->id)->amount,2)).' '.$currency->currency); ?>");
    $('#hide_balance').show();
    $('#reveal_balance').hide();
  });
  "use strict";
  var KTGeneralDrawerDemos = {
    init: function() {}
  };
  KTUtil.onDOMContentLoaded(function() {
    KTGeneralDrawerDemos.init();
  });
</script>

<script type="text/javascript">
  function portfolio() {
    var element = document.getElementById('kt_chart_earning');

    var height = parseInt(KTUtil.css(element, 'height'));
    var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
    var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
    var baseColor = KTUtil.getCssVariableValue('--bs-info');
    var lightColor = 'transparent';

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Bought',
        data: [<?php foreach ($user->planUnits() as $val) {
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
        categories: [<?php foreach ($user->planUnits() as $val) {
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/user/dashboard/index.blade.php ENDPATH**/ ?>