@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Projects</h1>
            <div class="flex gap-4">
                <a href="{{ route('dashboard') }}"
                    class="px-6 py-3 bg-white border-2 border-gray-200 text-gray-700 hover:bg-gray-50 font-medium rounded-xl transition-all">Back</a>
                <a href="{{ route('admin.project.create') }}"
                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg shadow-indigo-200 transition-all">Add
                    Projects</a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">Title</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">Description</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">Image</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($projects as $project)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-800 font-medium whitespace-nowrap">{{ $project->title }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ \Illuminate\Support\Str::limit($project->description, 80) }}
                            </td>
                            <td class="px-6 py-4">
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="image"
                                        class="w-16 h-16 object-cover rounded-lg border border-gray-100" />
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.project.edit', $project) }}"
                                    class="inline-block px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm shadow-indigo-200">
                                    Edit
                                </a>
                                <form action="{{ route('admin.project.destroy', $project) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-block px-4 py-2 bg-white border border-red-200 text-red-600 hover:bg-red-50 text-sm font-medium rounded-lg transition-colors"
                                        onclick="return confirm('Delete this project?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $projects->links() }}</div>
    </div>
@endsection