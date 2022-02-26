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
                        <h3 class="p-3">Employees</h3>
                    </div>
                    <div class="p-3">
                      <a href="{{ route('employees.create') }}">
                        <button type="button" class="btn btn-primary">Create New Employees Record</button>
                      </a>
                        <div class=" mt-4 rounded border">
                            <div class="border-bottom">
                                <h5 class="p-2">Employees List</h5>
                            </div>
                            <div class="p-4">
                                <table class="table table-bordered rounded">
                                    <thead> 
                                        <tr> 
                                            <th scope="col">No.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">company</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Employees as $Employee)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $Employee->first_name }} {{ $Employee->last_name }}</td>
                                            <td>{{ $Employee->company->name ?? $Employee->company_id }}</td>
                                            <td>{{ $Employee->email }}</td>
                                            <td>{{ $Employee->phone }}</td>
                                            <td>
                                                <a href="/employees/{{ $Employee->id }}/edit">
                                                  <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                                </a>
                                                <form action="/employees/{{ $Employee->id }}" method="post">
                                                @csrf
                                                @method('delete')
                                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
