@extends('admin')

@section('content')
<div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
    <div class="flex flex-col gap-9">
        <!-- Contact Form -->
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">
                    Buat Konten
                </h3>
            </div>
            <form action=" {{route('admin.blog.post')}}" method="post">
                @csrf
                <div class="p-6.5">
                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Judul <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" name="judul" placeholder="judul" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                    </div>
                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Ringkasan <span class="text-meta-1">*</span>
                        </label>
                        <textarea name="ringkasan" placeholder="ringkasan" class="w-full h-48 rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"></textarea>
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Kontent/Isi <span class="text-meta-1">*</span>
                        </label>
                        <textarea id="tinymc" name="konten"></textarea>
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Kategori <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" name="kategori" placeholder="nama menu" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">

                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            URL GAMBAR <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" id="gambar" name="gambar" placeholder="File" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                    </div>
                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Publish & Show In Carausel <span class="text-meta-1">*</span>
                        </label>
                        <div class=" shadow-md px-3 py-2">
                            <input  type="checkbox"  name="publish" value="1" > Publish
                            <input class="ml-5" type="checkbox" name="oncarousel" value="1" > Show On Carousel
                        </div>
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