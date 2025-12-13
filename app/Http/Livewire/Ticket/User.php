<?php

namespace App\Http\Livewire\Ticket;

use Livewire\Component;
use App\Models\Ticket;
use Livewire\WithFileUploads;
use App\Jobs\SendEmail;

class User extends Component
{
    use WithFileUploads;
    public $perPage = 100;
    public $user;
    public $settings;
    public $search = "";
    public $status = "";
    public $priority = "";
    public $orderBy = "created_at";
    public $subject;
    public $details;
    public $selectPriority = "low";
    public $files = [];
    public $filePaths = [];
    public $sortBy = "desc";
    private $ticket;

    public function loadMore()
    {
        $this->perPage = $this->perPage + $this->perPage;
        $this->emit('drawer');
    }

    public function addTicket()
    {
        $this->validate([
            'subject' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'selectPriority' => ['required', 'string'],
            'files.*' => 'nullable|mimes:jpg,jpeg,png,gif|max:1024',
        ]);

        foreach ($this->files as $file) {
            $path = $file->store('ticket');
            $this->filePaths[] = $path;
        }

        $filePathsString = implode(',', $this->filePaths);

        $ticket = Ticket::create([
            'user_id' => $this->user->id,
            'subject' => $this->subject,
            'priority' => $this->selectPriority,
            'message' => $this->details,
            'ticket_id' => randomNumber(16),
            'business_id' => $this->user->business_id,
            'files' => ($filePathsString != null) ? $filePathsString : null,
        ]);

        dispatch(new SendEmail($this->user->email, $this->user->first_name . ' ' . $this->user->last_name, 'New Ticket - ' . $ticket->ticket_id, "Thank you for contacting us, we will get back to you shortly, your Ticket ID is " . $ticket->ticket_id, null, null, 1));
        dispatch(new SendEmail($this->settings->support_email, $this->settings->site_name, 'New Ticket:' . $ticket->ticket_id, "New ticket request", null, null, 0));

        $this->reset(['subject', 'details', 'selectPriority', 'files']);
        $this->emit('closeDrawer');
        $this->emit('success', 'Ticket created');
    }

    public function render()
    {
        $this->ticket = Ticket::whereUserId($this->user->id)->whereBusinessId($this->user->business_id)
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->Where('subject', 'like', '%' . $this->search . '%')
                        ->orWhere('priority', 'like', '%' . $this->search . '%')
                        ->orWhere('ticket_id', 'like', '%' . $this->search . '%')
                        ->orWhere('message', 'like', '%' . $this->search . '%');
                });
            })
            ->when(($this->status != null), function ($query) {
                return $query->whereStatus($this->status);
            })
            ->when(($this->priority != null), function ($query) {
                return $query->wherepriority($this->priority);
            })
            ->orderby('status', 'desc')
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.ticket.user', ['ticket' => $this->ticket]);
    }
}
