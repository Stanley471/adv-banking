<div>
    <div class="px-9 pt-6 rounded h-250px w-100 castro-secret2 bgi-no-repeat bgi-size-cover bgi-position-y-top rounded-5">
        <div class="d-flex flex-stack mt-6">
            <h3 class="m-0 text-white fw-bolder fs-3"><?php echo e(__('Save Money')); ?></h3>
        </div>
        <div class="d-flex align-items-center align-self-center flex-wrap pt-6">
            <div class="fw-bold fs-5 text-start text-white pt-5">
                <span class="fi fi-<?php echo e(strtolower($currency->iso2)); ?> mr-2 fis fs-1 rounded-4 text-white"></span> <?php echo e(__('Current Savings')); ?>

                <span class="fw-bolder fs-2hx d-block mt-n1 text-white">
                    <span id="main_balance">
                        <?php if($user->business->reveal_balance == 1): ?><?php echo e($currency->currency_symbol.currencyFormat(number_format($user->savedMoney('loan')->sum('amount'), 2)).' '.$currency->currency); ?> <?php else: ?> ************ <?php endif; ?>
                    </span>
                    <span class="ml-3 fs-3 cursor-pointer" wire:click="xBalance">
                        <i class="fal fa-eye-slash" id="hide_balance" <?php if($user->business->reveal_balance == 0): ?> style="display:none;" <?php endif; ?>></i>
                        <i class="fal fa-eye" id="reveal_balance" <?php if($user->business->reveal_balance == 1): ?> style="display:none;" <?php endif; ?>></i>
                    </span>
                </span>
            </div>
        </div>
    </div>
    <?php echo $__env->make('partials.savings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="mx-md-6 mx-4 mt-n20">
        <div class="row g-8 row-cols-1 row-cols-sm-2">
            <?php if($set->rss && getRegularSavings()): ?>
            <div class="col mb-3">
                <div class="text-start bg-white shadow-xs rounded-5 p-7 h-100 cursor-pointer" id="kt_regular_button">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-75px mt-1 mb-3">
                        <span class="symbol-label bg-light-info rounded-4">
                            <i class="fal fa-sync fa-3x text-info"></i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <p class="text-dark fw-boldest fs-3 mt-4 d-block"><?php echo e(__('Regular Savings')); ?></p>
                    <p class="text-dark"><?php echo e(__('Save money regularly in a locked plan for at least '.getRegularSavings()->first()->duration.' months..')); ?></p>
                    <p class="text-dark fw-bolder mb-0"><?php echo e(__('UP TO')); ?></p>
                    <p><span class="fs-1 fw-bold text-info"><?php echo e(getRegularSavings()->last()->interest); ?>%</span> <?php echo e(__('p.a')); ?></p>
                </div>
            </div>
            <?php endif; ?>
            <?php if($set->ess): ?>
            <div class="col mb-3">
                <div class="text-start bg-white shadow-xs rounded-5 p-7 h-100 cursor-pointer" id="kt_emergency_button">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-75px mt-1 mb-3">
                        <span class="symbol-label bg-light-info rounded-4">
                            <i class="fal fa-bell-on fa-3x text-info"></i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <p class="text-dark fw-boldest fs-3 mt-4 d-block"><?php echo e(__('Emergency Savings')); ?></p>
                    <p class="text-dark"><?php echo e(__('Save for emergencies and easily access your funds when the need arises.')); ?></p>
                    <p class="text-dark fw-bolder mb-0"><?php echo e(__('UP TO')); ?></p>
                    <p><span class="fs-1 fw-bold text-info"><?php echo e($set->egi); ?>%</span> <?php echo e(__('p.a if goal is reached')); ?></p>
                </div>
            </div>
            <?php endif; ?>
            <?php if($set->dss): ?>
            <div class="col mb-3">
                <div class="text-start bg-white shadow-xs rounded-5 p-7 h-100 cursor-pointer" id="kt_duo_button">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-75px mt-1 mb-3">
                        <span class="symbol-label bg-light-info rounded-4">
                            <i class="fal fa-heart-circle-check fa-3x text-info"></i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <p class="text-dark fw-boldest fs-3 mt-4 d-block"><?php echo e(__('Money Duo')); ?></p>
                    <p class="text-dark"><?php echo e(__('Create a savings plan together with your partner.')); ?></p>
                    <p class="text-dark fw-bolder mb-0"><?php echo e(__('UP TO')); ?></p>
                    <p><span class="fs-1 fw-bold text-info"><?php echo e($set->dsi); ?>%</span> <?php echo e(__('p.a if goal is reached')); ?></p>
                </div>
            </div>
            <?php endif; ?>
            <?php if(getSavingCircles()->count()): ?>
            <div class="col mb-3">
                <div class="text-start bg-white shadow-xs rounded-5 p-7 h-100 cursor-pointer" data-href="<?php echo e(route('saving.circles', ['type' => getCircleCategory()->first()->id])); ?>">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-75px mt-1 mb-3">
                        <span class="symbol-label bg-light-info rounded-4">
                            <i class="fal fa-users fa-3x text-info"></i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <p class="text-dark fw-boldest fs-3 mt-4 d-block"><?php echo e(__('Savings Circle')); ?></p>
                    <p class="text-dark"><?php echo e(__('Challenge yourself by saving with people who have the same goals as you.')); ?></p>
                    <p class="text-dark fw-bolder mb-0"><?php echo e(__('UP TO')); ?></p>
                    <p><span class="fs-1 fw-bold text-info"><?php echo e(getSavingCircles()->last()->interest); ?>%</span> <?php echo e(__('p.a')); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
    "use strict"
    $('#hide_balance').on('click', function() {
        $('#main_balance').text('************');
        $('#reveal_balance').show();
        $('#hide_balance').hide();
    });
    $('#reveal_balance').on('click', function() {
        $('#main_balance').text("<?php echo e(number_format($user->savedMoney('loan')->sum('amount') ,2).' '.$currency->currency); ?>");
        $('#hide_balance').show();
        $('#reveal_balance').hide();
    });

    "use strict";

    document.addEventListener('livewire:load', function() {

        var regularInput = $("#regular-amount");
        var emergencyInput = $("#emergency-amount");
        var goalInput = $("#emergency-goal");
        var duoInput = $("#duo-goal");

        regularInput.on("input", function() {
            checkAmountRegular(regularInput);
        });

        emergencyInput.on("input", function() {
            checkAmountEmergency(emergencyInput);
        });

        goalInput.on("input", function() {
            checkAmountGoal(goalInput);
        });

        duoInput.on("input", function() {
            checkAmountDuo(duoInput);
        });

        function logSelectedValueRegular() {
            var selectedValue = $('.rga:checked').val();
            $("#regular-amount").val(selectedValue);
            checkAmountRegular($("#regular-amount"));
        }

        logSelectedValueRegular();
        $('.rga').on('change', logSelectedValueRegular);

        function logSelectedValueEmergency() {
            var selectedValue = $('.ega:checked').val();
            $("#emergency-amount").val(selectedValue);
            checkAmountEmergency($("#emergency-amount"));
        }

        logSelectedValueEmergency();
        $('.ega').on('change', logSelectedValueEmergency);

        function checkAmountEmergency(amountInput) {
            if (amountInput.val().trim() == "") {
                amountInput.val(null);
            } else {
                var num = amountInput.val();
                var pre = parseFloat(convertToFloat(num));
                var formatted = formatNumber(amountInput.val());
                amountInput.val(formatted);
                window.livewire.find('<?php echo e($_instance->id); ?>').set('emergency_amount', formatted);

                var radioValues = [];

                $('.ega').each(function() {
                    radioValues.push($(this).val());
                });

                if (radioValues.indexOf(pre.toString()) === -1) {
                    $('.ega').prop('checked', false);
                }
            }
        }

        function checkAmountGoal(amountInput) {
            if (amountInput.val().trim() == "") {
                amountInput.val(null);
            } else {
                var num = amountInput.val();
                var pre = parseFloat(convertToFloat(num));
                var formatted = formatNumber(amountInput.val());
                amountInput.val(formatted);
                var currencySymbol = '<?php echo e($currency->currency_symbol); ?>';
                var currencyCode = '<?php echo e($currency->currency); ?>';
                var pre = parseFloat(convertToFloat($("#emergency-goal").val()));
                var emergency_return = parseFloat(pre + (pre * parseFloat('<?php echo e($set->egi); ?>') / 100));

                $('#emergency_interest').text('<?php echo e($set->egi); ?>');
                $('#emergency_return').text(currencySymbol + emergency_return.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
            }
        }

        function checkAmountDuo(amountInput) {
            if (amountInput.val().trim() == "") {
                amountInput.val(null);
            } else {
                var num = amountInput.val();
                var pre = parseFloat(convertToFloat(num));
                var formatted = formatNumber(amountInput.val());
                amountInput.val(formatted);
                var currencySymbol = '<?php echo e($currency->currency_symbol); ?>';
                var currencyCode = '<?php echo e($currency->currency); ?>';
                var pre = parseFloat(convertToFloat($("#duo-goal").val()));
                var duo_return = parseFloat(pre + (pre * parseFloat('<?php echo e($set->dsi); ?>') / 100));

                $('#duo_interest').text('<?php echo e($set->dsi); ?>');
                $('#duo_return').text(currencySymbol + duo_return.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
            }
        }

        function checkAmountRegular(amountInput) {
            if (amountInput.val().trim() == "") {
                amountInput.val(null);
            } else {
                var num = amountInput.val();
                var pre = parseFloat(convertToFloat(num));
                var formatted = formatNumber(amountInput.val());
                amountInput.val(formatted);
                window.livewire.find('<?php echo e($_instance->id); ?>').set('regular_amount', formatted);

                var radioValues = [];

                $('.rga').each(function() {
                    radioValues.push($(this).val());
                });

                if (radioValues.indexOf(pre.toString()) === -1) {
                    $('.rga').prop('checked', false);
                }
                regularDuration();
            }
        }

        function regularDuration() {
            var currencySymbol = '<?php echo e($currency->currency_symbol); ?>';
            var currencyCode = '<?php echo e($currency->currency); ?>';
            var pre = parseFloat(convertToFloat($("#regular-amount").val()));
            var plan = $('#regular_plan');
            var regular_return = parseFloat(pre + (pre * plan.find('option:selected').attr('data-interest') / 100));
            var regular_expiry = moment(moment()).add(plan.find('option:selected').attr('data-duration'), 'months').format('MMMM D, YYYY');

            $('#regular_interest').text(plan.find('option:selected').attr('data-interest'));
            $('#regular_return').text(currencySymbol + regular_return.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
            $('#regular_expiry').text(regular_expiry);
        }

        regularDuration();
        $('#regular_plan').change(regularDuration);


    });

    function checkTag() {
        var valName = $("#tag").val();
        if (valName.trim() != '') {
            var url = "<?php echo e(route('tag.check')); ?>";
            $.post(url, {
                tag: valName,
                "_token": "<?php echo e(csrf_token()); ?>"
            }, function(json) {
                if (json.st == 1) {
                    $("#message").show().text('Recipient doesn\'t exist');
                    $('#duo_button').attr('disabled', true);
                } else {
                    $("#recipient").text(json.user.first_name + ' ' + json.user.last_name);
                    $('#duo_button').attr('disabled', false);
                    $("#message").show().text('Recipient Exists');
                }
            }, 'json');
        }
    }
    $("#tag").keyup(checkTag);
    checkTag();
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/savings/index.blade.php ENDPATH**/ ?>