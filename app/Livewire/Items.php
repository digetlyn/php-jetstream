<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{   
    use WithPagination; //페이징 작업..

    public function render()
    {
        $items = Item::where('user_id',auth()->user()->id)->paginate(10);
        return view('livewire.items', compact('items'));  // compact() 여기에 ['items' => $items];  이렇게 넣어줘도 상관없다.
    }
}
