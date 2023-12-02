<div class="p-3">
    <form wire:submit="updateUser">
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="name" wire:model="name"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder=" "/>
            <label for="name"
                   class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">نام</label>
            @error('name')
            <span class="mt-2  text-sm text-red-500">
                 {{$message}}
                </span>
            @enderror
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="email" wire:model="email"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder=" "/>
            <label for="email"
                   class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ایمیل
                </label>
            @error('email')
            <span class="mt-2  text-sm text-red-500">
                 {{$message}}
                </span>
            @enderror
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="password" name="password" wire:model="password"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder=" "/>
            <label for="password"
                   class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">پسورد</label>
            @error('password')
            <span class="mt-2  text-sm text-red-500">
                 {{$message}}
                </span>
            @enderror
        </div>
        <div class="relative z-0 w-full mb-6 group">

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

            </div>

        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            ویرایش
        </button>
    </form>
    @if(session('success'))
        <h1>
            {{session('success')}}
        </h1>
    @endif
</div>