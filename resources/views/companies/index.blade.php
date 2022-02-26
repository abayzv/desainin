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
                        <h3 class="p-3">Companies</h3>
                    </div>
                    <div class="p-3">
                        <a href="/companies/create">
                            <button type="button" class="btn btn-primary">Create New Company</button>
                        </a>
                        <div class=" mt-4 rounded border">
                            <div class="border-bottom">
                                <h5 class="p-2">Companies List</h5>
                            </div>
                            <div class="p-4">
                                <table class="table table-bordered rounded">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Logo</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Website</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($Companies as $Company)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                              <img src="{{ asset('storage/logo/' . $Company->logo)}}" style="max-width:50px;">
                                            </td>
                                            <td>{{ $Company->name }}</td>
                                            <td>{{ $Company->address }}</td>
                                            <td>{{ $Company->website }}</td>
                                            <td>{{ $Company->email }}</td>
                                            <td>
                                                <a href="/companies/{{ $Company->id }}/edit">
                                                  <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                                </a>
                                                <form action="/companies/{{ $Company->id }}" method="post">
                                                @csrf
                                                @method('delete')
                                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                                  {{ $Companies->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
