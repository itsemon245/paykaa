@php
    $tagline = $landing->hero['title'];
    $fontFamily = 'Roboto';
@endphp
<!DOCTYPE html>
<html class="MktRoot"
      lang="en-US"
      data-js-controller="Page"
      data-page-id="Home"
      data-page-title="PayKaa | {!! $tagline !!}"
      style="--scrollbarWidth: 0px;">

<head>
    <script src="/js/animated-gradient.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const gradient = new Gradient();
            gradient.initGradient("#gradient-canvas");
        })
    </script>
    <title>PayKaa | {!! $tagline !!}</title>
    @include('partials.meta', ['landing' => $landing, 'tagline' => $tagline])
    @vite('resources/css/app.css')
    @include('landing.partials.styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @stack('styles')
    <style>
        @keyframes glow {
            0% {
                box-shadow: 0 0 0px theme('colors.blue.500');
            }

            25% {
                box-shadow: 5px -5px 10px theme('colors.green.500');
            }

            50% {
                box-shadow: 10px -10px 20px theme('colors.purple.500');
            }

            75% {
                box-shadow: 5px 5px 10px theme('colors.green.500');
            }

            100% {
                box-shadow: 0 0 0px theme('colors.blue.500');
            }
        }
    </style>
    <!-- Service Worker for PWA -->
    <script src="/build/registerSW.js"></script>
    <script defer
            src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="module"
            src="/assets/landing/Bootstrapper-ZNZHVLI3.js"></script>
</head>

<body class="MktBody theme-light flavor--Chroma accent--Blurple has-scrollbar"
      data-js-controller="Homepage">
    <div id="MktContent"
         class="">
        @include('landing.partials.header')
        <script>
            (() => {
                function displayContentForState(state) {
                    document.querySelectorAll(`template[data-mount-on-state="${state}"]`)
                        .forEach((template) => document.querySelectorAll(template.dataset.mountTarget)
                            .forEach((target) => {
                                while (target.firstChild) target.removeChild(target.firstChild);
                                target.appendChild(template.content.cloneNode(true));
                            }));
                }
                const siteAuthCookie = document.cookie.match(/(?:^|;) *site-auth=([^;]+);/);
                const hasLoggedInCookie = document.cookie.match(/(?:^|;) *__Secure-has_logged_in=([^;]+);/);
                const isLoggedIn = siteAuthCookie && siteAuthCookie[1] === '1';
                const hasLoggedIn = hasLoggedInCookie && hasLoggedInCookie[1];
                if (isLoggedIn) {
                    displayContentForState('logged-in');
                } else if (hasLoggedIn) {
                    displayContentForState('logged-out-existing');
                } else {
                    displayContentForState('logged-out-new');
                }
            })();
        </script>
        @include('landing.partials.hero', ['hero' => $landing->hero])
        @include('landing.partials.how-it-works', ['howItWorks' => $landing->how_it_works])
        @include('landing.partials.payment-methods')
        @include('landing.partials.footer', ['landing' => $landing])
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const links = document.querySelectorAll('[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
