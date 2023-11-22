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

    <!-- component -->

    <div class="bg-grey-lighter min-h-screen flex flex-col">
        <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">

            <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
                <h1 class="mb-8 text-3xl text-center">افزودن کاربر جدید</h1>
                <form wire:submit="createNewUser" action="">
                    <input
                        wire:model="name"
                        type="text"
                        class="block border border-grey-light w-full p-3 rounded mb-4"
                        name="username"
                        placeholder="User Name" />
                    @error('name')
                    <span class="text-red-500 text-xs">{{$message}}</span>
                    @enderror
                    <input
                        wire:model="email"
                        type="text"
                        class="block border border-grey-light w-full p-3 rounded mb-4"
                        name="email"
                        placeholder="Email" />
                    @error('email')
                    <span class="text-red-500 text-xs">{{$message}}</span>
                    @enderror
                    <input
                        wire:model="password"
                        type="password"
                        class="block border border-grey-light w-full p-3 rounded mb-4"
                        name="password"
                        placeholder="Password" />
                    @error('password')
                    <span class="text-red-500 text-xs">{{$message}}</span>
                    @enderror
                    <input
                        wire:model="role_id"
                        type="text"
                        class="block border border-grey-light w-full p-3 rounded mb-4"
                        name="role_id"
                        placeholder="role_id" />
                    @error('role_id')
                    <span class="text-red-500 text-xs">{{$message}}</span>
                    @enderror
                    <button
                        wire:click.prevent="createNewUser"
                        type="submit"
                        class="w-full text-center py-3 rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none my-1"
                    >ایجاد کاربر</button>

                </form>
                @if(session('success'))
                    <span>{{session('success')}}</span>
                @endif

            </div>


        </div>

    </div>
</div>



