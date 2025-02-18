@php
    $tagline = "Protecting \r\n your money \r\n is our \r\n responsibility";
    $fontFamily = 'Roboto';
@endphp
<!DOCTYPE html>
<html class="MktRoot"
      lang="en-US"
      data-js-controller="Page"
      data-page-id="Home"
      data-page-title="Stripe | {!! $tagline !!}"
      style="--scrollbarWidth: 0px;">

<head>
    <meta http-equiv="Content-Type"
          content="text/html; charset=UTF-8">
        <script src="/js/animated-gradient.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const gradient = new Gradient();
            gradient.initGradient("#gradient-canvas");
        })
    </script>

    <script>
        window.__capturedErrors = [];
        window.onerror = function(message, url, line, column, error) {
            __capturedErrors.push(error);
        };
        window.onunhandledrejection = function(evt) {
            __capturedErrors.push(evt.reason);
        }
    </script>
    <meta name="sentry-config"
          data-js-dsn="https://7cd38b0eb2b348b39a6002cc768f91c7@errors.stripe.com/376"
          data-js-release="33d11bfcfc6166d969156df77e2634af7d642cd4"
          data-js-environment="production"
          data-js-project="mkt">
    <meta name="experiment-treatments"
          content="acquisition_top_cta_change.control.ursula.2366e0d8-7df7-49da-aeab-0ce85f705010.a,wpp_homepage_title_copy.control.ursula.977fe5db-7336-44a9-b422-06a57add2f68.a,acquisition_chat_on_dot_com.control.ursula.5ec0ab27-56bc-47eb-896b-45f9127f8a1e.a,acquisition_jp_homepage_holdback.control.ursula.4bca77c7-1c8a-4e2b-a0f6-35fe52869e9c.a,acquisition_text_scaling_with_viewport_sizing.treatment.ursula.92435fc2-230c-44e9-b4dd-c7df6e5e699b.a,acquisition_desktop_nav_with_carets.control.ursula.1cf17dbd-58e1-4320-a106-31b144c31db8.a,wpp_sitewide_cta_swap.control.ursula.1857e0e8-f662-4a5a-acf7-8ebaa9e65d74.a">
    <template id="source-attribution-loader"></template>
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <link rel="shortcut icon"
          href="/assets/favicon.png">
    <link rel="apple-touch-icon"
          href="/assets/favicon.png">
    <link rel="icon"
          href="/assets/favicon.png">
    <meta name="description"
          content="Paykaa powers online and in-person payment processing and financial solutions for businesses of all sizes. Accept payments, send payouts, and automate financial processes with a suite of APIs and no-code tools.">
    <title>Paykaa | Home</title>
    <link rel="preconnect"
          href="https://fonts.googleapis.com">
    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <meta name="format-detection"
          content="telephone=no">
    <meta name="facebook-domain-verification"
          content="zvsnguqc5l0xz3at5o9beubpl46dv8">
    <meta property="og:title"
          content="Stripe | {!! $tagline !!}">
    <meta property="og:description"
          content="Stripe powers online and in-person payment processing and financial solutions for businesses of all sizes. Accept payments, send payouts, and automate financial processes with a suite of APIs and no-code tools.">
    <meta property="og:image"
          name="og:image"
          content="https://images.stripeassets.com/fzn2n1nzq965/3AGidihOJl4nH9D1vDjM84/9540155d584be52fc54c443b6efa4ae6/homepage.png?q=80">
    <meta name="og:url"
          content="https://paykaa.com/">
    <meta name="twitter:site"
          content="@paykaa">
    <meta name="twitter:image"
          content="https://images.stripeassets.com/fzn2n1nzq965/3AGidihOJl4nH9D1vDjM84/9540155d584be52fc54c443b6efa4ae6/homepage.png?q=80">
    <meta name="twitter:card"
          content="summary_large_image">
    <meta name="twitter:title"
          content="Paykaa | {!! $tagline !!}">
    <meta name="twitter:description"
          content="Paykaa powers online and in-person payment processing and financial solutions for businesses of all sizes. Accept payments, send payouts, and automate financial processes with a suite of APIs and no-code tools.">
    <script>
        new MutationObserver(e => {
            for (const d of e)
                if (d.addedNodes)
                    for (const e of d.addedNodes) e instanceof HTMLLinkElement && void 0 !== e.dataset
                        .jsLazyStyle && e.addEventListener("load", function() {
                            this.media = "all"
                        })
        }).observe(document.head, {
            childList: !0
        }), document.addEventListener("DOMContentLoaded", () => {
            for (const e of document.querySelectorAll("link[data-js-lazy-style]")) "all" !== e.media && (e.media =
                "all")
        });
    </script>
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
    <script defer
            src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="module"
            src="/assets/landing/Bootstrapper-ZNZHVLI3.js"></script>
</head>

<body class="MktBody theme-light flavor--Chroma accent--Blurple has-scrollbar"
      data-js-controller="Homepage">
    <div id="MktContent" class="">
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
                link.addEventListener('click', function (e) {
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
