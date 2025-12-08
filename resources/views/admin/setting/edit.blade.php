@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-4">Edit Setting: {{ $setting->key }}</h1>

    @if($errors->any())
        <div class="mb-4 text-red-700">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.setting.update', $setting) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium">Value</label>
            <textarea name="value" class="mt-1 block w-full border rounded px-3 py-2" rows="4">{{ old('value', $setting->value) }}</textarea>
        </div>
        <div>
            <button class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.setting.index') }}" class="ml-2 text-gray-600">Cancel</a>
        </div>
    </form>
</div>
@endsection
