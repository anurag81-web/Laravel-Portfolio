@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Hero Section</h1>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded p-6">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left">Title</th>
                    <th class="text-left">Subtitle</th>
                    <th class="text-left">Image</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($heroes as $hero)
                <tr class="border-t">
                    <td class="py-3">{{ $hero->title }}</td>
                    <td class="py-3">{{ \Illuminate\Support\Str::limit($hero->subtitle, 80) }}</td>
                    <td class="py-3">
                        @if($hero->image)
                            <img src="{{ asset('storage/' . $hero->image) }}" alt="hero" class="w-28 h-16 object-cover rounded" />
                        @endif
                    </td>
                    <td class="py-3 text-right">
                        <a href="{{ route('admin.hero.edit', $hero) }}" class="text-indigo-600">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
