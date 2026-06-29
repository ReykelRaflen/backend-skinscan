<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glowternity Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: { colors: { navy: '#0d1e42', gold: '#d4af37', bgSoft: '#f8f9fa' } }
            }
        }
    </script>
</head>
<body class="bg-navy flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-3xl shadow-2xl border border-white/10">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-navy text-gold mx-auto rounded-2xl flex items-center justify-center font-bold text-3xl mb-4 border border-gold/25">G</div>
            <h2 class="text-2xl font-bold text-navy">Glowternity</h2>
            <p class="text-sm text-slate-400 mt-1">Admin Panel Login</p>
        </div>

        @if ($errors->any())
            <div class="bg-rose-50 text-rose-600 p-4 rounded-xl text-sm mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-bold text-navy uppercase tracking-wider mb-2">Email</label>
                <input type="email" name="email" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-navy" placeholder="admin@glowternity.com" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-navy uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-navy" placeholder="••••••••" required>
            </div>
            <button type="submit" class="w-full py-3 bg-navy hover:bg-navy/95 text-white font-bold rounded-xl transition duration-150 shadow-lg shadow-navy/20">
                Masuk ke Panel
            </button>
        </form>
    </div>
</body>
</html>