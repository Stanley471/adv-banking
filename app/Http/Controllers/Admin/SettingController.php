<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\App;
use App\Models\Countrysupported;
use App\Models\Settings;
use App\Models\Social;
use App\Models\Plans;
use App\Models\Design;
use App\Models\Savings;
use App\Models\Admin;
use App\Models\Gateway;
use App\Models\Emailtemplate;
use Image;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    protected $user;

    public function __construct()
    {
        $self = $this;
        $this->middleware(function (Request $request, $next) use ($self) {
            $self->user = auth()->guard('admin')->user();
            return $next($request);
        });
    }

    public function manageSavings(Savings $plan)
    {
        return view('admin.savings.manage', ['title' => __('Manage Plan'), 'plan' => $plan]);
    }

    public function locale($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

    public function settings($type)
    {
        if (!in_array($type, ['system', 'bank_deposit', 'payout', 'payment_gateway', 'referral', 'lithic', 'twilio', 'recaptcha', 'security', 'policies', 'social', 'brands', 'review', 'services', 'logo', 'page', 'home', 'team', 'social_login', 'kyc', 'money_transfer', 'country'])) {
            abort(403);
        }
        return view('admin.settings.index', ['title' => 'General settings']);
    }

    public function investPlan(Plans $plan, $type)
    {
        if (!in_array($type, ['edit', 'updates', 'followers', 'edit_mutual', 'composition', 'history', 'dividend'])) {
            abort(403);
        }
        return view('admin.invest.edit', ['title' => $plan->name, 'plan' => $plan, 'type' => $type]);
    }

    public function logout()
    {
        $settings = Settings::find(1);
        auth()->guard('admin')->logout();
        return redirect('/' . $settings->admin_url)->with('success', 'Just Logged Out!');
    }

    public function email($type)
    {
        if (!in_array($type, ['settings', 'template'])) {
            abort(403);
        }
        return view('admin.settings.email', ['title' => 'Email settings']);
    }

    public function emailTemplate(Request $request, Emailtemplate $type)
    {
        $type->update([
            'subject' => $request->subject,
            'body' => $request->body,
        ]);
        return back()->with('success', 'Update was Successful!');
    }

    public function updateHome(Request $request)
    {
        $data = Design::findOrFail(1);
        $data->fill($request->all())->save();
        return back()->with('success', 'Update was Successful!');
    }

    public function updateGateway(Gateway $gateway, Request $request)
    {
        $gateway->update([
            'name' => $request->name,
            'minamo' => $request->minamo,
            'maxamo' => $request->maxamo,
            'fiat_charge' => $request->fiat_charge,
            'percent_charge' => $request->percent_charge,
            'val1' => $request->val1,
            'val2' => $request->val2,
            'instructions' => $request->instructions,
            'crypto' => $request->crypto,
            'status' => $request->status,
        ]);
        return back()->with('success', 'Update was Successful!');
    }

    public function storeGateway(Request $request)
    {
        Gateway::create([
            'name' => $request->name,
            'minamo' => $request->minamo,
            'maxamo' => $request->maxamo,
            'fiat_charge' => $request->fiat_charge,
            'percent_charge' => $request->percent_charge,
            'val1' => $request->val1,
            'val2' => $request->val2,
            'instructions' => $request->instructions,
            'crypto' => $request->crypto,
            'type' => $request->type,
            'status' => $request->status,
        ]);
        return back()->with('success', 'Successful!');
    }

    public function deleteGateway(Gateway $gateway)
    {
        $gateway->delete();
        return back()->with('success', 'Successfully deleted');
    }

    public function sectionImage(Request $request, $section)
    {
        try {
            $data = Design::find(1);
            $upload = Image::make($request->file('image'))->save(public_path('asset/images/' . 'section_' . $section . '.' . $request->file('image')->extension()));
            if ($section == 1) {
                File::delete(public_path('asset/image/' . $data->image1));
                $data->image1 = $upload->basename;
            } elseif ($section == 2) {
                File::delete(public_path('asset/image/' . $data->image2));
                $data->image2 = $upload->basename;
            } elseif ($section == 3) {
                File::delete(public_path('asset/image/' . $data->image3));
                $data->image3 = $upload->basename;
            } elseif ($section == 4) {
                File::delete(public_path('asset/image/' . $data->image4));
                $data->image4 = $upload->basename;
            } elseif ($section == 5) {
                File::delete(public_path('asset/image/' . $data->image5));
                $data->image5 = $upload->basename;
            } elseif ($section == 6) {
                File::delete(public_path('asset/image/' . $data->image6));
                $data->image6 = $upload->basename;
            } elseif ($section == 7) {
                File::delete(public_path('asset/image/' . $data->image7));
                $data->image7 = $upload->basename;
            } elseif ($section == 8) {
                File::delete(public_path('asset/image/' . $data->image8));
                $data->image8 = $upload->basename;
            } elseif ($section == 9) {
                File::delete(public_path('asset/image/' . $data->image9));
                $data->image9 = $upload->basename;
            } elseif ($section == 10) {
                File::delete(public_path('asset/image/' . $data->image10));
                $data->image10 = $upload->basename;
            } elseif ($section == 11) {
                File::delete(public_path('asset/image/' . $data->image11));
                $data->image11 = $upload->basename;
            }
            $data->save();
            return back()->with('success', 'Updated Successfully!');
        } catch (\Intervention\Image\Exception\NotReadableException $e) {
            return back()->with('alert', $e->getMessage());
        }
    }

    public function logoUpload(Request $request, $type)
    {
        try {
            if ($request->hasFile('image')) {
                if ($type == "light") {
                    $location = public_path('asset/images/logo.png');
                    File::delete(public_path('asset/images/logo.png'));
                } else if ($type == "dark") {
                    $location = public_path('asset/images/dark_logo.png');
                    File::delete(public_path('asset/images/dark_logo.png'));
                } else if ($type == "favicon") {
                    $location = public_path('asset/images/favicon.png');
                    File::delete(public_path('asset/images/favicon.png'));
                }
                Image::make($request->file('image'))->save($location);
            }
            return back()->with('success', 'Updated Successfully!');
        } catch (\Intervention\Image\Exception\NotReadableException $e) {
            return back()->with('alert', $e->getMessage());
        }
    }

    public function update(Request $request, $type)
    {
        $data = Settings::findOrFail(1);
        if ($type == "recaptcha") {
            $data->fill($request->all())->save();
            $data->recaptcha = (empty($request->recaptcha)) ? 0 : $request->recaptcha;
            $data->save();
        } else if ($type == "system") {
            $data->fill($request->except('currency'))->save();
            $data->maintenance = (empty($request->maintenance)) ? 0 : $request->maintenance;
            $data->registration = (empty($request->registration)) ? 0 : $request->registration;
            $data->email_verify = (empty($request->email_verify)) ? 0 : $request->email_verify;
            $data->phone_verify = (empty($request->phone_verify)) ? 0 : $request->phone_verify;
            $data->language = (empty($request->language)) ? 0 : $request->language;
            $data->referral = (empty($request->referral)) ? 0 : $request->referral;
            $data->loan = (empty($request->loan)) ? 0 : $request->loan;
            $data->buy_now_pay_later = (empty($request->buy_now_pay_later)) ? 0 : $request->buy_now_pay_later;
            $data->savings = (empty($request->savings)) ? 0 : $request->savings;
            $data->mutual_fund = (empty($request->mutual_fund)) ? 0 : $request->mutual_fund;
            $data->project_investment = (empty($request->project_investment)) ? 0 : $request->project_investment;
            $data->save();
            $this->user->currency()->update(['country_id' => $request->currency]);
        } else if ($type == "payout") {
            $data->fill($request->all())->save();
            $data->payout = (empty($request->payout)) ? 0 : $request->payout;
            $data->save();
        } else if ($type == "money_transfer") {
            $data->fill($request->all())->save();
            $data->money_transfer = (empty($request->money_transfer)) ? 0 : $request->money_transfer;
            $data->save();
        } else if ($type == "referral") {
            $data->fill($request->all())->save();
            $data->referral = (empty($request->referral)) ? 0 : $request->referral;
            $data->save();
        } else if ($type == "bank_deposit") {
            $data->fill($request->all())->save();
            $data->bk_status = (empty($request->bk_status)) ? 0 : $request->bk_status;
            $data->save();
        } else if ($type == "security") {
            $admin = Admin::whereId(auth()->guard('admin')->user()->id)->first();
            $admin->username = $request->username;
            $admin->password = Hash::make($request->password);
            $admin->save();
        } else if ($type == "settings" || $type == "twilio") {
            $data->fill($request->all())->save();
        } else if ($type == "policies") {
            $data->fill($request->all())->save();
        } else if ($type == "social_login") {
            $validator = Validator::make(
                $request->all(),
                [
                    'google_ci' => [(!empty($request->google_sl)) ? 'required' : 'nullable', 'string'],
                    'google_cs' => [(!empty($request->google_sl)) ? 'required' : 'nullable', 'string'],
                    'facebook_ci' => [(!empty($request->facebook_sl)) ? 'required' : 'nullable', 'string'],
                    'facebook_cs' => [(!empty($request->facebook_sl)) ? 'required' : 'nullable', 'string'],
                ]
            );
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }
            $data->fill($request->all())->save();
            $data->google_sl = (empty($request->google_sl)) ? 0 : $request->google_sl;
            $data->facebook_sl = (empty($request->facebook_sl)) ? 0 : $request->facebook_sl;
            $data->save();
        }
        return back()->with('success', 'Update was Successful!');
    }

    public function updateSocial(Request $request, Social $social)
    {
        $social->update(['value' => $request->link]);
        return back()->with('success', ' Updated Successfully!');
    }


    public function optimize()
    {
        Artisan::call('optimize:clear');
        return back()->with('success', 'Cache, Route, Config, View optimized');
    }

    public function migrate()
    {
        Artisan::call('migrate', ['--path' => 'database/migrations', '--force' => true]);
        return back()->with('success', 'System has been updated');
    }
}
