<?php $__env->startSection('content'); ?>
<div class="toolbar" id="kt_toolbar">
  <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
    <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
      <h1 class="text-dark fw-bolder my-1 fs-2"><?php echo e(__('Dashboard')); ?></h1>
      <p class="fs-6 fw-bold text-gray-800 mb-10">Data refreshes every 10 minutes</p>
    </div>
    <div class="d-flex align-items-center flex-nowrap text-nowrap py-1 mb-6">
      <a href="<?php echo e(route('optimize.system')); ?>" class="btn btn-dark me-4"><i class="fal fa-bolt"></i> <?php echo e(__('Optimize system')); ?></a>
    </div>
  </div>
  <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
    <div class="container">
      <?php if($set->maintenance == 1): ?>
      <div class="alert alert-danger mb-6">
        <div class="d-flex flex-column">
          <span><?php echo e(__('Maintenance mode is turned on, users won\'t be able to create an account & login')); ?></span>
        </div>
      </div>
      <?php endif; ?>
      <div class="row g-6 g-xl-9">
        <div class="col-lg-6 col-xxl-4">
          <div class="card h-100">
            <div class="card-body p-9">
              <div class="row">
                <div class="col-md-8">
                  <div class="fs-2hx fw-boldest"><?php echo e(number_format_short_nc($admin->customers())); ?></div>
                  <div class="fs-6 fw-bold text-gray-800 mb-7">Total Users</div>
                </div>
                <div class="col-md-4 text-end">
                  <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-secondary btn-sm me-3">Users</a>
                </div>
              </div>
              <div class="d-flex flex-wrap">
                <div class="d-flex flex-center h-100px w-100px me-9 mb-5">
                  <canvas id="kt_user_list_chart"></canvas>
                </div>
                <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                  <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                    <div class="bullet bg-info me-3"></div>
                    <div class="text-gray-800">Active</div>
                    <div class="ms-auto fw-boldest text-dark"><?php echo e(number_format_short_nc($admin->customers('active'))); ?></div>
                  </div>
                  <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                    <div class="bullet bg-success me-3"></div>
                    <div class="text-gray-800">Blocked</div>
                    <div class="ms-auto fw-boldest text-dark"><?php echo e(number_format_short_nc($admin->customers('blocked'))); ?></div>
                  </div>
                  <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                    <div class="bullet bg-gray-300 me-3"></div>
                    <div class="text-gray-800">KYC Pending</div>
                    <div class="ms-auto fw-boldest text-dark"><?php echo e(number_format_short_nc($admin->customers('kyc'))); ?></div>
                  </div>
                  <div class="d-flex fs-6 fw-bold align-items-center">
                    <div class="bullet bg-danger me-3"></div>
                    <div class="text-gray-800">Deleted</div>
                    <div class="ms-auto fw-boldest text-dark"><?php echo e(number_format_short_nc($admin->customers('deleted'))); ?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xxl-4">
          <!--begin::Budget-->
          <div class="card h-100">
            <div class="card-body p-9">
              <div class="fs-2hx fw-boldest"><?php echo e(number_format_short($admin->userFunds()).' '.$currency->currency); ?></div>
              <div class="fs-6 fw-bold text-gray-800 mb-7">User Funds</div>
              <div class="fs-6 d-flex justify-content-between mb-4">
                <div class="fw-bold">Account</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userFunds('account')).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">Purchased Units</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userFunds('units')).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">Savings</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userFunds('savings')).' '.$currency->currency); ?>

                </div>
              </div>
            </div>
          </div>
          <!--end::Budget-->
        </div>
        <div class="col-lg-6 col-xxl-4">
          <div class="card h-100">
            <div class="card-body p-9">
              <div class="fs-2hx fw-boldest"><?php echo e(number_format_short($admin->contacts()->count())); ?></div>
              <div class="fs-6 fw-bold text-gray-800 mb-7">Total Contacts</div>
              <?php if($admin->contacts()->count() > 6): ?>
              <div class="symbol-group symbol-hover mb-9">
                <?php $__currentLoopData = $admin->contacts()->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?php echo e($contact->first_name.' '.$contact->last_name); ?>">
                  <span class="symbol-label bg-warning text-inverse-warning fw-boldest"><?php echo e(substr($contact->first_name, 0, 1)); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('admin.message', ['type' => 'contacts'])); ?>" class="symbol symbol-35px symbol-circle">
                  <span class="symbol-label bg-dark text-gray-300 fs-8 fw-boldest">+<?php echo e($admin->contacts()->count() - 6); ?></span>
                </a>
              </div>
              <?php endif; ?>
              <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                  <div class="bullet bg-info me-3"></div>
                  <div class="text-gray-800">Subscribed</div>
                  <div class="ms-auto fw-boldest text-dark"><?php echo e(number_format_short_nc($admin->contacts('subscribed')->count())); ?></div>
                </div>
                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                  <div class="bullet bg-success me-3"></div>
                  <div class="text-gray-800">Unsubscribed</div>
                  <div class="ms-auto fw-boldest text-dark"><?php echo e(number_format_short_nc($admin->contacts('unsubscribed')->count())); ?></div>
                </div>
                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                  <div class="bullet bg-gray-300 me-3"></div>
                  <div class="text-gray-800">Inbox</div>
                  <div class="ms-auto fw-boldest text-dark"><?php echo e(number_format_short_nc($admin->contacts('inbox')->count())); ?></div>
                </div>
                <div class="d-flex fs-6 fw-bold align-items-center">
                  <div class="bullet bg-danger me-3"></div>
                  <div class="text-gray-800">Open Tickets</div>
                  <div class="ms-auto fw-boldest text-dark"><?php echo e(number_format_short_nc($admin->contacts('open_tickets')->count())); ?></div>
                </div>
              </div>
              <div class="d-flex">
                <a href="<?php echo e(route('admin.message', ['type' => 'inbox'])); ?>" class="btn btn-info btn-sm me-3">Inbox</a>
                <a href="<?php echo e(route('admin.ticket', ['type' => 'open'])); ?>" class="btn btn-secondary btn-sm">Open Tickets</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <!--begin::Budget-->
          <div class="card h-100">
            <div class="card-body p-9">
              <div class="fs-2hx fw-boldest"><?php echo e(number_format_short($admin->savingsDeposit()[0]).' '.$currency->currency); ?></div>
              <div class="fs-6 fw-bold text-gray-800 mb-7">Savings Deposit</div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">Today (<?php echo e($admin->savingsDeposit('today')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->savingsDeposit('today')[0]).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">This Week (<?php echo e($admin->savingsDeposit('week')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->savingsDeposit('week')[0]).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">This Month (<?php echo e($admin->savingsDeposit('month')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->savingsDeposit('month')[0]).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">This Year (<?php echo e($admin->savingsDeposit('year')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->savingsDeposit('year')[0]).' '.$currency->currency); ?>

                </div>
              </div>
            </div>
          </div>
          <!--end::Budget-->
        </div>
        <div class="col-lg-4">
          <!--begin::Budget-->
          <div class="card h-100">
            <div class="card-body p-9">
              <div class="fs-2hx fw-boldest"><?php echo e(number_format_short($admin->loanProfit()[0]).' '.$currency->currency); ?></div>
              <div class="fs-6 fw-bold text-gray-800 mb-7">Loan Profit</div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">Today (<?php echo e($admin->loanProfit('today')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->loanProfit('today')[0]).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">This Week (<?php echo e($admin->loanProfit('week')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->loanProfit('week')[0]).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">This Month (<?php echo e($admin->loanProfit('month')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->loanProfit('month')[0]).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">This Year (<?php echo e($admin->loanProfit('year')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->loanProfit('year')[0]).' '.$currency->currency); ?>

                </div>
              </div>
            </div>
          </div>
          <!--end::Budget-->
        </div>
        <div class="col-lg-4">
          <div class="card h-100">
            <div class="card-body p-9">
              <div class="fs-2hx fw-boldest"><?php echo e(number_format_short($admin->userLoan()).' '.$currency->currency); ?></div>
              <div class="fs-6 fw-bold text-gray-800 mb-7">Loan Processed</div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">Paid Back</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userLoan('completed')).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">Active</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userLoan('active')).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">Defaulters</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userLoan('defaulters')).' '.$currency->currency); ?>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <!--begin::Budget-->
          <div class="card h-100">
            <div class="card-body p-9">
              <div class="fs-2hx fw-boldest"><?php echo e(number_format_short($admin->userCharges()[0]).' '.$currency->currency); ?></div>
              <div class="fs-6 fw-bold text-gray-800 mb-7">Charges</div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">Deposit (<?php echo e($admin->userCharges('deposit')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userCharges('deposit')[0]).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">Payout (<?php echo e($admin->userCharges('payout')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userCharges('payout')[0]).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">Unit Sale (<?php echo e($admin->userCharges('unit_sale')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userCharges('unit_sale')[0]).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">Purchased Units (<?php echo e($admin->userCharges('unit_purchase')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userCharges('unit_purchase')[0]).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">Today (<?php echo e($admin->userCharges(null, 'today')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userCharges(null, 'today')[0]).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">This Week (<?php echo e($admin->userCharges(null, 'week')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userCharges(null, 'week')[0]).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">This Month (<?php echo e($admin->userCharges(null, 'month')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userCharges(null, 'month')[0]).' '.$currency->currency); ?>

                </div>
              </div>
              <div class="separator separator-dashed"></div>
              <div class="fs-6 d-flex justify-content-between my-4">
                <div class="fw-bold">This Year (<?php echo e($admin->userCharges(null, 'year')[1]); ?>)</div>
                <div class="d-flex fw-boldest">
                  <?php echo e(number_format_short($admin->userCharges(null, 'year')[0]).' '.$currency->currency); ?>

                </div>
              </div>
            </div>
          </div>
          <!--end::Budget-->
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
  "use strict";
  var KTProjectList = {
    init: function() {
      !(function() {
        var t = document.getElementById("kt_user_list_chart");
        if (t) {
          var e = t.getContext("2d");
          new Chart(e, {
            type: "doughnut",
            data: {
              datasets: [{
                data: ["<?php echo e(number_format_short_nc($admin->customers('active'))); ?>", "<?php echo e(number_format_short_nc($admin->customers('blocked'))); ?>", "<?php echo e(number_format_short_nc($admin->customers('kyc'))); ?>", "<?php echo e(number_format_short_nc($admin->customers('deleted'))); ?>"],
                backgroundColor: ["#820cd7", "#50cd89", "#b5b5c3", "#f1416c"]
              }],
              labels: ["Active", "Blocked", "KYC Pending", "Deleted"]
            },
            options: {
              chart: {
                fontFamily: "inherit"
              },
              cutout: "75%",
              cutoutPercentage: 65,
              responsive: !0,
              maintainAspectRatio: !1,
              title: {
                display: !1
              },
              animation: {
                animateScale: !0,
                animateRotate: !0
              },
              tooltips: {
                enabled: !0,
                intersect: !1,
                mode: "nearest",
                bodySpacing: 5,
                yPadding: 10,
                xPadding: 10,
                caretPadding: 0,
                displayColors: !1,
                backgroundColor: "#20D489",
                titleFontColor: "#ffffff",
                cornerRadius: 4,
                footerSpacing: 0,
                titleSpacing: 0,
              },
              plugins: {
                legend: {
                  display: !1
                }
              },
            },
          });
        }
      })();
    },
  };
  KTUtil.onDOMContentLoaded(function() {
    KTProjectList.init();
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>