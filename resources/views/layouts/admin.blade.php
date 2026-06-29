<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glowternity Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#0D1E42',
                        gold: '#D4AF37',
                        goldLight: '#DFBA81',
                        bgSoft: '#F8F9FA'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-bgSoft text-slate-800 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-64 bg-navy text-white flex flex-col justify-between flex-shrink-0">
            <div>
                <div class="p-6 border-b border-white/10 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gold flex items-center justify-center font-bold text-navy">G</div>
                    <span class="text-lg font-bold tracking-wider text-goldLight">Glowternity</span>
                </div>
                <nav class="p-4 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-150 {{ Request::routeIs('admin.dashboard') ? 'bg-gold text-navy font-bold' : 'hover:bg-white/5' }}">
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-150 {{ Request::routeIs('admin.users*') ? 'bg-gold text-navy font-bold' : 'hover:bg-white/5' }}">
                        <span>Data Pengguna</span>
                    </a>
                    <a href="{{ route('admin.rekomendasi.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-150 {{ Request::routeIs('admin.rekomendasi*') ? 'bg-gold text-navy font-bold' : 'hover:bg-white/5' }}">
                        <span>Tips Rekomendasi</span>
                    </a>
                </nav>
            </div>
            <div class="p-4 border-t border-white/10">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-rose-600 hover:bg-rose-700 text-white rounded-xl font-bold transition duration-150">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white border-b border-slate-100 p-6 flex justify-between items-center sticky top-0 z-10">
                <h1 class="text-xl font-bold text-navy">@yield('page_title')</h1>
                <div class="text-sm font-medium text-slate-500">Administrator</div>
            </header>
            <main class="p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>