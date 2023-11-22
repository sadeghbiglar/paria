<div>
    <div class="flex flex-col">
        <!-- جستجو -->
        <input
            wire:model.live.debounce.500ms="search"
            type="text"
            class="my-2 p-2 border border-gray-300 rounded"
            placeholder="جستجو..."
        >

        <!-- جدول -->
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table
                        class="min-w-full text-center text-sm font-light bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 text-white"
                    >
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="px-6 py-4">کد کاربری</th>
                            <th scope="col" class="px-6 py-4">نام کاربر</th>
                            <th scope="col" class="px-6 py-4">ایمیل</th>
                            <th scope="col" class="px-6 py-4">نقش کاربر</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- فیلتر بر اساس همه‌ی فیلدهای جدول -->
                        @foreach($users as $user)
                        <tr  class="border-b">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $user->id }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $user->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $user->email }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $user->role->name }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>

    </div>


</div>
