<div>
    <div class="flex flex-col vazirmatn">
        <!-- جستجو -->
        <input
            wire:model.live.debounce.500ms="search"
            type="text"
            class="my-2 p-2 border border-gray-300 rounded"
            placeholder="جستجو..."
        >

        <!-- جدول -->
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 ">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table
                        class="min-w-full text-center text-sm font-light bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 text-white "
                    >
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="px-6 py-4">کد کاربری</th>
                            <th scope="col" class="px-6 py-4">نام کاربر</th>
                            <th scope="col" class="px-6 py-4">ایمیل</th>
                            <th scope="col" class="px-6 py-4">نقش کاربر</th>
                            <th scope="col" class="px-6 py-4">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- فیلتر بر اساس همه‌ی فیلدهای جدول -->
                        @foreach($users as $user)
                            <tr class="border-b">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $user->id }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $user->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $user->email }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $user->role->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <button onClick="confirm('Are you sure?')" wire:click="delete({{$user->id}})">
                                        <svg fill="#000000" xmlns="http://www.w3.org/2000/svg"
                                             width="20px" height="20px" viewBox="0 0 52 52"
                                             enable-background="new 0 0 52 52" xml:space="preserve">
                                    <g>
                                     <path d="M45.5,10H33V6c0-2.2-1.8-4-4-4h-6c-2.2,0-4,1.8-4,4v4H6.5C5.7,10,5,10.7,5,11.5v3C5,15.3,5.7,16,6.5,16h39
		                                c0.8,0,1.5-0.7,1.5-1.5v-3C47,10.7,46.3,10,45.5,10z M23,7c0-0.6,0.4-1,1-1h4c0.6,0,1,0.4,1,1v3h-6V7z"/>
                                        <path d="M41.5,20h-31C9.7,20,9,20.7,9,21.5V45c0,2.8,2.2,5,5,5h24c2.8,0,5-2.2,5-5V21.5C43,20.7,42.3,20,41.5,20z
	                                  	 M23,42c0,0.6-0.4,1-1,1h-2c-0.6,0-1-0.4-1-1V28c0-0.6,0.4-1,1-1h2c0.6,0,1,0.4,1,1V42z M33,42c0,0.6-0.4,1-1,1h-2
	                                    	c-0.6,0-1-0.4-1-1V28c0-0.6,0.4-1,1-1h2c0.6,0,1,0.4,1,1V42z"/>
                                    </g>
                                        </svg>
                                    </button>
                                    <button wire:click="edit({{$user->id}}) ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                        </svg>
                                    </button>
                                </td>
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
    <div class="bg-grey-lighter max-h-screen flex flex-col">
                        <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">

                            <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
                                <h1 class="mb-8 text-3xl text-center">افزودن کاربر جدید</h1>
                                <form wire:submit="createNewUser" >
                                    <input
                                        wire:model="name"
                                        type="text"
                                        class="block border border-grey-light w-full p-3 rounded mb-4"
                                        name="username"
                                        placeholder="User Name"/>
                                    @error('name')
                                    <span class="text-red-500 text-xs">{{$message}}</span>
                                    @enderror
                                    <input
                                        wire:model="email"
                                        type="text"
                                        class="block border border-grey-light w-full p-3 rounded mb-4"
                                        name="email"
                                        placeholder="Email"/>
                                    @error('email')
                                    <span class="text-red-500 text-xs">{{$message}}</span>
                                    @enderror
                                    <input
                                        wire:model="password"
                                        type="password"
                                        class="block border border-grey-light w-full p-3 rounded mb-4"
                                        name="password"
                                        placeholder="Password"/>
                                    @error('password')
                                    <span class="text-red-500 text-xs">{{$message}}</span>
                                    @enderror

                                    <select wire:model="role_id"
                                            class="block border border-grey-light w-full p-3 rounded mb-4">
                                        <option value="">انتخاب نقش</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <span class="text-red-500 text-xs">{{$message}}</span>
                                    @enderror

                                    <button
                                        wire:click.prevent="createNewUser"
                                        type="submit"
                                        class="w-full text-center py-3 rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none my-1"
                                    >ایجاد یک کاربر
                                    </button>

                                </form>
                                @if(session('success'))
                                    <span>{{session('success')}}</span>
                                @endif

                            </div>


                        </div>

                    </div>

        <!-- component -->


    <button x-data x-on:click="$dispatch('open-modal',{name:'create'})" class="px-3 py-1 bg-teal-500 text-white rounded">
        ایجاد کاربر
    </button>
    <x-my-modal name="create" title="ایجاد کاربر">
        <x-slot:body>

            <div class="bg-grey-lighter max-h-screen flex flex-col">
                <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">

                    <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
                        <form wire:submit="createNewUser" action="">
                            <input
                                wire:model="name"
                                type="text"
                                class="block border border-grey-light w-full p-3 rounded mb-4"
                                name="username"
                                placeholder="User Name"/>
                            @error('name')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                            <input
                                wire:model="email"
                                type="text"
                                class="block border border-grey-light w-full p-3 rounded mb-4"
                                name="email"
                                placeholder="Email"/>
                            @error('email')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                            <input
                                wire:model="password"
                                type="password"
                                class="block border border-grey-light w-full p-3 rounded mb-4"
                                name="password"
                                placeholder="Password"/>
                            @error('password')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror

                            <select wire:model="role_id"
                                    class="block border border-grey-light w-full p-3 rounded mb-4">
                                <option value="">انتخاب نقش</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror

                            <button
                                wire:click.prevent="createNewUser"
                                type="submit"
                                class="w-full text-center py-3 rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none my-1"
                            >ایجاد یک کاربر
                            </button>

                        </form>
                        @if(session('success'))
                            <span>{{session('success')}}</span>
                        @endif

                    </div>


                </div>

            </div>
        </x-slot:body>
    </x-my-modal>



</div>



