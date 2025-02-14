@php
    $hero = $hero ?? null;
@endphp
<style>
.HomepageHeroGraphic__phone.PhoneGraphic {
  --phoneWidth: 262px;
  --phoneHeight: 538px;
}
</style>
<section
         class="
    Section
    HomepageHero
    theme--White

    accent--Slate

    Section--bleed1
    Section--bleed2
    Section--paddingNormal



    Section--hasGuides


  ">
    <div class="Section__masked">
        <div class="Section__backgroundMask">
            <div class="
        Section__background

      ">

                <div class="
    Guides

  "
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

                    <div class="
    ColumnLayout



  "
                         data-columns="2,2">
                        <section class="
    Copy
    HomepageHero__title
    variant--Superhero

  "
                                 style="










  ">

                            <header class="
    HomepageHeroHeader
    HomepageHeroHeader--hasCaption


  "
                                    data-js-controller="HomepageHeroHeader"
                                    data-experiment-id="acquisition_text_scaling_with_viewport_sizing" "="">
  <div class="HeroCaption HomepageHeroHeader__caption">
  <div class="HeroCaption__container HeroCaption--onDark ">
    <div class="HeroCaption__content">
      <span class="HeroCaption__title">
        {{ now()->format('F Y') }}

          <span class="HeroCaption__separator HeroCaption__separator--desktopOnly">•</span>
          <a class="
    Link
    HeroCaption__link
  " href="{{ route('login', ['register' => true]) }}" target="_blank" data-js-controller="AnalyticsButton" data-analytics-category="Links" data-analytics-action="Clicked" data-analytics-label="hero_pill_sessions_2025_early_bird_registration">We want to protect your money starting today&nbsp;<svg class="
    HoverArrow


  " width="10" height="10" viewBox="0 0 10 10" aria-hidden="true">
  <g fill-rule="evenodd">

      <path class="HoverArrow__linePath" d="
                                    M0
                                    5h7">
                                </path>
                                <path class="HoverArrow__tipPath"
                                      d="M1 1l4 4-4 4"></path>

                                </g>
                                </svg></a>

                                </span>
                    </div>
                </div>
            </div>
            <h2 class="
      HomepageHeroHeader__title
      HomepageHeroHeader__title--scaled
    "
                data-js-target-list="HomepageHeroHeader.title">{!! $hero['title'] !!}</h2>

            <div class="HomepageHeroGradient Gradient isLoaded">
                <canvas class="Gradient__canvas isLoaded"
                        data-js-controller="Gradient"
                        data-js-darken-top=""
                        data-transition-in=""
                        width="1030"
                        height="600"></canvas>
            </div>

            <div class="
      HomepageHeroHeader__title
      HomepageHeroHeader__title--overlay
      HomepageHeroHeader__title--burn
      HomepageHeroHeader__title--scaled
    "
                 data-js-target-list="HomepageHeroHeader.title"
                 aria-hidden="true">{!! $hero['title'] !!}</div>

            <div class="
      HomepageHeroHeader__title
      HomepageHeroHeader__title--overlay
      HomepageHeroHeader__title--scaled
    "
                 data-js-target-list="HomepageHeroHeader.title"
                 aria-hidden="true">{!! $hero['title'] !!}</div>
            </header>

            <div class="
        Copy__body


      ">{!! $hero['description'] !!}</div>

            <footer class="Copy__footer">
                <div class="Copy__ctaContainer">
                    <div class="HomepageHero__ctas">
                        <a class="
    CtaButton
    variant--Button
    CtaButton--arrow
    HomepageHero__cta
  "
                           href="/login?register=1"
                           data-js-controller="AnalyticsButton"
                           data-analytics-category="Buttons"
                           data-analytics-action="Clicked"
                           data-analytics-label="Start Now CTA Hero">Start now&nbsp;<svg class="
    HoverArrow


  "
                                 width="10"
                                 height="10"
                                 viewBox="0 0 10 10"
                                 aria-hidden="true">
                                <g fill-rule="evenodd">

                                    <path class="HoverArrow__linePath"
                                          d="M0 5h7"></path>
                                    <path class="HoverArrow__tipPath"
                                          d="M1 1l4 4-4 4"></path>

                                </g>
                            </svg></a>
                        <a class="
    CtaButton
    variant--Link
    CtaButton--arrow
    HomepageHero__cta
  "
                           href=/contact/sales"
                           data-js-controller="AnalyticsButton"
                           data-analytics-category="Buttons"
                           data-analytics-action="Clicked"
                           data-analytics-label="Contact Sales CTA Hero">Contact sales&nbsp;<svg
                                 class="
    HoverArrow


  "
                                 width="10"
                                 height="10"
                                 viewBox="0 0 10 10"
                                 aria-hidden="true">
                                <g fill-rule="evenodd">

                                    <path class="HoverArrow__linePath"
                                          d="M0 5h7"></path>
                                    <path class="HoverArrow__tipPath"
                                          d="M1 1l4 4-4 4"></path>

                                </g>
                            </svg></a>
                    </div>

                    <div class="HomepageHero__emailInput">
                        <div class="HeroEmailInput"
                             data-js-controller="HeroEmailInput"
                             data-register-href="">
                            <form class="HeroEmailInput__form"
                                  action="{{ route('login') }}">
                                <div class="EmailInput">
                                    <input type="hidden"
                                           value="1"
                                           name="register" />
                                    <input data-js-controller="EmailInput"
                                           class="EmailInput__input"
                                           name="email"
                                           type="text"
                                           placeholder="Email address"
                                           data-js-target="HeroEmailInput.emailInput">
                                    <div class="EmailInput__error"
                                         aria-label="Invalid field"
                                         hidden="">
                                        <svg width="16"
                                             height="16"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 16 16">
                                            <g fill="var(--inputErrorAccentColor)"
                                               fill-rule="evenodd">
                                                <circle cx="8"
                                                        cy="8"
                                                        r="8"
                                                        fill-opacity=".2"></circle>
                                                <path
                                                      d="M8 11a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-8a1 1 0 0 1 1 1v5a1 1 0 1 1-2 0V4a1 1 0 0 1 1-1z">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                <button class="
    CtaButton
    variant--Button
    CtaButton--arrow
    HeroEmailInput__button
  "
                                        data-js-controller="AnalyticsButton"
                                        data-js-target="HeroEmailInput.startNowButton"
                                        data-analytics-category="Buttons"
                                        data-analytics-action="Clicked"
                                        data-analytics-label="HomePageEmailInputCta">Start now&nbsp;<svg
                                         class="
    HoverArrow


  "
                                         width="10"
                                         height="10"
                                         viewBox="0 0 10 10"
                                         aria-hidden="true">
                                        <g fill-rule="evenodd">

                                            <path class="HoverArrow__linePath"
                                                  d="M0 5h7"></path>
                                            <path class="HoverArrow__tipPath"
                                                  d="M1 1l4 4-4 4"></path>

                                        </g>
                                    </svg></button>
                            </form>
                        </div>
                    </div>
                </div>

            </footer>

</section>
<div class="
    HomepageHeroGraphic
    HomepageHero__graphic
  ">
    <div class="HomepageDashboardGraphic HomepageHeroGraphic__dashboard">
        <div class="HomepageDashboardGraphic__company">
            <img src="/assets/favicon.png" class="w-5 h-5"/>
            Paykaa
        </div>
        <div class="w-[600px] h-[500px] rounded-xl overflow-hidden">
            <img src="{{$hero['image_desktop']}}" class="w-full h-full"/>
        </div>
    </div>
    <figure class="HomepageHeroGraphic__phone PhoneGraphic overflow-hidden p-2"
            style=""aria-hidden="true">
        <img src="{{$hero['image_mobile']}}" class="w-full h-full rounded-[30px]"/>
    </figure>
</div>
</div>

</div>
</div>
</div>
</div>
</section>
