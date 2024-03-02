<?php

namespace App\Livewire;
// namespace App\Http\Livewire;


use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{   
    use WithPagination; //페이징 작업..

    public $active = false;
    public $q;  
    public $sort_by = 'id';
    public $sortAsc = true;
    public $confirmingItemDeletion = false;

    protected $queryString = [   //검색된 내용의 주소창을 그대로 가지고 다른창에 복사해서 열었을때 같은 결과값 나오게끔.
       'active'=> ['keep' => false ],   //비어있는거는 굳이 표현 안하겠다. ['except=>false]
        'q' => ['keep'=>''],            //비어있는거는 굳이 표현 안하겠다. ['except=>'']
        'sort_by' => ['except' => 'id'],
        'sortAsc' => ['except' => true]
    ];

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
            })
            ->orderBy($this->sort_by, $this->sortAsc ? 'ASC': 'DESC');
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


    public function sortBy($field)
    {
        if($field == $this->sort_by){
            $this ->sortAsc = !$this ->sortAsc;
        }else{
            $this->sortAsc = true;
        }
        $this->sort_by = $field;
    }


    public function confirmItemDeletion($id)
    {
       // $item->delete();
       $this->confirmingItemDeletion = $id;
    }
}
