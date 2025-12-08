@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-4">Edit Hero</h1>

    @if($errors->any())
        <div class="mb-4 text-red-700">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hero.update', $hero) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium">Title</label>
            <input type="text" name="title" value="{{ old('title', $hero->title) }}" class="mt-1 block w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Subtitle</label>
            <textarea name="subtitle" class="mt-1 block w-full border rounded px-3 py-2" rows="3">{{ old('subtitle', $hero->subtitle) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Image</label>
            @if($hero->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $hero->image) }}" alt="hero" class="w-32 h-20 object-cover rounded">
                </div>
            @endif
            <input type="file" name="image" accept="image/*" class="mt-1 block w-full">
        </div>
        <div>
            <button class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.hero.index') }}" class="ml-2 text-gray-600">Cancel</a>
        </div>
    </form>
</div>
@endsection
