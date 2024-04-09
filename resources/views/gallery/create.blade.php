@extends('admin')

@section('content')
<div class="container">
    <h1>Upload Image</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('admin.images.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-3 gap-3">
            <div>
                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Judul <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" name="title" placeholder="Title" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                </div>

                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        File <span class="text-meta-1">*</span>
                    </label>
                    <input type="file" id="file" name="image" placeholder="File" class="w-full rounded border-[1.5px] border-stroke bg-transdata px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                </div>


                <button type="submit" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90">
                    Upload
                </button>
            </div>

            <img class="  col-span-2" id="imageView">

        </div>
    </form>


</div>
@endsection

<script>
    setTimeout(() => {
        var input = document.getElementById('file');

        input.onchange = function() {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function() {
                /*
                Note: Now we need to register the blob in TinyMCEs image blob
                registry. In the next release this part hopefully won't be
                necessary, as we are looking to handle it internally.
                */

                var img = document.getElementById('imageView');
                img.setAttribute('src', reader.result);

                // var id = 'blobid' + (new Date()).getTime();
                // var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                // var base64 = reader.result.split(',')[1];
                // var blobInfo = blobCache.create(id, file, base64);
                // blobCache.add(blobInfo);

                // /* call the callback and populate the Title field with the file name */
                // cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
        };
    }, 500);
</script>