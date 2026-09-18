{{--
    Shared sidebar navigation.
    Usage: @include('partials.sidebar', ['active' => 'siswa'])
    $active accepts: 'siswa' | 'profile'
--}}

<aside class="w-64 bg-blue-700 text-white p-6">

    <h1 class="text-xl font-bold mb-8">
        Dashboard Management Siswa
    </h1>

    <nav class="space-y-2">

        <a
            href="{{ route('siswa.index') }}"
            class="block px-4 py-3 rounded-lg
                {{ ($active ?? '') === 'siswa' ? 'bg-blue-800' : 'hover:bg-blue-800' }}"
        >
            Siswa
        </a>

        <a
            href="{{ route('profile.index') }}"
            class="block px-4 py-3 rounded-lg
                {{ ($active ?? '') === 'profile' ? 'bg-blue-800' : 'hover:bg-blue-800' }}"
        >
            Profile
        </a>

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button
                type="submit"
                class="w-full text-left px-4 py-3 rounded-lg hover:bg-blue-800"
            >
                Logout
            </button>

        </form>

    </nav>

</aside>
