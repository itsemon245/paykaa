@@php
    $socials = $landing->socials ?? [];
    $about = $landing->about ?? [];
@endphp
    <footer
            class="Section HomepageGlobalSection theme--Dark flavor--Chroma accent--Cyan Section--angleTop Section--paddingNormal Section--hasGuides">
        <div class="Section__masked">
            <div class="Section__backgroundMask !overflow-hidden">
                <div class="    Section__background">
                    <figure class="BackgroundGlobe "
                            data-js-controller="BackgroundGlobe">
                        <div class="Globe js-globe Globe--isAngled "></div>
                    </figure>
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
                            <div class="ColumnLayout
    "
                                 data-columns="2,2">
                                <section class="Copy HomepageGlobalSection__copy variant--Section">

                                    <header class="Copy__header">

                                        <h2 class="Copy__caption">{{$about['title'] ?? 'About us'}}</h2>

                                        <h1 class="        Copy__title

          ">
                                            {{$about['title'] ?? 'About us'}}
                                        </h1>

                                    </header>

                                    <div class="    Copy__body
        ">{{$about['description'] ?? 'We are a team of developers, designers, and product managers who are passionate about making the world a better place. We believe that everyone deserves access to financial services and we are committed to making that a reality.'}}</div>

                                </section>
                            </div>

                            <div class="ColumnLayout
    "
                                 data-columns="1,1,1,1">
                                <section class="Copy

    variant--Stat"
                                         style="






    ">

                                    <header class="Copy__header">

                                        <h1 class="        Copy__title

          ">
                                            500M+
                                        </h1>

                                    </header>

                                    <div class="    Copy__body
        ">
                                        API requests per day, peaking at 13,000 requests a second.
                                    </div>

                                </section>

                                <section class="Copy
    HomepageGlobalSection__uptimeStat
    variant--Stat"
                                         style="






    ">

                                    <header class="Copy__header">

                                        <h1 class="        Copy__title

          ">
                                            99.999%
                                        </h1>

                                    </header>

                                    <div class="    Copy__body
        ">
                                        historical uptime for <a class="Link"
                                           href="https://status.stripe.com/"
                                           data-js-controller="AnalyticsButton"
                                           data-analytics-category="Links"
                                           data-analytics-action="Clicked"
                                           data-analytics-label="Global Stripe services">Stripe services</a>.
                                    </div>

                                </section>

                                <section class="Copy

    variant--Stat"
                                         style="






    ">

                                    <header class="Copy__header">

                                        <h1 class="        Copy__title

          ">
                                            90%
                                        </h1>

                                    </header>

                                    <div class="    Copy__body
        ">
                                        of U.S. adults have bought from businesses using Stripe.
                                    </div>

                                </section>

                                <section class="Copy

    variant--Stat"
                                         style="






    ">

                                    <header class="Copy__header">

                                        <h1 class="        Copy__title

          ">
                                            135+
                                        </h1>

                                    </header>

                                    <div class="    Copy__body
        ">
                                        currencies and payment methods supported.
                                    </div>

                                </section>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </footer>
