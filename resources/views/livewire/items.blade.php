<div class="p-6 sm:px-20 bg-white border-b border-gary-200">
    <div class="mt-8 text-2xl">
    Items
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
                    </div></th>
                    <th class="px-4 py-2"><div class="flex items-center">
                        <button wire:click="sortBy('name')">이름</button>
                    </div></th>
                    <th class="px-4 py-2"><div class="flex items-center">
                        <button wire:click="sortBy('price')">가격</button>
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
                    <td class="border px-4 py-2">수정버튼 삭제버튼</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
    {{$items->links() }}
    </div>

</div>
