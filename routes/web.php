<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\User\PhoneController;
use App\Http\Controllers\User\OTPController;
use App\Http\Controllers\User\ComplianceController;
use App\Http\Controllers\User\EmailController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PaymentController;
use App\Models\Category;
use App\Models\Settings;
use App\Models\User;
use App\Models\Language;

Route::get('ipnboompay', [PaymentController::class, 'ipnboompay'])->name('ipn.boompay');

Route::controller(SettingController::class)->group(function () {
    Route::get('lang/{locale}', [SettingController::class, 'locale'])->name('lang');
    Route::get('optimize', 'optimize')->name('optimize.system');
    Route::get('migrate', 'migrate')->name('run.migration');
});

Route::controller(PaymentController::class)->group(function () {
    Route::get('ipncoinpaybtc/{ipn}', 'ipnCoinPayBtc')->name('ipn.coinPay.btc');
    Route::get('ipncoinpayeth/{ipn}', 'ipnCoinPayEth')->name('ipn.coinPay.eth');
    Route::get('ipncoinbase/{ipn}', 'ipnCoinBase')->name('ipn.coinbase');
    Route::get('ipnpaypal/{ipn}', 'ipnpaypal')->name('ipn.paypal');
    Route::get('ipnperfectv', 'ipnperfect')->name('ipn.perfect');
    Route::get('ipnstripe/{ipn}', 'ipnstripe')->name('ipn.stripe');
    Route::get('ipncoingate/{ipn}', 'ipncoingate')->name('ipn.coingate');
    Route::post('ipncoingatepost/{ipn}', 'ipncoingate')->name('ipn.coingate.post');
    Route::get('ipnskrill/{ipn}', 'ipnskrill')->name('ipn.skrill');
    Route::get('ipnflutter/{ipn}', 'ipnflutter')->name('ipn.flutter');
    Route::get('ipnpaystack/{ipn}', 'ipnpaystack')->name('ipn.paystack');
});

// Frontend routes
Route::get('unsubscribe/{contact}', [FrontendController::class, 'unsubscribe'])->name('unsubscribe');
Route::view('/', 'front.index')->name('home');
Route::get('pricing', [FrontendController::class, 'pricing'])->name('pricing');
Route::view('about', 'front.about', ['title' => 'About Us'])->name('about');
Route::view('terms', 'front.terms', ['title' => 'Terms & conditions'])->name('terms');
Route::view('privacy', 'front.privacy', ['title' => 'Privacy Policy'])->name('privacy');
Route::view('contact', 'front.contact', ['title' => 'Contact Us'])->name('contact');
Route::get('page/{page:slug}', [FrontendController::class, 'page'])->name('page');
Route::post('contact', [FrontendController::class, 'contactSubmit'])->name('contact-submit');

Route::group(['prefix' => 'help_center'], function () {
    Route::view('/', 'front.helpcenter.index', ['title' => 'Help Centre'])->name('help.center');
    Route::controller(FrontendController::class)->group(function () {
        Route::get('topic/{topic:slug}', 'helpcenterTopic')->name('help.topic');
        Route::get('article/{article:slug}', 'helpcenterArticle')->name('help.article');
        Route::post('search', 'searchHelpcenter')->name('help.search');
    });
});

Route::group(['prefix' => 'blog',], function () {
    Route::controller(FrontendController::class)->group(function () {
        Route::get('category/{category}/{slug}', 'blogCategory')->name('blog.category');
        Route::get('/', 'blog')->name('blog');
        Route::get('article/{article:slug}', 'blogArticle')->name('blog.article');
        Route::post('search', 'searchBlog')->name('blog.search');
    });
});

// User routes
Route::get('login', [LoginController::class, 'showLoginform'])->name('login');
Route::get('reactivate/{user}', [UserController::class, 'reactivate'])->name('reactivate');
Route::view('2fa', 'auth.2fa', ['title' => 'Unlock'])->name('2fa');
Route::controller(RegisterController::class)->group(function () {
    Route::get('callback-login/{type}', 'callbackLogin')->name('callback.login');
    Route::get('redirect-login/{type}', 'redirectLogin')->name('redirect.login');
});

