<div class="container mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-4 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach($words as $word)
            <div class="p-4 border rounded-md lg:col-span-1 md:col-span-2 xl:col-span-1">
                <img :src="`wordsImages/{{$word->word}}.jpg`" class="image-container mb-4">

                <div class="text-4xl text-center">{{ $word->word }}</div>

                <div class="flex flex-col mt-6 border-b pb-4">
                    <button class="bg-green-500 text-white py-1 px-2 mb-2 block"> بلد بودم</button>
                    <button class="bg-red-500 text-white py-1 px-2 block" >بلد نبودم</button>
                </div>


                <div class="flex flex-col mt-4">
                    <button wire:click="showMeaning({{ $word->id }})" class="bg-blue-500 text-white py-1 px-2 mb-2 block" >نمایش معنی</button>
                    @if ($meaningVisible && $selectedWordId == $word->id)
                        <div class=" mt-2 text-center">{{ $word->fa }}</div>
                    @endif
                    <button class="bg-yellow-500 text-white py-1 px-2 mb-2 block" >نمایش مثال</button>
                    <button class="bg-amber-500 text-white py-1 px-2 mb-2 block" >مترادف</button>
                    <button class="bg-cyan-500 text-white py-1 px-2 mb-2 block" >متضاد</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
