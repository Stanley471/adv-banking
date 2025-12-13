<?php

namespace App\Http\Livewire\Admin\Review;

use Livewire\Component;
use App\Models\Review;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    private $reviews;
    public $search = "";
    public $category = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $admin;
    public $name;
    public $occupation;
    public $review;
    public $image;

    protected $listeners = ['saved' => '$refresh'];

    public function addReview()
    {

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'review' => ['required', 'string'],
            'image' => 'required|file|mimes:jpeg,png,jpg|max:1024',
        ]);

        $filePath = $this->image->storePublicly('review');

        Review::create([
            'name' =>  $this->name,
            'occupation' =>  $this->occupation,
            'review' =>  $this->review,
            'image' => $filePath,
        ]);
        $this->reset(['name', 'image', 'occupation', 'review']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Review Created');
    }

    public function disable(Review $review)
    {
        $review->update(['status' => 0]);
        $this->emit('success', __('Review disabled'));
        $this->emitUp('saved');
    }

    public function enable(Review $review)
    {
        $review->update(['status' => 1]);
        $this->emit('success', __('Review enabled'));
        $this->emitUp('saved');
    }

    public function render()
    {
        $this->reviews = Review::when($this->search, function ($query) {
            $this->emit('drawer');
            $query->where(function ($query) {
                $query->Where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('occupation', 'like', '%' . $this->search . '%')
                    ->orWhere('review', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->search == null, function ($query) {
            $this->emit('searchdrawer');
        })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);

        return view('livewire.admin.review.index', ['reviews' => $this->reviews]);
    }
}
