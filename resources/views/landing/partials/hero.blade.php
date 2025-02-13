@php
    $hero = $hero ?? null;
@endphp
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


  "
  >
      <div class="Section__masked">
          <div class="Section__backgroundMask">
              <div class="
        Section__background

      ">

                  <div
                      class="
    Guides

  "
                      aria-hidden="true"
                  >
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

                      <div
                          class="
    ColumnLayout



  "
                          data-columns="2,2"
                      >
                          <section
                              class="
    Copy
    HomepageHero__title
    variant--Superhero

  "
                              style="










  "
                          >

                              <header
                                  class="
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
                                  5h7"
                              >
                                  </path>
                                  <path
                                      class="HoverArrow__tipPath"
                                      d="M1 1l4 4-4 4"
                                  ></path>

                                  </g>
                                  </svg></a>

                                  </span>
                      </div>
                  </div>
              </div>
              <h2
                  class="
      HomepageHeroHeader__title
      HomepageHeroHeader__title--scaled
    "
                  data-js-target-list="HomepageHeroHeader.title"
              >{!! $hero['title'] !!}</h2>

              <div class="HomepageHeroGradient Gradient isLoaded">
                  <canvas
                      class="Gradient__canvas isLoaded"
                      data-js-controller="Gradient"
                      data-js-darken-top=""
                      data-transition-in=""
                      width="1030"
                      height="600"
                  ></canvas>
              </div>

              <div
                  class="
      HomepageHeroHeader__title
      HomepageHeroHeader__title--overlay
      HomepageHeroHeader__title--burn
      HomepageHeroHeader__title--scaled
    "
                  data-js-target-list="HomepageHeroHeader.title"
                  aria-hidden="true"
              >{!! $hero['title'] !!}</div>

              <div
                  class="
      HomepageHeroHeader__title
      HomepageHeroHeader__title--overlay
      HomepageHeroHeader__title--scaled
    "
                  data-js-target-list="HomepageHeroHeader.title"
                  aria-hidden="true"
              >{!! $hero['title'] !!}</div>
              </header>

              <div class="
        Copy__body


      ">{!!$hero['description']!!}</div>

              <footer class="Copy__footer">
                  <div class="Copy__ctaContainer">
                      <div class="HomepageHero__ctas">
                          <a
                              class="
    CtaButton
    variant--Button
    CtaButton--arrow
    HomepageHero__cta
  "
                              href="/login?register=1"
                              data-js-controller="AnalyticsButton"
                              data-analytics-category="Buttons"
                              data-analytics-action="Clicked"
                              data-analytics-label="Start Now CTA Hero"
                          >Start now&nbsp;<svg
                                  class="
    HoverArrow


  "
                                  width="10"
                                  height="10"
                                  viewBox="0 0 10 10"
                                  aria-hidden="true"
                              >
                                  <g fill-rule="evenodd">

                                      <path
                                          class="HoverArrow__linePath"
                                          d="M0 5h7"
                                      ></path>
                                      <path
                                          class="HoverArrow__tipPath"
                                          d="M1 1l4 4-4 4"
                                      ></path>

                                  </g>
                              </svg></a>
                          <a
                              class="
    CtaButton
    variant--Link
    CtaButton--arrow
    HomepageHero__cta
  "
                              href=/contact/sales"
                              data-js-controller="AnalyticsButton"
                              data-analytics-category="Buttons"
                              data-analytics-action="Clicked"
                              data-analytics-label="Contact Sales CTA Hero"
                          >Contact sales&nbsp;<svg
                                  class="
    HoverArrow


  "
                                  width="10"
                                  height="10"
                                  viewBox="0 0 10 10"
                                  aria-hidden="true"
                              >
                                  <g fill-rule="evenodd">

                                      <path
                                          class="HoverArrow__linePath"
                                          d="M0 5h7"
                                      ></path>
                                      <path
                                          class="HoverArrow__tipPath"
                                          d="M1 1l4 4-4 4"
                                      ></path>

                                  </g>
                              </svg></a>
                      </div>

                      <div class="HomepageHero__emailInput">
                          <div
                              class="HeroEmailInput"
                              data-js-controller="HeroEmailInput"
                              data-register-href=""
                          >
                              <form
                                  class="HeroEmailInput__form"
                                  action="{{ route('login') }}"
                              >
                                  <div class="EmailInput">
                                      <input
                                          type="hidden"
                                          value="1"
                                          name="register"
                                      />
                                      <input
                                          data-js-controller="EmailInput"
                                          class="EmailInput__input"
                                          name="email"
                                          type="text"
                                          placeholder="Email address"
                                          data-js-target="HeroEmailInput.emailInput"
                                      >
                                      <div
                                          class="EmailInput__error"
                                          aria-label="Invalid field"
                                          hidden=""
                                      >
                                          <svg
                                              width="16"
                                              height="16"
                                              xmlns="http://www.w3.org/2000/svg"
                                              viewBox="0 0 16 16"
                                          >
                                              <g
                                                  fill="var(--inputErrorAccentColor)"
                                                  fill-rule="evenodd"
                                              >
                                                  <circle
                                                      cx="8"
                                                      cy="8"
                                                      r="8"
                                                      fill-opacity=".2"
                                                  ></circle>
                                                  <path
                                                      d="M8 11a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-8a1 1 0 0 1 1 1v5a1 1 0 1 1-2 0V4a1 1 0 0 1 1-1z"
                                                  ></path>
                                              </g>
                                          </svg>
                                      </div>
                                  </div>
                                  <button
                                      class="
    CtaButton
    variant--Button
    CtaButton--arrow
    HeroEmailInput__button
  "
                                      data-js-controller="AnalyticsButton"
                                      data-js-target="HeroEmailInput.startNowButton"
                                      data-analytics-category="Buttons"
                                      data-analytics-action="Clicked"
                                      data-analytics-label="HomePageEmailInputCta"
                                  >Start now&nbsp;<svg
                                          class="
    HoverArrow


  "
                                          width="10"
                                          height="10"
                                          viewBox="0 0 10 10"
                                          aria-hidden="true"
                                      >
                                          <g fill-rule="evenodd">

                                              <path
                                                  class="HoverArrow__linePath"
                                                  d="M0 5h7"
                                              ></path>
                                              <path
                                                  class="HoverArrow__tipPath"
                                                  d="M1 1l4 4-4 4"
                                              ></path>

                                          </g>
                                      </svg></button>
                              </form>
                              <a
                                  class="
    CtaButton
    variant--Link
    CtaButton--arrow
    HeroContactSalesMobile__link
  "
                                  href=/contact/sales"
                                  data-js-controller="AnalyticsButton"
                                  data-analytics-category="Buttons"
                                  data-analytics-action="Clicked"
                                  data-analytics-label="HomePageContactSalesMobileLinkCta"
                              >Contact sales&nbsp;<svg
                                      class="
    HoverArrow


  "
                                      width="10"
                                      height="10"
                                      viewBox="0 0 10 10"
                                      aria-hidden="true"
                                  >
                                      <g fill-rule="evenodd">

                                          <path
                                              class="HoverArrow__linePath"
                                              d="M0 5h7"
                                          ></path>
                                          <path
                                              class="HoverArrow__tipPath"
                                              d="M1 1l4 4-4 4"
                                          ></path>

                                      </g>
                                  </svg></a>
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
              <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
              >
                  <path
                      fill="#FFF"
                      d="M10 0a10 10 0 1 1 0 20 10 10 0 0 1 0-20zm3.3 6.11H4.34a.41.41 0 0 0 0 .83h8.94a2.89 2.89 0 0 1 0 5.77H7.65a.41.41 0 0 0 0 .83h5.64a3.71 3.71 0 0 0 0-7.43zm0 1.65a2.06 2.06 0 1 0 2.05 2.06c0-1.13-.92-2.06-2.06-2.06zm-2.83 3.3h-4.7a.41.41 0 0 0 0 .83h4.7a.41.41 0 0 0 0-.83zM13.3 8.6a1.24 1.24 0 1 1 0 2.47 1.24 1.24 0 0 1 0-2.47zm-3.3.8H3.41a.41.41 0 1 0 0 .83h6.6c.22 0 .4-.19.4-.42a.41.41 0 0 0-.41-.4zm.47-1.65H6.24a.41.41 0 1 0 0 .83h4.23a.41.41 0 1 0 0-.83z"
                  ></path>
              </svg>
              Rocket Rides
              <svg
                  width="10"
                  height="4"
                  viewBox="0 0 10 4"
              >
                  <polyline
                      fill="none"
                      stroke="#FFF"
                      points="1 0 5 4 9 0"
                  ></polyline>
              </svg>
          </div>
          <div>
              <div class="HomepageDashboardGraphic__header">
                  <div class="HomepageDashboardGraphic__searchBar">
                      <svg
                          class="HomepageDashboardGraphic__searchIcon"
                          viewBox="0 0 10 10"
                      >
                          <circle
                              cx="4"
                              cy="4"
                              r="3.5"
                              fill="none"
                              stroke="#62788d"
                          ></circle>
                          <path
                              fill="#62788d"
                              d="M6.15 6.15c.2-.2.5-.2.7 0l2.12 2.12a.5.5 0 1 1-.7.7L6.15 6.85a.5.5 0 0 1 0-.7z"
                          ></path>
                      </svg>
                      Search
                  </div>
                  <svg
                      width="70"
                      height="12"
                      viewBox="0 0 70 12"
                  >
                      <path
                          fill="#62788d"
                          d="M3.12 10.5h3.76C6.7 11.37 5.91 12 5 12c-.91 0-1.7-.63-1.88-1.5zm5.72-3.7l.94.92c.22.22.28.54.16.82a.77.77 0 0 1-.7.46H.76a.77.77 0 0 1-.71-.46.74.74 0 0 1 .16-.82l.94-.92V3.75A3.8 3.8 0 0 1 5 0a3.8 3.8 0 0 1 3.84 3.75V6.8z"
                      ></path>
                      <path
                          fill="#62788d"
                          d="M34 12a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm-.75-5.93v.3a.75.75 0 0 0 1.44.29 2.63 2.63 0 1 0-3.32-2.53.75.75 0 0 0 1.51-.01A1.13 1.13 0 0 1 34 3a1.12 1.12 0 0 1 0 2.23.75.75 0 0 0-.75.83zM34 10.5a1.13 1.13 0 1 0 0-2.25 1.13 1.13 0 0 0 0 2.25zm30-2.25c1.09 0 2.13-.41 2.92-1.15l1.33.5A2.7 2.7 0 0 1 70 10.12v1.12c0 .41-.34.75-.75.75h-10.5a.75.75 0 0 1-.75-.75v-1.13C58 9 58.7 8 59.76 7.6l1.32-.5A4.23 4.23 0 0 0 64 8.26zM63.85 0h.3a2.63 2.63 0 0 1 2.61 2.84l-.12 1.48a2.65 2.65 0 0 1-5.28 0l-.12-1.48A2.63 2.63 0 0 1 63.85 0z"
                      ></path>
                  </svg>
              </div>

              <div class="HomepageDashboardGraphic__body">
                  <div class="HomepageDashboardGraphic__content">
                      <div class="HomepageDashboardGraphic__topSection">
                          <div class="HomepageDashboardGraphic__title">
                              <span>Today</span>
                          </div>
                          <div class="HomepageDashboardGraphic__todaySection">
                              <div class="HomepageDashboardGraphic__todaySection--left">
                                  <div class="HomepageDashboardGraphic__netVolumeLayout">
                                      <div>
                                          <div class="HomepageDashboardGraphic__flexGroup--gap">
                                              <span class="HomepageDashboardGraphic__copy--small"><b>Net
                                                      volume</b></span>
                                              <svg
                                                  class="HomepageDashboardGraphic__caratSvg"
                                                  width="7"
                                                  height="4"
                                                  fill="none"
                                                  xmlns="http://www.w3.org/2000/svg"
                                              >
                                                  <path
                                                      fill-rule="evenodd"
                                                      clip-rule="evenodd"
                                                      d="M5.532.54a.379.379 0 0 1 .536.536L3.684 3.46a.378.378 0 0 1-.535 0L.765 1.076A.379.379 0 0 1 1.3.54l2.116 2.116L5.532.54Z"
                                                      fill="#0A2540"
                                                  ></path>
                                              </svg>
                                          </div>
                                          <div
                                              class="HomepageDashboardGraphic__copy--large HomepageDashboardGraphic__verticalSpacing">
                                              $3,528,198.72</div>
                                          <div
                                              class="HomepageDashboardGraphic__copy--XSmall HomepageDashboardGraphic__verticalSpacing">
                                              2:00 PM</div>
                                      </div>
                                      <div>
                                          <div class="HomepageDashboardGraphic__flexGroup--gap">
                                              <span
                                                  class="HomepageDashboardGraphic__copy--small"><b>Yesterday</b></span>
                                              <svg
                                                  class="HomepageDashboardGraphic__caratSvg"
                                                  width="7"
                                                  height="4"
                                                  fill="none"
                                                  xmlns="http://www.w3.org/2000/svg"
                                              >
                                                  <path
                                                      fill-rule="evenodd"
                                                      clip-rule="evenodd"
                                                      d="M5.532.54a.379.379 0 0 1 .536.536L3.684 3.46a.378.378 0 0 1-.535 0L.765 1.076A.379.379 0 0 1 1.3.54l2.116 2.116L5.532.54Z"
                                                      fill="#0A2540"
                                                  ></path>
                                              </svg>
                                          </div>
                                          <div
                                              class="HomepageDashboardGraphic__copy--medium HomepageDashboardGraphic__verticalSpacing">
                                              $2,931,556.34</div>
                                      </div>
                                  </div>
                                  <div class="HomepageDashboardGraphic__mainGraph">
                                      <svg
                                          class="HomepageDashboardGraphic__mainGraphSvg"
                                          viewBox="0 0 468 70"
                                          width="468"
                                          height="70"
                                          fill="none"
                                          xmlns="http://www.w3.org/2000/svg"
                                      >
                                          <path
                                              opacity=".3"
                                              d="M0 68.125h467.488v.623H0v-.623Z"
                                              fill="#C4CCD8"
                                          ></path>
                                          <path
                                              opacity=".3"
                                              d="M.153.355h.306v67.892H.153V.355ZM19.606.355h.306v68.238h-.306V.355ZM39.06.355h.306v68.238h-.307V.355ZM58.512.355h.307v68.238h-.307V.355ZM77.966.355h.306v68.238h-.306V.355ZM97.418.355h.307v68.238h-.306V.355ZM116.871.355h.307v68.238h-.307V.355ZM136.325.355h.307v68.238h-.307V.355ZM155.778.355h.307v68.238h-.307V.355ZM175.231.355h.307v68.238h-.307V.355ZM194.684.355h.307v68.238h-.307V.355ZM214.137.355h.307v68.238h-.307V.355ZM233.591.355h.306v68.238h-.306V.355ZM253.044.355h.306v68.238h-.306V.355ZM272.497.355h.306v67.892h-.306V.355ZM291.95.355h.306v68.238h-.306V.355ZM311.404.355h.305v68.238h-.305V.355ZM330.857.355h.306v68.238h-.306V.355ZM350.31.355h.306v68.238h-.306V.355ZM369.762.355h.306v68.238h-.306V.355ZM389.215.355h.307v68.238h-.307V.355ZM408.669.355h.307v68.238h-.307V.355ZM428.122.355h.307v68.238h-.307V.355ZM447.575.355h.307v68.238h-.307V.355ZM467.028.355h.307v67.892h-.307V.355Z"
                                              stroke="#C4CCD8"
                                              stroke-width=".423"
                                              stroke-linejoin="round"
                                          ></path>
                                          <path
                                              opacity=".3"
                                              d="M467.488 29.742H350.617l-19.48 12.794h-38.956l-19.479 4.265h-58.436l-19.478 8.529h-58.437l-19.479 4.264H97.393L77.915 63.86l-19.479 4.265H0"
                                              stroke="#C4CCD8"
                                              stroke-width=".846"
                                              stroke-linejoin="round"
                                          ></path>
                                          <path
                                              d="M274.138 28.75c0-.834-.666-1.51-1.486-1.51-.819 0-1.485.676-1.485 1.51v.096c0 .834.666 1.51 1.485 1.51.82 0 1.486-.676 1.486-1.51v-.096Z"
                                              fill="#635BFF"
                                          ></path>
                                          <path
                                              d="M-1.934 68.15h78.16l19.54-8.899h78.16l19.54-21.75 19.54-4.35h19.54l19.54-4.152h21.559"
                                              stroke="#635BFF"
                                              stroke-width="1.271"
                                              stroke-linejoin="round"
                                          ></path>
                                      </svg>
                                      <div class="HomepageDashboardGraphic__graphTimeLayout">
                                          <span class="HomepageDashboardGraphic__copy--XSmall">12:00 AM</span>
                                          <span
                                              class="HomepageDashboardGraphic__copy--XSmall HomepageDashboardGraphic__copy--XSmallFancy"
                                          >Now, 2:00 PM</span>
                                          <span class="HomepageDashboardGraphic__copy--XSmall">11:59 PM</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="HomepageDashboardGraphic__todaySection--right">
                                  <div class="HomepageDashboardGraphic__flexGroup">
                                      <div>
                                          <div class="HomepageDashboardGraphic__flexGroup--gap">

                                              <span class="HomepageDashboardGraphic__copy--small"><b>USD
                                                      Balance</b></span>
                                              <svg
                                                  class="HomepageDashboardGraphic__caratSvg"
                                                  width="7"
                                                  height="4"
                                                  fill="none"
                                                  xmlns="http://www.w3.org/2000/svg"
                                              >
                                                  <path
                                                      fill-rule="evenodd"
                                                      clip-rule="evenodd"
                                                      d="M5.532.54a.379.379 0 0 1 .536.536L3.684 3.46a.378.378 0 0 1-.535 0L.765 1.076A.379.379 0 0 1 1.3.54l2.116 2.116L5.532.54Z"
                                                      fill="#0A2540"
                                                  ></path>
                                              </svg>
                                          </div>
                                          <div
                                              class="HomepageDashboardGraphic__copy--large HomepageDashboardGraphic__verticalSpacing">
                                              $553,257.51</div>
                                          <div
                                              class="HomepageDashboardGraphic__copy--XSmall HomepageDashboardGraphic__verticalSpacing">
                                              Available to pay out</div>
                                      </div>
                                      <span
                                          class="HomepageDashboardGraphic__copy--small HomepageDashboardGraphic__copy--smallHeaderFancy"
                                      >View</span>
                                  </div>
                                  <div class="HomepageDashboardGraphic__separator"></div>
                                  <div class="HomepageDashboardGraphic__flexGroup">
                                      <div>
                                          <span class="HomepageDashboardGraphic__copy--small"><b>Payouts</b></span>
                                          <div
                                              class="HomepageDashboardGraphic__copy--large HomepageDashboardGraphic__verticalSpacing">
                                              $102,633.07</div>
                                          <div
                                              class="HomepageDashboardGraphic__copy--XSmall HomepageDashboardGraphic__verticalSpacing">
                                              Expected today</div>
                                      </div>
                                      <span
                                          class="HomepageDashboardGraphic__copy--small HomepageDashboardGraphic__copy--smallHeaderFancy"
                                      >View</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="HomepageDashboardGraphic__bottomSection">
                          <div class="HomepageDashboardGraphic__column">
                              <div
                                  class="HomepageDashboardGraphic__flexGroup--gap HomepageDashboardGraphic__flexGroup--baseline">
                                  <span class="HomepageDashboardGraphic__copy--medium"><b>Net volume from
                                          sales</b></span>
                                  <span class="HomepageDashboardGraphic__copy--XSmall"><b>+32.8%</b></span>
                              </div>
                              <div
                                  class="HomepageDashboardGraphic__flexGroup--gap HomepageDashboardGraphic__flexGroup--baseline HomepageDashboardGraphic__verticalSpacing">
                                  <span class="HomepageDashboardGraphic__copy--large"><b>$39,274.29</b></span>
                                  <span class="HomepageDashboardGraphic__copy--small">$29,573.54</span>
                              </div>
                              <div class="HomepageDashboardGraphic__sectionGraph">
                                  <svg
                                      class="HomepageDashboardGraphic__sectionGraphSvg"
                                      xmlns="http://www.w3.org/2000/svg"
                                      fill="none"
                                      viewBox="0 0 220 112"
                                  >
                                      <g clip-path="url(#homepage-net-volume-graph-layer-a)">
                                          <g opacity=".3">
                                              <path
                                                  d="M218.625 108.961H.81v.351h217.815v-.351Z"
                                                  fill="#C4CCD8"
                                              ></path>
                                              <path
                                                  d="M218.625 108.961H.81v.351h217.815v-.351Z"
                                                  stroke="#C4CCD8"
                                                  stroke-width=".423"
                                              ></path>
                                          </g>
                                          <path
                                              d="m.698 7.865.61-.5c.34.65.866 1.017 1.553 1.092V6.313C1.937 6.122.986 5.863.986 4.746c0-.959.822-1.609 1.874-1.692V2.26h.618v.8c.874.101 1.536.527 1.85 1.143l-.585.485c-.264-.51-.679-.86-1.264-.96v1.985c.933.192 1.891.467 1.891 1.643 0 1-.823 1.66-1.89 1.777v.808h-.62v-.8c-.967-.084-1.78-.559-2.162-1.276v-.001Zm1.035-3.17c0 .551.5.751 1.128.885V3.712c-.653.066-1.128.434-1.128.983Zm2.891 2.711c0-.591-.508-.81-1.145-.959v2.01c.654-.084 1.145-.425 1.145-1.05ZM7.407 3.07h.61v6.022h-.814V4.687H5.737v-.591l.652-.042c.722-.05.959-.292 1.018-.985ZM8.97 8.432l1.797-1.468c.832-.675 1.476-1.25 1.476-2.034 0-.734-.484-1.235-1.23-1.235-.729 0-1.23.55-1.23 1.235 0 .216.05.44.136.65h-.763a1.926 1.926 0 0 1-.136-.692c0-1.069.89-1.877 2.01-1.877 1.23 0 2.01.767 2.01 1.868 0 1.018-.712 1.718-1.586 2.41L10.08 8.391h3.079v.7h-4.19v-.66Zm5.847-5.33v3.662l1.968-2.035h.95l-1.73 1.718 1.874 2.644h-.891L15.46 6.989l-.643.642v1.46h-.764V3.103h.763ZM.97 102.697c0-1.826.874-3.086 2.324-3.086 1.442 0 2.315 1.26 2.315 3.086 0 1.827-.873 3.085-2.314 3.085-1.45 0-2.324-1.258-2.324-3.085Zm.815 0c0 1.401.517 2.385 1.509 2.385.984 0 1.51-.984 1.51-2.385 0-1.401-.527-2.385-1.51-2.385-.992 0-1.51.984-1.51 2.385Z"
                                              fill="#727F96"
                                          ></path>
                                          <path
                                              opacity=".3"
                                              d="M218.844 49.185h-32.949l-32.948 14.9-32.95-29.8-32.948 44.7-32.948 29.8H21.15"
                                              stroke="#C4CCD8"
                                              stroke-width=".846"
                                              stroke-linejoin="round"
                                          ></path>
                                          <path
                                              d="m21.151 108.785 32.95-29.8 32.948-14.9 32.948 29.8 32.95-44.7h32.948l32.949-29.8"
                                              stroke="#fff"
                                              stroke-width="3.383"
                                              stroke-linejoin="round"
                                          ></path>
                                          <path
                                              d="m21.151 108.785 32.95-29.8 32.948-14.9 32.948 29.8 32.95-44.7h32.948l32.949-29.8"
                                              stroke="#635BFF"
                                              stroke-width="1.691"
                                              stroke-linejoin="round"
                                          ></path>
                                          <path
                                              opacity=".3"
                                              d="M21.62 109.662h-.313v2.456h.313v-2.456Z"
                                              stroke="#C4CCD8"
                                              stroke-width=".423"
                                              stroke-linejoin="round"
                                          ></path>
                                      </g>
                                      <defs>
                                          <clippath id="homepage-net-volume-graph-layer-a">
                                              <path
                                                  fill="#fff"
                                                  d="M0 0h220v112H0z"
                                              ></path>
                                          </clippath>
                                      </defs>
                                  </svg>
                                  <div class="HomepageDashboardGraphic__flexGroup">
                                      <span class="HomepageDashboardGraphic__copy--XSmall">Apr 20</span>
                                      <span class="HomepageDashboardGraphic__copy--XSmall">Today</span>
                                  </div>
                              </div>
                              <div
                                  class="StartupHubHomeDashboardGraphic__updatedTime HomepageDashboardGraphic__flexGroup--gap">
                                  <span class="HomepageDashboardGraphic__copy--XSmall">Updated today 7:50 AM</span>
                              </div>
                          </div>
                          <div class="HomepageDashboardGraphic__column">
                              <div
                                  class="HomepageDashboardGraphic__flexGroup--gap HomepageDashboardGraphic__flexGroup--baseline">
                                  <span class="HomepageDashboardGraphic__copy--medium"><b>New customers</b></span>
                                  <span class="HomepageDashboardGraphic__copy--XSmall"><b>+32.1%</b></span>
                              </div>
                              <div
                                  class="HomepageDashboardGraphic__flexGroup--gap HomepageDashboardGraphic__flexGroup--baseline HomepageDashboardGraphic__verticalSpacing">
                                  <span class="HomepageDashboardGraphic__copy--large"><b>37</b></span>
                                  <span class="HomepageDashboardGraphic__copy--small">28</span>
                              </div>

                              <div class="HomepageDashboardGraphic__sectionGraph">
                                  <svg
                                      class="HomepageDashboardGraphic__sectionGraphSvg"
                                      xmlns="http://www.w3.org/2000/svg"
                                      fill="none"
                                      width="220"
                                      height="112"
                                      viewBox="0 0 220 112"
                                  >
                                      <g clip-path="url(#homepage-new-customer-graph-layer-a)">
                                          <mask
                                              id="homepage-new-customer-graph-layer-b"
                                              style="mask-type:luminance"
                                              maskUnits="userSpaceOnUse"
                                              x="0"
                                              y="0"
                                              width="220"
                                              height="112"
                                          >
                                              <path
                                                  d="M220 0H0v112h220V0Z"
                                                  fill="#fff"
                                              ></path>
                                          </mask>
                                          <g mask="url(#homepage-new-customer-graph-layer-b)">
                                              <mask
                                                  id="homepage-new-customer-graph-layer-c"
                                                  style="mask-type:luminance"
                                                  maskUnits="userSpaceOnUse"
                                                  x="0"
                                                  y="0"
                                                  width="220"
                                                  height="112"
                                              >
                                                  <path
                                                      d="M220 0H0v112h220V0Z"
                                                      fill="#fff"
                                                  ></path>
                                              </mask>
                                              <g mask="url(#homepage-new-customer-graph-layer-c)">
                                                  <mask
                                                      id="homepage-new-customer-graph-layer-d"
                                                      style="mask-type:luminance"
                                                      maskUnits="userSpaceOnUse"
                                                      x="0"
                                                      y="0"
                                                      width="220"
                                                      height="112"
                                                  >
                                                      <path
                                                          d="M0 0h220v112H0V0Z"
                                                          fill="#fff"
                                                      ></path>
                                                  </mask>
                                                  <g mask="url(#homepage-new-customer-graph-layer-d)">
                                                      <g opacity=".3">
                                                          <path
                                                              d="M218.625 108.961H.81v.351h217.815v-.351Z"
                                                              fill="#C4CCD8"
                                                          ></path>
                                                          <path
                                                              d="M218.625 108.961H.81v.351h217.815v-.351Z"
                                                              stroke="#C4CCD8"
                                                              stroke-width=".423"
                                                          ></path>
                                                      </g>
                                                      <path
                                                          opacity=".3"
                                                          d="M218.844 49.185h-32.949l-32.948 14.9-32.95-5.8-32.948 33.7-32.948 16.8H21.15"
                                                          stroke="#C4CCD8"
                                                          stroke-width=".846"
                                                          stroke-linejoin="round"
                                                      ></path>
                                                      <path
                                                          d="m21.15 108.785 32.95-14.8 32.949-24.9 32.948 12.8 32.95-32.7 32.948-4 32.949-25.8"
                                                          stroke="#fff"
                                                          stroke-width="3.383"
                                                          stroke-linejoin="round"
                                                      ></path>
                                                      <path
                                                          d="m21.15 108.785 32.95-14.8 32.949-24.9 32.948 12.8 32.95-32.7 32.948-4 32.949-25.8"
                                                          stroke="#635BFF"
                                                          stroke-width="1.691"
                                                          stroke-linejoin="round"
                                                      ></path>
                                                      <path
                                                          opacity=".3"
                                                          d="M21.62 109.662h-.313v2.456h.313v-2.456Z"
                                                          stroke="#C4CCD8"
                                                          stroke-width=".423"
                                                          stroke-linejoin="round"
                                                      ></path>
                                                      <mask
                                                          id="homepage-new-customer-graph-layer-e"
                                                          style="mask-type:luminance"
                                                          maskUnits="userSpaceOnUse"
                                                          x="0"
                                                          y="8"
                                                          width="8"
                                                          height="7"
                                                      >
                                                          <path
                                                              d="M0 8h8v7H0V8Z"
                                                              fill="#fff"
                                                          ></path>
                                                      </mask>
                                                      <g mask="url(#homepage-new-customer-graph-layer-e)">
                                                          <path
                                                              d="M2.426 14.501v-4.63h-.06L1 10.863v-.707l1.43-1.028h.667V14.5h-.67l-.001.001Zm2.224 0v-.462l1.817-1.966c.686-.742.887-1.02.887-1.49v-.008c0-.566-.384-.99-1.017-.99-.644 0-1.073.42-1.073 1.054l-.003.007-.64-.004-.008-.003C4.616 9.685 5.353 9 6.382 9c.938 0 1.657.637 1.657 1.505v.007c0 .615-.264 1.062-1.236 2.063L5.58 13.838v.06h2.55v.603H4.65Z"
                                                              fill="#727F96"
                                                          ></path>
                                                      </g>
                                                      <path
                                                          d="M3.896 105.628c-1.188 0-1.896-1.084-1.896-2.812v-.008C2 101.08 2.708 100 3.896 100s1.903 1.08 1.903 2.808v.008c0 1.728-.715 2.812-1.903 2.812Zm0-.585c.77 0 1.229-.857 1.229-2.227v-.008c0-1.37-.458-2.219-1.23-2.219-.77 0-1.22.849-1.22 2.219v.008c0 1.37.451 2.227 1.221 2.227Z"
                                                          fill="#727F96"
                                                      ></path>
                                                  </g>
                                              </g>
                                          </g>
                                      </g>
                                      <defs>
                                          <clippath id="homepage-new-customer-graph-layer-a">
                                              <path
                                                  fill="#fff"
                                                  d="M0 0h220v112H0z"
                                              ></path>
                                          </clippath>
                                      </defs>
                                  </svg>
                                  <div class="HomepageDashboardGraphic__flexGroup">
                                      <span class="HomepageDashboardGraphic__copy--XSmall">Apr 20</span>
                                      <span class="HomepageDashboardGraphic__copy--XSmall">Today</span>
                                  </div>
                              </div>

                              <div
                                  class="StartupHubHomeDashboardGraphic__updatedTime HomepageDashboardGraphic__flexGroup--gap">
                                  <span class="HomepageDashboardGraphic__copy--XSmall">Updated today 7:50 AM</span>
                              </div>
                          </div>
                          <div class="HomepageDashboardGraphic__column">
                              <span class="HomepageDashboardGraphic__copy--medium"><b>Invoices</b></span>
                              <div class="HomepageDashboardGraphic__paymentsBar">
                                  <div class="HomepageDashboardGraphic__paymentsBar--purple"></div>
                                  <div class="HomepageDashboardGraphic__paymentsBar--blue"></div>
                                  <div class="HomepageDashboardGraphic__paymentsBar--teal"></div>
                              </div>
                              <div class="HomepageDashboardGraphic__lineItem HomepageDashboardGraphic__flexGroup">
                                  <div
                                      class="HomepageDashboardGraphic__flexGroup--gap HomepageDashboardGraphic__copy--lineItem HomepageDashboardGraphic__copy--smallInvoices">
                                      <div class="HomepageDashboardGraphic__block"></div>
                                      Paid
                                  </div>
                                  <span class="HomepageDashboardGraphic__copy--small"><b>$25,000.00</b></span>
                              </div>
                              <div class="HomepageDashboardGraphic__lineItem HomepageDashboardGraphic__flexGroup">
                                  <div
                                      class="HomepageDashboardGraphic__flexGroup--gap HomepageDashboardGraphic__copy--lineItem HomepageDashboardGraphic__copy--smallInvoices">
                                      <div
                                          class="HomepageDashboardGraphic__block HomepageDashboardGraphic__block--blue">
                                      </div>
                                      Open
                                  </div>
                                  <span class="HomepageDashboardGraphic__copy--small"><b>$20,000.00</b></span>
                              </div>
                              <div class="HomepageDashboardGraphic__lineItem HomepageDashboardGraphic__flexGroup">
                                  <div
                                      class="HomepageDashboardGraphic__flexGroup--gap HomepageDashboardGraphic__copy--lineItem HomepageDashboardGraphic__copy--smallInvoices">
                                      <div
                                          class="HomepageDashboardGraphic__block HomepageDashboardGraphic__block--teal">
                                      </div>
                                      Past due
                                  </div>
                                  <span class="HomepageDashboardGraphic__copy--small"><b>$1,000.00</b></span>
                              </div>
                              <div
                                  class="HomepageDashboardGraphic__updatedTime HomepageDashboardGraphic__flexGroup--gap">
                                  <span class="HomepageDashboardGraphic__copy--XSmall">Updated today 7:50 AM</span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="HomepageDashboardGraphic__sideBar">
                      <div class="HomepageDashboardGraphic__iconLayout">
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 20 20"
                              width="20"
                              height="20"
                          >
                              <path
                                  d="M17.333 10.996a.667.667 0 0 1-1.333 0V5a.667.667 0 0 1 1.333 0v5.996Zm-.232 4.173c-.103.088-2.573 2.16-7.101 2.16-4.528 0-6.998-2.072-7.1-2.16a.667.667 0 0 1 .866-1.014c.039.033 2.244 1.84 6.234 1.84 4.04 0 6.211-1.82 6.233-1.838a.667.667 0 0 1 .868 1.012ZM2.667 5A.667.667 0 0 1 4 5v5.996a.667.667 0 0 1-1.333 0V5ZM6 3.667a.667.667 0 0 1 1.333 0v8.906a.667.667 0 0 1-1.333 0V3.667Zm3.333-.338a.667.667 0 1 1 1.334 0v9.667a.667.667 0 0 1-1.334 0V3.329Zm3.334.338a.667.667 0 0 1 1.333 0v8.906a.667.667 0 0 1-1.333 0V3.667ZM17.5 0h-15A2.5 2.5 0 0 0 0 2.5v15A2.5 2.5 0 0 0 2.5 20h15a2.5 2.5 0 0 0 2.5-2.5v-15A2.5 2.5 0 0 0 17.5 0Z"
                                  fill="#081C34"
                              ></path>
                          </svg>
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 20 21"
                              width="20"
                              height="21"
                          >
                              <mask
                                  id="homepage-xero-path-a"
                                  style="mask-type:alpha"
                                  maskUnits="userSpaceOnUse"
                                  x="0"
                                  y="0"
                                  width="20"
                                  height="21"
                              >
                                  <path
                                      d="M16.66.77H3.585a3.27 3.27 0 0 0-3.27 3.27v13.077a3.27 3.27 0 0 0 3.27 3.27H16.66a3.27 3.27 0 0 0 3.27-3.27V4.04A3.27 3.27 0 0 0 16.66.77Z"
                                      fill="#C4C4C4"
                                  ></path>
                              </mask>
                              <g mask="url(#homepage-xero-path-a)">
                                  <path
                                      d="M19.93.77H.314v19.616H19.93V.771Z"
                                      fill="#13B5EA"
                                  ></path>
                                  <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M10.055 3.235a7.2 7.2 0 0 1 7.2 7.198 7.2 7.2 0 0 1-7.2 7.198 7.2 7.2 0 0 1-7.2-7.198 7.2 7.2 0 0 1 7.2-7.198Zm2.391 7.177a1.616 1.616 0 0 0 3.23 0c0-.89-.725-1.614-1.615-1.614s-1.615.724-1.615 1.614Zm.456 0a1.16 1.16 0 0 1 2.317 0 1.16 1.16 0 0 1-2.317 0ZM7.584 9.181l-1.229 1.231 1.229 1.23a.22.22 0 1 1-.316.306L6.04 10.726 4.81 11.954a.22.22 0 1 1-.309-.313l1.228-1.23L4.5 9.181a.22.22 0 1 1 .31-.313l1.233 1.23L7.271 8.87a.22.22 0 0 1 .313.31Zm6.477 1.63a.4.4 0 1 1 0-.8.4.4 0 0 1 0 .8Zm-1.797-1.984h.068a.22.22 0 0 1 .22.22c0 .122-.092.211-.223.216-.002 0-.05 0-.092.004-.478.06-.529.285-.529.842v1.671a.22.22 0 0 1-.44 0V9.064c0-.122.096-.219.217-.219a.22.22 0 0 1 .216.173.916.916 0 0 1 .563-.19Zm-1.443 1.278a1.61 1.61 0 0 0-.716-1.055 1.628 1.628 0 0 0-1.799.048 1.632 1.632 0 0 0-.632 1.714c.163.64.714 1.126 1.37 1.206.195.023.385.012.581-.039.17-.04.332-.11.483-.205.156-.1.287-.233.413-.392l.003-.003.005-.005c.087-.109.071-.264-.025-.337-.082-.063-.218-.088-.325.05a1.487 1.487 0 0 1-.078.1 1.266 1.266 0 0 1-.318.257 1.16 1.16 0 0 1-.541.136c-.64-.007-.983-.454-1.105-.773a1.15 1.15 0 0 1-.05-.185.505.505 0 0 1-.002-.034h2.298c.315-.006.485-.229.438-.483Zm-2.717.041v-.018a1.167 1.167 0 0 1 2.266.018H8.104Z"
                                      fill="#fff"
                                  ></path>
                              </g>
                          </svg>
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 20 20"
                              width="20"
                              height="20"
                          >
                              <g clip-path="url(#startup-hub-mailchip-path-a)">
                                  <path
                                      d="M0 0h20v20H0V0Z"
                                      fill="#FEE954"
                                  ></path>
                                  <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M15.428 11.57c.058.182.092.3.092.332.216 0 .525.208.475.767 0 .55-.217 1.158-.275 1.283-.792 1.892-2.71 2.96-4.968 2.9-2.1-.066-3.9-1.158-4.692-2.992-.492 0-.975-.216-1.342-.55-.358-.366-.608-.825-.667-1.283-.025-.367 0-.7.125-1.008l-.425-.367c-2.008-1.71 4.3-8.752 6.276-6.985.033 0 .7.667.7.667l.367-.15c1.8-.733 3.234-.367 3.234.792 0 .608-.4 1.342-1.009 1.984.242.216.425.55.517.916.092.275.125.55.125.734.033.24.033.825.033.825l.242.058c.458.125.825.309.975.492.15.183.242.367.275.55.034.15.034.45-.183.758l.125.276Zm-9.239 1.772c.023-.003.044-.007.063-.007.766-.125.941-.916.825-1.75-.15-.883-.759-1.183-1.159-1.217-.125 0-.217 0-.308.034-.734.158-1.125.767-1.067 1.558.058.734.825 1.342 1.492 1.375.046.023.104.015.154.007Zm-1.796-2.724c.25-.366.642-.608 1.1-.7.575-1.558 1.55-2.992 2.834-3.942.623-.51 1.287-.97 1.983-1.375 0 0-.55-.642-.733-.7-1.008-.267-3.234 1.258-4.634 3.267-.583.8-1.409 2.259-1.008 2.992.033.092.308.333.458.458Zm8.326 2.376-.033.033s-.825.4-2.192 0c.066.31.342.434.492.492.183.058.366.09.366.09 1.617.277 3.142-.64 3.476-.882.033-.025.067 0 .033.033l-.033.06c-.4.55-1.525 1.157-2.992 1.157-.609 0-1.25-.25-1.492-.583-.359-.517-.025-1.31.583-1.217l.275.033c.759.092 1.825 0 2.742-.425.825-.4 1.159-.825 1.1-1.158a.567.567 0 0 0-.15-.275c-.15-.15-.391-.242-.791-.367a3.623 3.623 0 0 1-.309-.092c-.183-.058-.241-.116-.275-.425 0-.054-.006-.174-.013-.312-.01-.18-.02-.39-.02-.513l-.005-.055c-.031-.355-.069-.772-.362-.978a.348.348 0 0 0-.242-.092c-.065-.024-.096-.014-.12-.006a.74.74 0 0 0-.37.177l-.06.046c-.366.3-.7.333-1.033.333-.08 0-.177-.012-.28-.026a3.068 3.068 0 0 0-.387-.032h-.15c-.575-.025-1.217.458-1.308 1.192-.121.81.325 1.305.617 1.627.07.078.132.146.174.206l.011.014c.023.03.048.06.048.11 0 .056-.021.11-.059.15-.616.61-.8 1.585-.583 2.41a.56.56 0 0 0 .063.237l.029.07c.516 1.25 2.158 1.8 3.809 1.285.208-.06.425-.15.608-.242.358-.183.7-.425.942-.7.392-.458.667-.917.758-1.525.025-.31-.033-.434-.125-.492-.091-.067-.216-.033-.216-.033s-.067-.4-.217-.734a4.663 4.663 0 0 1-1.525.76 5.751 5.751 0 0 1-2.042.215 6.524 6.524 0 0 1-.215-.033c-.325-.053-.532-.088-.636.217 1.009.366 2.076.216 2.076.216s.033 0 .033.034ZM9.785 5.8c-.55.275-1.183.792-1.675 1.375-.021.022-.006.025.026.03l.016.004a5.054 5.054 0 0 1 1.8-.792 4.823 4.823 0 0 1 2.225 0c.034 0 .067-.06.034-.06-.334-.207-.85-.332-1.217-.332-.033 0-.033-.033-.033-.033.031-.032.06-.064.086-.095a.742.742 0 0 1 .155-.147s0-.033-.033-.033c-.525.025-1.134.275-1.467.516 0 0-.033 0-.033-.033.016-.08.06-.171.098-.25.02-.044.04-.084.052-.117 0-.033 0-.033-.034-.033Zm3.118 3.934h.275c.058-.125.058-.308 0-.517-.059-.308-.15-.516-.334-.49-.183.032-.183.274-.125.582a.744.744 0 0 0 .184.425Zm-1.617.275c.125.058.217.092.242.058.024-.024.012-.045-.009-.08l-.025-.045c-.058-.125-.216-.216-.333-.275a.896.896 0 0 0-.917.125c-.091.06-.183.15-.15.217 0 .033.034.033.059.033.019 0 .063-.014.124-.033.122-.04.312-.1.517-.117.184-.008.367.06.492.117Zm-.61.3c.06-.058.151-.116.334-.15.242-.025.425.067.434.16v.057c-.015.02-.033.016-.064.01-.021-.004-.049-.01-.086-.01-.15-.033-.309-.033-.55.058 0 0-.092.034-.125.034h-.034v-.034c0-.033.034-.066.092-.125h-.001Zm1.676.4c.125.058.242.033.308-.058.034-.092-.033-.217-.15-.275-.125-.06-.242-.034-.308.058-.067.092.025.217.15.275Zm.576-.425c0-.15.091-.24.183-.24s.158.115.183.24c0 .15-.091.242-.183.242-.125 0-.183-.117-.183-.242ZM6.652 12.42c-.033-.034-.058-.034-.091 0h-.092c-.058 0-.125-.034-.15-.092a.43.43 0 0 1 0-.275l.033-.058c.092-.184.217-.46.059-.734-.125-.217-.275-.333-.492-.367a.59.59 0 0 0-.55.217c-.217.242-.242.55-.217.667 0 .033.033.058.058.058.034 0 .092-.033.125-.125v-.033c0-.06.034-.125.092-.217.058-.092.15-.15.242-.15.091-.033.216 0 .308.058.15.092.217.275.15.46-.091.09-.125.241-.125.4.034.274.217.4.367.424.15 0 .275-.092.275-.15.022-.034.018-.045.013-.06-.002-.005-.005-.012-.005-.023Z"
                                      fill="#0A0903"
                                  ></path>
                              </g>
                              <defs>
                                  <clippath id="startup-hub-mailchip-path-a">
                                      <rect
                                          width="20"
                                          height="20"
                                          rx="3"
                                          fill="#fff"
                                      ></rect>
                                  </clippath>
                              </defs>
                          </svg>
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 20 20"
                              width="20"
                              height="20"
                          >
                              <g clip-path="url(#startup-hub-docusign-path-a)">
                                  <path
                                      d="M0 0h20v20H0V0Z"
                                      fill="#E2F800"
                                  ></path>
                                  <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="m9.15 8.676-.001 1.432-.087.06-.595-.605c-.546-.555-1.092-1.11-1.63-1.67-.151-.157-.242-.173-.395-.004-.261.29-.538.566-.827.827-.174.156-.144.243.008.393a713.482 713.482 0 0 1 4.168 4.156c.143.145.225.19.393.02A564.476 564.476 0 0 1 14.38 9.1c.169-.167.14-.251-.014-.393-.277-.255-.547-.52-.8-.799-.155-.172-.248-.191-.423-.008-.369.387-.75.763-1.13 1.14l-.466.461-.686.683V8.458c-.004-1.364-.002-2.729.007-4.093.004-.297-.077-.385-.367-.361-.323.026-.65.026-.973 0-.3-.024-.39.062-.387.376.012 1.432.01 2.864.009 4.296Zm-.57 7.31h1.393v.002h1.34a789.28 789.28 0 0 1 4.352.005c.248.001.352-.052.334-.32a6.918 6.918 0 0 1 0-1.052c.026-.315-.084-.388-.388-.387-2.247.009-4.494.008-6.741.008H6.36c-.673.001-1.345.002-2.018-.006-.243-.003-.353.05-.333.321.025.35.028.704 0 1.052-.027.314.083.387.388.385 1.394-.009 2.787-.011 4.181-.008h.002Z"
                                      fill="#000"
                                  ></path>
                              </g>
                              <defs>
                                  <clippath id="startup-hub-docusign-path-a">
                                      <rect
                                          width="20"
                                          height="20"
                                          rx="3"
                                          fill="#fff"
                                      ></rect>
                                  </clippath>
                              </defs>
                          </svg>
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 20 20"
                              width="20"
                              height="20"
                          >
                              <g clip-path="url(#startup-hub-owl-path-a)">
                                  <mask
                                      id="startup-hub-owl-path-b"
                                      style="mask-type:luminance"
                                      maskUnits="userSpaceOnUse"
                                      x="0"
                                      y="0"
                                      width="20"
                                      height="20"
                                  >
                                      <path
                                          d="M20 0H0v20h20V0Z"
                                          fill="#fff"
                                      ></path>
                                  </mask>
                                  <g mask="url(#startup-hub-owl-path-b)">
                                      <path
                                          d="M16.667 0H3.333A3.333 3.333 0 0 0 0 3.333v13.334A3.333 3.333 0 0 0 3.333 20h13.334A3.333 3.333 0 0 0 20 16.667V3.333A3.333 3.333 0 0 0 16.667 0Z"
                                          fill="#CCE3FA"
                                      ></path>
                                      <mask
                                          id="startup-hub-owl-path-c"
                                          style="mask-type:luminance"
                                          maskUnits="userSpaceOnUse"
                                          x="5"
                                          y="3"
                                          width="10"
                                          height="15"
                                      >
                                          <path
                                              d="M14.227 3.333H5.556V17.43h8.671V3.333Z"
                                              fill="#fff"
                                          ></path>
                                      </mask>
                                      <g
                                          mask="url(#startup-hub-owl-path-c)"
                                          fill="#232323"
                                      >
                                          <path
                                              d="M14.227 12.343v4.829c0 .183-.071.254-.254.254-.66 0-1.32.008-1.98-.002-1.529-.021-2.891-.512-4.069-1.485a6.396 6.396 0 0 1-2.204-3.565 6.394 6.394 0 0 1-.164-1.461c0-1.074-.002-2.147.001-3.221.003-1.115.373-2.094 1.118-2.924a4.193 4.193 0 0 1 2.35-1.343c1.102-.22 2.148-.046 3.11.54.977.594 1.621 1.452 1.935 2.553.111.388.157.786.157 1.189v4.636Zm-4.256-.878c.176 0 .428-.022.675-.075.944-.2 1.718-.681 2.29-1.46.697-.949.903-2.008.64-3.157a2.577 2.577 0 0 0-.389-.93 1.505 1.505 0 0 0-1.15-.667 1.802 1.802 0 0 0-.945.185 1.81 1.81 0 0 0-.868.842c-.102.207-.15.426-.152.656-.002.13-.08.209-.195.2-.098-.006-.164-.083-.165-.2a1.523 1.523 0 0 0-.079-.485c-.181-.522-.537-.885-1.034-1.111a1.608 1.608 0 0 0-1.085-.114c-.44.111-.754.39-.977.773-.254.438-.378.917-.424 1.416-.044.487.01.965.147 1.434.469 1.585 1.964 2.694 3.711 2.693Zm2.587 5.42h1.009c.087 0 .118-.032.118-.12v-.295c0-.1-.028-.127-.129-.127h-1.475a5.5 5.5 0 0 1-.963-.083 5.333 5.333 0 0 1-2.37-1.05 5.377 5.377 0 0 1-1.693-2.208 5.332 5.332 0 0 1-.394-1.61c-.023-.26-.02-.52-.02-.782a.186.186 0 0 0-.03-.113l-.261-.368c-.042-.058-.099-.077-.158-.059-.057.018-.093.07-.093.14v.319c-.004.437.001.874.07 1.308.123.792.391 1.53.814 2.21a5.933 5.933 0 0 0 2.554 2.278 5.838 5.838 0 0 0 2.194.55c.293.016.586.004.827.01Zm.03-1.085h.976c.091 0 .121-.03.121-.123v-.289c0-.103-.027-.13-.132-.13h-1.481a4.32 4.32 0 0 1-2.033-.5 4.308 4.308 0 0 1-2.038-2.31 3.92 3.92 0 0 1-.23-.906c-.008-.055-.024-.104-.074-.137-.093-.06-.183-.123-.274-.186-.049-.033-.1-.043-.153-.013-.055.032-.074.082-.068.143.01.08.017.16.027.239.065.492.204.963.417 1.41a4.836 4.836 0 0 0 1.786 2.033 4.795 4.795 0 0 0 2.339.76c.288.017.577.005.817.01Zm.077-1.083h.888c.105 0 .132-.027.132-.13v-.283c0-.101-.027-.13-.127-.13h-1.462c-.137.001-.273-.006-.409-.021a3.187 3.187 0 0 1-1.675-.706 3.172 3.172 0 0 1-1.016-1.44.186.186 0 0 0-.14-.133c-.081-.02-.161-.046-.241-.07-.06-.02-.12-.026-.169.023-.05.049-.044.107-.026.168a3.759 3.759 0 0 0 1.588 2.118c.543.354 1.14.549 1.788.593.308.021.617.004.87.01Zm.078-1.084h.818c.096 0 .124-.03.124-.126v-.29c0-.098-.028-.126-.13-.126-.509 0-1.019.003-1.528-.001a2.1 2.1 0 0 1-1.084-.31 2.103 2.103 0 0 1-.705-.686c-.03-.05-.066-.094-.129-.096a4.247 4.247 0 0 0-.33 0c-.1.005-.153.102-.113.193a.823.823 0 0 0 .055.1c.546.874 1.334 1.324 2.365 1.341.22.004.438 0 .656 0Zm.031-1.084h.8c.077 0 .11-.034.111-.11v-.306c0-.097-.029-.126-.125-.126-.465 0-.93-.004-1.395.002-.273.003-.525-.049-.746-.216a.142.142 0 0 0-.132-.02c-.09.026-.18.05-.271.077-.142.04-.173.154-.067.255.305.292.672.434 1.091.443.245.005.49 0 .734 0Zm.189-1.084h.607c.082 0 .115-.032.115-.111v-.32c0-.078-.033-.11-.114-.11l-.747-.001a.193.193 0 0 0-.117.037c-.139.1-.278.198-.417.296-.05.034-.08.077-.06.137.02.057.067.073.125.073.202-.002.405-.001.608-.001Z"
                                          ></path>
                                          <path
                                              d="M7.993 6.046a.814.814 0 0 1 .815.807.814.814 0 0 1-.81.819.814.814 0 0 1-.815-.814c0-.446.364-.81.81-.812ZM11.788 6.046c.446 0 .811.363.813.81a.815.815 0 0 1-.813.816.814.814 0 0 1-.813-.816.815.815 0 0 1 .813-.81Z"
                                          ></path>
                                      </g>
                                      <g clip-path="url(#startup-hub-owl-path-d)">
                                          <mask
                                              id="startup-hub-owl-path-e"
                                              style="mask-type:luminance"
                                              maskUnits="userSpaceOnUse"
                                              x="0"
                                              y="0"
                                              width="20"
                                              height="20"
                                          >
                                              <path
                                                  d="M0 0h20v20H0V0Z"
                                                  fill="#fff"
                                              ></path>
                                          </mask>
                                          <g mask="url(#startup-hub-owl-path-e)">
                                              <path
                                                  d="M16.667 0H3.333A3.333 3.333 0 0 0 0 3.333v13.334A3.333 3.333 0 0 0 3.333 20h13.334A3.333 3.333 0 0 0 20 16.667V3.333A3.333 3.333 0 0 0 16.667 0Z"
                                                  fill="#CCE3FA"
                                              ></path>
                                              <mask
                                                  id="startup-hub-owl-path-f"
                                                  style="mask-type:luminance"
                                                  maskUnits="userSpaceOnUse"
                                                  x="5"
                                                  y="3"
                                                  width="10"
                                                  height="15"
                                              >
                                                  <path
                                                      d="M14.228 3.333H5.556V17.43h8.672V3.333Z"
                                                      fill="#fff"
                                                  ></path>
                                              </mask>
                                              <g
                                                  mask="url(#startup-hub-owl-path-f)"
                                                  fill="#232323"
                                              >
                                                  <path
                                                      d="M14.228 12.343v4.828c0 .184-.072.256-.256.256-.66 0-1.32.006-1.98-.003-1.528-.022-2.89-.513-4.068-1.485a6.395 6.395 0 0 1-2.204-3.565c-.11-.479-.166-.969-.164-1.46 0-1.075-.003-2.148 0-3.223A4.259 4.259 0 0 1 6.675 4.77a4.193 4.193 0 0 1 2.348-1.345c1.104-.218 2.15-.044 3.111.54.978.595 1.622 1.453 1.935 2.554.111.389.158.785.158 1.189v4.636Zm-4.256-.877c.175 0 .427-.023.675-.076.944-.2 1.716-.681 2.289-1.459.697-.95.903-2.01.64-3.158-.066-.333-.199-.649-.388-.93a1.505 1.505 0 0 0-1.151-.667 1.8 1.8 0 0 0-.945.185c-.377.173-.683.47-.867.842-.1.205-.152.429-.153.656-.002.13-.08.209-.195.2-.098-.006-.164-.083-.165-.2 0-.165-.026-.328-.079-.484-.182-.523-.536-.886-1.033-1.112a1.609 1.609 0 0 0-1.085-.114c-.44.111-.755.389-.978.773-.254.438-.378.917-.423 1.416A3.79 3.79 0 0 0 6.26 8.77c.469 1.586 1.965 2.696 3.711 2.695h.001Zm2.586 5.418h1.009c.088 0 .117-.03.119-.12v-.294c0-.1-.03-.128-.13-.128H12.08a5.5 5.5 0 0 1-.963-.082 5.334 5.334 0 0 1-2.371-1.05 5.377 5.377 0 0 1-1.692-2.208 5.332 5.332 0 0 1-.394-1.61c-.022-.26-.02-.52-.02-.782a.186.186 0 0 0-.03-.113l-.26-.368c-.042-.058-.1-.078-.159-.059-.056.018-.093.07-.093.14v.319a7.92 7.92 0 0 0 .069 1.308c.119.784.396 1.537.815 2.21a5.933 5.933 0 0 0 2.554 2.279c.688.324 1.434.51 2.194.549.293.016.586.004.827.01Zm.03-1.084h.977c.09 0 .12-.03.12-.122v-.29c0-.102-.027-.13-.133-.13h-1.48a4.313 4.313 0 0 1-2.033-.5A4.307 4.307 0 0 1 8 12.449a3.92 3.92 0 0 1-.23-.906c-.008-.055-.023-.104-.074-.137a8.95 8.95 0 0 1-.274-.186c-.048-.033-.1-.043-.153-.012-.055.03-.074.08-.067.142.046.573.197 1.132.445 1.65a4.837 4.837 0 0 0 1.784 2.033c.7.452 1.507.714 2.34.76.288.016.577.004.816.008Zm.078-1.083h.886c.107 0 .134-.027.134-.13v-.282c0-.102-.028-.13-.127-.13h-1.463c-.137 0-.273-.007-.408-.023a3.187 3.187 0 0 1-1.677-.705 3.172 3.172 0 0 1-1.014-1.44.186.186 0 0 0-.14-.133c-.082-.02-.162-.046-.242-.07-.06-.02-.12-.026-.168.023-.05.049-.045.106-.027.168a3.76 3.76 0 0 0 1.589 2.118c.534.35 1.15.554 1.787.594.309.02.617.003.87.01Zm.077-1.084h.818c.096 0 .125-.03.125-.126v-.29c0-.1-.03-.126-.13-.126-.51 0-1.02.002-1.53 0a2.101 2.101 0 0 1-1.084-.31 2.105 2.105 0 0 1-.703-.688c-.031-.049-.067-.093-.13-.095a4.35 4.35 0 0 0-.331 0c-.098.004-.152.102-.111.193a.835.835 0 0 0 .054.1c.546.875 1.334 1.325 2.366 1.341.219.004.436 0 .655 0l.001.001Zm.031-1.084h.8c.078 0 .112-.033.112-.11v-.307c0-.095-.03-.125-.126-.125-.464 0-.93-.004-1.396.002-.272.003-.524-.049-.745-.216a.142.142 0 0 0-.131-.02l-.272.077c-.142.04-.173.155-.067.256.304.29.672.433 1.091.442.245.005.489 0 .735 0Zm.19-1.085h.606c.082 0 .114-.032.116-.11v-.32c0-.077-.034-.11-.115-.11h-.746a.193.193 0 0 0-.118.036l-.417.296c-.05.034-.079.077-.059.136.02.058.067.074.123.074h.608l.001-.002Z"
                                                  ></path>
                                                  <path
                                                      d="M7.993 6.046a.815.815 0 0 1 .579 1.384.814.814 0 0 1-1.15.003.815.815 0 0 1-.24-.575c0-.446.365-.812.811-.812Zm3.796 0a.813.813 0 0 1 0 1.625.814.814 0 0 1-.575-1.387.817.817 0 0 1 .575-.238Z"
                                                  ></path>
                                              </g>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                              <defs>
                                  <clippath id="startup-hub-owl-path-a">
                                      <path
                                          fill="#fff"
                                          d="M0 0h20v20H0z"
                                      ></path>
                                  </clippath>
                                  <clippath id="startup-hub-owl-path-d">
                                      <path
                                          fill="#fff"
                                          d="M0 0h20v20H0z"
                                      ></path>
                                  </clippath>
                              </defs>
                          </svg>
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 20 20"
                              width="20"
                              height="20"
                          >
                              <g clip-path="url(#startup-hub-kyber-path-a)">
                                  <path
                                      d="M0 0h20v20H0V0Z"
                                      fill="#FF2951"
                                  ></path>
                                  <path
                                      d="M7.762 15.42c.423.09.844.19 1.273.247.541.07 1.09.09 1.634.053a7.568 7.568 0 0 0 3.111-.924c.28-.154.552-.324.814-.51 3.046-2.144 3.223-6.125.398-8.527-2.658-2.26-6.97-2.354-9.72-.213-.76.592-1.413 1.347-1.822 2.243a4.92 4.92 0 0 0-.421 2.576c.098.88.473 1.79 1.008 2.53.29.398.623.763.994 1.086.02.017.193.149.188.168-.223.963-.552 1.907-.838 2.85.473-.27.947-.537 1.42-.81.509-.29 1.003-.6 1.53-.853.144.026.288.055.431.086v-.002Z"
                                      fill="#A22636"
                                  ></path>
                                  <path
                                      d="M7.762 15.42c.423.09.844.19 1.273.247.541.07 1.09.09 1.634.053a7.568 7.568 0 0 0 3.111-.924c.28-.154.552-.324.814-.51 3.046-2.144 3.223-6.125.398-8.527-2.658-2.26-6.97-2.354-9.72-.213-.76.592-1.413 1.347-1.822 2.243a4.92 4.92 0 0 0-.421 2.576c.098.88.473 1.79 1.008 2.53.29.398.623.763.994 1.086.02.017.193.149.188.168-.223.963-.552 1.907-.838 2.85.473-.27.947-.537 1.42-.81.509-.29 1.003-.6 1.53-.853.144.026.288.055.431.086v-.002Z"
                                      fill="#fff"
                                  ></path>
                                  <path
                                      d="M8.9 12.986c-.124-.31-.826-1.996-1.894-3.098a.02.02 0 0 1-.004-.026.02.02 0 0 1 .007-.006c.155-.103 1.151-.67 1.89 1.091.007.018.033.02.042.002.215-.447 1.912-3.914 2.905-3.942.168-.005.334-.01.502-.006.125.004.251.008.377.019.063.005.126.012.187.023.087.015.125.138.041.182l-.023.013-.052.03c-.095.057-.187.12-.275.188a5.862 5.862 0 0 0-.597.548 8.33 8.33 0 0 0-.509.59c-.208.26-.405.53-.59.808-.235.346-.457.7-.666 1.063a30.24 30.24 0 0 0-1.299 2.521c-.009.019-.036.019-.042 0Z"
                                      fill="#E3E4E4"
                                  ></path>
                                  <path
                                      d="M8.9 12.986c-.124-.31-.826-1.996-1.894-3.098a.02.02 0 0 1-.004-.026.02.02 0 0 1 .007-.006c.155-.103 1.151-.67 1.89 1.091.007.018.033.02.042.002.215-.447 1.912-3.914 2.905-3.942.168-.005.334-.01.502-.006.125.004.251.008.377.019.063.005.126.012.187.023.087.015.125.138.041.182l-.023.013-.052.03c-.095.057-.187.12-.275.188a5.862 5.862 0 0 0-.597.548 8.33 8.33 0 0 0-.509.59c-.208.26-.405.53-.59.808-.235.346-.457.7-.666 1.063a30.24 30.24 0 0 0-1.299 2.521c-.009.019-.036.019-.042 0Z"
                                      fill="#00A7F7"
                                  ></path>
                              </g>
                              <defs>
                                  <clippath id="startup-hub-kyber-path-a">
                                      <rect
                                          width="20"
                                          height="20"
                                          rx="3"
                                          fill="#fff"
                                      ></rect>
                                  </clippath>
                              </defs>
                          </svg>
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 20 20"
                              width="20"
                              height="20"
                          >
                              <path
                                  d="M16.448 0H3.552C1.59 0 0 1.492 0 3.333v13.334C0 18.507 1.59 20 3.552 20h12.896C18.41 20 20 18.508 20 16.667V3.333C20 1.493 18.41 0 16.448 0Z"
                                  fill="#F6F8FA"
                              ></path>
                              <path
                                  fill-rule="evenodd"
                                  clip-rule="evenodd"
                                  d="M10.523 9.577h3.681c.34 0 .614.293.614.654 0 .361-.275.654-.614.654h-3.681v3.923c0 .361-.275.654-.614.654-.339 0-.614-.293-.614-.654v-3.923H5.614c-.34 0-.614-.293-.614-.654 0-.361.275-.654.614-.654h3.681V5.654c0-.361.275-.654.614-.654.339 0 .614.293.614.654v3.923Z"
                                  fill="#A3ACBA"
                              ></path>
                          </svg>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <figure
          class="
    HomepageHeroGraphic__phone
    PhoneGraphic

  "
          style="


  "
          aria-hidden="true"
      >
          <div class="PhoneGraphic__screen">
              <div class="
    CheckoutPhoneGraphic


  ">

                  <div class="CheckoutPhoneGraphic__image">
                      <div class="HomepageAbstractionPhone__imageContainer">
                          <svg
                              width="72"
                              height="91"
                              viewBox="0 0 72 91"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                          >
                              <path
                                  d="M47.2675.5H3.25289C1.45637.5 0 1.95637 0 3.75289V69.9255c0 1.7965 1.45637 3.2529 3.25289 3.2529H47.2675c1.7965 0 3.2529-1.4564 3.2529-3.2529V3.75289C50.5204 1.95637 49.064.5 47.2675.5Z"
                                  fill="url(#homepage-abstraction-phone-path-a)"
                              ></path>
                              <path
                                  d="M50.5204 38.9151C31.3754 20.6207 16.6356 13.7735.45563 12.2929L0 12.2512v10.0435c13.8831 1.3733 27.2888 7.4539 46.9645 27.1295L50.5 52.9598l.0204-.0204V38.9151Z"
                                  fill="#FAB000"
                              ></path>
                              <path
                                  d="M12.5919 51.9737c3.5202 0 6.3738-2.8536 6.3738-6.3738s-2.8536-6.3738-6.3738-6.3738c-3.52017 0-6.37382 2.8536-6.37382 6.3738s2.85365 6.3738 6.37382 6.3738Z"
                                  fill="url(#homepage-abstraction-phone-path-b)"
                              ></path>
                              <path
                                  d="M6.32072 62.9735v4.6711h-.83274v-4.6711h.83274Zm.4923 4.0206.58552-.4685c.20168.3318.59203.553.98888.553.3318 0 .63757-.1171.63757-.4228 0-.2928-.28626-.3253-.82624-.4359-.53998-.1106-1.15803-.2473-1.15803-.9759 0-.6246.54649-1.08 1.33369-1.08.59853 0 1.13201.2668 1.37923.6441l-.52697.4749c-.19517-.3057-.52046-.4814-.8978-.4814-.31878 0-.52697.1431-.52697.3708 0 .2473.24722.2928.6766.3839.57902.1236 1.30767.2472 1.30767 1.0279 0 .6896-.63106 1.132-1.40525 1.132-.63107 0-1.26213-.2537-1.5679-.7221Zm3.21478 0 .5855-.4685c.2017.3318.5921.553.9889.553.3318 0 .6376-.1171.6376-.4228 0-.2928-.2863-.3253-.8263-.4359-.5399-.1106-1.158-.2473-1.158-.9759 0-.6246.5465-1.08 1.3337-1.08.5985 0 1.132.2668 1.3792.6441l-.5269.4749c-.1952-.3057-.5205-.4814-.8978-.4814-.3188 0-.527.1431-.527.3708 0 .2473.2472.2928.6766.3839.579.1236 1.3077.2472 1.3077 1.0279 0 .6896-.6311 1.132-1.4053 1.132-.6311 0-1.2621-.2537-1.5679-.7221Zm6.4156-2.765v3.4155h-.7807v-.3643c-.1951.2277-.4879.4359-.9303.4359-.7156 0-1.158-.4879-1.158-1.2231v-2.264h.7807v2.0949c0 .4163.1821.6831.605.6831.3513 0 .7026-.2603.7026-.7482v-2.0298h.7807Zm2.2672 3.4871c-.9759 0-1.659-.7221-1.659-1.7761 0-1.0019.6766-1.7761 1.6264-1.7761.9889 0 1.5159.7482 1.5159 1.685v.2603h-2.3942c.0586.5855.4099.9433.9109.9433.3838 0 .6896-.1952.7937-.5465l.6701.2537c-.2408.5986-.7807.9564-1.4638.9564Zm-.0391-2.8951c-.4033 0-.7156.2407-.8327.7026h1.5679c-.0065-.3773-.2407-.7026-.7352-.7026Zm3.26.488c0-1.4248.6766-2.4072 1.8347-2.4072 1.158 0 1.8346.9824 1.8346 2.4072 0 1.4247-.6766 2.4071-1.8346 2.4071-1.1581 0-1.8347-.9824-1.8347-2.4071Zm.8328 0c0 .9823.3122 1.685 1.0019 1.685.6896 0 1.0019-.7027 1.0019-1.685 0-.9824-.3123-1.685-1.0019-1.685-.6897 0-1.0019.7026-1.0019 1.685Zm3.2778 0c0-1.4248.6766-2.4072 1.8346-2.4072 1.1581 0 1.8347.9824 1.8347 2.4072 0 1.4247-.6766 2.4071-1.8347 2.4071-1.158 0-1.8346-.9824-1.8346-2.4071Zm.8328 0c0 .9823.3122 1.685 1.0018 1.685.6897 0 1.0019-.7027 1.0019-1.685 0-.9824-.3122-1.685-1.0019-1.685-.6896 0-1.0018.7026-1.0018 1.685Zm3.2338 1.6589 1.171-.9628c.6376-.5205 1.2101-.9824 1.2101-1.5679 0-.4815-.2993-.8263-.7937-.8263-.4879 0-.8067.3839-.8067.8458 0 .1496.026.2993.0781.4424h-.7742c-.0651-.1887-.0846-.3123-.0846-.4879 0-.8783.7221-1.5094 1.6069-1.5094.9759 0 1.6004.605 1.6004 1.4833 0 .8263-.6245 1.3923-1.2816 1.9127l-.7807.6181h2.1209v.7286h-3.2659v-.6766Z"
                                  fill="#fff"
                              ></path>
                              <g filter="url(#homepage-abstraction-phone-path-c)">
                                  <path
                                      d="M62.2166 9H18.7867c-1.958 0-3.5452 1.5873-3.5452 3.5453v65.5878c0 1.958 1.5872 3.5453 3.5452 3.5453h43.4299c1.958 0 3.5453-1.5873 3.5453-3.5453V12.5453c0-1.958-1.5873-3.5453-3.5453-3.5453Z"
                                      fill="#F6F9FC"
                                  ></path>
                              </g>
                              <path
                                  d="M40.5692 49.2909c-7.5153 0-13.6798 5.7842-14.2844 13.1436-.0538.6549.4841 1.1895 1.1412 1.1895h26.2865c.6571 0 1.195-.5346 1.1412-1.1895-.6046-7.3594-6.7691-13.1436-14.2845-13.1436Z"
                                  fill="#FAB000"
                              ></path>
                              <path
                                  d="M40.3331 33.5c-7.5154 0-13.6798 5.7842-14.2844 13.1436-.0538.6549.484 1.1895 1.1412 1.1895h26.2864c.6572 0 1.195-.5346 1.1412-1.1895C54.0129 39.2842 47.8485 33.5 40.3331 33.5Z"
                                  fill="#F6F9FC"
                              ></path>
                              <mask
                                  id="homepage-abstraction-phone-path-d"
                                  style="mask-type:alpha"
                                  maskUnits="userSpaceOnUse"
                                  x="26"
                                  y="34"
                                  width="29"
                                  height="15"
                              >
                                  <path
                                      d="M40.3331 34.5c-7.5154 0-13.6798 5.7842-14.2844 13.1436-.0538.6549.484 1.1895 1.1412 1.1895h26.2864c.6572 0 1.195-.5346 1.1412-1.1895C54.0129 40.2842 47.8485 34.5 40.3331 34.5Z"
                                      fill="#F6F9FC"
                                  ></path>
                              </mask>
                              <g mask="url(#homepage-abstraction-phone-path-d)">
                                  <g filter="url(#homepage-abstraction-phone-path-e)">
                                      <ellipse
                                          cx="33.498"
                                          cy="34.062"
                                          rx="11.4684"
                                          ry="11.6778"
                                          fill="#2C09F1"
                                      ></ellipse>
                                  </g>
                                  <g filter="url(#homepage-abstraction-phone-path-f)">
                                      <ellipse
                                          cx="33.5026"
                                          cy="49.3713"
                                          rx="9.09451"
                                          ry="9.29176"
                                          transform="rotate(-1.83252 33.5026 49.3713)"
                                          fill="#FAC300"
                                      ></ellipse>
                                  </g>
                                  <g filter="url(#homepage-abstraction-phone-path-g)">
                                      <ellipse
                                          cx="46.3983"
                                          cy="32.4332"
                                          rx="8.73365"
                                          ry="9.19056"
                                          fill="#FF4FD8"
                                      ></ellipse>
                                  </g>
                              </g>
                              <path
                                  d="M21.5647 15.8288h-.8327V20.5h.8327v-4.6712Zm.4923 4.0206c.3058.4684.9368.7222 1.5679.7222.7742 0 1.4052-.4424 1.4052-1.132 0-.7807-.7286-.9043-1.3076-1.028-.4294-.091-.6766-.1366-.6766-.3838 0-.2277.2082-.3708.5269-.3708.3774 0 .7027.1756.8978.4814l.527-.4749c-.2472-.3774-.7807-.6441-1.3792-.6441-.7872 0-1.3337.4554-1.3337 1.08 0 .7286.6181.8652 1.158.9758.54.1106.8263.1432.8263.4359 0 .3058-.3058.4229-.6376.4229-.3969 0-.7872-.2212-.9889-.553l-.5855.4684Zm3.2148 0c.3057.4684.9368.7222 1.5679.7222.7742 0 1.4052-.4424 1.4052-1.132 0-.7807-.7286-.9043-1.3076-1.028-.4294-.091-.6766-.1366-.6766-.3838 0-.2277.2081-.3708.5269-.3708.3774 0 .7026.1756.8978.4814l.527-.4749c-.2472-.3774-.7807-.6441-1.3792-.6441-.7872 0-1.3337.4554-1.3337 1.08 0 .7286.618.8652 1.158.9758.54.1106.8262.1432.8262.4359 0 .3058-.3057.4229-.6375.4229-.3969 0-.7872-.2212-.9889-.553l-.5855.4684Zm6.4156-2.7649h-.7807v2.0298c0 .4879-.3513.7481-.7026.7481-.4229 0-.6051-.2667-.6051-.6831v-2.0948h-.7807v2.264c0 .7351.4424 1.2231 1.1581 1.2231.4424 0 .7351-.2082.9303-.4359V20.5h.7807v-3.4155Zm2.2671 3.4871c.6831 0 1.2231-.3579 1.4638-.9564l-.6701-.2537c-.1041.3513-.4098.5465-.7937.5465-.5009 0-.8522-.3578-.9108-.9434h2.3941v-.2602c0-.9368-.5269-1.685-1.5158-1.685-.9499 0-1.6265.7742-1.6265 1.7761 0 1.0539.6831 1.7761 1.659 1.7761Zm-.039-2.8951c.4944 0 .7286.3253.7351.7026h-1.5679c.1171-.4619.4294-.7026.8328-.7026Zm3.26.4879c0 1.4248.6766 2.4072 1.8346 2.4072s1.8346-.9824 1.8346-2.4072c0-1.4247-.6766-2.4071-1.8346-2.4071s-1.8346.9824-1.8346 2.4071Zm.8327 0c0-.9824.3123-1.685 1.0019-1.685s1.0019.7026 1.0019 1.685-.3123 1.685-1.0019 1.685-1.0019-.7026-1.0019-1.685Zm3.2779 0c0 1.4248.6766 2.4072 1.8346 2.4072s1.8346-.9824 1.8346-2.4072c0-1.4247-.6766-2.4071-1.8346-2.4071s-1.8346.9824-1.8346 2.4071Zm.8327 0c0-.9824.3123-1.685 1.0019-1.685s1.0019.7026 1.0019 1.685-.3123 1.685-1.0019 1.685-1.0019-.7026-1.0019-1.685Zm4.4822-2.3681c-.0455.553-.2863.7547-.8718.8067l-.4554.0391v.618h1.1255V20.5h.8328v-4.7037h-.6311Z"
                                  fill="#4C555F"
                              ></path>
                              <defs>
                                  <filter
                                      id="homepage-abstraction-phone-path-c"
                                      x="9.0372"
                                      y="5.01155"
                                      width="62.9289"
                                      height="85.0869"
                                      filterUnits="userSpaceOnUse"
                                      color-interpolation-filters="sRGB"
                                  >
                                      <feflood
                                          flood-opacity="0"
                                          result="BackgroundImageFix"
                                      ></feflood>
                                      <fecolormatrix
                                          in="SourceAlpha"
                                          values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                          result="hardAlpha"
                                      ></fecolormatrix>
                                      <feoffset dy="1.32948"></feoffset>
                                      <fegaussianblur stdDeviation="1.32948"></fegaussianblur>
                                      <fecolormatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0">
                                      </fecolormatrix>
                                      <feblend
                                          in2="BackgroundImageFix"
                                          result="effect1_dropShadow_990_4682"
                                      ></feblend>
                                      <fecolormatrix
                                          in="SourceAlpha"
                                          values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                          result="hardAlpha"
                                      ></fecolormatrix>
                                      <feoffset dy="2.21581"></feoffset>
                                      <fegaussianblur stdDeviation="3.10213"></fegaussianblur>
                                      <fecolormatrix
                                          values="0 0 0 0 0.196078 0 0 0 0 0.196078 0 0 0 0 0.364706 0 0 0 0.25 0"
                                      ></fecolormatrix>
                                      <feblend
                                          in2="effect1_dropShadow_990_4682"
                                          result="effect2_dropShadow_990_4682"
                                      ></feblend>
                                      <feblend
                                          in="SourceGraphic"
                                          in2="effect2_dropShadow_990_4682"
                                          result="shape"
                                      ></feblend>
                                  </filter>
                                  <filter
                                      id="homepage-abstraction-phone-path-e"
                                      x="11.567"
                                      y="11.9216"
                                      width="43.8619"
                                      height="44.2808"
                                      filterUnits="userSpaceOnUse"
                                      color-interpolation-filters="sRGB"
                                  >
                                      <feflood
                                          flood-opacity="0"
                                          result="BackgroundImageFix"
                                      ></feflood>
                                      <feblend
                                          in="SourceGraphic"
                                          in2="BackgroundImageFix"
                                          result="shape"
                                      ></feblend>
                                      <fegaussianblur
                                          stdDeviation="5.23126"
                                          result="effect1_foregroundBlur_990_4682"
                                      ></fegaussianblur>
                                  </filter>
                                  <filter
                                      id="homepage-abstraction-phone-path-f"
                                      x="13.9453"
                                      y="29.6172"
                                      width="39.1147"
                                      height="39.5083"
                                      filterUnits="userSpaceOnUse"
                                      color-interpolation-filters="sRGB"
                                  >
                                      <feflood
                                          flood-opacity="0"
                                          result="BackgroundImageFix"
                                      ></feflood>
                                      <feblend
                                          in="SourceGraphic"
                                          in2="BackgroundImageFix"
                                          result="shape"
                                      ></feblend>
                                      <fegaussianblur
                                          stdDeviation="5.23126"
                                          result="effect1_foregroundBlur_990_4682"
                                      ></fegaussianblur>
                                  </filter>
                                  <filter
                                      id="homepage-abstraction-phone-path-g"
                                      x="27.2718"
                                      y="12.8499"
                                      width="38.2528"
                                      height="39.1666"
                                      filterUnits="userSpaceOnUse"
                                      color-interpolation-filters="sRGB"
                                  >
                                      <feflood
                                          flood-opacity="0"
                                          result="BackgroundImageFix"
                                      ></feflood>
                                      <feblend
                                          in="SourceGraphic"
                                          in2="BackgroundImageFix"
                                          result="shape"
                                      ></feblend>
                                      <fegaussianblur
                                          stdDeviation="5.19639"
                                          result="effect1_foregroundBlur_990_4682"
                                      ></fegaussianblur>
                                  </filter>
                                  <radialgradient
                                      id="homepage-abstraction-phone-path-b"
                                      cx="0"
                                      cy="0"
                                      r="1"
                                      gradientUnits="userSpaceOnUse"
                                      gradientTransform="matrix(33.10171119 35.23199341 -676.24595427 635.35713152 -1.56642 27.6897)"
                                  >
                                      <stop stop-color="#2C09F1"></stop>
                                      <stop
                                          offset=".328125"
                                          stop-color="#ED8EF8"
                                      ></stop>
                                      <stop
                                          offset=".578125"
                                          stop-color="#F7CE5D"
                                      ></stop>
                                  </radialgradient>
                                  <lineargradient
                                      id="homepage-abstraction-phone-path-a"
                                      x1="47.861"
                                      y1="73.1784"
                                      x2="27.2626"
                                      y2="-18.3913"
                                      gradientUnits="userSpaceOnUse"
                                  >
                                      <stop stop-color="#6237D5"></stop>
                                      <stop
                                          offset="1"
                                          stop-color="#E28CDF"
                                      ></stop>
                                  </lineargradient>
                              </defs>
                          </svg>
                      </div>
                  </div>

                  <div class="CheckoutPhoneGraphic__description">
                      Abstraction Magazine
                  </div>

                  <div class="CheckoutPhoneGraphic__price">
                      $19 per month
                  </div>

                  <div class="CheckoutPhoneGraphic__buttonsContainer">
                      <div class="CheckoutPhoneGraphic__button CheckoutPhoneGraphic__applePayButton">
                          <svg
                              class="CheckoutPhoneGraphic__applePay"
                              viewBox="0 0 32 14"
                          >
                              <path
                                  fill="#FFF"
                                  d="M25.94 4.22l1.62 5.23h.03l1.62-5.23h1.4l-2.41 6.77c-.56 1.55-1.19 2.06-2.52 2.06-.1 0-.44 0-.53-.03v-1.06l.4.02c.6 0 .95-.26 1.16-.92l.12-.4-2.32-6.44h1.43zM7.4 3.43c.31.03 1.2.12 1.76.96C9.1 4.43 8.1 5 8.1 6.22c.01 1.45 1.27 1.94 1.29 1.95-.02.04-.2.69-.66 1.36-.4.59-.82 1.17-1.47 1.18-.64.01-.85-.38-1.58-.38-.73 0-.97.37-1.57.4-.63.01-1.11-.64-1.51-1.23-.83-1.19-1.45-3.36-.6-4.83a2.32 2.32 0 0 1 1.97-1.2c.63-.01 1.2.41 1.58.41.38 0 1.05-.5 1.83-.45zm14 .71c1.57 0 2.6.82 2.6 2.1v4.4h-1.27V9.6h-.03a2.26 2.26 0 0 1-2.02 1.12c-1.28 0-2.17-.76-2.17-1.9 0-1.13.87-1.78 2.46-1.88l1.7-.1v-.5c0-.72-.46-1.11-1.3-1.11-.7 0-1.2.36-1.3.9h-1.24c.04-1.15 1.12-1.98 2.57-1.98zm-6.13-2.35c1.71 0 2.9 1.18 2.9 2.9a2.8 2.8 0 0 1-2.95 2.93h-1.9v3.03h-1.36V1.79h3.3zm7.4 5.95l-1.52.1c-.85.06-1.3.38-1.3.93s.46.9 1.2.9c.92 0 1.63-.6 1.63-1.43v-.5zm-7.76-4.8h-1.58v3.53h1.57c1.2 0 1.87-.65 1.87-1.77 0-1.11-.68-1.75-1.86-1.75zM7.4 1.12c.06.57-.16 1.13-.5 1.54-.34.4-.88.73-1.42.68-.07-.55.2-1.13.5-1.48.35-.42.94-.71 1.42-.74z"
                              ></path>
                          </svg>
                      </div>

                  </div>

                  <div class="CheckoutPhoneGraphic__separator">
                      <div class="CheckoutPhoneGraphic__separatorTitle">
                          Or pay with card
                      </div>
                  </div>

                  Email

                  <div class="CheckoutPhoneGraphic__input"></div>

                  Card Information

                  <div class="CheckoutPhoneGraphic__input CheckoutPhoneGraphic__input--card">
                      <div class="CheckoutPhoneGraphic__placeholder CheckoutPhoneGraphic__placeholder--number">
                          Number
                          <svg
                              width="17"
                              viewBox="0 0 17 12"
                          >
                              <path
                                  fill="#FFF"
                                  stroke="#000"
                                  stroke-opacity=".2"
                                  stroke-width=".5"
                                  d="M1.6.18h13.8c.79 0 1.42.63 1.42 1.41v8.74c0 .78-.63 1.42-1.41 1.42H1.59c-.78 0-1.41-.64-1.41-1.42V1.6C.18.81.8.18 1.59.18z"
                              ></path>
                              <path
                                  fill="#1434cb"
                                  d="M1.98 4.39A5.1 5.1 0 0 0 .7 3.9l.02-.09h1.93c.27 0 .48.1.55.37l.42 2.01.13.6 1.18-2.97h1.28l-1.9 4.35H3.05l-1.07-3.8zm5.17 3.8h-1.2l.75-4.37h1.2l-.75 4.37zm4.37-4.26l-.16.95-.11-.05c-.21-.09-.5-.18-.9-.17-.48 0-.69.19-.7.38 0 .2.27.33.68.54.7.3 1.02.69 1.02 1.19-.01.9-.83 1.48-2.1 1.48-.54 0-1.06-.1-1.34-.22l.16-.99.17.07c.39.17.64.24 1.13.24.34 0 .71-.14.72-.43 0-.19-.16-.33-.63-.54-.45-.22-1.06-.57-1.05-1.2 0-.84.85-1.44 2.03-1.44.47 0 .85.1 1.08.19zm1.6 2.72h1l-.27-1.27-.09-.38-.15.43-.48 1.22zm1.5-2.83l.96 4.37h-1.12l-.14-.65h-1.54l-.26.65h-1.26l1.79-4c.13-.3.34-.36.63-.36h.93v-.01z"
                              ></path>
                          </svg>
                          <svg
                              width="17"
                              viewBox="0 0 17 12"
                          >
                              <rect
                                  width="17"
                                  height="12"
                                  fill="#0A2540"
                                  rx="2"
                              ></rect>
                              <circle
                                  cx="6"
                                  cy="6"
                                  r="3.6"
                                  fill="#ED0006"
                              ></circle>
                              <circle
                                  cx="10.8"
                                  cy="6"
                                  r="3.6"
                                  fill="#F9A000"
                              ></circle>
                              <path
                                  fill="#FF5D00"
                                  d="M8.4 3.32a3.6 3.6 0 0 1 0 5.36 3.58 3.58 0 0 1-.08-5.29z"
                              ></path>
                          </svg>

                          <svg
                              width="17"
                              viewBox="0 0 17 12"
                          >
                              <rect
                                  width="17"
                                  height="12"
                                  fill="#016FD0"
                                  rx="2"
                              ></rect>
                              <polygon
                                  fill="#FFF"
                                  points="9.347 10.101 9.347 5.801 17 5.808 17 6.996 16.115 7.941 17 8.895 17 10.108 15.588 10.108 14.837 9.28 14.092 10.111"
                              ></polygon>
                              <polygon
                                  fill="#016FD0"
                                  points="9.858 9.63 9.858 6.275 12.703 6.275 12.703 7.047 10.779 7.047 10.779 7.572 12.657 7.572 12.657 8.332 10.779 8.332 10.779 8.847 12.703 8.847 12.703 9.63"
                              ></polygon>
                              <polygon
                                  fill="#016FD0"
                                  points="12.689 9.63 14.263 7.95 12.689 6.275 13.907 6.275 14.869 7.338 15.834 6.275 17 6.275 17 6.301 15.459 7.95 17 9.582 17 9.63 15.822 9.63 14.843 8.556 13.874 9.63"
                              ></polygon>
                              <polygon
                                  fill="#FFF"
                                  points="9.704 1.985 11.549 1.985 12.197 3.456 12.197 1.985 14.474 1.985 14.867 3.087 15.261 1.985 17 1.985 17 6.285 7.809 6.285"
                              ></polygon>
                              <path
                                  fill="#016FD0"
                                  d="M10.05 2.45L8.56 5.8H9.6l.28-.67h1.52l.28.67h1.05l-1.49-3.35h-1.18zm.13 1.93l.45-1.07.44 1.07h-.89z"
                              ></path>
                              <polygon
                                  fill="#016FD0"
                                  points="12.701 5.804 12.701 2.451 14.137 2.457 14.875 4.517 15.619 2.451 17 2.451 17 5.804 16.111 5.812 16.111 3.509 15.272 5.804 14.461 5.804 13.604 3.501 13.604 5.804"
                              ></polygon>
                          </svg>

                          <svg
                              width="17"
                              viewBox="0 0 17 12"
                          >
                              <path
                                  fill="#FFF"
                                  stroke="#000"
                                  stroke-opacity=".2"
                                  stroke-width=".5"
                                  d="M15.58 11.75c.68 0 1.24-.55 1.24-1.24V1.4c0-.32-.14-.64-.37-.87a1.22 1.22 0 0 0-.87-.36H1.42C1.09.18.78.3.55.53a1.3 1.3 0 0 0-.37.89v9.09c0 .32.14.64.37.88.23.23.54.36.87.36h14.16z"
                              ></path>
                              <path
                                  fill="#F27712"
                                  d="M8.93 12.07h6.65c.78 0 1.41-.62 1.42-1.4V9a27.44 27.44 0 0 1-8.07 3.07z"
                              ></path>
                              <path
                                  fill="#000"
                                  d="M16.41 6.79h-.6l-.68-.9h-.07v.9h-.49V4.56h.73c.57 0 .9.23.9.65 0 .35-.21.57-.57.64l.78.94zm-.72-1.56c0-.21-.17-.33-.47-.33h-.15v.68h.14c.31 0 .48-.12.48-.35zm-2.83-.67h1.38v.37h-.9v.5h.87v.38h-.87v.6h.9v.38h-1.4V4.56h.02zm-1.6 2.28l-1.06-2.3h.54l.67 1.51.68-1.5h.53l-1.07 2.3h-.28zm-4.46 0c-.75 0-1.34-.51-1.34-1.17 0-.65.6-1.17 1.35-1.17.21 0 .39.04.6.13v.52a.88.88 0 0 0-.61-.25c-.47 0-.83.34-.83.77 0 .44.36.77.85.77.23 0 .4-.07.6-.25v.52c-.23.1-.41.13-.62.13zM5.31 6.1c0 .43-.35.73-.88.73-.37 0-.63-.13-.87-.43l.33-.26c.1.2.3.3.53.3.22 0 .38-.15.38-.32 0-.1-.05-.18-.15-.23-.1-.05-.22-.1-.34-.13-.46-.15-.62-.3-.62-.62 0-.36.34-.63.79-.63.28 0 .53.08.74.24l-.25.3a.54.54 0 0 0-.4-.18c-.21 0-.37.11-.37.25 0 .12.1.18.38.28.57.18.73.34.73.7zM2.9 4.56h.5v2.23h-.5V4.56zM1.3 6.79H.59V4.56h.72c.8 0 1.35.46 1.35 1.1 0 .35-.16.66-.45.87-.25.18-.52.26-.9.26zm.57-1.67c-.16-.13-.35-.18-.67-.18h-.13v1.48h.14c.31 0 .5-.06.66-.18a.7.7 0 0 0 0-1.12z"
                              ></path>
                              <path
                                  fill="#F27712"
                                  d="M8.79 4.5c-.64 0-1.17.52-1.17 1.15 0 .68.5 1.2 1.17 1.2.66 0 1.18-.52 1.18-1.18 0-.65-.51-1.17-1.18-1.17z"
                              ></path>
                          </svg>

                      </div>

                      <div class="CheckoutPhoneGraphic__placeholder">MM / YY</div>

                      <div class="CheckoutPhoneGraphic__placeholder CheckoutPhoneGraphic__placeholder--cvc">
                          CVC
                          <svg
                              class="CheckoutPhoneGraphic__cvcIcon"
                              width="19"
                              viewBox="0 0 19 14"
                          >
                              <rect
                                  width="17"
                                  height="12"
                                  y="2"
                                  fill="#E6EBF1"
                                  rx="2"
                              ></rect>
                              <rect
                                  width="13"
                                  height="2"
                                  x="2"
                                  y="4"
                                  fill="#FFF"
                                  rx="1"
                              ></rect>
                              <circle
                                  cx="14.5"
                                  cy="4.5"
                                  r="4.5"
                                  fill="#B4C2D0"
                              ></circle>
                              <path
                                  fill="#FFF"
                                  d="M12.5 5.96V3.03H12c-.04.33-.2.46-.58.5l-.24.01v.51h.66v1.9h.67zm1.61.04c.65 0 1.07-.4 1.07-.87 0-.36-.2-.57-.46-.67a.65.65 0 0 0 .4-.62c0-.48-.38-.84-.99-.84-.63 0-1.02.4-1.09.92l.62.07c.04-.25.2-.43.44-.43.23 0 .37.13.37.32 0 .22-.17.32-.42.32h-.26v.54h.27c.27 0 .46.1.46.33 0 .24-.18.37-.42.37-.25 0-.44-.16-.48-.45l-.65.1c.08.6.54.91 1.14.91zm2.53 0c.6 0 1.07-.43 1.07-1.02 0-.56-.36-.98-.95-.98-.2 0-.37.07-.48.16l.05-.54h1.2v-.58h-1.7l-.14 1.6.6.07c.07-.1.2-.18.37-.18.26 0 .42.2.42.46 0 .27-.2.45-.45.45s-.42-.17-.46-.44l-.65.1c.09.58.52.9 1.12.9z"
                              ></path>
                          </svg>
                      </div>
                  </div>

                  Country or region

                  <div class="CheckoutPhoneGraphic__input CheckoutPhoneGraphic__input--country">
                      <div class="CheckoutPhoneGraphic__placeholder CheckoutPhoneGraphic__placeholder--country">
                          United States
                          <svg
                              width="9"
                              viewBox="0 0 9 6"
                          >
                              <polyline
                                  fill="none"
                                  stroke="#62788D"
                                  stroke-width="1.2"
                                  points="1 1 4.5 4.5 8 1"
                              ></polyline>
                          </svg>
                      </div>

                      <div class="CheckoutPhoneGraphic__placeholder">ZIP</div>
                  </div>

                  <div class="CheckoutPhoneGraphic__button CheckoutPhoneGraphic__cardPaymentButton">

                      Pay
                  </div>

                  <div
                      class="ApplePaySheet ApplePaySheet--isHidden"
                      data-js-controller="ApplePaySheet"
                      data-js-autoplay-face-id-animation=""
                  >
                      <div
                          class="ApplePaySheet__overlay"
                          data-js-target="ApplePaySheet.overlay"
                      ></div>

                      <div
                          class="ApplePaySheet__sheet"
                          data-js-target="ApplePaySheet.sheet"
                      >
                          <div class="ApplePaySheet__row ApplePaySheet__row--header">
                              <svg
                                  width="39"
                                  height="16"
                                  viewBox="0 0 39 16"
                                  class="ApplePaySheet__logo"
                              >
                                  <path
                                      fill="#0A2540"
                                      d="M32.74 4.16l2.17 7.01h.04l2.17-7H39l-3.24 9.07c-.74 2.08-1.58 2.76-3.38 2.76-.14 0-.6-.02-.71-.05v-1.42l.54.03c.81 0 1.27-.35 1.55-1.23l.17-.53-3.12-8.64h1.93zM7.55 3.11h.24c.41.03 1.6.16 2.36 1.28-.06.05-1.4.82-1.4 2.45.02 1.95 1.72 2.6 1.73 2.62-.01.04-.27.91-.88 1.82-.54.79-1.1 1.56-1.98 1.58-.86.01-1.14-.5-2.12-.5-.98 0-1.3.48-2.1.51-.86.03-1.51-.84-2.05-1.63-1.1-1.6-1.95-4.5-.8-6.47A3.13 3.13 0 0 1 3.2 3.16c.84-.02 1.62.55 2.12.55s1.41-.66 2.47-.6zm19.07.95c2.1 0 3.48 1.1 3.48 2.8v5.92h-1.7v-1.43h-.05a3.04 3.04 0 0 1-2.71 1.52c-1.71 0-2.9-1.02-2.9-2.55 0-1.53 1.15-2.4 3.3-2.53l2.29-.14v-.66c0-.96-.63-1.49-1.76-1.49-.93 0-1.6.48-1.75 1.21h-1.66c.05-1.54 1.5-2.65 3.46-2.65zM18.36.9c2.3 0 3.91 1.58 3.91 3.9 0 2.31-1.63 3.91-3.96 3.91h-2.56v4.06h-1.84V.9h4.45zm9.97 7.97l-2.05.14c-1.15.07-1.75.5-1.75 1.25 0 .72.62 1.19 1.6 1.19 1.25 0 2.2-.8 2.2-1.9v-.68zM17.88 2.46h-2.13v4.71h2.12c1.6 0 2.52-.86 2.52-2.36s-.91-2.35-2.51-2.35zM7.8 0a2.9 2.9 0 0 1-.67 2.06c-.46.54-1.19.97-1.92.9-.1-.72.27-1.5.69-1.98A2.87 2.87 0 0 1 7.8 0z"
                                  ></path>
                              </svg>
                              <span class="ApplePaySheet__cancelButton">
                                  Cancel
                              </span>
                          </div>

                          <div class="ApplePaySheet__row">
                              <div class="ApplePaySheet__checkoutLabel">

                                  <svg
                                      width="24"
                                      height="16"
                                      viewBox="0 0 24 16"
                                  >
                                      <rect
                                          width="23"
                                          height="15"
                                          x=".5"
                                          y=".5"
                                          fill="none"
                                          stroke="#E6EBF1"
                                          rx="2"
                                      ></rect>
                                      <path
                                          fill="#1434cb"
                                          d="M3.29 5.91a7.2 7.2 0 0 0-1.79-.67l.03-.13h2.73c.38.01.68.13.77.52l.6 2.84.18.85 1.67-4.2h1.8L6.6 11.27H4.8L3.3 5.9zm7.31 5.37H8.9l1.06-6.17h1.7l-1.06 6.17zm6.17-6.02l-.23 1.34-.16-.07c-.3-.12-.71-.25-1.27-.24-.67 0-.97.27-.98.54 0 .28.37.47.96.76.98.44 1.44.98 1.43 1.68-.01 1.28-1.17 2.1-2.96 2.1a5.4 5.4 0 0 1-1.9-.32l.24-1.39.23.1c.55.23.91.33 1.6.33.48 0 1-.2 1.01-.6 0-.27-.22-.47-.88-.77-.64-.3-1.5-.8-1.49-1.68 0-1.2 1.2-2.04 2.87-2.04.66 0 1.2.14 1.53.26zm2.26 3.84h1.41l-.39-1.79-.12-.53-.22.6-.68 1.72zm2.1-3.99l1.37 6.17h-1.58l-.2-.92h-2.18l-.36.92H16.4l2.52-5.66c.18-.4.49-.5.9-.5h1.3z"
                                      ></path>
                                  </svg>
                              </div>

                              <div class="ApplePaySheet__checkoutInfo">
                                  Chase Freedom (•••• 1234)
                                  <br>27 Fredrick Ave Brothers OR
                              </div>

                              <svg
                                  class="ApplePaySheet__checkoutArrow"
                                  viewBox="0 0 6 10"
                              >
                                  <polyline
                                      fill="none"
                                      stroke="#4B82FE"
                                      stroke-width="1.5"
                                      points="1 1 5 5 1 9"
                                  ></polyline>
                              </svg>
                          </div>

                          <div class="ApplePaySheet__row">
                              <div class="ApplePaySheet__checkoutLabel">

                                  Billing

                              </div>

                              <div class="ApplePaySheet__checkoutInfo ApplePaySheet__checkoutInfoAddress">
                                  John Appleseed
                                  <br>27 Fredrick Ave<br>
                                  Brothers, OR 97712<br>
                                  United States
                              </div>

                              <svg
                                  class="ApplePaySheet__checkoutArrow"
                                  viewBox="0 0 6 10"
                              >
                                  <polyline
                                      fill="none"
                                      stroke="#4B82FE"
                                      stroke-width="1.5"
                                      points="1 1 5 5 1 9"
                                  ></polyline>
                              </svg>
                          </div>

                          <div class="ApplePaySheet__row">
                              <div class="ApplePaySheet__checkoutLabel">
                                  Contact
                              </div>

                              <div class="ApplePaySheet__checkoutInfo">
                                  j.appleseed@example.com
                                  <br>+1 (458) 555-2863
                              </div>

                              <svg
                                  class="ApplePaySheet__checkoutArrow"
                                  viewBox="0 0 6 10"
                              >
                                  <polyline
                                      fill="none"
                                      stroke="#4B82FE"
                                      stroke-width="1.5"
                                      points="1 1 5 5 1 9"
                                  ></polyline>
                              </svg>
                          </div>

                          <div class="ApplePaySheet__row">
                              <div class="ApplePaySheet__checkoutLabel"></div>

                              <div class="ApplePaySheet__checkoutInfo">
                                  Pay total
                              </div>

                              <div class="ApplePaySheet__checkoutInfo">

                                  $65.00

                              </div>
                          </div>

                          <div class="ApplePaySheet__faceID">
                              <div
                                  class="Face is-resting"
                                  data-js-controller="FaceIdAnimation"
                                  data-js-follow-mouse=""
                              >
                                  <div class="Face__phoneContainer">
                                      <svg
                                          class="Face__phone"
                                          width="80"
                                          height="80"
                                      >
                                          <clippath
                                              class="Face__phoneClip"
                                              id="Face__phoneClip"
                                          >
                                              <path d="M20,85L20,85,60,85,60,220,20,220Z"></path>
                                          </clippath>
                                          <g clip-path="url(#Face__phoneClip)">
                                              <path
                                                  class="Face__phoneGlare"
                                                  d="M20,55L20,55,60,55,60,220,20,220Z"
                                              ></path>
                                          </g>
                                          <g class="Face__phoneIcon">
                                              <rect
                                                  width="40"
                                                  height="80"
                                                  fill="none"
                                                  rx="5"
                                                  x="20"
                                                  y="84"
                                              ></rect>
                                              <rect
                                                  width="18"
                                                  height="2"
                                                  fill="#0278fc"
                                                  rx=".5"
                                                  x="31"
                                                  y="84"
                                              ></rect>
                                          </g>
                                      </svg>
                                  </div>
                                  <div
                                      class="Face__borders"
                                      data-js-target="FaceIdAnimation.borders"
                                  >
                                      <svg
                                          class="Face__border--copy"
                                          width="100"
                                          height="100"
                                          data-js-target="FaceIdAnimation.borderCopy"
                                      >
                                          <path
                                              class="Face__corner Face__corner--tl"
                                              d="M10,30 L10,22 A12,12,0,0,1,22,10L30,10"
                                              data-js-target-list="FaceIdAnimation.tl"
                                          ></path>
                                          <path
                                              class="Face__corner Face__corner--tr"
                                              d="M70,10 L78,10 A12,12,0,0,1,90,22L90,30"
                                              data-js-target-list="FaceIdAnimation.tr"
                                          ></path>
                                          <path
                                              class="Face__corner Face__corner--br"
                                              d="M90,70 L90,78 A12,12,0,0,1,78,90L70,90"
                                              data-js-target-list="FaceIdAnimation.br"
                                          ></path>
                                          <path
                                              class="Face__corner Face__corner--bl"
                                              d="M30,90 L22,90 A12,12,0,0,1,10,78L10,70"
                                              data-js-target-list="FaceIdAnimation.bl"
                                          ></path>
                                      </svg>
                                      <svg
                                          class="Face__border"
                                          width="100"
                                          height="100"
                                          viewBox="0 0 100 100"
                                          data-js-target="FaceIdAnimation.border"
                                          xmlns="http://www.w3.org/2000/svg"
                                      >
                                          <path
                                              class="Face__corner Face__corner--tl"
                                              d="M10,30 L10,22 A12,12,0,0,1,22,10L30,10"
                                              data-js-target-list="FaceIdAnimation.tl"
                                          ></path>
                                          <path
                                              class="Face__corner Face__corner--tr"
                                              d="M70,10 L78,10 A12,12,0,0,1,90,22L90,30"
                                              data-js-target-list="FaceIdAnimation.tr"
                                          ></path>
                                          <path
                                              class="Face__corner Face__corner--br"
                                              d="M90,70 L90,78 A12,12,0,0,1,78,90L70,90"
                                              data-js-target-list="FaceIdAnimation.br"
                                          ></path>
                                          <path
                                              class="Face__corner Face__corner--bl"
                                              d="M30,90 L22,90 A12,12,0,0,1,10,78L10,70"
                                              data-js-target-list="FaceIdAnimation.bl"
                                          ></path>
                                      </svg>
                                  </div>
                                  <svg
                                      class="Face__features"
                                      width="100"
                                      height="100"
                                      data-js-target="FaceIdAnimation.features"
                                  >
                                      <g
                                          class="Face__eyes"
                                          data-js-target="FaceIdAnimation.eyes"
                                      >
                                          <path
                                              class="Face__eye"
                                              d="M33,39 l0,6.5"
                                          ></path>
                                          <path
                                              class="Face__eye"
                                              d="M67,39 l0,6.5"
                                          ></path>
                                      </g>
                                      <path
                                          class="Face__nose"
                                          d="M51.5,38.5 L51.5,53.5A4,4,0,0,1,47,57.5L46,57.5"
                                          data-js-target="FaceIdAnimation.nose"
                                      ></path>
                                      <path
                                          class="Face__mouth"
                                          d="M37,68 A20,20,0,0,0,63,68"
                                          data-js-target="FaceIdAnimation.mouth"
                                      ></path>
                                  </svg>
                                  <svg class="Face__check">
                                      <path d="M34,52,43,61,66,39"></path>
                                  </svg>

                              </div>
                          </div>
                      </div>
                  </div>

              </div>
          </div>
      </figure>
  </div>
  </div>

  </div>
  </div>
  </div>
  </div>
  </section>
