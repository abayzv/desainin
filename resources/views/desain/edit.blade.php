<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Desain') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <div>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('desain.update', $desain->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Upload Thumbnail</label>
                                <input class="form-control" value="{{ $desain->thumbnail }}" type="file" id="logo"
                                    name="logo">
                                @error('file')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Desain Name" name="name" value="{{ $desain->name }}">
                                @error('name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Address</label>
                                <select class="form-control" name="category" value="{{ $desain->category }}">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Website</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Company Website" name="link" value="{{ $desain->link }}">
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
