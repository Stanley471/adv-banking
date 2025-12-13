<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Balance;
use App\Models\Business;
use App\Models\Contact;
use App\Models\Countrysupported;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Jobs\SendEmail;
use App\Jobs\CustomEmail;
use Illuminate\Validation\Rules\Password;
use App\Models\Devices;
use hisorange\BrowserDetect\Parser as Browser;
use Propaganistas\LaravelPhone\PhoneNumber;

class Index extends Component
{
    private $clients;
    public $settings;
    public $admin;
    public $type;
    public $kyc = "";
    public $status = "";
    public $email_verified = "";
    public $phone_verified = "";
    public $search = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;
    public $mobile; 
    public $mobile_code; 

    protected $listeners = ['saved' => '$refresh'];

    public function addUser(Request $request)
    {
        $rules = [
            'username' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|unique:users',
            'password' => ['required', Password::defaults()],
            'mobile' => 'required|phone:'.strtoupper($this->mobile_code),
        ];
        $this->validate($rules, [
            'phone.required' => 'Phone number is required',
            'phone.phone' => 'Invalid phone number',
        ]);

        $user = User::create([
            'merchant_id' => Str::random(6),
            'first_name' => ucwords(strtolower($this->first_name)),
            'last_name' => ucwords(strtolower($this->last_name)),
            'mobile_code' => strtoupper($this->mobile_code),
            'country_id' => Countrysupported::first()->id,
            'ip_address' => $request->ip(),
            'last_login' => Carbon::now(),
            'email_time' => Carbon::now(),
            'phone_time' => Carbon::now(),
            'phone' => PhoneNumber::make($this->mobile, strtoupper($this->mobile_code))->formatE164(),
            'email' => $this->email,
            'email_verify' => 0,
            'email_auth' => Str::random(30),
            'password' => Hash::make($this->password),
        ]);

        if ($this->username != null) {
            if (User::whereMerchantId($this->username)->exists() > 0) {
                $user->update([
                    'referral' => User::whereMerchantId($this->username)->first()->id,
                    'referred_date' => Carbon::now()
                ]);
            }
        }
        $contact = Contact::create([
            'user_id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'mobile' => $user->phone,
            'email' => $user->email,
        ]);
        $user->update(['contact_id' => $contact->id]);

        $business = Business::create([
            'user_id' => $user->id,
            'name' => $user->first_name . ' ' . $user->last_name,
            'reference' => randomNumber(7),
        ]);

        $user->update(['business_id' => $business->reference]);

        try {
            $mac = $this->macAddress();
            Devices::create(
                [
                    'user_id' => $user->id,
                    'business_id' => $user->business_id,
                    'userAgent' => Browser::userAgent(),
                    'deviceType' => Browser::deviceType(),
                    'browserName' => Browser::browserName(),
                    'platformName' => Browser::platformName(),
                    'deviceFamily' => Browser::deviceFamily(),
                    'browserFamily' => Browser::browserFamily(),
                    'browserVersion' => Browser::browserVersion(),
                    'platformFamily' => Browser::platformFamily(),
                    'platformVersion' => Browser::platformVersion(),
                    'deviceModel' => Browser::deviceModel(),
                    'mobileGrade' => Browser::mobileGrade(),
                    'ip_address' => user_ip(),
                    'mac_address' => $mac,
                ]
            );
        } catch (\Exception $e) {
            createAudit('Could not log Mac address', $user);
        }

        foreach (getAcceptedCountry() as $val) {
            Balance::create([
                'user_id' => $user->id,
                'country_id' => $val->id,
                'ref_id' => Str::uuid(),
                'business_id' => $business->reference,
                'main' => ($val->id == $user->country_id) ? 1 : 0,
                'short_code' => $val->real->currency,
            ]);
        }

        dispatch(new CustomEmail('welcome_message', $user->id));
        dispatch(new SendEmail($user->email, $user->business->name, 'We need to verify your email address', 'Thanks you for signing up to ' . $this->settings->site_name . '.<br> As part of our securtiy checks we need to verify your email address. Simply click on the link below and job done.<br><a href="' . route('user.confirm-email', ['verify' => $user->email_auth]) . '">' . route('user.confirm-email', ['verify' => $user->email_auth]) . '</a>', null, null, 0));
        $this->emit('saved');
        $this->reset(['first_name', 'last_name', 'username', 'email', 'mobile', 'password']);
        $this->emit('closeDrawer');
        $this->emit('success', 'User created');
    }

    public function block(User $user)
    {
        $user->update(['status' => 1]);
        $this->emit('success', __('User blocked'));
        $this->emitUp('saved');
    }

    public function unblock(User $user)
    {
        $user->update(['status' => 0]);
        $this->emit('success', __('User enabled'));
        $this->emitUp('saved');
    }

    public function render()
    {
        $this->clients = User::when($this->search, function ($query) {
            $query->where(function ($query) {
                $this->emit('drawer');
                $query->Where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%')
                    ->orWhereRelation('business', 'tag', 'like', '%' . $this->search . '%')
                    ->orWhereRelation('business', 'line_1', 'like', '%' . $this->search . '%')
                    ->orWhereRelation('business', 'line_2', 'like', '%' . $this->search . '%')
                    ->orWhereRelation('business', 'city', 'like', '%' . $this->search . '%')
                    ->orWhereRelation('business', 'postal_code', 'like', '%' . $this->search . '%');
            });
        })->when($this->search == null, function ($query) {
            $this->emit('searchdrawer');
        })
            ->when($this->status, function ($query) {
                return $query->whereStatus($this->status);
            })
            ->when($this->email_verified, function ($query) {
                return $query->whereEmailVerify($this->email_verified);
            })
            ->when($this->phone_verified, function ($query) {
                return $query->wherePhoneVerify($this->phone_verified);
            })
            ->when($this->kyc, function ($query) {
                return $query->whereRelation('business', 'kyc_status', '=', $this->kyc);
            })
            ->when($this->type == 'kyc', function ($query) {
                return $query->whereRelation('business', 'kyc_status', '=', 'PROCESSING')
                    ->orWhereHas('business', function ($query) {
                        $query->where('loan_status', '=', 'processing');
                    });
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.admin.users.index', ['clients' => $this->clients]);
    }
}
