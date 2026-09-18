<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Test Tailwind</title>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-xl shadow-lg text-center">
        <h1 class="text-3xl font-bold text-blue-600 mb-4">
            Test Management Siswa
        </h1>

        <p class="text-gray-600">
            Tailwind CSS berhasil terhubung!
        </p>

        <button class="mt-6 px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Test Button
        </button>
    </div>

</body>
</html>