Route::group(['prefix' => 'register'], function () {
    Route::post('submit', [RegisterController::class, 'submitregister'])->name('submitregister');
    Route::get('create_account/{referral?}', [RegisterController::class, 'index'])->name('register');
});

Route::group(['prefix' => 'user', 'middleware' => 'web'], function () {
    Route::group(['middleware' => 'auth:user'], function () {
        Route::group(['prefix' => 'duo_savings'], function () {
            Route::controller(UserController::class)->group(function () {
                Route::get('plan/{plan:ref_id}', 'duoPlan')->name('duo.plan');
                Route::get('action/{plan:ref_id}/{type}', 'duoAction')->name('duo.plan.action');
            });
        });
        Route::group(['prefix' => 'email'], function () {
            Route::controller(EmailController::class)->group(function () {
                Route::get('add', 'add')->name('user.add-email');
                Route::get('send-email', 'sendEmail')->name('user.send-email');
                Route::get('confirm-email/{verify}', 'confirmEmail')->name('user.confirm-email');
                Route::get('verify-email', 'verify')->name('user.verify-email');
            });
            Route::view('success-email', 'auth.email.success', ['title' => 'Verify email address'])->name('user.success-email');
        });

        Route::group(['prefix' => 'otp'], function () {
            Route::controller(OTPController::class)->group(function () {
                Route::get('verify', 'verify')->name('verify.otp');
                Route::get('resend', 'resend')->name('resend.otp');
                Route::post('confirm', 'confirm')->name('confirm.otp');
            });
        });

        Route::group(['prefix' => 'phone'], function () {
            Route::view('no', 'auth.phone.no', ['title' => 'Add phone number'])->name('user.no-phone');
            Route::controller(PhoneController::class)->group(function () {
                Route::get('add', 'add')->name('user.add-phone');
                Route::get('verify', 'add')->name('user.verify-phone');
                Route::get('edit', 'edit')->name('user.edit-phone');
                Route::get('resend', 'resend')->name('user.resend-phone');
                Route::post('confirm', 'confirm')->name('user.confirm-phone');
                Route::post('create', 'create')->name('user.create-phone');
                Route::post('update', 'update')->name('user.update-phone');
            });
        });

        Route::group(['prefix' => 'pin'], function () {
            Route::controller(UserController::class)->group(function () {
                Route::post('create', 'createPin')->name('create.pin');
            });
            Route::view('pin', 'auth.pin', ['title' => 'Setup Pin', 'previous' => null])->name('setup.pin');
        });

        Route::middleware(['NoPhone', 'Maintenance', 'Blocked', 'Email', 'Phone', 'OTP', 'Tfa', 'Localization'])->group(function () {
            Route::get('compliance/{type}', [ComplianceController::class, 'compliance'])->name('user.compliance');
            Route::post('submit-compliance/{type}', [ComplianceController::class, 'setup'])->name('compliance.setup');
            Route::post('image-upload/{cloud?}', [ComplianceController::class, 'kycImageUpload'])->name('kyc.image.upload');

            Route::group(['prefix' => 'profile'], function () {
                Route::get('index/{type}', [UserController::class, 'profile'])->name('user.profile');
            });

            Route::group(['prefix' => 'ticket'], function () {
                Route::view('all', 'user.support.index', ['title' => __('Support')])->name('user.ticket');
            });

            Route::group(['prefix' => 'plan'], function () {
                Route::view('index', 'user.plan.index', ['title' => __('Investment Plans')])->name('user.plan');
                Route::view('project/{type}', 'user.plan.projects', ['title' => __('Investment Plans')])->name('user.project');
                Route::view('mutual/{type}', 'user.plan.mutual', ['title' => __('Mutual funds')])->name('user.mutual');
                Route::get('details/{plan}/{type}', [UserController::class, 'planDetails'])->name('view.plan');
            });

            Route::group(['prefix' => 'loan'], function () {
                Route::view('index', 'user.loan.index', ['title' => __('Loan')])->name('user.loan');
                Route::get('plans/{plan}', [UserController::class, 'loanPlanDetails'])->name('user.loan.plan');
            });

            Route::group(['prefix' => 'market'], function () {
                Route::get('plans/{plan}', [UserController::class, 'loanPlanDetails'])->name('user.market.plan');
                Route::view('index', 'user.loan.market', ['title' => __('BNPL')])->name('user.market');
            });

            Route::group(['prefix' => 'savings'], function () {
                Route::view('index', 'user.savings.index', ['title' => __('Save')])->name('user.savings');
                Route::get('circle/{type?}', [UserController::class, 'savingCircles'])->name('saving.circles');
            });

            Route::get('deposit-confirm/{deposit:secret}', [PaymentController::class, 'depositConfirm'])->name('deposit.confirm');
            Route::view('transactions', 'user.transactions.index', ['title' => __('Transactions')])->name('user.transactions');
            Route::view('dashboard', 'user.dashboard.index', ['title' => __('Dashboard'), 'type' => 'balance'])->name('user.dashboard');
            Route::post('check-tag', [UserController::class, 'checkTag'])->name('tag.check');

            Route::group(['prefix' => 'portfolio'], function () {
                Route::view('dashboard', 'user.dashboard.index', ['title' => __('Portfolio'), 'type' => 'portfolio'])->name('user.porfolio');
                Route::get('followed/{type}', function ($type) {
                    if (in_array($type, ['project_investment', 'mutual_fund', 'loan', 'savings'])) {
                        return view('user.profile.portfolio', ['title' => __('Portfolio'), 'type' => $type]);
                    }
                    abort(403);
                })->name('user.followed');
                Route::get('manage/{plan}', [UserController::class, 'manageSavings'])->name('save.manage');
            });

            Route::view('referral', 'user.profile.referral', ['title' => __('Referral')])->name('user.referral');
        });
    });
    Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
});

