<?php

use App\Models\Settings;
use App\Models\Countrysupported;
use App\Models\Design;
use App\Models\Services;
use App\Models\Brands;
use App\Models\Review;
use App\Models\Page;
use App\Models\Social;
use App\Models\Blog;
use App\Models\Audit;
use App\Models\LeaderShip;
use App\Models\Category;
use App\Models\Country;
use App\Models\Gateway;
use Carbon\Carbon;
use Curl\Curl;
use Illuminate\Support\Str;
use App\Models\HelpCenter;
use App\Models\Language;
use App\Models\CountryReg;
use App\Models\Plans;
use App\Models\LoanPlans;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

function validCountriesJson()
{
    foreach (CountryReg::whereStatus(1)->get() as $val) {
        $country[] = strtolower($val->real->iso2);
    }
    return json_encode($country);
}

function validCountries()
{
    return CountryReg::whereStatus(1)->get();
}

function currencyFormat($value)
{
    $set = Settings::first();
    if ($set->currency_format == 'normal') {
        return $value;
    } else {
        $number = str_replace('.', '|', $value);
        $number = str_replace(',', '.', $number);
        $number = str_replace('|', ',', $number);
        return $number;
    }
}

function sortPortfolio($type){
    $set = Settings::find(1);
    $permission = [
        'loan' => $set->loan,
        'savings' => $set->savings,
        'buy_now_pay_later' => $set->buy_now_pay_later,
        'mutual_fund' => $set->mutual_fund,
        'project_investment' => $set->project_investment,
    ];
    if($permission[$type] == 1){
        return route('user.followed', ['type' => $type]);
    }else{
        if($permission['loan'] == 1){
            $next = 'loan';
        }else if($permission['savings'] == 1){
            $next = 'savings';
        }else if($permission['buy_now_pay_later'] == 1){
            $next = 'buy_now_pay_later';
        }else if($permission['mutual_fund'] == 1){
            $next = 'mutual_fund';
        }else if($permission['project_investment'] == 1){
            $next = 'project_investment';
        }else{
            return redirect()->route('user.dashboard')->with('alert', __('Enable a financial service'));
        }
        return route('user.followed', ['type' => $next]);
    }
}

function getPlans($type)
{
    return Plans::whereStatus(1)->whereType($type)->get();
}

function getLoans($type)
{
    return LoanPlans::whereStatus(1)->whereType($type)->get();
}

function getProjects($type)
{
    if ($type == "active") {
        return Plans::whereStatus(1)->whereType('project')->where('start_date', '<=', Carbon::now()->toDateTimeLocalString())->where('expiring_date', '>', Carbon::now()->toDateTimeLocalString())->latest()->get();
    } else if ($type == "coming") {
        return Plans::whereStatus(1)->whereType('project')->where('start_date', '>', Carbon::now()->toDateTimeLocalString())->latest()->get();
    } else {
        return Plans::whereStatus(1)->whereType('project')->where('expiring_date', '<', Carbon::now()->toDateTimeLocalString())->latest()->get();
    }
}

function getMutual($type = null)
{
    $collection = collect(Plans::whereStatus(1)->whereType('mutual')->get())
        ->when($type != null, function ($query) {
            return $query->filter(function ($item) {
                return $item->recommendation == 1;
            });
        })
        ->filter(function ($item) {
            return $item->priceHistory->last()->date >= \Carbon\Carbon::today() && $item->fundComposition->count();
        });
    return $collection;
}

function getDefaultLang()
{
    $locale = session()->get('locale');
    if ($locale == null || $locale == 'en') {
        $locale = "us";
    }
    return Language::whereCode($locale)->first();
}

function getLang()
{
    return Language::wherestatus(0)->get();
}

function getGateways()
{
    return Gateway::whereStatus(1)->orderBy('name', 'ASC')->get();
}

function getAllCountry()
{
    return Country::orderBy('name', 'asc')->get();
}

function hasNamedRoute($name)
{
    $routes = app('router')->getRoutes();
    return $routes->hasNamedRoute($name);
}

function getHelpCenterTopics()
{
    return Category::whereType('faq')->orderby('name', 'asc')->get();
}

function getOtherPayout()
{
    return Category::whereType('withdraw')->orderby('name', 'asc')->get();
}

function getRegularSavings()
{
    return Category::whereType('regular')->orderby('duration', 'asc')->get();
}

function getSavingCircles()
{
    return Category::whereType('circle')->whereStatus(1)->orderby('interest', 'asc')->get();
}

function getCircleCategory()
{
    return Category::whereType('circle_category')->whereStatus(1)->orderby('name', 'asc')->get();
}

function getPopularHelpCenter($limit = null, $skip = null)
{
    return HelpCenter::orderby('views', 'desc')->take($limit)
        ->when(($skip != null), function ($query) use ($skip) {
            return $query->skip($skip);
        })->get();
}

function getPopularBlog($limit = null, $skip = null)
{
    return Blog::orderby('views', 'desc')->with(['category'])->whereStatus(1)->take($limit)->get();
}

function getRelatedBlog($limit = null, $cat = null, $article = null)
{
    return Blog::orderby('views', 'desc')->with(['category'])->whereStatus(1)->whereCatId($cat)->where('id', '!=', $article)->take($limit)->get();
}

function estimateReadingTime($text, $wpm = 200)
{
    $totalWords = str_word_count(strip_tags($text));
    $minutes = floor($totalWords / $wpm);
    $seconds = floor($totalWords % $wpm / ($wpm / 60));
    if ($minutes == 0) {
        return $seconds . ' seconds';
    }
    return $minutes . ' minutes';
}

