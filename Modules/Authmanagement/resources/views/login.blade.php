<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes authBgFade {
            0%, 17% { opacity: 1; }
            20%, 97% { opacity: 0; }
            100% { opacity: 0; }
        }
        .auth-bg-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            filter: blur(14px);
            transform: scale(1.08);
            opacity: 0;
            animation: authBgFade 25s infinite;
        }
        .auth-bg-slide--1 { animation-delay: 0s; }
        .auth-bg-slide--2 { animation-delay: 5s; }
        .auth-bg-slide--3 { animation-delay: 10s; }
        .auth-bg-slide--4 { animation-delay: 15s; }
        .auth-bg-slide--5 { animation-delay: 20s; }
    </style>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            "50":"#f0fdf4","100":"#dcfce7","200":"#bbf7d0","300":"#86efac","400":"#4ade80","500":"#22c55e","600":"#16a34a","700":"#15803d","800":"#166534","900":"#14532d","950":"#052e16"
                        }
                    }
                },
                fontFamily: {
                    'body': [
                        'Poppins',
                        'ui-sans-serif',
                        'system-ui',
                        '-apple-system',
                        'system-ui',
                        'Segoe UI',
                        'Roboto',
                        'Helvetica Neue',
                        'Arial',
                        'Noto Sans',
                        'sans-serif',
                        'Apple Color Emoji',
                        'Segoe UI Emoji',
                        'Segoe UI Symbol',
                        'Noto Color Emoji'
                    ],
                    'sans': [
                        'Poppins',
                        'ui-sans-serif',
                        'system-ui',
                        '-apple-system',
                        'system-ui',
                        'Segoe UI',
                        'Roboto',
                        'Helvetica Neue',
                        'Arial',
                        'Noto Sans',
                        'sans-serif',
                        'Apple Color Emoji',
                        'Segoe UI Emoji',
                        'Segoe UI Symbol',
                        'Noto Color Emoji'
                    ]
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 font-sans">
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="grid min-h-screen grid-cols-1 lg:grid-cols-2">
        <div class="hidden lg:flex relative overflow-hidden text-white">
            <div class="absolute inset-0">
                <div class="auth-bg-slide auth-bg-slide--1" style="background-image:url('/assets/image/black-pregnant-women-posing_23-2151446117.jpg')"></div>
                <div class="auth-bg-slide auth-bg-slide--2" style="background-image:url('/assets/image/black-pregnant-women-posing_23-2151446121.jpg')"></div>
                <div class="auth-bg-slide auth-bg-slide--3" style="background-image:url('/assets/image/black-pregnant-women-posing_23-2151446129.jpg')"></div>
                <div class="auth-bg-slide auth-bg-slide--4" style="background-image:url('/assets/image/black-pregnant-women-posing_23-2151446130.jpg')"></div>
                <div class="auth-bg-slide auth-bg-slide--5" style="background-image:url('/assets/image/young-asian-pregnant-woman-holding-her-belly-talking-with-her-child-mom-feeling-happy-smiling-positive-peaceful-while-take-care-baby-pregnancy-near-window-living-room-home_7861-2180.jpg')"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-gray-900/90 via-gray-900/85 to-gray-800/80"></div>
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(34,197,94,0.20),transparent_55%),radial-gradient(ellipse_at_bottom_right,rgba(34,197,94,0.10),transparent_60%)]"></div>
            </div>

            <div class="relative z-10 w-full p-10 xl:p-16">
                <a href="{{ url('/') }}" class="flex items-center mb-10 text-2xl font-semibold text-white">
                    <img class="w-10 h-10 mr-3 rounded-lg object-contain bg-white/10 p-1" src="{{ asset('assets/image/LOGO-MALKIA-KONNECT.jpg') }}" alt="{{ config('app.name') }} logo">
                    {{ config('app.name') }}
                </a>

                <div class="space-y-8 max-w-xl">
                    <div>
                        <h2 class="text-2xl font-bold">Get started quickly</h2>
                        <p class="text-gray-300 mt-2">Ingia kwa haraka na uendelee na kazi zako.</p>
                    </div>
                    <div class="space-y-6">
                        <div class="flex gap-3">
                            <div class="mt-1 h-5 w-5 rounded-full bg-primary-600"></div>
                            <div>
                                <div class="font-semibold">Support any business model</div>
                                <div class="text-gray-300 text-sm">Muonekano mzuri na salama kwenye mazingira tofauti.</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="mt-1 h-5 w-5 rounded-full bg-primary-600"></div>
                            <div>
                                <div class="font-semibold">Join millions of businesses</div>
                                <div class="text-gray-300 text-sm">Admin portal iliyoboreshwa kwa utendaji na uthabiti.</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="mt-1 h-5 w-5 rounded-full bg-primary-600"></div>
                            <div>
                                <div class="font-semibold">Secure access</div>
                                <div class="text-gray-300 text-sm">Rate limiting na session-based authentication.</div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-10 text-gray-400 text-sm flex gap-5">
                        <span>About</span>
                        <span>Terms &amp; Conditions</span>
                        <span>Contact</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col items-center justify-center px-6 py-10">
            <a href="{{ url('/') }}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white lg:hidden">
                <img class="w-9 h-9 mr-2 rounded-lg object-contain bg-primary-600/10 p-1" src="{{ asset('assets/image/LOGO-MALKIA-KONNECT.jpg') }}" alt="{{ config('app.name') }} logo">
                {{ config('app.name') }}
            </a>

            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in
                    </h1>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <button type="button" class="w-full inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-primary-100 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-primary-900/30">
                            <svg class="h-5 w-5" viewBox="0 0 48 48" aria-hidden="true">
                                <path fill="#EA4335" d="M24 9.5c3.05 0 5.8 1.05 7.95 2.77l5.45-5.45C34.06 3.91 29.33 2 24 2 14.8 2 6.98 7.2 3.24 14.76l6.66 5.17C11.44 14.28 17.22 9.5 24 9.5z"/>
                                <path fill="#34A853" d="M46.1 24.55c0-1.57-.14-3.07-.4-4.55H24v8.62h12.4c-.54 2.9-2.2 5.36-4.7 7.02l7.18 5.57C43.06 37.34 46.1 31.5 46.1 24.55z"/>
                                <path fill="#4A90E2" d="M9.9 28.93a14.5 14.5 0 0 1 0-9.86l-6.66-5.17A23.96 23.96 0 0 0 2 24c0 3.92.94 7.63 2.6 10.9l7.3-5.97z"/>
                                <path fill="#FBBC05" d="M24 46c5.33 0 9.82-1.77 13.1-4.8l-7.18-5.57c-2 1.35-4.56 2.15-5.92 2.15-6.78 0-12.56-4.78-14.1-11.43l-7.3 5.97C6.98 40.8 14.8 46 24 46z"/>
                            </svg>
                            Continue with Google
                        </button>
                        <button type="button" class="w-full inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-primary-100 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-primary-900/30">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor">
                                <path d="M16.365 1.43c0 1.14-.42 2.08-1.25 2.82-.99.9-2.2 1.43-3.48 1.33-.11-1.09.43-2.2 1.32-3.02.9-.84 2.26-1.43 3.41-1.13z"/>
                                <path d="M20.86 17.2c-.6 1.38-.88 2-1.64 3.23-1.05 1.67-2.53 3.75-4.38 3.77-1.64.02-2.06-1.08-4.3-1.07-2.23.01-2.7 1.09-4.33 1.07-1.85-.02-3.27-1.88-4.32-3.55-2.95-4.7-3.26-10.22-1.44-13.02 1.29-2 3.34-3.17 5.29-3.17 1.99 0 3.24 1.09 4.89 1.09 1.6 0 2.58-1.1 4.88-1.1 1.73 0 3.56.94 4.84 2.56-4.26 2.34-3.57 8.43.51 10.19z"/>
                            </svg>
                            Continue with Apple
                        </button>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="h-px w-full bg-gray-200 dark:bg-gray-700"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">or</span>
                        <div class="h-px w-full bg-gray-200 dark:bg-gray-700"></div>
                    </div>

                    @if ($errors->any())
                        <div class="rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-800 dark:border-red-800/50 dark:bg-red-900/20 dark:text-red-200">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('auth.login.submit') }}">
                        @csrf

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required autocomplete="email" autofocus>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required autocomplete="current-password">
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" name="remember" value="1" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
