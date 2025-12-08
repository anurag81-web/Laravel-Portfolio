@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-4">Create Project</h1>

    @if($errors->any())
        <div class="mb-4 text-red-700">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="mt-1 block w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Description</label>
            <textarea name="description" class="mt-1 block w-full border rounded px-3 py-2" rows="4">{{ old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Image</label>
            <input type="file" name="image" accept="image/*" class="mt-1 block w-full">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Link</label>
            <input type="url" name="link" value="{{ old('link') }}" class="mt-1 block w-full border rounded px-3 py-2">
        </div>
        <div>
            <button class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('admin.project.index') }}" class="ml-2 text-gray-600">Cancel</a>
        </div>
    </form>
</div>
@endsection
