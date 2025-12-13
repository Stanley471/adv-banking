<?php

namespace App\Http\Livewire\Admin\Message;

use Livewire\Component;
use App\Jobs\SendEmail;
use App\Models\Contact;
use App\Models\SentEmail;

class Contacts extends Component
{
    private $contacts;
    public $perPage = 100;
    public $type;
    public $archive = [];
    public $all = false;
    public $admin;
    public $subject;
    public $message;
    public $search = "";
    public $orderBy = "created_at";
    public $subscribed = "";
    public $customer = "";
    public $count = 0;
    public $sortBy = "desc";

    protected $listeners = ['saved' => '$refresh', 'fileError' => 'attachement'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + 10;
        $this->emit('reload');
    }

    public function checked()
    {
        $collect = collect($this->archive)->filter(function ($key, $item) {
            return $key == true;
        });
        $this->emit('updatemarked', ($collect->count() > 0) ? 1 : 0);
        if (count($this->archive) > $collect->count()) {
            $this->all = false;
        }
    }

    public function setAll()
    {
        if ($this->all) {
            $contactIds = Contact::pluck('id')->toArray();
            $replacedArray = array_fill_keys($contactIds, true);
            $this->archive = $replacedArray;
            $this->checked();
        } else {
            $this->archive = [];
        }
    }

    public function deleteAll()
    {
        foreach ($this->archive as $archive => $key) {
            if ($key == true) {
                Contact::find($archive)->delete();
            }
        }
        $this->reset(['archive', 'all']);
        $this->emit('saved');
        $this->emit('success', 'Contacts deleted');
        $this->emit('clearMarkAll');
    }

    public function sendEmail()
    {
        $collect = collect($this->archive)->filter(function ($key, $item) {
            return $key == true;
        });
        if ($collect->count() > 0) {
            if($collect->count() > 1){
                if($this->admin->promo == 0){
                    $this->emit('alert', 'Permission denied');
                    return;
                }
            }
            foreach ($collect->toArray() as $archive => $key) {
                if ($key == true) {
                    $contact = Contact::find($archive);
                    SentEmail::create([
                        'subject' => $this->subject,
                        'message' => $this->message,
                        'contact_id' => $contact->id,
                        'admin_id' => $this->admin->id,
                    ]);
                    dispatch(new SendEmail($contact->email, $contact->first_name . ' ' . $contact->last_name, $this->subject, $this->message, null, $contact));
                }
            }
            $this->reset(['archive', 'all', 'subject', 'message']);
            $this->emit('success', 'Email added to queue');
            $this->emit('clearMarkAll');
            $this->emit('closeDrawer');
        } else {
            $this->emit('alert', 'Select a contact');
        }
    }

    public function render()
    {
        $this->contacts = Contact::when($this->search, function ($query) {
            $this->emit('reload');
            $query->where(function ($query) {
                $query->Where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('mobile', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->search == null, function ($query) {
            $this->emit('searchdrawer');
        })->when(($this->subscribed != null), function ($query) {
            return $query->whereSubscribed($this->subscribed);
        })->when(($this->customer != null), function ($query) {
            return ($this->customer == 1) ? $query->whereNotNull('user_id') : $query->whereNull('user_id');
        })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        $this->checked();
        return view('livewire.admin.message.contacts', [
            'contacts' => $this->contacts,
            'type' => $this->type
        ]);
    }
}
