@extends('admin')

@section('content')
<div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
    <div class="flex flex-col gap-9">
        <!-- Contact Form -->
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">
                    Buat/Edit User
                </h3>
            </div>
            <form action=" {{ route('admin.users.post')}}" method="post">
                @csrf
                <div class="p-6.5">
                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Nama <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" name="name" placeholder="nama" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Email/User Name <span class="text-meta-1">*</span>
                        </label>
                        <input type="email" name="email" placeholder="email/username" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal
                         text-black outline-none transition focus:border-primary active:border-primary 
                         disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input
                          dark:text-white dark:focus:border-primary">
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Role <span class="text-meta-1">*</span>
                        </label>
                        <select name="role" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal
                         text-black outline-none transition focus:border-primary active:border-primary 
                         disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input
                          dark:text-white dark:focus:border-primary">
                            <option>admin</option>
                            <option>author</option>
                        </select>
                    </div>

                    <button type="submit" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection