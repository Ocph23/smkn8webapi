{{-- Layout and section directives might vary based on your app's structure --}}
@extends('admin')

@section('content')
    <div class="container">
        <div class="flex justify-between mb-5">
            <p class="border-b-8 border-lime-600 font-bold text-3xl uppercase">Image Gallery</p>
            <a href=" {{ route('admin.images.upload') }}"
                class="text-white bg-teal-500 shadow-sm p-2 shadow-teal-600">Upload</a>
        </div>
        <div class="row">
            <div class="grid grid-cols-4 gap-2">
                @foreach ($images as $image)
                    <div class="thumbnail">
                        <!-- Thumbnail Image -->

                        <div style="height: 250px;" class="shadow-md p-3 w-full cursor-pointer">
                            <div class="flex justify-end">
                                <div class="w-5 m-5 self-end absolute " onclick="deleteImage('{{ $image->filename }}')">
                                    <svg viewBox="0 0 1024 1024" fill="#ff0000" class="icon" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" stroke="#ff0000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M512 897.6c-108 0-209.6-42.4-285.6-118.4-76-76-118.4-177.6-118.4-285.6 0-108 42.4-209.6 118.4-285.6 76-76 177.6-118.4 285.6-118.4 108 0 209.6 42.4 285.6 118.4 157.6 157.6 157.6 413.6 0 571.2-76 76-177.6 118.4-285.6 118.4z m0-760c-95.2 0-184.8 36.8-252 104-67.2 67.2-104 156.8-104 252s36.8 184.8 104 252c67.2 67.2 156.8 104 252 104 95.2 0 184.8-36.8 252-104 139.2-139.2 139.2-364.8 0-504-67.2-67.2-156.8-104-252-104z"
                                                fill=""></path>
                                            <path d="M707.872 329.392L348.096 689.16l-31.68-31.68 359.776-359.768z"
                                                fill="">
                                            </path>
                                            <path d="M328 340.8l32-31.2 348 348-32 32z" fill=""></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <img class="-fill w-full h-full" onclick="toggleModalx('imageModal{{ $image->id }}')"
                                src="{{ asset('storage/galleries/' . $image->filename) }}" alt="{{ $image->title }}"
                                data-toggle="modal" data-target="#imageModal{{ $image->id }}">
                        </div>


                        <!--Modal-->
                        <div id="imageModal{{ $image->id }}"
                            class="modal absolute opacity-0 pointer-events-none w-full h-full top-0 left-0 flex items-center justify-center">
                            <div class="modal-overlay absolute w-full h-full  opacity-95"></div>
                            <div
                                class="modal-container md:w-1/2 md:h-1/2 w-3/4 h-3/4 z-50 overflow-y-auto  bg-gray-100 shadow-md ">

                                <!-- Add margin if you want to see grey behind the modal-->
                                <div class="modal-content container mx-auto h-auto text-left p-4">
                                    <!--Title-->
                                    <div class="flex justify-between items-center pb-2">
                                        <p class="text-xl font-bold">Image Preview </p>
                                        <div onclick="toggleModalx('imageModal{{ $image->id }}')"
                                            class="modal-close  top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-black text-sm z-50">
                                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg"
                                                width="18" height="18" viewBox="0 0 18 18">
                                                <path
                                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                                </path>
                                            </svg>
                                            (Esc)
                                        </div>
                                    </div>

                                    <!--Body-->
                                    <img src="{{ asset('storage/galleries/' . $image->filename) }}"
                                        alt="{{ $image->title }}" style="width:100%;">
                                    <!--Footer-->

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