Route::group(['prefix' => 'password'], function () {
    Route::get('reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('user.password.request');
    Route::post('email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('user.password.email');
    Route::get('reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('user.password.reset');
    Route::post('reset', [ResetPasswordController::class, 'reset']);
});

Route::controller(AdminController::class)->group(function () {
    Route::get(Settings::find(1)->admin_url, 'adminlogin')->name('admin.loginForm');
    Route::post(Settings::find(1)->admin_url, 'submitadminlogin')->name('admin.login');
    Route::post('admin-check', 'submitAdminCheck')->name('admin.check');
    Route::get('admin-reset', 'reset')->name('admin.reset');
    Route::get('admin-resetlink/{id}', 'resetLink')->name('admin.reset.link');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('logout', [SettingController::class, 'logout'])->name('admin.logout');
    Route::view('dashboard', 'admin.dashboard.index', ['title' => 'Dashboard'])->name('admin.dashboard');

    Route::controller(SettingController::class)->group(function () {
        Route::group(['middleware' => 'Admin:general_settings'], function () {
            Route::post('home-page', 'updateHome')->name('homepage.update');
            Route::post('section-image/{section}', 'sectionImage')->name('section.image');
            Route::get('settings/{type}', 'settings')->name('admin.settings');
            Route::post('settings/{type}', 'update')->name('admin.settings.update');

            Route::post('currency/{currency}', 'updateCurrency')->name('update.currency');
            Route::post('social/{social}', 'updateSocial')->name('social-links.update');
            Route::post('logo/{type}', 'logoUpload')->name('logo.upload');
        });
        Route::group(['middleware' => 'Admin:email_configuration'], function () {
            Route::get('email/{type}', 'email')->name('email.settings');
            Route::post('email-template/{type:type}', 'emailTemplate')->name('email.template.settings');
        });
    });

    Route::group(['middleware' => 'Admin:profile'], function () {
        Route::view('users', 'admin.user.index', ['title' => 'Users', 'type' => 'users'])->name('admin.users');
        Route::view('kyc', 'admin.user.index', ['title' => 'Pending KYC', 'type' => 'kyc'])->name('admin.kyc');
        Route::get('manage-user/{client}/{type}', function (User $client, $type) {
            if (in_array($type, ['details', 'audit', 'beneficiary', 'portfolio', 'ticket', 'sent-emails', 'transactions', 'loan', 'savings'])) {
                return view('admin.user.manage', ['title' => 'Manage User', 'client' => $client, 'type' => $type]);
            }
            abort(403);
        })->name('user.manage');
    });


    Route::group(['middleware' => 'Admin:support'], function () {
        Route::get('ticket/{type}', function ($type) {
            if (in_array($type, ['open', 'closed'])) {
                return view('admin.support.index', ['title' => 'Ticket', 'type' => $type]);
            }
            abort(403);
        })->name('admin.ticket');
    });

    Route::group(['middleware' => 'Admin:news'], function () {
        Route::get('blog/{type}', function ($type) {
            if (in_array($type, ['articles', 'category', 'draft', 'deleted'])) {
                return view('admin.blog.index', ['title' => 'Articles', 'type' => $type]);
            }
            abort(403);
        })->name('admin.blog');
    });

    Route::group(['middleware' => 'Admin:investment'], function () {
        Route::get('invest/{type}', function ($type) {
            if (in_array($type, ['project-plans', 'mutual-plans', 'category'])) {
                return view('admin.invest.index', ['title' => 'Invest', 'type' => $type]);
            }
            abort(403);
        })->name('admin.invest');
        Route::get('invest-plan/{plan}/{type}', [SettingController::class, 'investPlan'])->name('admin.invest.plan');
    });

    Route::group(['middleware' => 'Admin:savings'], function () {
        Route::get('save/{type}', function ($type) {
            if (in_array($type, ['regular', 'emergency', 'duo', 'circle', 'category'])) {
                return view('admin.savings.index', ['title' => 'Savings', 'type' => $type]);
            }
            abort(403);
        })->name('admin.save');
        Route::get('save-manage/{plan}', [SettingController::class, 'manageSavings'])->name('admin.save.manage');
    });

    Route::group(['middleware' => 'Admin:loan'], function () {
        Route::get('loan/{type}', function ($type) {
            if (in_array($type, ['bnplplans', 'loanplans', 'pending', 'active', 'completed', 'defaulters', 'category', 'shipping'])) {
                return view('admin.loan.index', ['title' => 'Loan', 'type' => $type]);
            }
            abort(403);
        })->name('admin.loan');
    });

    Route::group(['middleware' => 'Admin:message'], function () {
        Route::get('messages/{type}', function ($type) {
            if (in_array($type, ['inbox', 'sent', 'contacts', 'deleted'])) {
                return view('admin.message.index', ['title' => 'Messages', 'type' => $type]);
            }
            abort(403);
        })->name('admin.message');
    });

    Route::group(['middleware' => 'Admin:payout'], function () {
        Route::get('payout/{type}', function ($type) {
            if (in_array($type, ['pending', 'declined', 'success'])) {
                return view('admin.payout.index', ['title' => 'Payouts', 'type' => $type]);
            }
            abort(403);
        })->name('admin.payout');
    });

    Route::group(['middleware' => 'Admin:language'], function () {
        Route::group(['prefix' => 'language'], function () {
            Route::view('index', 'admin.language.index', ['title' => 'Language'])->name('admin.language');
            Route::get('edit/{lang}', function (Language $lang) {
                return view('admin.language.edit', ['title' => 'Languages', 'lang' => $lang]);
            })->name('admin.edit.language');
        });
    });

    Route::group(['middleware' => 'Admin:deposit'], function () {
        Route::get('deposit/{type}', function ($type) {
            if (in_array($type, ['pending', 'declined', 'success'])) {
                return view('admin.deposit.index', ['title' => 'Deposits', 'type' => $type]);
            }
            abort(403);
        })->name('admin.deposit');
        Route::group(['prefix' => 'gateway'], function () {
            Route::get('delete/{gateway}', [SettingController::class, 'deleteGateway'])->name('gateway.delete');
            Route::post('create', [SettingController::class, 'storeGateway'])->name('gateway.store');
            Route::post('update/{gateway}', [SettingController::class, 'updateGateway'])->name('gateway.update');
        });
    });

    Route::group(['prefix' => 'staff', 'middleware' => 'Admin'], function () {
        Route::view('staff', 'admin.staff.index', ['title' => 'Staffs'])->name('admin.staffs');
    });

    Route::group(['prefix' => 'help_center', 'middleware' => 'Admin:knowledge_base'], function () {
        Route::view('index', 'admin.helpcenter.index', ['title' => 'Help Center'])->name('faq.index');
        Route::get('articles/{topic}', function (Category $topic) {
            return view('admin.helpcenter.articles', ['title' => 'Articles', 'topic' => $topic]);
        })->name('topic.articles');
    });
});
