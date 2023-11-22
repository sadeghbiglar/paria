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

