<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Data Siswa</title>

    <link
    rel="stylesheet"
    href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        @include('partials.sidebar', ['active' => 'siswa'])

        {{-- CONTENT --}}
        <main class="flex-1 p-8">

            <div class="mb-8 flex items-center justify-between">

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        DATA SISWA
                    </h2>

                    <p class="text-gray-500 mt-1">
                        Pendataan siswa Latiseducation dan Tutorindonesia
                    </p>
                </div>

                <div class="flex items-center gap-3">

                    <button
                        type="button"
                        id="exportExcel"
                        class="px-5 py-2.5 rounded-lg
                            bg-green-600 text-white
                            font-semibold hover:bg-green-700
                            transition"
                    >
                        Export Excel
                    </button>

                    <a
                        href="{{ route('siswa.create') }}"
                        class="px-5 py-2.5 rounded-lg
                            bg-blue-600 text-white
                            font-semibold hover:bg-blue-700
                            transition"
                    >
                        + Tambah Siswa
                    </a>

                </div>

            </div>

            @if (session('success'))

                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4">

                    <p class="text-sm text-green-700">
                        {{ session('success') }}
                    </p>

                </div>

            @endif

            {{-- DROPDOWN FILTER --}}
            <div class="mb-4 flex items-center justify-between">

                <div>

                    {{-- <label
                        for="filterLembaga"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Filter Lembaga
                    </label> --}}

                    <select
                        id="filterLembaga"
                        class="rounded-lg border border-gray-300 px-4 py-2
                            text-sm focus:border-blue-500
                            focus:ring-2 focus:ring-blue-200 outline-none"
                    >

                        <option value="">
                            Semua Lembaga
                        </option>

                        @foreach ($lembagas as $lembaga)

                            <option value="{{ $lembaga->nama_lembaga }}">
                                {{ $lembaga->nama_lembaga }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            {{-- DATA --}}
            <div class="bg-white rounded-xl shadow overflow-hidden">

                <div class="overflow-x-auto">

                    <table
                        id="siswaTable"
                        class="w-full text-sm text-left text-gray-600"
                    >

                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                            <tr>

                                <th class="px-6 py-4">
                                    No
                                </th>

                                <th class="px-6 py-4">
                                    NIS
                                </th>

                                <th class="px-6 py-4">
                                    Nama Siswa
                                </th>

                                <th class="px-6 py-4">
                                    Email
                                </th>

                                <th class="px-6 py-4">
                                    Lembaga
                                </th>

                                <th class="px-6 py-4">
                                    Foto
                                </th>

                                <th class="px-6 py-4">
                                    Action
                                </th>

                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($siswas as $siswa)

                                <tr class="border-b hover:bg-gray-50">

                                    <td class="px-6 py-4">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $siswa->nis }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $siswa->nama_siswa }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $siswa->email }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $siswa->lembaga->nama_lembaga ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">

                                        @if ($siswa->foto)

                                            <img
                                                src="{{ asset('storage/' . $siswa->foto) }}"
                                                alt="Foto {{ $siswa->nama_siswa }}"
                                                class="w-12 h-12 rounded-lg object-cover"
                                            >

                                        @else

                                            <span class="text-gray-400">
                                                Tidak ada
                                            </span>

                                        @endif

                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-2">

                                            <a
                                                href="{{ route('siswa.edit', $siswa->id) }}"
                                                class="px-3 py-2 rounded-lg bg-blue-600
                                                    text-white text-xs font-semibold
                                                    hover:bg-blue-700"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('siswa.destroy', $siswa->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="px-3 py-2 rounded-lg bg-red-600
                                                        text-white text-xs font-semibold
                                                        hover:bg-red-700"
                                                >
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </main>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {

            const table = $('#siswaTable').DataTable({

                pageLength: 10,

                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],

                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    zeroRecords: "Data tidak ditemukan",

                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }
                },

                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        targets: [0, 5, 6]
                    }
                ]
            });


            /*
            |--------------------------------------------------------------------------
            | SEARCH
            |--------------------------------------------------------------------------
            | Hanya mencari NIS dan Nama Siswa
            */

            let searchValue = '';
            let lembagaValue = '';


            $('#siswaTable_filter input')
                .off()
                .on('keyup', function () {

                    searchValue = this.value.toLowerCase();

                    table.draw();
                });


            $.fn.dataTable.ext.search.push(function (
                settings,
                data,
                dataIndex
            ) {

                if (settings.nTable.id !== 'siswaTable') {
                    return true;
                }

                if (searchValue === '') {
                    return true;
                }

                const nis = data[1].toLowerCase();
                const nama = data[2].toLowerCase();

                return (
                    nis.includes(searchValue) ||
                    nama.includes(searchValue)
                );
            });


            /*
            |--------------------------------------------------------------------------
            | FILTER LEMBAGA
            |--------------------------------------------------------------------------
            */

            $('#filterLembaga').on('change', function () {

                lembagaValue = this.value;

                table
                    .column(4)
                    .search(lembagaValue)
                    .draw();
            });


            /*
            |--------------------------------------------------------------------------
            | EXPORT EXCEL
            |--------------------------------------------------------------------------
            | Mengirim search + filter lembaga ke Laravel
            */

            $('#exportExcel').on('click', function () {

                const params = new URLSearchParams();

                if (searchValue !== '') {
                    params.set('search', searchValue);
                }

                if (lembagaValue !== '') {
                    params.set('lembaga', lembagaValue);
                }

                const url = "{{ route('siswa.export') }}";

                window.location.href =
                    url + '?' + params.toString();
            });

        });
    </script>

</body>
</html>
