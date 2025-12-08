@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-4">Edit About Entry</h1>

    @if($errors->any())
        <div class="mb-4 text-red-700">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.about.update', $about) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name', $about->name) }}" class="mt-1 block w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Description</label>
            <textarea name="description" class="mt-1 block w-full border rounded px-3 py-2" rows="4">{{ old('description', $about->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Photo</label>
            @if($about->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $about->photo) }}" alt="photo" class="w-24 h-24 object-cover rounded">
                </div>
            @endif
            <input type="file" name="photo" accept="image/*" class="mt-1 block w-full">
        </div>
        <div>
            <button class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.about.index') }}" class="ml-2 text-gray-600">Cancel</a>
        </div>
    </form>
</div>
@endsection
