<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-left">
        <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight uppercase">Welcome Back</h2>
        <p class="text-slate-500 dark:text-slate-400 text-xs mt-1 font-medium">Sign in to the portal to continue</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-700 dark:text-slate-300 uppercase mb-1.5 tracking-widest">Email Address</label>
            <input id="email" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/10 transition-all" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <div>
            <label class="block text-[10px] font-black text-slate-700 dark:text-slate-300 uppercase mb-1.5 tracking-widest">Password</label>
            <input id="password" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/10 transition-all" type="password" name="password" required />
        </div>

        <div class="flex items-center justify-between py-1">
            <label class="inline-flex items-center gap-2 text-xs font-medium text-slate-600 dark:text-slate-400 cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 dark:border-slate-700 text-blue-600" name="remember">
                <span>Remember me</span>
            </label>
            <a class="text-xs text-blue-600 dark:text-blue-400 font-bold hover:underline" href="{{ route('password.request') }}">Forgot?</a>
        </div>

        <button type="submit" class="w-full rounded-xl bg-blue-600 px-6 py-3.5 text-[11px] font-black uppercase tracking-widest text-white shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition-all active:scale-95">
            ➜ Access Account
        </button>

        <div class="text-center pt-4 border-t border-slate-100 dark:border-slate-800">
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 font-bold hover:underline">Sign Up</a>
            </p>
        </div>
    </form>
</x-guest-layout>