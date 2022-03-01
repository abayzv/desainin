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
                    <div class="p-3">
                        <a href="/category/create">
                            <button type="button" class="btn btn-primary">Add Category</button>
                        </a>
                        <div class=" mt-4 rounded border">
                            <div class="border-bottom">
                                <h5 class="p-2">Category List</h5>
                            </div>
                            <div class="p-4">
                                <table class="table table-bordered rounded">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="/category/{{ $item->id }}/edit"
                                                            class="mr-2">
                                                            <button type="button"
                                                                class="btn btn-warning btn-sm">Edit</button>
                                                        </a>
                                                        <form action="/category/{{ $item->id }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    {{ $categories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
