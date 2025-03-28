<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif
    @livewireStyles


</head>

<body class="bg-gray-50 font-sans">
    <nav class="bg-gray-600 shadow-md">
        <div class="container mx-auto px-4 py-3">
            <h1 class="text-white text-xl font-bold">تطبيق المهام</h1>
        </div>
    </nav>
    <!-- Simple Navbar with Title Only -->
    
    <div class="container mx-auto max-w-md p-4">
        <!-- العنوان -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">إنشاء مهمة جديدة</h1>
        <livewire:add_todo />
        <livewire:todo_list />
    </div>
    @livewireScripts

</body>

</html>