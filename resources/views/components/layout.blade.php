<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50/50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentabahay | Rent Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full text-gray-800 font-sans antialiased selection:bg-blue-500 selection:text-white">

    <!-- Top Accent Bar -->
    <div class="h-1.5 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Navigation Header -->
        <header class="mb-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-gray-200/60">
            <div class="flex items-center gap-3">
                <!-- Brand Icon -->
                <div class="p-2 bg-blue-600 text-white rounded-xl shadow-md shadow-blue-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
                <div>
                    <!-- Updated App Title -->
                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">
                        renta<span class="text-blue-600 font-medium">bahay</span>
                    </h1>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex items-center gap-2">
                <a href="/" class="text-xs sm:text-sm font-semibold text-gray-600 hover:text-gray-900 px-4 py-2 rounded-xl hover:bg-gray-100 transition duration-200">
                    Dashboard
                </a>
                <a href="/tenants" class="text-xs sm:text-sm font-semibold text-gray-600 hover:text-gray-900 px-4 py-2 rounded-xl hover:bg-gray-100 transition duration-200">
                    Tenants
                </a>
                <a href="/form" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100/80 px-4 py-2 rounded-xl transition duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Entry
                </a>
            </nav>
        </header>

        <!-- Main Content -->
        <main>
            {{ $slot }} 
        </main>
    </div>

</body>
</html>