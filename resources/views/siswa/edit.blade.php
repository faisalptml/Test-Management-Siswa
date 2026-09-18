<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Edit Siswa</title>
</head>

<body class="min-h-screen bg-gray-100">

    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        @include('partials.sidebar', ['active' => 'siswa'])


        {{-- CONTENT --}}
        <main class="flex-1 p-8">

            <div class="max-w-3xl mx-auto">

                <div class="mb-6">

                    <h2 class="text-2xl font-bold text-gray-800">
                        Edit Data Siswa
                    </h2>

                    <p class="text-gray-500 mt-1">
                        Perbarui data siswa
                    </p>

                </div>


                <div class="bg-white rounded-xl shadow p-8">

                    <form
                        action="{{ route('siswa.update', $siswa->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        @method('PUT')


                        {{-- LEMBAGA --}}
                        <div class="mb-5">

                            <label
                                for="lembaga_id"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Lembaga
                            </label>

                            <select
                                id="lembaga_id"
                                name="lembaga_id"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2.5
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                       outline-none"
                            >

                                <option value="">
                                    -- Pilih Lembaga --
                                </option>

                                @foreach ($lembagas as $lembaga)

                                    <option
                                        value="{{ $lembaga->id }}"
                                        {{ old('lembaga_id', $siswa->lembaga_id) == $lembaga->id ? 'selected' : '' }}
                                    >
                                        {{ $lembaga->nama_lembaga }}
                                    </option>

                                @endforeach

                            </select>

                            @error('lembaga_id')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- NIS --}}
                        <div class="mb-5">

                            <label
                                for="nis"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                NIS
                            </label>

                            <input
                                type="text"
                                id="nis"
                                name="nis"
                                value="{{ old('nis', $siswa->nis) }}"
                                inputmode="numeric"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2.5
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                       outline-none"
                                placeholder="Masukkan NIS"
                            >

                            @error('nis')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- NAMA --}}
                        <div class="mb-5">

                            <label
                                for="nama_siswa"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Nama Siswa
                            </label>

                            <input
                                type="text"
                                id="nama_siswa"
                                name="nama_siswa"
                                value="{{ old('nama_siswa', $siswa->nama_siswa) }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2.5
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                       outline-none"
                                placeholder="Masukkan nama siswa"
                            >

                            @error('nama_siswa')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- EMAIL --}}
                        <div class="mb-5">

                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $siswa->email) }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2.5
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                       outline-none"
                                placeholder="nama@email.com"
                            >

                            @error('email')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- PHOTO --}}
                        <div class="mb-6">

                            <label
                                for="foto"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Foto
                            </label>

                            @if ($siswa->foto)

                                <div class="mb-3">

                                    <p class="text-sm text-gray-500 mb-2">
                                        Foto saat ini:
                                    </p>

                                    <img
                                        src="{{ asset('storage/' . $siswa->foto) }}"
                                        alt="Foto {{ $siswa->nama_siswa }}"
                                        class="w-24 h-24 object-cover rounded-lg border"
                                    >

                                </div>

                            @endif

                            <input
                                type="file"
                                id="foto"
                                name="foto"
                                accept=".jpg,.jpeg,.png"
                                class="w-full rounded-lg border border-gray-300
                                       px-4 py-2.5 bg-white"
                            >

                            <p class="mt-1 text-xs text-gray-500">
                                Kosongkan jika tidak ingin mengganti foto.
                                Format JPG/PNG, maksimal 100KB.
                            </p>

                            @error('foto')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- BUTTON --}}
                        <div class="flex gap-3">

                            <a
                                href="{{ route('siswa.index') }}"
                                class="px-5 py-2.5 rounded-lg border border-gray-300
                                       text-gray-700 hover:bg-gray-50"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="px-5 py-2.5 rounded-lg bg-blue-600
                                       text-white font-semibold
                                       hover:bg-blue-700 transition"
                            >
                                Update
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </main>

    </div>

</body>

</html>