function getLatestBlog($limit)
{
    return Blog::orderby('created_at', 'desc')->whereStatus(1)->paginate($limit);
}

function curlContent($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function getUi()
{
    return Design::first();
}

function notifyUser($subject, $text, $link = null, $button = null, $type = null)
{
    if ($type == "general") {
        $notification = new \MBarlow\Megaphone\Types\General(
            $subject,
            $text,
            $link,
            $button,
        );
    } else if ($type == "important") {
        $notification = new \MBarlow\Megaphone\Types\Important(
            $subject,
            $text,
            $link,
            $button,
        );
    } else if ($type == "newfeature") {
        $notification = new \MBarlow\Megaphone\Types\NewFeature(
            $subject,
            $text,
            $link,
            $button,
        );
    }
    return $notification;
}

function calculateFee($num, $type, $fiat = 0, $percent = 0)
{
    if ($type == 'both') {
        $result = ($num * $percent / 100) + $fiat;
    } else if ($type == 'fiat') {
        $result = $fiat;
    } else if ($type == 'percent') {
        $result = $num * $percent / 100;
    } else if ($type == 'min' && $num <= $fiat) {
        $result = $num * $percent / 100;
    } else if ($type == 'max' && $num > $fiat) {
        $result = $num * $percent / 100;
    } else {
        $result = '0.00';
    }
    return $result;
}

function removeCommas($numberString)
{
    $numberString = str_replace(",", "", $numberString); // remove commas
    $numberFloat = floatval($numberString); // convert to float
    return round($numberFloat, 2); // round to 2 decimal places
}

function createAudit($message, $user = null, $url = null)
{
    Audit::create([
        'user_id' => ($user == null) ? auth()->guard('user')->user()->id : $user->id,
        'business_id' => ($user == null) ? auth()->guard('user')->user()->business_id : $user->business_id,
        'trx' => Str::random(16),
        'log' => $message,
    ]);
    return;
}

function getBlog()
{
    return Blog::whereStatus(1)->orderBy('views', 'DESC')->limit(5)->get();
}

function getCat()
{
    return Category::whereType('blog')->get();
}

function getService()
{
    return Services::all();
}
function getBrands()
{
    return Brands::whereStatus(1)->get();
}
function getReview()
{
    return Review::whereStatus(1)->get();
}
function getSocial()
{
    return Social::all();
}
function getPage()
{
    return Page::whereStatus(1)->get();
}

function getTeam()
{
    return LeaderShip::whereStatus(1)->oldest()->get();
}


function randomNumber($length)
{
    $result = '';
    for ($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }
    return $result;
}

function getAcceptedCountry()
{
    $value = Cache::remember('getAcceptedCountry', 3600, function () {
        return Countrysupported::with(['real'])->orderby('country_id', 'asc')->get();
    });
    return $value;
}

function sub_check()
{
    $set = Settings::first();
    if (env('PURCHASECODE') == null) {
        session_start();
        $_SESSION["error"] = "no purchase code found";
        $url = route('ipn.boompay');
        header("Location: " . $url);
        exit();
    } else {
        if ($set->xperiod < Carbon::now()) {
            $purchase_code = trim(env('PURCHASECODE'));
            $domain = trim(env('DOMAIN'));
            $curl = new Curl();
            $curl->setHeader('Content-Type', 'application/json');
            $curl->setHeader('Accept', 'application/json');
            $curl->get('https://boomchart.io/api/verify-purchase/' . $purchase_code . '/' . $domain);
            $curl->close();
            $response = $curl->response;
            if ($response->status == "success") {
            } else {
                session_start();
                $_SESSION["error"] = $response->message;
                $url = route('ipn.boompay');
                header("Location: " . $url);
                exit();
            }
            $set->xperiod = Carbon::now()->add('10 minutes');
            $set->save();
        }
    }
}

function user_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function UR_exists($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($code == 200) {
        $status = true;
    } else {
        $status = false;
    }
    curl_close($ch);
    return $status;
}

function number_format_short($n, $precision = 1)
{
    if ($n < 900) {
        $n_format = currencyFormat(number_format($n, $precision));
        $suffix = '';
    } else if ($n < 900000) {
        $n_format = currencyFormat(number_format($n / 1000, $precision));
        $suffix = 'K';
    } else if ($n < 900000000) {
        $n_format = currencyFormat(number_format($n / 1000000, $precision));
        $suffix = 'M';
    } else if ($n < 900000000000) {
        $n_format = currencyFormat(number_format($n / 1000000000, $precision));
        $suffix = 'B';
    } else {
        $n_format = currencyFormat(number_format($n / 1000000000000, $precision));
        $suffix = 'T';
    }
    if ($precision > 0) {
        $dotzero = '.' . str_repeat('0', $precision);
        $n_format = str_replace($dotzero, '', $n_format);
    }
    return $n_format . $suffix;
}

function number_format_short_nc($n, $precision = 1)
{
    if ($n < 900) {
        $n_format = number_format($n, $precision);
        $suffix = '';
    } else if ($n < 900000) {
        $n_format = number_format($n / 1000, $precision);
        $suffix = 'K';
    } else if ($n < 900000000) {
        $n_format = number_format($n / 1000000, $precision);
        $suffix = 'M';
    } else if ($n < 900000000000) {
        $n_format = number_format($n / 1000000000, $precision);
        $suffix = 'B';
    } else {
        $n_format = number_format($n / 1000000000000, $precision);
        $suffix = 'T';
    }
    if ($precision > 0) {
        $dotzero = '.' . str_repeat('0', $precision);
        $n_format = str_replace($dotzero, '', $n_format);
    }
    return $n_format . $suffix;
}
