<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Business;
use App\Models\Ticket;
use App\Models\Contact;
use App\Models\Savings;
use App\Models\SentEmail;
use App\Models\LoanPlans;
use App\Models\Plans;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Sonata\GoogleAuthenticator\GoogleAuthenticator;
use Sonata\GoogleAuthenticator\GoogleQrUrl;
use App\Jobs\SendEmail;

class UserController extends Controller
{
    protected $user;
    protected $settings;

    public function checkTag(Request $request)
    {
        $user = (User::whereMerchantId($request->tag)->count() == 0) ? null : User::whereMerchantId($request->tag)->first();

        $response = collect(['st' => (!User::whereMerchantId($request->tag)->exists()) ? 1 : 2]);
        if (User::whereMerchantId($request->tag)->exists()) {
            $response = $response->merge([
                'user' => [
                    'country_id' => $user->country_id,
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                ],
                'business' => [
                    'name' => $user->business->name,
                ]
            ]);
        }
        return response()->json(
            $response->toArray()
        );
    }

    public function __construct()
    {
        $this->settings = Settings::find(1);
        $self = $this;
        $this->middleware(function (Request $request, $next) use ($self) {
            $self->user = auth()->guard('user')->user();
            return $next($request);
        });
    }

    public function planDetails(Plans $plan, $type)
    {
        if(!in_array($type, ['details', 'updates', 'followers', 'portfolio'])){
            abort(403);
        }
        return view('user.plan.details', ['title' => $plan->name, 'plan' => $plan, 'type' => $type]);
    }

    public function duoPlan(Savings $plan)
    {
        return view('auth.duo', ['title' => $plan->name, 'plan' => $plan]);
    }

    public function manageSavings(Savings $plan)
    {
        if(!in_array($this->user->id, [$plan->user_id, $plan->partner_id])){
            abort(403);
        }
        return view('user.savings.manage', ['title' => __('Manage Plan'), 'plan' => $plan]);
    }

    public function savingCircles($type = null)
    {
        return view('user.savings.circle', ['title' => __('Circles'), 'type' => $type]);
    }

    public function duoAction(Savings $plan, $type)
    {
        if(!in_array($type, ['accept', 'decline'])){
            abort(403);
        }
        if($type == 'accept'){
            dispatch(new SendEmail($plan->user->email, $plan->user->business->name, 'Invitation Accepted', $this->user->business->name . ' has accepted your invitation to join '.$plan->name.' saving plan', null, null, 0));
            $plan->update(['joined_status' => 'accepted']);
            return redirect()->route('user.followed', ['type' => 'savings'])->with('success', __('Invitation Accepted'));
        }else{
            dispatch(new SendEmail($plan->user->email, $plan->user->business->name, 'Invitation Declined', $this->user->business->name . ' has declined your invitation to join '.$plan->name.' saving plan', null, null, 0));
            $plan->update(['joined_status' => 'declined']);
            if(url()->previous() == route('duo.plan', ['plan' => $plan->ref_id])){
                return redirect()->route('user.dashboard')->with('success', __('Invitation Declined'));
            }else{
                return redirect()->route('user.followed', ['type' => 'savings'])->with('success', __('Invitation Declined'));
            }
        }
    }

    public function loanPlanDetails(LoanPlans $plan)
    {
        if($this->user->business->kyc_status != 'APPROVED'){
            return back()->with('alert', __('Complete KYC'));
        }
        if($this->user->business->loan_status != 'approved'){
            return back()->with('alert', __('Complete loan application'));
        }
        return view('user.loan.plan', ['title' => $plan->name, 'plan' => $plan]);
    }

    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

    public function checkBusiness(Request $request)
    {
        return response()->json(['st' => (Business::whereName($request->business_name)->whereAccountType('business')->count() == 0) ? 1 : 2]);
    }

    public function createPin(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'pin' => ['numeric', 'required', 'min_digits:4', 'max_digits:6'],
            ],
            [
                'pin.required' => __('Pin is required'),
                'pin.min_digits' => __('Minimum length of pin must be 4'),
                'pin.max_digits' => __('Maximum length of pin must be 6'),
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }
        $this->user->business->update(['pin' => Hash::make($request->pin)]);
        createAudit('Created Transfer Pin');
        return redirect()->route('user.dashboard')->with('success', 'Transfer Pin created successfully.');
    }

    public function reactivate($user)
    {
        $xx = User::withTrashed()->whereId($user)->first();
        User::whereId($xx->id)->restore();
        Business::whereId($xx->id)->restore();
        Ticket::whereId($xx->id)->restore();
        Contact::whereId($xx->id)->restore();
        SentEmail::whereId($xx->id)->restore();
        return redirect()->route('login')->with('success', 'Account restored');
    }
     
    public function profile($type)
    {
        if(!in_array($type, ['profile', 'bank', 'security', 'notifications', 'beneficiary'])){
            abort(403);
        }
        $g = new GoogleAuthenticator();
        $secret = $g->generateSecret();
        $image = GoogleQrUrl::generate($this->user->email, $secret, $this->settings->site_name);
        return view('user.profile.index', ['title' => 'Settings', 'type' => $type, 'secret' => $secret, 'image' => $image]);
    }

    public function logout()
    {
        if (Auth::guard('user')->check()) {
            $this->user->update(['fa_expiring' => Carbon::now()->subMinutes(30)]);
            Auth::guard('user')->logout();
            session()->flash('message', 'Just Logged Out!');
            return redirect()->route('login');
        } else {
            return redirect()->route('login');
        }
    }

}
