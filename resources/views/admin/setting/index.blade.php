@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Settings</h1>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded p-4">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left">Key</th>
                    <th class="text-left">Value</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($settings as $setting)
                <tr class="border-t">
                    <td class="py-3">{{ $setting->key }}</td>
                    <td class="py-3">{{ \Illuminate\Support\Str::limit($setting->value, 120) }}</td>
                    <td class="py-3 text-right">
                        <a href="{{ route('admin.setting.edit', $setting) }}" class="text-indigo-600">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
