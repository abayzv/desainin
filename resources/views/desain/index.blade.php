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
                        <div class="border-bottom">
                            <div class="mb-3">
                                <a href="/desain/create">
                                    <button type="button" class="btn btn-primary">Create New Desain</button>
                                </a>
                                <a href="/category">
                                    <button type="button" class="btn btn-primary">Category List</button>
                                </a>
                            </div>
                        </div>
                        <div class="rounded">
                            <table class="table rounded">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Cover</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Jumlah Download</th>
                                        <th scope="col">Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($desain as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <img src="{{ asset('storage/logo/' . $item->thumbnail) }}"
                                                    style="max-width:50px;">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @foreach ($categories as $category)
                                                    @if ($category->id == $item->category)
                                                        {{ $category->name }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ $item->downloaded_time }}
                                            </td>
                                            <td><a href="/download?file={{ $item->link }}">Download File</a></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="/desain/{{ $item->id }}/edit" class="mr-2">
                                                        <button type="button"
                                                            class="btn btn-warning btn-sm">Edit</button>
                                                    </a>
                                                    <form action="/desain/{{ $item->id }}" method="post">
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
                                {{ $desain->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
