<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{   
    use WithPagination; //페이징 작업..

    public $active;
    public $q;

    public function render()
    {
        $items = Item::where('user_id',auth()->user()->id)
            ->when($this->q,function($query){
                return $query
                ->where('name','like', '%'. $this->q .'%')  // name like '%'query% 비슷
                ->orwhere('price','like', '%'. $this->q. '%');
            })


            ->when($this->active, function($query) {
           // return $query->where('status',1);
           return $query->active();
        });
     $query = $items->toSql();
     $items = $items->paginate(10);
        return view('livewire.items', compact('items','query'));  // compact() 여기에 ['items' => $items, 'query' => $query];  랑 같다... 이렇게 넣어줘도 상관없다.
    }

    public function updatingActive()
    {
        $this->resetPage();
    }


    public function updatingQ()
    {
        $this->resetPage();
    }
}
