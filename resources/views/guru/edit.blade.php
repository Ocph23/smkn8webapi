@extends('admin')

@section('content')
<div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
    <div class="flex flex-col gap-9">
        <!-- Contact Form -->
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">
                    Edit Guru
                </h3>
            </div>
            <form action="{{route('admin.guru.put')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="p-6.5">
                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Nama <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" name="nama" value="{{$model->nama}}" require placeholder="nama menu" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                    </div>
                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Jenis Kelamin <span class="text-meta-1">*</span>
                        </label>
                        <select name="jk" value="{{$model->jk}}" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>


                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Jabatan </span>
                        </label>
                        <input type="text" name="jabatan"  value="{{$model->jabatan}}" placeholder="nama menu" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Level Jabatan <span class="text-meta-1">*</span>
                        </label>
                        <input type="number" name="level_jabatan"  value="{{$model->level_jabatan}}" value="1" placeholder="nama menu" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                    </div>


                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Pelajaran 
                        </label>
                        <input type="text" name="pelajaran"  value="{{$model->pelajaran}}" placeholder="nama menu" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">

                    </div>
                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Urutan <span class="text-meta-1">*</span>
                        </label>
                        <input type="number" value="0" name="urutan"  value="{{$model->urutan}}" placeholder="nama menu" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Photo <span class="text-meta-1">*</span>
                        </label>
                        <input type="file" id="image" name="image" placeholder="Photo" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                    </div>
                    <input name="id"  value="{{$model->id}}" hidden>
                    <button type="submit" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection