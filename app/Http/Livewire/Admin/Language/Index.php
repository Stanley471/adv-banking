<?php

namespace App\Http\Livewire\Admin\Language;

use Livewire\Component;
use App\Models\Language;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    private $language;
    public $name;

    protected $listeners = ['saved' => '$refresh'];

    public function block(Language $lang){
        $lang->update(['status' => 1]);
        $this->emit('success', __('Language blocked'));
    }
    
    public function unblock(Language $lang){
        $lang->update(['status' => 0]);
        $this->emit('success', __('Language unblocked'));
    }

    public function delete(Language $lang)
    {
        @unlink(resource_path('lang/' . $lang->code . '.json'));
        $lang->delete();
        return $this->emit('success', 'Language deleted');
    }

    public function addLanguage()
    {
        $this->validate([
            'name' => ['required', 'string'],
        ]);
        $lang = explode("*", $this->name);
        if (Language::wherecode($lang[0])->count() == 1) {
            return $this->emit('alert', 'Already Added');
        } else {
            $path = resource_path('lang/'.trim(strtolower($lang[0])) . '.json');
            File::put($path, file_get_contents(resource_path('lang/en.json')));
            Language::create(['name' => $lang[1], 'code' => $lang[0], 'status' => 0]);
            $this->reset(['name']);
            return $this->emit('closeDrawer');
            $this->emit('success', __('Language created'));
        }
    }

    public function render()
    {
        $this->language = Language::all();
        return view('livewire.admin.language.index', ['language' => $this->language]);
    }
}
