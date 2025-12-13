<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KycDoc;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Jobs\SendEmail;

class ComplianceController extends Controller
{
    protected $user;
    protected $settings;

    public function __construct()
    {
        $this->settings = Settings::find(1);
        $self = $this;
        $this->middleware(function (Request $request, $next) use ($self) {
            $self->user = auth()->guard('user')->user();
            return $next($request);
        });
    }

    public function examineImage($image = null)
    {
        $image = file_get_contents(storage_path('app/' . $image));

        $img = imagecreatefromstring($image);
        $width = imagesx($img);
        $height = imagesy($img);
        $sharpnessThreshold = 50;
        $gray = imagecreatetruecolor($width, $height);
        imagefilter($img, IMG_FILTER_GRAYSCALE);
        imagecopy($gray, $img, 0, 0, 0, 0, $width, $height);
        $laplacian = array(array(0, 1, 0), array(1, -4, 1), array(0, 1, 0));
        imageconvolution($gray, $laplacian, 1, 0);
        $sharpness = array_sum(array_map(function ($x) {
            return array_sum($x);
        }, [(array) imagecolorstotal($gray)])) / ($width * $height);
        if ($sharpness < $sharpnessThreshold) {
            $contrast = 0;
        }
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $color = imagecolorat($img, $x, $y);
                $red = ($color >> 16) & 0xFF;
                $green = ($color >> 8) & 0xFF;
                $blue = $color & 0xFF;
                $brightness = (0.2126 * $red) + (0.7152 * $green) + (0.0722 * $blue);
                if ($brightness < $sharpnessThreshold) {
                    $contrast = 0;
                } else {
                    $contrast = 1;
                }
            }
        }
        return $contrast;
    }

    public function compliance($type)
    {
        if (in_array($type, ['personal', 'physical', 'selfie'])) {
            if ($this->user->business->kyc_status == null || $this->user->business->kyc_status == "DECLINED" || $this->user->business->kyc_status == "PENDING" || $this->user->business->kyc_status == "RESUBMIT") {
                if ($type != 'personal' && $this->user->business->doc_number == null) {
                    return view('user.compliance.personal', ['title' => ucwords($type), 'kyc' => KycDoc::whereStatus(1)->get()]);
                } elseif ($type == "selfie" && ($this->user->business->doc_front == null || $this->user->business->doc_back == null)) {
                    return view('user.compliance.physical', ['title' => ucwords($type), 'kyc' => KycDoc::whereStatus(1)->get()]);
                } else {
                    return view('user.compliance.' . $type, ['title' => ucwords($type), 'kyc' => KycDoc::whereStatus(1)->get()]);
                }
            } elseif ($this->user->business->kyc_status == "PROCESSING") {
                return redirect()->route('user.dashboard')->with('alert', 'We are reviewing your compliance');
            } elseif ($this->user->business->kyc_status == "DECLINED") {
                return redirect()->route('user.dashboard')->with('alert', 'Compliance has been rejected');
            } else {
                return redirect()->route('user.dashboard')->with('alert', 'Compliance is already approved');
            }
        }
        abort(403);
    }

    public function kycImageUpload(Request $request, $cloud = null)
    {
        if ($request->hasFile('proof_of_address')) {
            $type = 'proof_of_address';
        } elseif ($request->hasFile('doc_front')) {
            $type = 'doc_front';
        } elseif ($request->hasFile('doc_back')) {
            $type = 'doc_back';
        } elseif ($request->hasFile('financial_statement')) {
            $type = 'financial_statement';
        } elseif ($request->hasFile('g_proof_of_address')) {
            $type = 'g_proof_of_address';
        } elseif ($request->hasFile('g_doc_front')) {
            $type = 'g_doc_front';
        } elseif ($request->hasFile('g_doc_back')) {
            $type = 'g_doc_back';
        }

        $image_path = $request->file($type)->storePublicly('kyc');
        if (in_array($request->file($type)->extension(), ['image/jpeg', 'image/png', 'image/jpg']) && $type != 'financial_statement') {
            if ($this->examineImage($image_path) == 0) {
                return response()->json(['error' => 'Image is not clear enough'], 400);
            }
        }

        if (in_array($request->file($type)->extension(), ['jpeg', 'png', 'jpg']) && $type != 'financial_statement') {
            $folder = uniqid() . '-' . now()->timestamp;
            if ($type == "doc_front") {
                $this->user->business->update(['doc_front' => $image_path]);
            } else if ($type == "doc_back") {
                $this->user->business->update(['doc_back' => $image_path]);
            } else if ($type == "proof_of_address") {
                $this->user->business->update(['proof_of_address' => $image_path]);
            } elseif ($type == "g_doc_front") {
                $this->user->business->update(['g_doc_front' => $image_path]);
            } else if ($type == "g_doc_back") {
                $this->user->business->update(['g_doc_back' => $image_path]);
            } else if ($type == "g_proof_of_address") {
                $this->user->business->update(['g_proof_of_address' => $image_path]);
            }
            return $folder;
        } elseif (in_array($request->file($type)->extension(), ['pdf']) && $type == 'financial_statement') {
            $folder = uniqid() . '-' . now()->timestamp;
            $this->user->business->update(['financial_statement' => $image_path]);
            return $folder;
        } else {
            return response()->json(['error' => 'Invalid file type'], 400);
        }
    }

    public function setup(Request $request, $type)
    {
        if ($type == 'personal') {
            $kycdoc = KycDoc::whereId($request->doc_type)->first();
            $validator = Validator::make($request->all(), [
                'b_month' => 'required',
                'b_day' => 'required',
                'b_year' => 'required',
                'source_of_funds' => 'required',
                'doc_type' => ['required'],
                'doc_number' => [
                    'required',
                    $kycdoc->type == 'text' ? 'string' : 'digits_between:' . $kycdoc->min . ',' . $kycdoc->max,
                    $kycdoc->type == 'text' ? 'min:'.$kycdoc->min : '',
                    $kycdoc->type == 'text' ? 'max:'.$kycdoc->max : '',
                ],
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'line_1' => ['required', 'max:255', 'string'],
                'line_2' => ['nullable', 'max:255', 'string'],
                'postal_code' => 'required|string|max:255|postal_code:'.$this->user->mobile_code,
            ], [
                'postal_code.postal_code' => 'Invalid postal code',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }

            $this->user->business->update([
                'b_day' => $request->b_day,
                'b_month' => $request->b_month,
                'b_year' => $request->b_year,
                'line_1' => $request->line_1,
                'line_2' => $request->line_2,
                'state' => explode('*', $request->state)[0],
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'source_of_funds' => $request->source_of_funds,
                'doc_type' => $request->doc_type,
                'doc_number' => $request->doc_number,
            ]);

            createAudit('Submited personal compliance details');
            return redirect()->route('user.compliance', ['type' => 'physical']);
        } elseif ($type == 'physical') {
            if ($this->user->business->doc_front == null || $this->user->business->doc_back == null || $this->user->business->proof_of_address == null) {
                return back()->with('alert', __('Upload all files'));
            }
            return redirect()->route('user.compliance', ['type' => 'selfie']);
        } elseif ($type == 'selfie') {
            $img = $request->image;
            $image_parts = explode(";base64,", $img);
            $image_base64 = base64_decode($image_parts[1]);
            $folderPath = "kyc/";
            $fileName = uniqid() . '.png';
            $file = $folderPath . $fileName;
            Storage::put($file, $image_base64);
            $this->user->business->update(['selfie' => $file, 'kyc_status' => "PROCESSING"]);
            dispatch(new SendEmail($this->settings->email, 'Compliance Team', 'New Compliance request, ' . $this->user->business->name, $this->user->business->name . " Just submitted a new compliance request, please review it & process applicant", null, null, 0));
            createAudit('Submitted all details for compliance review');
            return redirect()->route('user.dashboard')->with('success', __('We will get back to you.'));
        }
    }
}
