@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Projects</h1>
        <a href="{{ route('admin.project.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Create</a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Title</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Description</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Image</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($projects as $project)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $project->title }}</td>
                    <td class="px-6 py-4">{{ \Illuminate\Support\Str::limit($project->description, 80) }}</td>
                    <td class="px-6 py-4">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="image" class="w-20 h-20 object-cover rounded" />
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.project.edit', $project) }}" class="text-indigo-600 mr-2">Edit</a>
                        <form action="{{ route('admin.project.destroy', $project) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Delete this project?')">Delete</button>
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
