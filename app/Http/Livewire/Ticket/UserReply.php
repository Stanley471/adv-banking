<?php

namespace App\Http\Livewire\Ticket;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Jobs\SendEmail;
use App\Models\Reply;

class UserReply extends Component
{
    use WithFileUploads;
    public $user;
    public $message;
    public $files = [];
    public $filePaths = [];
    public $val;
    public $settings;

    public function reply(){
        $this->validate([
            'message' => ['required', 'string', 'max:255'],
            'files.*' => 'nullable|mimes:jpg,jpeg,png,gif|max:1024',
        ]);

        foreach ($this->files as $file) {
            $path = $file->store('ticket');
            $this->filePaths[] = $path;
        }
        $filePathsString = implode(',', $this->filePaths);

        Reply::create([
            'reply' => $this->message,
            'ticket_id' => $this->val->id,
            'status' => 0,
            'user_id' => $this->user->id,
            'business_id' => $this->user->business_id,
            'files' => ($filePathsString != null) ? $filePathsString : null,
        ]);
        dispatch(new SendEmail($this->settings->support_email, $this->settings->site_name, 'Ticket Reply:' . $this->val->ticket_id, "New ticket reply request"));
        $this->reset(['message', 'files']);
        $this->emit('newChat');
    }

    public function render()
    {
        return view('livewire.ticket.user-reply');
    }
}
