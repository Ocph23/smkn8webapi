{{-- Layout and section directives might vary based on your app's structure --}}
@extends('admin')

@section('content')
<div class="container">
    <div class="flex justify-between mb-5">
        <p class="border-b-4 border-lime-600 font-bold text-3xl uppercase">Berita & Blog </p>
        <a href=" {{route('admin.blog.create')}}" class="text-white bg-teal-500 shadow-sm px-3 py-1 rounded-sm shadow-teal-600">Baru</a>
    </div>
    <div class="row">
        <table class=" w-full">
            <thead>
                <tr class="border-t border-stroke px-4 py-4.5 dark:border-strokedark">
                    <th class=" text-left px-2 py-3 md:px-6 xl:px-7.5">Tanggal</th>
                    <th class="text-left px-2 py-3 md:px-6 xl:px-7.5">Judul</th>
                    <th class="text-left px-2 py-3 md:px-6 xl:px-7.5">Kategori</th>
                    <th class="text-left px-2 py-3 md:px-6 xl:px-7.5">Author</th>
                    <th class="px-2 py-3 md:px-6 xl:px-7.5 text-center">Publish</th>
                    <th class="px-2 py-3 md:px-6 xl:px-7.5 text-center">On Carousel</th>
                    <th class="px-2 py-3 md:px-6 xl:px-7.5 text-right"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog )
                <tr class="border-t border-stroke px-4 py-4.5 dark:border-strokedark">
                    <td class="px-2 py-3 md:px-6 xl:px-7.5">{{ $blog->created_at }}</td>
                    <td class="px-2 py-3 md:px-6 xl:px-7.5">{{ $blog->judul }}</td>
                    <td class="px-2 py-3 md:px-6 xl:px-7.5">{{ $blog->kategori }}</td>
                    <td class="px-2 py-3 md:px-6 xl:px-7.5">{{ $blog->author->name }}</td>
                    <td class="px-2 py-3 md:px-6 xl:px-7.5 text-center" > 
                        <input {{$blog->publish?'checked':''}} type="checkbox" onchange="onChangePublish('{{ route('client.blog.changepubish',$blog->id) }}')" value="1" /> </td>
                    <td class="px-2 py-3 md:px-6 xl:px-7.5 text-center" > <input {{$blog->oncarousel?'checked':''}} type="checkbox" value="1" disabled  /> </td>
                    <td class="px-2 py-3 md:px-6 xl:px-7.5 text-right" ><a href="{{ route('admin.blog.edit',$blog->id) }}"><i class='bx bxs-edit-alt text-sm text-white rounded-sm  bg-amber-500 px-2 py-1 shadow-md'></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<script>
    function onChangePublish(route) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", route, true);
        xmlhttp.send();
    }
</script>