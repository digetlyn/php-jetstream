<div class="p-6 sm:px-20 bg-white border-b border-gary-200">
    <div class="mt-8 text-2xl flex justify-between">
        <div>
            Items
        </div>

        <div>
            <x-button wire:click="confirmAdd">
                신규 아이템 등록
            </x-button>
        </div>

    </div>  

    <textarea name="query" id="query" cols="80" rows="1">{{ $query }}</textarea>
    

    <div class="mt-6">
        <div class="flex justify-between">
         <div>
         <input type="search" id="q" name="q" wire:model.live.debounce.800ms ="q" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="검색어" />
         </div>
            <div class="mr-2">
                <input type="checkbox" class="mr-6 leading-tight " wire:model.live ="active" /> 동작함
            </div>

        </div>
            
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2"><div class="flex items-center">
                        <button wire:click="sortBy('id')">번호</button>
                            <x-sort-icon sortField="id" :sort-by="$sort_by" :sort-asc="$sortAsc" />
 

                    </div></th>
                    <th class="px-4 py-2"><div class="flex items-center">
                        <button wire:click="sortBy('name')">이름</button>
                            <x-sort-icon sortField="name" :sort-by="$sort_by" :sort-asc="$sortAsc" />
                       
                    </div></th>
                    <th class="px-4 py-2"><div class="flex items-center">
                        <button wire:click="sortBy('price')">가격</button>
                             <x-sort-icon sortField="price" :sort-by="$sort_by" :sort-asc="$sortAsc" />
                    </div></th>
                    <th class="px-4 py-2">상태</th>
                    <th class="px-4 py-2">처리</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td class="border px-4 py-2">{{$item->id}}</td>
                    <td class="border px-4 py-2">{{$item->name}}</td>
                    <td class="border px-4 py-2">{{number_format($item->price,2)}}</td>
                    <td class="border px-4 py-2">{{$item->status ? '동작':'동작안함'}}</td>
                    <td class="border px-4 py-2">수정버튼 

                    <x-danger-button wire:click="confirmItemDeletion( {{$item->id }} )" wire:loading.attr="disabled">
                        삭제
                    </x-danger-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
    {{$items->links() }}
    </div>
         <!-- Delete Item Confirmation Modal -->
         <x-dialog-modal wire:model.live="confirmingItemDeletion">
            <x-slot name="title">
                {{ __('Delete Item') }}
            </x-slot>

            <x-slot name="content">
                {{ __('삭제를 하시겠습니까?') }}


                
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmingItemDeletion', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteItem( {{$confirmingItemDeletion }} )" wire:loading.attr="disabled">
                    {{ __('Delete Item') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>



        <!-- Add Item Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingItemAdd"> 
            <x-slot name="title">
                {{ __('아이템 신규 등록') }}
            </x-slot>

            <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('이름') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="item.name" />
                <x-input-error for="item.name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="price" value="{{ __('가격') }}" />
                <x-input id="price" type="text" class="mt-1 block w-full" wire:model="item.price" />
                <x-input-error for="item.price" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-3">
                <label class="flex items-center">
                    <input type="checkbox" wire:model.defer="item.status" />
                    <span class="text-sm text-gray-600 ml-2">동작</span>
                </label>
               
            </div>

            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmingItemAdd',false)" wire:loading.attr="disabled">
                    {{ __('취소') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click="saveItem()" wire:loading.attr="disabled">
                    {{ __('저장') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>

</div>
