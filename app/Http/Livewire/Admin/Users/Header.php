<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\SentEmail;
use App\Models\Ticket;
use App\Models\Followed;
use App\Models\LoanApplicants;
use App\Jobs\SendEmail;
use App\Jobs\DashNotify;

class Header extends Component
{
    private $beneficiary;
    private $sentMessage;
    private $tickets;
    private $portfolio;
    private $loan;
    public $client;
    public $type;
    public $subject;
    public $message;    
    public $dashboard_subject;
    public $dashboard_message;
    public $admin;

    protected $listeners = ['saved' => '$refresh'];

    public function sendEmail()
    {
        $contact = $this->client->contact;
        SentEmail::create([
            'subject' => $this->subject,
            'message' => $this->message,
            'contact_id' => $contact->id,
            'admin_id' => $this->admin->id,
        ]);
        dispatch(new SendEmail($contact->email, $contact->first_name . ' ' . $contact->last_name, $this->subject, $this->message, null, null, 0));
        $this->reset(['subject', 'message']);
        $this->emit('success', 'Email added to queue');
        $this->emit('closeDrawer');
    }

    public function sendNotify()
    {
        dispatch(new DashNotify($this->client, $this->dashboard_subject, strip_tags($this->dashboard_message)));
        $this->reset(['dashboard_subject', 'dashboard_message']);
        $this->emit('success', 'Notification added to queue');
        $this->emit('closeDrawer');
    }

    public function render()
    {
        $this->tickets = Ticket::whereUserId($this->client->id)->whereStatus(0)->count();
        $this->sentMessage = SentEmail::whereContactId($this->client->contact_id)->count();
        $this->portfolio = Followed::whereUserId($this->client->id)->count();
        $this->loan = LoanApplicants::whereUserId($this->client->id)->count();
        return view('livewire.admin.users.header', [
            'tickets' => $this->tickets,
            'sentMessage' => $this->sentMessage,
            'portfolio' => $this->portfolio,
            'loan' => $this->loan,
        ]);
    }
}
