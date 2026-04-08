<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PiggyNote</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #fdf2f8; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 bg-gradient-to-br from-pink-50 to-purple-50">
    <div class="w-full max-w-md">
        <div class="flex flex-col items-center mb-10">
            <a href="/" class="flex items-center gap-3">
                <div class="bg-pink-500 p-2 rounded-2xl shadow-lg shadow-pink-200 text-white">
                    <i data-lucide="piggy-bank" class="w-8 h-8"></i>
                </div>
                <span class="text-3xl font-bold text-gray-800">Piggy<span class="text-pink-600">Note</span></span>
            </a>
            <p class="text-gray-500 mt-4 font-medium">Join us and start tracking your wealth!</p>
        </div>

        <div class="glass p-8 rounded-[32px] shadow-2xl">
            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf
                <div class="space-y-1">
                    <label class="text-sm font-bold text-gray-600 ml-1">Full Name</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="John Doe" class="w-full bg-white border-2 border-transparent focus:border-pink-500 outline-none rounded-2xl py-3.5 pl-12 pr-6 font-medium transition-all shadow-sm">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-bold text-gray-600 ml-1">Email Address</label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com" class="w-full bg-white border-2 border-transparent focus:border-pink-500 outline-none rounded-2xl py-3.5 pl-12 pr-6 font-medium transition-all shadow-sm">
                    </div>
                    @error('email') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-bold text-gray-600 ml-1">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full bg-white border-2 border-transparent focus:border-pink-500 outline-none rounded-2xl py-3.5 pl-12 pr-6 font-medium transition-all shadow-sm">
                    </div>
                    @error('password') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-bold text-gray-600 ml-1">Confirm Password</label>
                    <div class="relative">
                        <i data-lucide="shield-check" class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                        <input type="password" name="password_confirmation" required placeholder="••••••••" class="w-full bg-white border-2 border-transparent focus:border-pink-500 outline-none rounded-2xl py-3.5 pl-12 pr-6 font-medium transition-all shadow-sm">
                    </div>
                </div>

                <button type="submit" class="w-full bg-pink-600 text-white py-4 rounded-2xl font-bold text-lg shadow-xl shadow-pink-100 hover:bg-pink-700 transition-all hover:translate-y-[-2px] active:translate-y-0 mt-4">
                    Create Account
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-gray-500">Already have an account? 
                    <a href="{{ route('login') }}" class="font-bold text-pink-600 hover:underline">Sign In</a>
                </p>
            </div>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
