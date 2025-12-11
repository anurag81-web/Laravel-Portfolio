@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Edit Project</h1>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.project.update', $project) }}" method="POST" enctype="multipart/form-data"
            class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block mb-2 font-bold text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 focus:border-indigo-500 focus:ring-0 bg-gray-50 transition-colors outline-none"
                    required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-bold text-gray-700">Description</label>
                <textarea name="description"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 focus:border-indigo-500 focus:ring-0 bg-gray-50 transition-colors outline-none"
                    rows="4">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-bold text-gray-700">Image</label>
                @if($project->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="image"
                            class="w-24 h-24 object-cover rounded-xl border-4 border-gray-100 shadow-sm">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-bold text-gray-700">Link</label>
                <input type="url" name="link" value="{{ old('link', $project->link) }}"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 focus:border-indigo-500 focus:ring-0 bg-gray-50 transition-colors outline-none">
            </div>

            <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-100">
                <button
                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg shadow-indigo-200 transition-all">Update</button>
                <a href="{{ route('admin.project.index') }}"
                    class="px-6 py-3 bg-white border-2 border-gray-200 text-gray-700 hover:bg-gray-50 font-medium rounded-xl transition-all">Cancel</a>
            </div>
        </form>
    </div>
@endsection