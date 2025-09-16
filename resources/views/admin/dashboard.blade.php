@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold">Selamat Datang di Dasbor Admin!</h1>
                <p class="mt-2">Anda berhasil login sebagai Admin.</p>

                <div class="mt-6">
                    <a href="{{ route('admin.barang.index') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700">
                        Manajemen Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
