<!DOCTYPE html>

<html class="scroll-smooth" lang="id"><head>
<script>
    if (localStorage.theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
</script>
<style>
  .fade-in-section {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    will-change: opacity, transform;
  }
  .fade-in-section.is-visible {
    opacity: 1;
    transform: none;
  }
</style>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Lexalink - Riset Hukum Modern</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body-md text-body-md overflow-x-hidden">
<!-- TopAppBar -->
<header class="fixed top-0 w-full z-50 bg-transparent border-b border-white/5 transition-all duration-300 h-16 flex justify-between items-center px-margin-mobile" id="main-header">
<div class="max-w-container-max w-full mx-auto flex justify-between items-center">
<a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
<img alt="LexaLink Logo" class="h-8 w-auto transition-all duration-200 group-hover:scale-105 object-contain" src="{{ asset('img/logolexa.png') }}"/>
<span class="text-xl font-extrabold tracking-tight text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">LexaLink</span>
</a>
<div class="hidden md:flex items-center gap-8">
<a class="text-label-sm {{ request()->routeIs('home') ? 'text-primary font-bold' : 'text-gray-700 dark:text-on-surface-variant hover:text-primary' }} transition-colors" href="{{ route('home') }}">Beranda</a>
<a class="text-label-sm {{ request()->routeIs('ecosystem') ? 'text-primary font-bold' : 'text-gray-700 dark:text-on-surface-variant hover:text-primary' }} transition-colors flex items-center gap-1" href="{{ route('ecosystem') }}">Ecosystem <span class="material-symbols-outlined text-[16px]">expand_more</span></a>
<a class="text-label-sm {{ request()->routeIs('tentang-kami') ? 'text-primary font-bold' : 'text-gray-700 dark:text-on-surface-variant hover:text-primary' }} transition-colors" href="{{ route('tentang-kami') }}">Tentang Kami</a>
<a class="text-label-sm {{ request()->routeIs('resources.page') ? 'text-primary font-bold' : 'text-gray-700 dark:text-on-surface-variant hover:text-primary' }} transition-colors" href="{{ route('resources.page') }}">Resources</a>
<a class="text-label-sm {{ request()->routeIs('event-academy') ? 'text-primary font-bold' : 'text-gray-700 dark:text-on-surface-variant hover:text-primary' }} transition-colors" href="{{ route('event-academy') }}">Event & Academy</a>
<a class="text-label-sm {{ request()->routeIs('opini-berita') ? 'text-primary font-bold' : 'text-gray-700 dark:text-on-surface-variant hover:text-primary' }} transition-colors" href="{{ route('opini-berita') }}">Opini & Berita</a>
<a class="text-label-sm {{ request()->routeIs('kontak') ? 'text-primary font-bold' : 'text-gray-700 dark:text-on-surface-variant hover:text-primary' }} transition-colors" href="{{ route('kontak') }}">Kontak</a>
</div>
<div class="flex items-center gap-4">
@auth
<a href="{{ auth()->user()->role === 'client' ? route('dashboard') : route('admin.dashboard') }}" class="hidden md:flex items-center gap-2 text-label-md font-bold text-[#001F3F] dark:text-primary hover:text-primary/80 transition-colors">
<img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=FFFFFF&background=0984e3" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover border border-primary/30" />
<span>{{ auth()->user()->name }}</span>
</a>
@else
<a href="{{ route('login') }}" class="hidden md:block text-label-md font-bold text-[#001F3F] dark:text-primary hover:text-primary/80 transition-colors">Login</a>
@endauth
<!-- <button id="theme-toggle" class="text-[#001F3F] dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 rounded-full p-2 transition-colors focus:outline-none flex items-center justify-center">
    <span id="theme-toggle-dark-icon" class="hidden material-symbols-outlined">dark_mode</span>
    <span id="theme-toggle-light-icon" class="hidden material-symbols-outlined">light_mode</span>
</button> -->
<button class="md:hidden text-[#001F3F] dark:text-primary p-1 focus:outline-none" id="menu-toggle">
<span class="material-symbols-outlined text-3xl">menu</span>
</button>
<span class="material-symbols-outlined text-[#001F3F] dark:text-primary scale-95 active:opacity-80 transition-all cursor-pointer">gavel</span>
</div>
</div>
</header>
<!-- Mobile Menu Overlay -->
<div class="fixed inset-0 z-[60] bg-white dark:bg-surface-container opacity-0 pointer-events-none translate-x-full" id="mobile-menu">
<div class="flex flex-col h-full p-6">
<div class="flex justify-between items-center mb-12">
<a href="{{ route('home') }}" class="flex items-center gap-2.5">
<img alt="LexaLink Logo" class="h-8 w-auto object-contain" src="{{ asset('img/logolexa.png') }}"/>
<span class="text-xl font-extrabold tracking-tight text-gray-900 dark:text-white">LexaLink</span>
</a>
<button class="text-primary p-1" id="menu-close">
<span class="material-symbols-outlined text-3xl">close</span>
</button>
</div>
<nav class="flex flex-col gap-4">
<a class="text-base font-medium {{ request()->routeIs('home') ? 'text-primary font-bold' : 'text-gray-900 dark:text-white' }} border-b border-gray-100 dark:border-white/10 pb-3" href="{{ route('home') }}">Beranda</a>
<a class="text-base font-medium {{ request()->routeIs('ecosystem') ? 'text-primary font-bold' : 'text-gray-900 dark:text-white' }} border-b border-gray-100 dark:border-white/10 pb-3 flex items-center justify-between" href="{{ route('ecosystem') }}">Ecosystem <span class="material-symbols-outlined text-[18px]">expand_more</span></a>
<a class="text-base font-medium {{ request()->routeIs('tentang-kami') ? 'text-primary font-bold' : 'text-gray-900 dark:text-white' }} border-b border-gray-100 dark:border-white/10 pb-3" href="{{ route('tentang-kami') }}">Tentang Kami</a>
<a class="text-base font-medium {{ request()->routeIs('resources.page') ? 'text-primary font-bold' : 'text-gray-900 dark:text-white' }} border-b border-gray-100 dark:border-white/10 pb-3" href="{{ route('resources.page') }}">Resources</a>
<a class="text-base font-medium {{ request()->routeIs('event-academy') ? 'text-primary font-bold' : 'text-gray-900 dark:text-white' }} border-b border-gray-100 dark:border-white/10 pb-3" href="{{ route('event-academy') }}">Event & Academy</a>
<a class="text-base font-medium {{ request()->routeIs('opini-berita') ? 'text-primary font-bold' : 'text-gray-900 dark:text-white' }} border-b border-gray-100 dark:border-white/10 pb-3" href="{{ route('opini-berita') }}">Opini & Berita</a>
<a class="text-base font-medium {{ request()->routeIs('kontak') ? 'text-primary font-bold' : 'text-gray-900 dark:text-white' }} border-b border-gray-100 dark:border-white/10 pb-3" href="{{ route('kontak') }}">Kontak</a>
@auth
<a class="text-base font-medium text-primary pt-2 flex items-center gap-3" href="{{ auth()->user()->role === 'client' ? route('dashboard') : route('admin.dashboard') }}">
<img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=FFFFFF&background=0984e3" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover border border-primary/30 shadow-sm" />
Profil Saya
</a>
@else
<a class="text-base font-bold text-primary pt-2" href="{{ route('login') }}">Login</a>
@endauth
</nav>
<div class="mt-auto pb-12">
<button class="w-full bg-primary text-on-primary py-4 rounded-lg font-bold">Jadwalkan Demo</button>
</div>
</div>
</div>
<main class="pt-16">
    @yield('content')
</main>
<!-- Footer -->
<footer class="w-full bg-white dark:bg-[#050B10] border-t border-gray-200 dark:border-white/5 pt-16 pb-12">
<div class="max-w-container-max mx-auto px-margin-mobile">
<div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
<!-- Brand Column -->
<div class="md:col-span-4 flex flex-col gap-6">
<div class="flex items-center gap-2.5 self-start">
<img alt="LexaLink Logo" class="h-8 md:h-9 w-auto object-contain" src="{{ asset('img/logolexa.png') }}"/>
<span class="text-xl font-extrabold tracking-tight text-gray-900 dark:text-white">LexaLink</span>
</div>
<p class="text-gray-600 dark:text-on-surface-variant text-body-md leading-relaxed">
                    Platform riset hukum berbasis AI dengan akses ke jutaan dokumen putusan pengadilan dan peraturan perundang-undangan.
                </p>
<div class="flex gap-3.5 pt-2">
<a class="w-10 h-10 rounded-xl bg-blue-50 hover:bg-blue-600 dark:bg-white/10 dark:hover:bg-blue-600 text-blue-700 hover:text-white dark:text-gray-300 dark:hover:text-white flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5 border border-blue-200/60 dark:border-white/10" href="#" aria-label="Facebook">
<svg class="w-5 h-5 fill-current" viewbox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path></svg>
</a>
<a class="w-10 h-10 rounded-xl bg-blue-50 hover:bg-blue-600 dark:bg-white/10 dark:hover:bg-blue-600 text-blue-700 hover:text-white dark:text-gray-300 dark:hover:text-white flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5 border border-blue-200/60 dark:border-white/10" href="#" aria-label="Twitter / X">
<svg class="w-5 h-5 fill-current" viewbox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"></path></svg>
</a>
<a class="w-10 h-10 rounded-xl bg-blue-50 hover:bg-blue-600 dark:bg-white/10 dark:hover:bg-blue-600 text-blue-700 hover:text-white dark:text-gray-300 dark:hover:text-white flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5 border border-blue-200/60 dark:border-white/10" href="#" aria-label="Instagram">
<svg class="w-5 h-5 fill-current" viewbox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.981 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path></svg>
</a>
</div>
</div>
<!-- Links Columns -->
<div class="md:col-span-8 grid grid-cols-2 sm:grid-cols-3 gap-8">
<div>
<h4 class="text-gray-900 dark:text-white font-bold mb-6">Fitur</h4>
<ul class="flex flex-col gap-4">
<li><a class="text-gray-600 dark:text-on-surface-variant hover:text-primary transition-colors text-body-md" href="#">Database Peraturan</a></li>
<li><a class="text-gray-600 dark:text-on-surface-variant hover:text-primary transition-colors text-body-md" href="#">Putusan Pengadilan</a></li>
<li><a class="text-gray-600 dark:text-on-surface-variant hover:text-primary transition-colors text-body-md" href="#">Legal Drafting</a></li>
<li><a class="text-gray-600 dark:text-on-surface-variant hover:text-primary transition-colors text-body-md" href="#">Document Review</a></li>
</ul>
</div>
<div>
<h4 class="text-gray-900 dark:text-white font-bold mb-6">Perusahaan</h4>
<ul class="flex flex-col gap-4">
<li><a class="text-gray-600 dark:text-on-surface-variant hover:text-primary transition-colors text-body-md" href="#">Harga</a></li>
<li><a class="text-gray-600 dark:text-on-surface-variant hover:text-primary transition-colors text-body-md" href="#">Referral Program</a></li>
<li><a class="text-gray-600 dark:text-on-surface-variant hover:text-primary transition-colors text-body-md" href="#">Student Plan</a></li>
<li><a class="text-gray-600 dark:text-on-surface-variant hover:text-primary transition-colors text-body-md" href="#">Kontak</a></li>
</ul>
</div>
<div class="col-span-2 sm:col-span-1">
<h4 class="text-gray-900 dark:text-white font-bold mb-6">Alamat</h4>
<p class="text-gray-600 dark:text-on-surface-variant text-body-md leading-relaxed mb-6">
                        The Kuningan Place, IMO 1&amp;2 Jl. Kuningan Utama Lot 15. Jakarta Selatan, 12960. DKI Jakarta
                    </p>
<div class="flex flex-col gap-1">
<a class="text-primary hover:underline text-body-md" href="tel:+628999085947">+62 89-9908-5947</a>
<a class="text-primary hover:underline text-body-md" href="mailto:admin@hukumku.id">admin@hukumku.id</a>
</div>
</div>
</div>
</div>
<!-- Bottom Footer -->
<div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
<p class="text-label-sm text-gray-600 dark:text-on-surface-variant">© 2026 Nama PT by Hukumku. All rights reserved.</p>
<div class="flex gap-8">
<a class="text-label-sm text-gray-600 dark:text-on-surface-variant hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
<a class="text-label-sm text-gray-600 dark:text-on-surface-variant hover:text-primary transition-colors" href="#">Syarat &amp; Ketentuan</a>
</div>
</div>
</div>
</footer>
<!-- BottomNavBar (Mobile Only) -->
<!-- <nav class="md:hidden fixed bottom-0 w-full z-50 bg-white dark:bg-surface-container border-t border-gray-200 dark:border-border-subtle rounded-t-xl h-16 flex justify-around items-center px-2 shadow-lg">
<a class="flex flex-col items-center justify-center bg-secondary-container text-on-secondary-container rounded-full px-4 py-1 Active: scale-95 duration-150" href="#">
<span class="material-symbols-outlined">search</span>
<span class="text-label-sm font-label-sm">Search</span>
</a>
<a class="flex flex-col items-center justify-center text-gray-600 dark:text-on-surface-variant hover:bg-surface-container-highest transition-colors" href="#">
<span class="material-symbols-outlined">edit_note</span>
<span class="text-label-sm font-label-sm">Draft</span>
</a>
<a class="flex flex-col items-center justify-center text-gray-600 dark:text-on-surface-variant hover:bg-surface-container-highest transition-colors" href="#">
<span class="material-symbols-outlined">security</span>
<span class="text-label-sm font-label-sm">Risks</span>
</a>
<a class="flex flex-col items-center justify-center text-gray-600 dark:text-on-surface-variant hover:bg-surface-container-highest transition-colors" href="#">
<span class="material-symbols-outlined">account_circle</span>
<span class="text-label-sm font-label-sm">Profile</span>
</a>
</nav> -->
<script>
    // Navbar Scroll Interaction
    const header = document.getElementById('main-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('nav-scrolled');
            header.classList.remove('bg-transparent');
        } else {
            header.classList.remove('nav-scrolled');
            header.classList.add('bg-transparent');
        }
    });

    // Mobile Menu Toggle
    const menuToggle = document.getElementById('menu-toggle');
    const menuClose = document.getElementById('menu-close');
    const mobileMenu = document.getElementById('mobile-menu');

    function openMenu() {
        mobileMenu.classList.remove('translate-x-full', 'opacity-0', 'pointer-events-none');
        mobileMenu.classList.add('translate-x-0', 'opacity-100');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        mobileMenu.classList.add('translate-x-full', 'opacity-0', 'pointer-events-none');
        mobileMenu.classList.remove('translate-x-0', 'opacity-100');
        document.body.style.overflow = '';
    }

    menuToggle.addEventListener('click', openMenu);
    menuClose.addEventListener('click', closeMenu);

    // Close menu when clicking links
    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Tonal layers micro-interactions
    document.querySelectorAll('.tonal-layer-1, .tonal-layer-2').forEach(card => {
        card.addEventListener('mousemove', e => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });

    // Fade-in effect on scroll
    const fadeObserverOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.15
    };

    const fadeObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, fadeObserverOptions);

    // Apply fade-in to all sections except the Hero section (which is the first one)
    document.querySelectorAll('section:not(:first-of-type)').forEach((section) => {
        section.classList.add('fade-in-section');
        fadeObserver.observe(section);
    });

    // Theme toggle logic
    const themeToggleBtn = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

    if (document.documentElement.classList.contains('dark')) {
        lightIcon.classList.remove('hidden');
    } else {
        darkIcon.classList.remove('hidden');
    }

    themeToggleBtn.addEventListener('click', function() {
        darkIcon.classList.toggle('hidden');
        lightIcon.classList.toggle('hidden');

        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    });
</script>
</body></html>
