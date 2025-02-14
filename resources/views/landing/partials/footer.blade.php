@php
    $socials = $landing->socials ?? [];
    $about = $landing->about ?? [];
@endphp
<footer class="Section HomepageGlobalSection theme--Dark flavor--Chroma accent--Cyan Section--angleTop Section--paddingNormal Section--hasGuides relative"> <div class="Section__masked">
        <div class="Section__backgroundMask !overflow-hidden">
            <div class="Section__background">
                <div class="Guides"
                     aria-hidden="true">
                    <div class="Guides__container">
                        <div class="Guides__guide"></div>
                        <div class="Guides__guide"></div>
                        <div class="Guides__guide"></div>
                        <div class="Guides__guide"></div>
                        <div class="Guides__guide"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="Section__container">
            <div class="Section__layoutContainer">
                <div class="Section__layout">
                    <div class="RowLayout"
                        style="--rowLayoutGap: var(--rowLayoutGapXLarge)">
                        <div class="ColumnLayout"
                              id="about"
                            data-columns="2,2">
                            <section class="Copy HomepageGlobalSection__copy variant--Section">
                                <header class="Copy__header">
                                    <h2 class="Copy__caption">{{ $about['title'] ?? 'About us' }}</h2>
                                    <h1 class="Copy__title">{{ $about['title'] ?? 'About us' }}</h1>
                                </header>
                                <div class="Copy__body">
                                    {{ $about['description'] ?? 'We are a team of developers, designers, and product managers who are passionate about making the world a better place. We believe that everyone deserves access to financial services and we are committed to making that a reality.' }}
                                </div>
                            </section>
                        </div>
                        <div class="ColumnLayout"
                            data-columns="1,1,1,1">
                            <section class="Copy HomepageGlobalSection__uptimeStat variant--Stat">
                                <header class="Copy__header">
                                    <h1 class="Copy__title">Address</h1>
                                </header>
                                <div class="Copy__body">
                                    {{ $about['address'] ?? '123 Main St, San Francisco, CA 94102' }}
                                </div>

                            </section>
                            <section id="social-media" class="Copy HomepageGlobalSection__uptimeStat variant--Stat">
                                <header class="Copy__header">
                                    <h1 class="Copy__title">Social Media</h1>
                                </header>
                                <div
                                    class="z-[1000] flex flex-wrap justify-start items-center gap-3 Copy__body"
                                    >
                                    @foreach($socials as $social)
                                        @php
                                            $icon = [
                                                    'instagram' => 'skill-icons:instagram',
                                                    'youtube'=> 'logos:youtube-icon'
                                                ][$social['title']] ?? "logos:".$social['title'];
                                            @endphp
                                            <a href="{{ $social['url'] }}" class="Link Link--social w-6 h-6 cursor-pointer">
                                                <!-- Icones are collected from https://icones.js.org -->
                                                <img class="w-full h-full" src="https://api.iconify.design/{{$icon}}.svg" alt="{{ $social['title'] }}" />
                                            </a>
                                        @endforeach
                                </div>
                            </section>
                            <section id="contact" class="Copy HomepageGlobalSection__uptimeStat variant--Stat">
                                <header class="Copy__header">
                                    <h1 class="Copy__title">Email</h1>
                                </header>
                                <div class="Copy__body">
                                    <a href="mailto:{{$about['email'] ?? 'info@paykaa.com'}}" class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor"><path d="m2 6l6.913 3.917c2.549 1.444 3.625 1.444 6.174 0L22 6"/><path d="M2.016 13.476c.065 3.065.098 4.598 1.229 5.733c1.131 1.136 2.705 1.175 5.854 1.254c1.94.05 3.862.05 5.802 0c3.149-.079 4.723-.118 5.854-1.254c1.131-1.135 1.164-2.668 1.23-5.733c.02-.986.02-1.966 0-2.952c-.066-3.065-.099-4.598-1.23-5.733c-1.131-1.136-2.705-1.175-5.854-1.254a115 115 0 0 0-5.802 0c-3.149.079-4.723.118-5.854 1.254c-1.131 1.135-1.164 2.668-1.23 5.733a69 69 0 0 0 0 2.952"/></g></svg>
                                        {{ $about['email'] ?? 'info@paykaa.com' }}
                                    </a></div>
                            </section>
                            <section class="Copy HomepageGlobalSection__uptimeStat variant--Stat">
                                <header class="Copy__header">
                                    <h1 class="Copy__title">Phone</h1>
                                </header>
                                <div class="Copy__body">
                                    <a href="tel:{{$about['phone'] ?? '+8801643428395'}}" class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M19.95 21q-3.125 0-6.175-1.362t-5.55-3.863t-3.862-5.55T3 4.05q0-.45.3-.75t.75-.3H8.1q.35 0 .625.238t.325.562l.65 3.5q.05.4-.025.675T9.4 8.45L6.975 10.9q.5.925 1.187 1.787t1.513 1.663q.775.775 1.625 1.438T13.1 17l2.35-2.35q.225-.225.588-.337t.712-.063l3.45.7q.35.1.575.363T21 15.9v4.05q0 .45-.3.75t-.75.3"/></svg>
                                        {{ $about['phone'] ?? '+8801643428395' }}
                                    </a></div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center absolute bottom-4 w-full font-bold">
        &copy; {{now()->format('Y')}} | All rights reserved to <a href="/" class="!text-cyan-500">Paykaa.com</a>
    </div>
</footer>
