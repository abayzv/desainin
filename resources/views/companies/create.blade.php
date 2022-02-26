<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <div class="border-bottom">
                        <h3 class="p-3">Input New Company Record</h3>
                    </div>

                    <div>
                    </div>
                    <div class="modal-body">
                        <form action="/companies" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Upload Company logo</label>
                                <input class="form-control" type="file" id="logo" name="file">
                                @error('file')
                                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Company Name" name="name">
                                @error('name')
                                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Address</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Company Address" name="address">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Website</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Company Website" name="website">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                    placeholder="name@example.com" name="email">
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
