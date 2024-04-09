{{-- Layout and section directives might vary based on your app's structure --}}
@extends('admin')

@section('content')
<div class="container">
    <div class="flex justify-between mb-5">
        <p class="border-b-8 border-lime-600 font-bold text-3xl uppercase">Image Gallery</p>
        <a href=" {{route('admin.images.upload')}}" class="text-white bg-teal-500 shadow-sm p-2 shadow-teal-600">Upload</a>
    </div>
    <div class="row">
        <div class="grid grid-cols-4 gap-2">
            @foreach($images as $image)
            <div class="thumbnail">
                <!-- Thumbnail Image -->

                <div style="height: 250px;" class="shadow-md p-3 w-full cursor-pointer">
                    <img class=" object-fill w-full h-full" onclick="toggleModalx('imageModal{{ $image->id }}')" src="{{ asset('storage/galleries/' . $image->filename) }}" alt="{{ $image->title }}"  data-toggle="modal" data-target="#imageModal{{ $image->id }}">
                </div>


                <!--Modal-->
                <div id="imageModal{{ $image->id }}" class="modal opacity-0 pointer-events-none fixed  w-full h-full top-0 left-0 flex items-center justify-center">
                    <div class="modal-overlay absolute w-full h-full  opacity-95"></div>
                    <div class="modal-container fixed w-3/4 h-3/4 z-50 overflow-y-auto  bg-teal-300 ">
                        <div onclick="toggleModalx('imageModal{{ $image->id }}')" class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-black text-sm z-50">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                            (Esc)
                        </div>

                        <!-- Add margin if you want to see grey behind the modal-->
                        <div class="modal-content container mx-auto h-auto text-left p-4">

                            <!--Title-->
                            <div class="flex justify-between items-center pb-2">
                                <p class="text-2xl font-bold">Full Screen Modal!</p>
                            </div>

                            <!--Body-->
                            <img src="{{ asset('storage/galleries/' . $image->filename) }}" alt="{{ $image->title }}" style="width:25%;">
                            <!--Footer-->
                            <div class="flex justify-end pt-2">
                                <button onclick="toggleModalx('imageModal{{ $image->id }}')" class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End of Modal -->
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection