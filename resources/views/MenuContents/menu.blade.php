@extends('admin')
@section('content')
<div class="max-w-full">
    <div class="flex justify-between px-4 py-6 md:px-6 xl:px-7.5">
        <h4 class="text-xl font-bold text-black dark:text-white">Menu Utama</h4>
        <a href="/admin/menu/create/0"> <i class='bx bx-plus text-teal-600'></i></a>
    </div>
    <ul class="px-4  m-4">
        @foreach ($data as $value)
        <li class="p-3 flex justify-between shadow-1">
            <div>{{ $value->menu }}</div>
            <div>
                @if (!$value->hasContent)
                <a href="/admin/menu/create/{{ $value->id }}"> <i class='bx bx-plus text-teal-600'></i></a>
                @endif

                @if (!$value->childs->count() > 0)
                <a href="/admin/maincontent/create/{{ $value->id }}"> <i class='bx bx-file'></i></a>
                @endif
                <a href="/admin/menu/{{ $value->id }}/edit"> <i class='bx bx-edit text-yellow-400'></i></a>
                <a class="cursor-pointer"><i onclick='deleteData("/admin/menu/delete/{{$value->id}}")' class="bx bx-trash text-orange-700"></i></a>
            </div>
        </li>
        @if ($value->childs->count() > 0)
        <ul class="ml-8">
            @foreach ($value->childs as $item)
            <li class="p-3 flex justify-between shadow-1">
                <div>{{ $item->menu }}</div>
                <div>
                    @if (!$item->hasContent)
                    <a href="/admin/menu/create/{{ $item->id }}"> <i class='bx bx-plus text-teal-600'></i></a>
                    @endif

                    @if (!$item->childs->count() > 0)
                    <a href="/admin/maincontent/create/{{ $item->id }}"> <i class='bx bx-file'></i></a>
                    @endif

                    <a href="/admin/menu/{{ $item->id }}/edit"> <i class='bx bx-edit text-yellow-400'></i></a>
                    <a class="cursor-pointer"><i onclick='deleteData("/admin/menu/delete/{{$item->id}}")' class="bx bx-trash text-orange-700"></i></a>
                </div>
            </li>

            @if ($item->childs->count() > 0)
            <ul class="ml-8">
                @foreach ($item->childs as $item2)
                <li class="p-3 flex justify-between shadow-1">
                    <div>{{ $item2->menu }}</div>
                    <div>
                        <a href="/admin/maincontent/create/{{ $item2->id }}"> <i class='bx bx-file'></i></a>
                        <a class="cursor-pointer"><i onclick='deleteData("/admin/menu/delete/{{$item2->id}}")' class="bx bx-trash text-orange-700"></i></a>
                    </div>
                </li>
                @endforeach
            </ul>
            @endif
            @endforeach
        </ul>
        @endif
        @endforeach
    </ul>
</div>
@endsection


<script>
    function deleteData(action) {
        Swal.fire({
            title: "Yakin ?",
            text: "Anda Yakin Hapus Data !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus !"
        }).then(function(result) {
            if (result.isConfirmed) {
                var form = document.createElement('form');
                form.action = action;
                form.method = 'POST';
                form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
                document.body.appendChild(form);
                form.submit();
            }
        });



    }
</script>