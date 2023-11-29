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
                            <th scope="col" class="px-6 py-4">عملیات </th>
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
                            <td class="whitespace-nowrap px-6 py-4">
                                <button wire:click="delete({{$user->id}})">
                                    delete
                                </button>
                                <button wire:click="edit({{$user->id}}) ">
                                    edit
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
    <button
        wire:click="openCreateUserModal"

        class="w-full text-center py-3 rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none my-1"
    >ایجاد  کاربر</button>



    <div>

        <div x-data="{ showCreateUserModal: @entangle('showCreateUserModal') }" x-show="showCreateUserModal" @click.away="showCreateUserModal = false"
             class="fixed inset-0 flex items-center justify-center overflow-y-auto">
            <div class="bg-white p-4 max-w-md mx-auto mt-8 mb-8 rounded shadow-lg">


                <!-- افزودن اسکرول به داخل مدال -->
                <div class="max-h-85 overflow-y-auto">
                    <!-- محتوای مدال -->

                    <div class="bg-grey-lighter max-h-screen flex flex-col">
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

                                    <select wire:model="role_id" class="block border border-grey-light w-full p-3 rounded mb-4">
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
                                    >ایجاد یک کاربر</button>

                                </form>
                                @if(session('success'))
                                    <span>{{session('success')}}</span>
                                @endif

                            </div>


                        </div>

                    </div>

                </div>

                <button wire:click="closeCreateUserModal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded mt-4">
                    بستن
                </button>
            </div>
        </div>
        <div x-data="{ showEditUserModal: @entangle('showEditUserModal') }" x-show="showEditUserModal" @click.away="showEditUserModal = false"
             class="fixed inset-0 flex items-center justify-center overflow-y-auto">
            <div class="bg-white p-4 max-w-md mx-auto mt-8 mb-8 rounded shadow-lg">


                <!-- افزودن اسکرول به داخل مدال -->
                <div class="max-h-85 overflow-y-auto">
                    <!-- محتوای مدال -->

                    <div class="bg-grey-lighter max-h-screen flex flex-col">
                        <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">

                            <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
                                <h1 class="mb-8 text-3xl text-center"> ویرایش کاربر </h1>

                                    <input
                                        wire:model="EditingName"
                                        type="text"
                                        class="block border border-grey-light w-full p-3 rounded mb-4"
                                        name="EditingName"
                                        placeholder="EditingName" />
                                    @error('EditingName')
                                    <span class="text-red-500 text-xs">{{$message}}</span>
                                    @enderror

                                    <button
                                        wire:click="update"

                                        class="w-full text-center py-3 rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none my-1"
                                    >  ویرایش کاربر</button>
                                    <button
                                        wire:click="cancelEdit"

                                        class="w-full text-center py-3 rounded bg-red-500 text-white hover:bg-red-500 focus:outline-none my-1"
                                    >  انصراف</button>


                                @if(session('success'))
                                    <span>{{session('success')}}</span>
                                @endif

                            </div>


                        </div>

                    </div>

                </div>


            </div>
        </div>

    </div>


</div>



