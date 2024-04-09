@extends('admin')

@section('content')
<div class=" flex justify-between px-4 py-6 md:px-6 xl:px-7.5">
  <h4 class="text-xl font-bold text-black dark:text-white">Data User</h4>
  <a href=" {{route('admin.users.create')}}"><i class=' shadow-md p-1 rounded-sm bx bx-plus'></i></a>
</div>

<table class=" w-full">
  <thead>
    <tr class="border-t border-stroke px-4 py-4.5 dark:border-strokedark">
      <th class=" text-left px-2 py-3 md:px-6 xl:px-7.5">Nama</th>
      <th class="text-left px-2 py-3 md:px-6 xl:px-7.5">Email</th>
      <th class="text-left px-2 py-3 md:px-6 xl:px-7.5">Role</th>
      <th class="text-left px-2 py-3 md:px-6 xl:px-7.5">Status</th>
      <th class="px-2 py-3 md:px-6 xl:px-7.5 text-right">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $item )
    <tr class="border-t border-stroke px-4 py-4.5 dark:border-strokedark">
      <td class="px-2 py-3 md:px-6 xl:px-7.5">{{ $item->name }}</td>
      <td class="px-2 py-3 md:px-6 xl:px-7.5">{{ $item->email }}</td>
      <td class="px-2 py-3 md:px-6 xl:px-7.5">{{ $item->role }}</td>
      <td class="px-2 py-3 md:px-6 xl:px-7.5">{{ $item->status ? "Aktif":"Tidak Aktif" }} </td>
      <td class="px-2 py-3 md:px-6 xl:px-7.5 text-right ">
        <a class=" w-60 p-2 shadow-md text-white {{ $item->status ? 'bg-orange-600':'bg-teal-600' }}"  href="/admin/users/changestatus/{{ $item->id }}"> {{ $item->status ? "Blok":"Aktifkan" }}</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection