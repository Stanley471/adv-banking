<?php

namespace App\Http\Livewire\Loan;

use Livewire\Component;
use App\Models\KycDoc;
use Propaganistas\LaravelPhone\PhoneNumber;
use App\Jobs\SendEmail;

class Guarantor extends Component
{
    public $user;
    private $kyc;
    public $g_first_name; 
    public $g_last_name; 
    public $g_email; 
    public $g_mobile; 
    public $g_mobile_code; 
    public $g_address; 
    public $g_doc_type; 
    public $g_doc_number; 
    public $settings; 

    public function mount(){
        $this->g_first_name = $this->user->business->g_first_name;
        $this->g_last_name = $this->user->business->g_last_name;
        $this->g_email = $this->user->business->g_email;
        $this->g_mobile = $this->user->business->g_mobile;
        $this->g_mobile_code = $this->user->business->g_mobile_code;
        $this->g_address = $this->user->business->g_address;
        $this->g_doc_type = $this->user->business->g_doc_type;
        $this->g_doc_number = $this->user->business->g_doc_number;
    }

    public function addGuarantor(){

        if($this->user->business->financial_statement == null || $this->user->business->g_doc_front == null || $this->user->business->g_doc_back == null || $this->user->business->g_proof_of_address == null){
            return $this->emit('added', __('Upload all documents'));
        }
        $this->validate([
            'g_first_name' => 'required|string|max:255',
            'g_last_name' => 'required|string|max:255',
            'g_email' => 'required|string|email:rfc,dns',
            'g_address' => 'required|string|max:255',
            'g_mobile_code' => 'required|string|max:255',
            'g_doc_type' => 'required|string|max:255',
            'g_doc_number' => 'required|string|max:255',
            'g_mobile' => 'required|phone:'.strtoupper($this->g_mobile_code),
        ], [
            'g_mobile.required' => 'Phone number is required',
            'g_mobile.phone' => 'Invalid phone number',
        ]);

        $this->user->business->update([
            'g_first_name' => ucwords(strtolower($this->g_first_name)),
            'g_last_name' => ucwords(strtolower($this->g_last_name)),
            'g_email' => $this->g_email,
            'g_address' => $this->g_address,
            'g_mobile' => PhoneNumber::make($this->g_mobile, strtoupper($this->g_mobile_code))->formatE164(),
            'g_mobile_code' => $this->g_mobile_code,
            'g_doc_number' => $this->g_doc_number,
            'g_doc_type' => $this->g_doc_type,
            'loan_status' => 'processing',
        ]);

        $this->emit('success', __('Guarantor submitted'));
        dispatch(new SendEmail($this->settings->email, 'Guarantor Review', 'New Guarantor Review request, ' . $this->user->business->name, $this->user->business->name . " Just submitted a new guarantor review request, please review it & process applicant", null, null, 0));
        createAudit('Submitted all details for guarantor review');
    }

    public function render()
    {
        $this->kyc = KycDoc::whereStatus(1)->get();
        return view('livewire.loan.guarantor', ['kyc' => $this->kyc]);
    }
}
