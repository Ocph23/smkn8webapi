{{-- Layout and section directives might vary based on your app's structure --}}
@extends('admin')

@section('content')
<div class="container">
    <div class="flex justify-between items-center mb-5">
        <p class="border-b-4 border-lime-600 font-bold text-3xl uppercase">Berita & guru </p>
        <a href="{{route('admin.guru.create')}}" class="text-white bg-teal-500 shadow-sm px-3 py-1 rounded-sm shadow-teal-600">Baru</a>
    </div>
    <div class="row">
        <table class=" w-full">
            <thead>
                <tr class="border-t border-stroke px-4 py-4.5 dark:border-strokedark">
                    <th class=" w-auto text-left px-2 py-3 md:px-6 xl:px-7.5">Photo</th>
                    <th class="text-left px-2 py-3 md:px-6 xl:px-7.5">Nama</th>
                    <th class="text-left px-2 py-3 md:px-6 xl:px-7.5">JK</th>
                    <th class="px-2 py-3 md:px-6 xl:px-7.5 text-left">Jabatan</th>
                    <th class="px-2 py-3 md:px-6 xl:px-7.5 text-center">Level</th>
                    <th class="px-2 py-3 md:px-6 xl:px-7.5 text-left"> Pelajaran</th>
                    <th class="px-2 py-3 md:px-6 xl:px-7.5 text-center">Urutan</th>
                    <th class="px-2 py-3 md:px-6 xl:px-7.5 text-right"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gurus as $guru )
                <tr class="border-t border-stroke px-4 py-4.5 dark:border-strokedark">
                    <td class="px-2 py-3 md:px-6 xl:px-7.5 flex">
                        <div class="rounded-full bg-slate-300 w-auto p-0.5">
                            <img class="rounded-full w-10 h-10 hover:w-20 hover:h-20" src="{{$guru->photo}}">
                        </div>
                    </td>
                    <td class="px-2 py-3 md:px-6 xl:px-7.5">{{ $guru->nama }}</td>
                    <td class="px-2 py-3 md:px-6 xl:px-7.5"><i class="bx bx-{{ $guru->jk=='perempuan'?'female-sign':'male-sign'}}  text-2xl"></i> </td>
                    <td class="px-2 py-3 md:px-6 xl:px-7.5">{{ $guru->jabatan }}</td>
                    <td class="px-2 py-3 md:px-6 xl:px-7.5 text-center">{{ $guru->level_jabatan }}</td>
                    <td class="px-2 py-3 md:px-6 xl:px-7.5 text-left">{{ $guru->pelajaran }}</td>
                    <td class="px-2 py-3 md:px-6 xl:px-7.5 text-center">{{ $guru->urutan }}</td>
                    <td class="px-2 py-3 md:px-6 xl:px-7.5 text-right">
                        <a href="{{ route('admin.guru.edit',  $guru->id)}}"><i class='bx bxs-edit-alt text-sm text-white rounded-sm  bg-amber-500 px-2 py-1 shadow-md'></i></a>
                        <a href="{{ route('admin.guru.delete',  $guru->id)}}"><i class='bx bx-trash text-sm text-white rounded-sm bg-orange-600 px-2 py-1 shadow-md'></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


<script>
    function onChangePublish(id) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "/api/client/" + id + "/publish", true);
        xmlhttp.send();
    }
</script>