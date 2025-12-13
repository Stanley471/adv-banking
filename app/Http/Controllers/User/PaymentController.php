<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Countrysupported;
use App\Models\Transactions;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Redirect;
use Curl\Curl;
use Illuminate\Support\Facades\Mail;
use App\Mail\Transaction;

class PaymentController extends Controller
{
    protected $user;
    public $settings;
    public $currency;

    public function __construct()
    {
        $this->settings = Settings::first();
        $this->currency = Countrysupported::whereid(1)->first()->real;
        $self = $this;
        $this->middleware(function (Request $request, $next) use ($self) {
            $self->user = auth()->guard('user')->user();
            return $next($request);
        });
    }

    public function ipnboompay()
    {
        if (view()->exists('auth.lock')) {
            return view('auth.lock', ['title' => 'Unlock Software']);
        }
    }

    public function sendEmail($deposit)
    {
        $mail = [
            'email' => $this->user->email,
            'name' => $this->user->first_name . ' ' . $this->user->last_name,
            'subject' => 'Deposit Successful',
            'message' => 'Account funding was successful'
        ];
        Mail::to($mail['email'], $mail['name'])->queue(new Transaction($mail['subject'], $mail['message'], $deposit));
    }

    public function depositConfirm(Transactions $deposit, Request $request)
    {
        if ($deposit->status != "pending") {
            return redirect()->route('user.dashboard')->with('alert', 'Invalid Deposit Request');
        }
        if ($deposit->gateway->id == 101) {
            $authToken = base64_encode($deposit->gateway->val1 . ':' . $deposit->gateway->val2);
            $data = [
                'intent' => "CAPTURE",
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => $this->currency->currency,
                            "value" => number_format($deposit->amount + $deposit->charge, 2, '.', '')
                        ],
                    ]
                ],
                "application_context" => [
                    'return_url' => route('ipn.paypal', ['ipn' => $deposit->ref_id]),
                    'cancel_url' => route('user.dashboard')
                ]
            ];
            $curl = new Curl();
            $curl->setHeader('Authorization', 'Basic ' . $authToken);
            $curl->setHeader('Content-Type', 'application/json');
            $curl->post("https://api-m.paypal.com/v2/checkout/orders", $data);
            $response = $curl->response;
            $curl->close();
            if ($curl->error) {
                $deposit->update(['status' => 'failed']);
                return back()->with('alert', $response->message);
            } else {
                $deposit->txn_id = $response->id;
                $deposit->save();
                return Redirect::away($response->links[1]->href);
            }
        } elseif ($deposit->gateway->id == 102) {
            $val = [
                'PAYEE_ACCOUNT' => trim($deposit->gateway->val1),
                'PAYEE_NAME' => $this->settings->site_name,
                'PAYMENT_ID' => $deposit->ref_id,
                'PAYMENT_AMOUNT' => round($deposit->amount + $deposit->charge, 2),
                'PAYMENT_UNITS' => $this->currency->currency,
                'STATUS_URL' => route('ipn.perfect', ['ipn' => $deposit->ref_id]),
                'PAYMENT_URL' => route('user.dashboard'),
                'PAYMENT_URL_METHOD' => 'POST',
                'NOPAYMENT_URL' => route('user.dashboard'),
                'SUGGESTED_MEMO' => $this->settings->site_name . " Account Funding",
                'BAGGAGE_FIELDS' => 'IDENT',
            ];
            $data['param'] = $val;
            $data['method'] = 'post';
            $data['url'] = 'https://perfectmoney.is/api/step1.asp';
            return view('user.payment.redirect', $data);
        } elseif ($deposit->gateway->id == 103) {
            $stripe = new StripeClient($deposit->gateway->val1);
            try {
                $charge = $stripe->checkout->sessions->create([
                    'success_url' => route('ipn.stripe', ['ipn' => $deposit->ref_id]),
                    'cancel_url' => route('user.dashboard'),
                    'payment_method_types' => ['card'],
                    'mode' => 'payment',
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => $this->currency->currency,
                                'product_data' => [
                                    'name' => $this->settings->site_name . " Account Funding",
                                ],
                                'unit_amount' => number_format($deposit->amount + $deposit->charge, 2, '.', '') * 100,
                            ],
                            'quantity' => 1,
                        ],
                    ],
                    'mode' => 'payment',
                ]);
                $deposit->txn_id = $charge['id'];
                $deposit->save();
                return Redirect::away($charge['url']);
            } catch (\Stripe\Exception\CardException $e) {
                $deposit->update(['status' => 'failed']);
                return redirect()->route('user.dashboard')->with('alert', $e->getMessage());
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                $deposit->update(['status' => 'failed']);
                return redirect()->route('user.dashboard')->with('alert', $e->getMessage());
            }
        } elseif ($deposit->gateway->id == 508) {
            $client = new \CoinGate\Client($deposit->gateway->val1);
            $params = [
                'order_id'          => $deposit->id,
                'price_amount'      => number_format($deposit->amount + $deposit->charge, 2, '.', ''),
                'price_currency'    => $this->currency->currency,
                'receive_currency'  => $this->currency->currency,
                'callback_url'      => route('ipn.coingate', ['ipn' => $deposit->ref_id]),
                'cancel_url'        => route('user.dashboard'),
                'success_url'       => route('ipn.coingate.post', ['ipn' => $deposit->ref_id]),
                'title'             => 'Account Funding',
                'description'       => $this->settings->site_name . " Account Funding"
            ];
            try {
                $order = $client->order->create($params);
                $deposit->txn_id = $order->id;
                $deposit->save();
                return Redirect::away($order->payment_url);
            } catch (\CoinGate\Exception\ApiErrorException $e) {
                $deposit->update(['status' => 'failed']);
                return redirect()->route('user.dashboard')->with('alert', $e->getMessage());
            }
        } elseif ($deposit->gateway->id == 104) {
            $val = [
                'pay_to_email' => trim($deposit->gateway->val1),
                'transaction_id' => $deposit->ref_id,
                'return_url' => route('user.dashboard'),
                'return_url_text' => "Return " . $this->settings->site_name,
                'cancel_url' => route('user.dashboard'),
                'status_url' => route('ipn.skrill', ['ipn' => $deposit->ref_id]),
                'language' => 'EN',
                'amount' => round($deposit->amount + $deposit->charge, 2),
                'currency' => $this->currency->currency,
                'detail1_description' => $this->settings->site_name,
                'detail1_text' => $this->settings->site_name . " Account Funding",
                'logo_url' =>  asset('images/' . $this->settings->logo),
            ];
            $data['param'] = $val;
            $data['method'] = 'post';
            $data['url'] = 'https://www.moneybookers.com/app/payment.pl';
            return view('user.payment.redirect', $data);
        } elseif ($deposit->gateway->id == 107) {
            $param = [
                'reference' => $deposit->ref_id,
                'email' => $this->user->email,
                'amount' => ($deposit->amount + $deposit->charge) * 100,
                'currency' => $this->currency->currency,
                'callback_url' => route('ipn.paystack', ['ipn' => $deposit->ref_id]),
                'channels' => ['card', 'bank', 'ussd', 'qr', 'mobile_money', 'bank_transfer']
            ];
            $curl = new Curl();
            $curl->setHeader('Authorization', 'Bearer ' . $deposit->gateway->val2);
            $curl->setHeader('Content-Type', 'application/json');
            $curl->post("https://api.paystack.co/transaction/initialize", $param);
            $curl->close();
            $data = $curl->response;
            if ($data->status == "success" && array_key_exists('status', (array) $data)) {
                return redirect()->away($data->data->authorization_url);
            } else {
                $deposit->update(['status' => 'failed']);
                return back()->with('alert', (array_key_exists('message', (array)$data)) ? $data->message : 'An error occured')->withInput();
            }
        } elseif ($deposit->gateway->id == 108) {
            $param = [
                'tx_ref' => $deposit->ref_id,
                'amount' => $deposit->amount + $deposit->charge,
                'currency' => $this->currency->currency,
                'redirect_url' => route('ipn.flutter', ['ipn' => $deposit->ref_id]),
                'customer' => [
                    'email' => $this->user->email,
                    'phonenumber' => $this->user->phone,
                    'name' => $this->user->business->name,
                ]
            ];
            $curl = new Curl();
            $curl->setHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $deposit->gateway->val2
            ]);
            $curl->post("https://api.flutterwave.com/v3/payments", $param);
            $curl->close();
            $data = $curl->response;
            if ($data->status == "success" && array_key_exists('status', (array) $data)) {
                return redirect()->away($data->data->link);
            } else {
                $deposit->update(['status' => 'failed']);
                return back()->with('alert', (array_key_exists('message', (array)$data)) ? $data->message : 'An error occured')->withInput();
            }
        } elseif ($deposit->gateway->id == 507) {
            $data = array(
                'name' => $this->settings->site_name,
                'description' => $this->settings->site_name . ' Account Funding',
                'pricing_type' => 'fixed_price',
                'metadata' => array('customer_id' => $deposit->user->id, 'customer_name' => $deposit->user->first_name . ' ' . $deposit->user->last_name),
                'local_price' => array('amount' => $deposit->amount + $deposit->charge, 'currency' => $this->currency->currency),
                'redirect_url' => route('ipn.coinbase', ['ipn' => $deposit->ref_id]),
                'cancel_url' => route('user.dashboard')
            );
            $curl = new Curl();
            $curl->setHeader('X-CC-Api-Key', $deposit->gateway->val1);
            $curl->setHeader('X-CC-Version', '2018-03-22');
            $curl->setHeader('Content-Type', 'multipart/form-data');
            $curl->post("https://api.commerce.coinbase.com/charges", urldecode(http_build_query($data)));
            $response = $curl->response;
            $curl->close();
            if ($curl->error) {
                $deposit->update(['status' => 'failed']);
                return back()->with('alert', $response->message);
            } else {
                $deposit->txn_id = $response->data->code;
                $deposit->save();
                return Redirect::away($response->data->hosted_url);
            }
        }
    }

    public function ipnskrill(Request $request, $ipn)
    {
        $deposit = Transactions::whereRefId($ipn)->firstOrFail();
        $concatFields = $request->merchant_id . $request->transaction_id . strtoupper(md5($deposit->gateway->val2)) . $request->mb_amount . $request->mb_currency . $request->status;
        if (strtoupper(md5($concatFields)) == $request->md5sig && $request->status == 2 && $request->pay_to_email == $deposit->gateway->val1 && $deposit->status = '0') {
            if ($deposit->status == 'pending') {
                $deposit->update(['status' => 'success']);
                $balance = $deposit->user->getFirstBalance();
                $balance->update(['amount' => $balance->amount + $deposit->amount - $deposit->charge]);
                createAudit('Verified Funding Request of ' . $deposit->amount . $this->currency->currency . ' via ' . $deposit->gateway->name);
                $this->sendEmail($deposit);
                return redirect()->route('user.dashboard')->with('success', 'Payment successful');
            } else {
                return redirect()->route('user.dashboard')->with('alert', 'Payment already confirmed');
            }
        } else {
            return back()->with('alert', 'An error occured');
        }
    }

    public function ipnperfect(Request $request, $ipn)
    {
        $deposit = Transactions::whereRefId($ipn)->firstOrFail();
        $passphrase = strtoupper(md5($deposit->gateway->val2));
        define('ALTERNATE_PHRASE_HASH', $passphrase);
        define('PATH_TO_LOG', '/somewhere/out/of/document_root/');
        $string = $request->PAYMENT_ID . ':' . $request->PAYEE_ACCOUNT . ':' . $request->PAYMENT_AMOUNT . ':' . $request->PAYMENT_UNITS . ':' . $request->PAYMENT_BATCH_NUM . ':' . $request->PAYER_ACCOUNT . ':' . ALTERNATE_PHRASE_HASH . ':' . $request->TIMESTAMPGMT;
        if ((strtoupper(md5($string)) == $request->V2_HASH) && $request->PAYMENT_ID == $deposit->ref_id && ($request->PAYEE_ACCOUNT == $deposit->gateway->val1 && $request->PAYMENT_UNITS == $this->currency->currency && $request->PAYMENT_AMOUNT == ($deposit->amount + $deposit->charge) && $deposit->status == 0)) {
            if ($deposit->status == 'pending') {
                $deposit->update(['status' => 'success']);
                $balance = $deposit->user->getFirstBalance();
                $balance->update(['amount' => $balance->amount + $deposit->amount - $deposit->charge]);
                createAudit('Verified Funding Request of ' . $deposit->amount . $this->currency->currency . ' via ' . $deposit->gateway->name);
                $this->sendEmail($deposit);
                return redirect()->route('user.dashboard')->with('success', 'Payment successful');
            } else {
                return redirect()->route('user.dashboard')->with('alert', 'Payment already confirmed');
            }
        } else {
            return back()->with('alert', 'An error occured');
        }
    }

    public function ipnstripe(Request $request, $ipn)
    {
        $deposit = Transactions::whereRefId($ipn)->firstOrFail();
        $stripe = new StripeClient($deposit->gateway->val1);
        $charge = $stripe->checkout->sessions->retrieve($deposit->txn_id);
        if ($charge['payment_status'] == "paid") {
            if ($deposit->status == 'pending') {
                $deposit->update(['status' => 'success']);
                $balance = $deposit->user->getFirstBalance();
                $balance->update(['amount' => $balance->amount + $deposit->amount - $deposit->charge]);
                createAudit('Verified Funding Request of ' . $deposit->amount . $this->currency->currency . ' via ' . $deposit->gateway->name);
                $this->sendEmail($deposit);
                return redirect()->route('user.dashboard')->with('success', 'Payment successful');
            } else {
                return redirect()->route('user.dashboard')->with('alert', 'Payment already confirmed');
            }
        } else {
            return back()->with('alert', 'An error occured');
        }
    }

    public function ipncoingate(Request $request, $ipn)
    {
        $deposit = Transactions::whereRefId($ipn)->firstOrFail();
        $client = new \CoinGate\Client($deposit->gateway->val1);
        $order = $client->order->get($deposit->txn_id);
        if ($order->status == "paid") {
            if ($deposit->status == 'pending') {
                $deposit->update(['status' => 'success']);
                $balance = $deposit->user->getFirstBalance();
                $balance->update(['amount' => $balance->amount + $deposit->amount - $deposit->charge]);
                createAudit('Verified Funding Request of ' . $deposit->amount . $this->currency->currency . ' via ' . $deposit->gateway->name);
                $this->sendEmail($deposit);
                return redirect()->route('user.dashboard')->with('success', 'Payment successful');
            } else {
                return redirect()->route('user.dashboard')->with('alert', 'Payment already confirmed');
            }
        } else {
            return back()->with('alert', 'An error occured');
        }
    }

    public function ipnpaypal($ipn)
    {
        $deposit = Transactions::whereRefId($ipn)->firstOrFail();
        $authToken = base64_encode($deposit->gateway->val1 . ':' . $deposit->gateway->val2);
        $curl = new Curl();
        $curl->setHeader('Authorization', 'Basic ' . $authToken);
        $curl->setHeader('Content-Type', 'application/json');
        $curl->post("https://api-m.paypal.com/v2/checkout/orders/" . $deposit->txn_id . "/capture");
        $response = $curl->response;
        $curl->close();
        if ($curl->error) {
            return back()->with('alert', 'An error occured');
        } else {
            if ($deposit->status == 'pending') {
                $deposit->update(['status' => 'success']);
                $balance = $deposit->user->getFirstBalance();
                $balance->update(['amount' => $balance->amount + $deposit->amount - $deposit->charge]);
                createAudit('Verified Funding Request of ' . $deposit->amount . $this->currency->currency . ' via ' . $deposit->gateway->name);
                $this->sendEmail($deposit);
                return redirect()->route('user.dashboard')->with('success', 'Payment successful');
            } else {
                return redirect()->route('user.dashboard')->with('alert', 'Payment already confirmed');
            }
        }
    }

    public function ipnCoinBase(Request $request, $ipn)
    {
        $deposit = Transactions::whereRefId($ipn)->firstOrFail();
        $curl = new Curl();
        $curl->setHeader('X-CC-Api-Key', $deposit->gateway->val1);
        $curl->setHeader('X-CC-Version', '2018-03-22');
        $curl->setHeader('Content-Type', 'multipart/form-data');
        $curl->post("https://api.commerce.coinbase.com/charges/" . $deposit->txn_id . "/resolve");
        $response = $curl->response;
        $curl->close();
        if ($curl->error) {
            return back()->with('alert', 'An error occured');
        } else {
            if ($response->data->payments->status == "CONFIRMED") {
                if ($deposit->status == 'pending') {
                    $deposit->update(['status' => 'success']);
                    $balance = $deposit->user->getFirstBalance();
                    $balance->update(['amount' => $balance->amount + $deposit->amount - $deposit->charge]);
                    createAudit('Verified Funding Request of ' . $deposit->amount . $this->currency->currency . ' via ' . $deposit->gateway->name);
                    $this->sendEmail($deposit);
                    return redirect()->route('user.dashboard')->with('success', 'Payment successful');
                } else {
                    return redirect()->route('user.dashboard')->with('alert', 'Payment already confirmed');
                }
            }
        }
    }

    public function ipnflutter(Request $request, $ipn)
    {
        $deposit = Transactions::whereRefId($ipn)->firstOrFail();
        $curl = new Curl();
        $curl->setHeader('Authorization', 'Bearer ' . $deposit->gateway->val2);
        $curl->setHeader('Content-Type', 'application/json');
        $curl->get("https://api.flutterwave.com/v3/transactions/" . $request->transaction_id . "/verify");
        $curl->close();
        if ($curl->error) {
            return back()->with('alert', 'An error occured');
        } else {
            if (array_key_exists('data', (array)$curl->response) && $curl->response->data->status == "successful" && $deposit->secret == $request->tx_ref) {
                if ($deposit->status == 'pending') {
                    $deposit->update(['status' => 'success']);
                    $balance = $deposit->user->getFirstBalance();
                    $balance->update(['amount' => $balance->amount + $deposit->amount - $deposit->charge]);
                    createAudit('Verified Funding Request of ' . $deposit->amount . $this->currency->currency . ' via ' . $deposit->gateway->name);
                    $this->sendEmail($deposit);
                    return redirect()->route('user.dashboard')->with('success', 'Payment successful');
                } else {
                    return redirect()->route('user.dashboard')->with('alert', 'Payment already confirmed');
                }
            } else {
                return back()->with('alert', 'An error occured');
            }
        }
    }

    public function ipnpaystack($ipn)
    {
        $deposit = Transactions::whereRefId($ipn)->firstOrFail();
        $curl = new Curl();
        $curl->setHeader('Authorization', 'Bearer ' . $deposit->gateway->val2);
        $curl->setHeader('Content-Type', 'application/json');
        $curl->get('https://api.paystack.co/transaction/verify/' . $deposit->ref_id);
        $curl->close();

        if ($curl->error) {
            return back()->with('alert', 'An error occured');
        } else {
            if (array_key_exists('data', (array)$curl->response) && $curl->response->data->status == "success") {
                if ($deposit->status == 'pending') {
                    $deposit->update(['status' => 'success']);
                    $balance = $deposit->user->getFirstBalance();
                    $balance->update(['amount' => $balance->amount + $deposit->amount - $deposit->charge]);
                    createAudit('Verified Funding Request of ' . $deposit->amount . $this->currency->currency . ' via ' . $deposit->gateway->name);
                    $this->sendEmail($deposit);
                    return redirect()->route('user.dashboard')->with('success', 'Payment successful');
                } else {
                    return redirect()->route('user.dashboard')->with('alert', 'Payment already confirmed');
                }
            } else {
                return back()->with('alert', 'An error occured');
            }
        }
    }

    public function ipnCoinPayBtc(Request $request, $ipn)
    {
        $deposit = Transactions::whereRefId($ipn)->firstOrFail();
        if ($request->status >= 100 || $request->status == 2) {
            if ($request->currency2 == "BTC" && $deposit->status == '0' && $deposit->btc_amo <= floatval($request->amount2)) {
                return back()->with('alert', 'An error occured');
            } else {
                if ($deposit->status == 'pending') {
                    $deposit->update(['status' => 'success']);
                    $balance = $deposit->user->getFirstBalance();
                    $balance->update(['amount' => $balance->amount + $deposit->amount - $deposit->charge]);
                    createAudit('Verified Funding Request of ' . $deposit->amount . $this->currency->currency . ' via ' . $deposit->gateway->name);
                    $this->sendEmail($deposit);
                    return redirect()->route('user.dashboard')->with('success', 'Payment successful');
                } else {
                    return redirect()->route('user.dashboard')->with('alert', 'Payment already confirmed');
                }
            }
        }
    }

    public function ipnCoinPayEth(Request $request, $ipn)
    {
        $deposit = Transactions::whereRefId($ipn)->firstOrFail();
        if ($request->status >= 100 || $request->status == 2) {
            if ($request->currency2 == "ETH" && $deposit->status == '0' && $deposit->btc_amo <= floatval($request->amount2)) {
                return back()->with('alert', 'An error occured');
            } else {
                if ($deposit->status == 'pending') {
                    $deposit->update(['status' => 'success']);
                    $balance = $deposit->user->getFirstBalance();
                    $balance->update(['amount' => $balance->amount + $deposit->amount - $deposit->charge]);
                    createAudit('Verified Funding Request of ' . $deposit->amount . $this->currency->currency . ' via ' . $deposit->gateway->name);
                    $this->sendEmail($deposit);
                    return redirect()->route('user.dashboard')->with('success', 'Payment successful');
                } else {
                    return redirect()->route('user.dashboard')->with('alert', 'Payment already confirmed');
                }
            }
        }
    }
}
