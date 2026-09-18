<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Profile</title>
</head>

<body class="min-h-screen bg-gray-100">

    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        @include('partials.sidebar', ['active' => 'profile'])

        {{-- CONTENT --}}
        <main class="flex-1 p-8">

            <div class="max-w-2xl mx-auto">

                <h2 class="text-2xl font-bold text-gray-800 mb-8">
                    Profile
                </h2>

                <div class="bg-white rounded-xl shadow p-8">

                    <div class="flex flex-col items-center text-center">

                        <img
                            src="{{ asset($candidate['photo']) }}"
                            alt="Foto {{ $candidate['name'] }}"
                            class="w-32 h-32 rounded-full object-cover
                                border-4 border-blue-100 mb-6"
                        >

                        <h3 class="text-xl font-bold text-gray-800">
                            {{ $candidate['name'] }}
                        </h3>

                        <p class="text-blue-600 font-medium mt-1">
                            {{ $candidate['position'] }}
                        </p>

                    </div>

                    <div class="mt-8 border-t pt-6 grid grid-cols-1 gap-4">

                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">
                                Nama Kandidat
                            </p>
                            <p class="text-gray-800 font-medium">
                                {{ $candidate['name'] }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">
                                Posisi
                            </p>
                            <p class="text-gray-800 font-medium">
                                {{ $candidate['position'] }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>

</body>
</html>
