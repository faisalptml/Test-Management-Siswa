<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Login - Management Siswa</title>
</head>
<body>

<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    <div class="w-full max-w-md px-4">

        <div class="bg-white rounded-2xl shadow-lg p-8">

            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">
                    Selamat Datang
                </h1>

                <p class="text-gray-500 mt-2">
                    Silakan login untuk melanjutkan
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 p-4">
                    <ul class="text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <form action="{{ route('login') }}" method="POST">

                @csrf

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
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                               outline-none"
                        placeholder="admin@example.com"
                    >
                </div>

                <div class="mb-6">
                    <label
                        for="password"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Password
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="w-full rounded-lg border border-gray-300 pl-4 pr-11 py-2.5
                                   focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                   outline-none"
                            placeholder="Masukkan password"
                        >

                        <button
                            type="button"
                            id="togglePassword"
                            class="absolute inset-y-0 right-0 flex items-center px-3
                                   text-gray-400 hover:text-gray-600"
                            aria-label="Tampilkan password"
                        >
                            {{-- Eye icon (shown when password is hidden) --}}
                            <svg id="iconEyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                            {{-- Eye-off icon (shown when password is visible) --}}
                            <svg id="iconEyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-lg bg-blue-600 py-2.5
                           font-semibold text-white
                           hover:bg-blue-700 transition"
                >
                    Login
                </button>

            </form>

        </div>

    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const iconEyeOpen = document.getElementById('iconEyeOpen');
        const iconEyeClosed = document.getElementById('iconEyeClosed');

        togglePassword.addEventListener('click', function () {
            const isHidden = passwordInput.type === 'password';

            passwordInput.type = isHidden ? 'text' : 'password';

            iconEyeOpen.classList.toggle('hidden', isHidden);
            iconEyeClosed.classList.toggle('hidden', !isHidden);

            togglePassword.setAttribute(
                'aria-label',
                isHidden ? 'Sembunyikan password' : 'Tampilkan password'
            );
        });
    </script>

</body>
</html>
