<header
    x-data="{ open: false }"
    class="SiteHeader SiteHeader--hasContactSales theme--Transparent variant--Overlay SiteHeader--hasGuides"
    data-js-controller="SiteHeader"
    style="--siteMenuArrowOffset: -63.5625px;"
>
    <div
        class="SiteHeader__stickyContainer"
        data-js-target="SiteHeader.stickyContainerEl"
    >
        <div
            class="SiteHeader__stickyShadow"
            data-js-target="SiteHeader.stickyShadowEl"
        ></div>

        <div class="SiteHeader__guidesContainer">
            <div
                class="
    Guides
    SiteHeader__guides
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

        <div class="SiteHeader__container">
            <div class="SiteHeader__navContainer">
                <h1 class="SiteHeader__logo">
                    <a
                        href="/"
                        class="SiteHeader__logoLink"
                        data-js-controller="AnalyticsButton"
                        data-analytics-category="Navigation"
                        data-analytics-action="Clicked"
                        data-analytics-label="Stripe Logo"
                        data-testid="header-stripe-logo"
                    >
                        <img
                            src="/assets/logo-long.png"
                            style="width:150px;height:auto;object-fit:cover;"
                        />
                    </a>
                </h1>

                <div
                    class="SiteHeader__headerNav"
                    data-js-target="SiteHeader.headerNavEl"
                >
                    <nav class="SiteHeaderNav">
                        <ul class="SiteHeaderNav__list">
                            @php
                                $links = [
                                #'How it works' => '#how-it-works',
                                'Payment Methods' => '/#payment-methods',
                                'Social Media' => '/#social-media',
                                'Contact' => '/#contact',
                                'About Us' => '/#about',
                                ]
                            @endphp
                            @foreach ($links as $link=> $url)
                                <li class="SiteHeaderNavItem">
                                    <a
                                        href="{{$url}}"
                                        class="SiteHeaderNavItem__link text-white"
                                    >

                                    {{$link}}

                                    </a>

                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <nav
                    class="SiteHeader__ctaNav"
                    data-js-target="SiteHeader.ctaNavEl"
                >
                    <div
                        class="SiteHeader__ctaNavContainer"
                        data-js-target="SiteHeader.ctaNavContainerEl"
                    >

                    @if (!auth()->check())

                        <div class="DashboardLoginLink__container">
                            <a
                                class="
    CtaButton
    variant--Link
    CtaButton--arrow
    SiteHeader__leftCta
  "
                                href="/login?register=1"
                                >{{"Sign up"}}&nbsp;<svg
                                    class="HoverArrow"
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
                    @endif

                        <div
                            class="NavCtaGradient"
                            data-js-target="Homepage.gradientCtaButton"
                        >
                            <a
                                class=" CtaButton variant--Button CtaButton--arrow "
                                href="/dashboard"
                            ><span
                                    class="NavCta__label"
                                    style="background: linear-gradient(90deg, var(--primary-400) 0%, var(--primary-500));"
                                >Sign in&nbsp;<svg
                                    class="HoverArrow"
                                    width="10"
                                    height="10"
                                    viewBox="0 0 10 10"
                                    aria-hidden="true"
                                    style="stroke: var(--primary-500)"
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
                </nav>

                <nav class="SiteHeader__menuNav">
                    <div class="flex items-center gap-2 !text-white">

                                                <a
                                class="CtaButton variant--Button CtaButton--arrow "
                                href="/dashboard"
                            ><span
                                >Sign in&nbsp;</a>
                    <button
                        @click="open = !open"
                        class="MenuButton !text-white"
                        href=/#"
                        :title="open ? 'Close navigation' : 'Open navigation'"
                        data-js-target="SiteHeader.menuButton"
                        data-testid="header-mobile-open-nav-menu-button"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" x-show="open">
                        <path fill="none" stroke="white" stroke-linecap="round" stroke-width="2" d="M20 20L4 4m16 0L4 20"/></svg>
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32"><path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h22M5 16h22M5 24h22"/></svg>
                    </button>

                    </div>
                </nav>

            </div>
        </div>
        <div @click.outside="open = false" x-cloak x-show="open" class="h-screen w-full bg-white p-3 rounded-lg animate__animated mt-4 transition-all" :class="{
            "translate-x-[-100%]": !open,
            "translate-x-[0%]": open
            }">
            <ul class="flex flex-col gap-5 mb-0 text-gray-700 w-full">
                                    <li class="!w-full block text-center">
                        <a href="/login?register=1"
                            class="text-center block rounded-md p-2 text-gray-700 hover:text-gray-900 hover:bg-gray-200 font-bold !w-full transition-colors duration-200">
                            Sign Up
                        </a>
                    </li>

                @foreach ($links as $link=> $url)
                    <li class="!w-full block text-center">
                        <a href="{{ $url }}" @click="setTimeout(() => open = false, 500)"
                           class="text-center block rounded-md p-2 text-gray-700 hover:text-gray-900 hover:bg-gray-200 font-bold !w-full transition-colors duration-200">
                            {{$link}}
                        </a>
                    </li>
                @endforeach
            </ul>


        </div>


        <div
            class="SiteHeader__menuContainer theme--White"
            data-js-target="SiteHeader.menuContainer"
        >
            <div
                class="SiteHeaderArrow"
                data-js-target="SiteHeader.arrow"
                aria-hidden="true"
            ></div>
            <div class="SiteHeader__menuShadowContainer">
                <div
                    class="
    SiteMenu
    SiteHeader__menu
  "
                    data-js-target="SiteHeader.menu"
                    style="width: 530px; --siteMenuHeight: 306px; --siteMenuTranslateX: 666px; pointer-events: none;"
                    hidden=""
                >
                    <div class="
    Card







    SiteMenu__card
  ">
                        <div
                            class="SiteMenu__section SiteMenu__section--hasSubMenu SiteMenu__section--left"
                            data-js-target-list="SiteHeader.menuSections"
                            data-js-theme-light=""
                            aria-hidden="true"
                            hidden=""
                        >
                            <section class="
    SiteMenuSection
    SiteMenuSection--variantNoPadding
  ">
                                <div class="SiteMenuSection__body">
                                    <div class="SiteProductsNav">
                                        <div class="SiteProductsNav__groupList">

                                            <div class="SiteProductsNav__group">
                                                <h1 class="SiteProductsNav__groupTitle">

                                                    Global payments

                                                </h1>
                                                <div class="SiteProductsNav__groupMenuContainer">
                                                    <ul class="SiteProductsNav__groupMenuList">

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/payments"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="payments"
                                                                tabindex="-1"
                                                                data-testid="header-products-global-payments-payments-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--Payments "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 40 40"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >

                                                                                <title>Payments</title>

                                                                                <path
                                                                                    d="M34.61 11.28a2.56 2.56 0 0 0-1.22-1.04L8.54.2A2.57 2.57 0 0 0 5 2.6V15c0 1.05.64 2 1.61 2.4l6.44 2.6 21.56 8.72c.26-.4.4-.88.39-1.36V12.64c0-.48-.13-.96-.39-1.37z"
                                                                                    fill="url(#product-icon-payments-SiteMenu-a)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M34.63 11.28L13.06 20l-6.45 2.6A2.58 2.58 0 0 0 5 25v12.42a2.58 2.58 0 0 0 3.54 2.39L33.4 29.76c.5-.21.93-.57 1.21-1.04.26-.41.4-.88.39-1.36V12.64c0-.48-.12-.95-.37-1.36z"
                                                                                    fill="#96F"
                                                                                ></path>
                                                                                <path
                                                                                    d="M34.62 11.28l.1.17c.18.37.28.77.28 1.19v-.03 14.75c0 .48-.13.95-.39 1.36L13.06 20l21.56-8.72z"
                                                                                    fill="url(#product-icon-payments-SiteMenu-b)"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-payments-SiteMenu-a"
                                                                                        x1="20"
                                                                                        y1="4.13"
                                                                                        x2="20"
                                                                                        y2="21.13"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#11EFE3">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#21CFE0"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-payments-SiteMenu-b"
                                                                                        x1="35"
                                                                                        y1="11.28"
                                                                                        x2="35"
                                                                                        y2="28.72"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#0048E5">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#9B66FF"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Payments&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span class="SiteNavItem__bodyLabel">Online
                                                                            payments</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                        <ul class="SiteProductsNav__groupMenuSubList">

                                                            <li class="SiteProductsNavSubItem">
                                                                <a
                                                                    class="SiteProductsNavSubItem__link"
                                                                    href=/payments/payment-links"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Product"
                                                                    data-analytics-description="payment-links"
                                                                    tabindex="-1"
                                                                    data-testid="header-products-global-payments-payment-links-nav-item"
                                                                >
                                                                    <span
                                                                        class="SiteProductsNavSubItem__label">Payment
                                                                        Links</span>
                                                                    <span class="SiteProductsNavSubItem__seperator">
                                                                        <span
                                                                            class="SiteProductsNavSubItem__seperatorDot"
                                                                        >
                                                                            <svg
                                                                                width="4"
                                                                                height="4"
                                                                                viewBox="0 0 4 4"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >
                                                                                <circle
                                                                                    cx="2"
                                                                                    cy="2"
                                                                                    r="1.1"
                                                                                    fill="#0A2540"
                                                                                ></circle>
                                                                            </svg>
                                                                        </span>
                                                                        <span
                                                                            class="SiteProductsNavSubItem__seperatorArrow"
                                                                        >&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteProductsNavSubItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg></span>
                                                                    </span>
                                                                    <span class="SiteProductsNavSubItem__body">No-code
                                                                        payments</span>
                                                                </a>
                                                            </li>

                                                            <li class="SiteProductsNavSubItem">
                                                                <a
                                                                    class="SiteProductsNavSubItem__link"
                                                                    href=/payments/checkout"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Product"
                                                                    data-analytics-description="checkout"
                                                                    tabindex="-1"
                                                                    data-testid="header-products-global-payments-checkout-links-nav-item"
                                                                >
                                                                    <span
                                                                        class="SiteProductsNavSubItem__label">Checkout</span>
                                                                    <span class="SiteProductsNavSubItem__seperator">
                                                                        <span
                                                                            class="SiteProductsNavSubItem__seperatorDot"
                                                                        >
                                                                            <svg
                                                                                width="4"
                                                                                height="4"
                                                                                viewBox="0 0 4 4"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >
                                                                                <circle
                                                                                    cx="2"
                                                                                    cy="2"
                                                                                    r="1.1"
                                                                                    fill="#0A2540"
                                                                                ></circle>
                                                                            </svg>
                                                                        </span>
                                                                        <span
                                                                            class="SiteProductsNavSubItem__seperatorArrow"
                                                                        >&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteProductsNavSubItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg></span>
                                                                    </span>
                                                                    <span
                                                                        class="SiteProductsNavSubItem__body">Prebuilt
                                                                        payment form</span>
                                                                </a>
                                                            </li>

                                                            <li class="SiteProductsNavSubItem">
                                                                <a
                                                                    class="SiteProductsNavSubItem__link"
                                                                    href=/payments/elements"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Product"
                                                                    data-analytics-description="elements"
                                                                    tabindex="-1"
                                                                    data-testid="header-products-global-payments-elements-nav-item"
                                                                >
                                                                    <span
                                                                        class="SiteProductsNavSubItem__label">Elements</span>
                                                                    <span class="SiteProductsNavSubItem__seperator">
                                                                        <span
                                                                            class="SiteProductsNavSubItem__seperatorDot"
                                                                        >
                                                                            <svg
                                                                                width="4"
                                                                                height="4"
                                                                                viewBox="0 0 4 4"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >
                                                                                <circle
                                                                                    cx="2"
                                                                                    cy="2"
                                                                                    r="1.1"
                                                                                    fill="#0A2540"
                                                                                ></circle>
                                                                            </svg>
                                                                        </span>
                                                                        <span
                                                                            class="SiteProductsNavSubItem__seperatorArrow"
                                                                        >&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteProductsNavSubItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg></span>
                                                                    </span>
                                                                    <span
                                                                        class="SiteProductsNavSubItem__body">Flexible
                                                                        UI components</span>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </ul>
                                                    <ul class="SiteProductsNav__groupMenuList">

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/terminal"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="terminal"
                                                                tabindex="-1"
                                                                data-testid="header-products-global-payments-payments-terminal-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--Terminal "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 40 40"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >

                                                                                <title>Terminal</title>

                                                                                <path
                                                                                    d="M36.98 14.05l-6.31 1.36L9.33 20l-7.35 1.58A2.52 2.52 0 0 0 0 24.05v13.42C0 38.87 1.12 40 2.5 40h35c1.38 0 2.5-1.13 2.5-2.53V16.53c0-.77-.34-1.49-.93-1.97a2.48 2.48 0 0 0-2.09-.5z"
                                                                                    fill="#9B66FF"
                                                                                ></path>
                                                                                <path
                                                                                    d="M28.59 0H11.58A2.54 2.54 0 0 0 9 2.5v25c0 1.38 1.15 2.5 2.58 2.5h16.84A2.54 2.54 0 0 0 31 27.5v-25A2.5 2.5 0 0 0 28.59 0z"
                                                                                    fill="url(#product-icon-terminal-SiteMenu-a)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M31 15.34V27.5c0 1.38-1.15 2.5-2.58 2.5H11.58A2.54 2.54 0 0 1 9 27.5v-7.43l.33-.07 21.34-4.59.33-.07z"
                                                                                    fill="url(#product-icon-terminal-SiteMenu-b)"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-terminal-SiteMenu-a"
                                                                                        x1="20"
                                                                                        y1="1.97"
                                                                                        x2="20"
                                                                                        y2="17.6"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#11EFE3">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset=".33"
                                                                                            stop-color="#15E8E2"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset=".74"
                                                                                            stop-color="#1FD3E0"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#21CFE0"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-terminal-SiteMenu-b"
                                                                                        x1="31"
                                                                                        y1="22.67"
                                                                                        x2="5.34"
                                                                                        y2="22.67"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#0048E5">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset=".64"
                                                                                            stop-color="#625AF5"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#8A62FC"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Terminal&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span class="SiteNavItem__bodyLabel">In-person
                                                                            payments</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/radar"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="radar"
                                                                tabindex="-1"
                                                                data-testid="header-products-global-payments-radar-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--Radar "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 40 40"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >

                                                                                <title>Radar</title>

                                                                                <path
                                                                                    d="M24.87 4.46a1.26 1.26 0 0 0-1.8.2l-4.6 5.82L3.42 29.45c.27.22.54.45.78.7a9.42 9.42 0 0 1 1.13 1.32l.1.13a9.15 9.15 0 0 1 .8 1.43c.29.62.5 1.28.65 1.95a2.5 2.5 0 0 0 2.45 1.93H38.7a1.27 1.27 0 0 0 1.27-1.3 42.43 42.43 0 0 0-15.1-31.15z"
                                                                                    fill="#9A66FF"
                                                                                ></path>
                                                                                <path
                                                                                    d="M27.8 21.98A33.82 33.82 0 0 0 5.95 4.28a1.29 1.29 0 0 0-1.56.98L.1 25.4a2.54 2.54 0 0 0 1.4 2.88 9.48 9.48 0 0 1 2.72 1.87l.17.17c.35.36.67.74.96 1.15l.1.13a9.15 9.15 0 0 1 .8 1.43l20.94-9.31a1.29 1.29 0 0 0 .62-1.74z"
                                                                                    fill="url(#product-icon-radar-SiteMenu-a)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M18.46 10.48l.47.38a33.82 33.82 0 0 1 8.87 11.12 1.29 1.29 0 0 1-.62 1.74L6.25 33.03a9.15 9.15 0 0 0-.8-1.43l-.1-.13-.23-.3c-.23-.3-.47-.58-.74-.85a9.7 9.7 0 0 0-.95-.86l15.03-18.98z"
                                                                                    fill="url(#product-icon-radar-SiteMenu-b)"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-radar-SiteMenu-a"
                                                                                        x1="13.98"
                                                                                        y1="4.24"
                                                                                        x2="13.98"
                                                                                        y2="33.03"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop
                                                                                            offset=".26"
                                                                                            stop-color="#FF5091"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset=".91"
                                                                                            stop-color="#E03071"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-radar-SiteMenu-b"
                                                                                        x1="15.68"
                                                                                        y1="10.48"
                                                                                        x2="15.68"
                                                                                        y2="33.03"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#6E00F5">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#9860FE"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Radar&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span class="SiteNavItem__bodyLabel">Fraud
                                                                            prevention</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/authorization"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="payments-authorization"
                                                                tabindex="-1"
                                                                data-testid="header-products-global-payments-authorization-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--Authorization "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 40 40"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >

                                                                                <title>Authorization</title>

                                                                                <path
                                                                                    fill="#96F"
                                                                                    d="M9.1381 4.1033c-.07474-1.1211.81447-2.07156 1.9381-2.07156H35.5c1.3807 0 2.5 1.11929 2.5 2.5V28.9556c0 1.1236-.9505 2.0128-2.0716 1.938C21.5483 29.935 10.0968 18.4834 9.1381 4.1033Z"
                                                                                ></path>
                                                                                <path
                                                                                    fill="url(#product-icon-authorization-SiteMenu-a)"
                                                                                    d="M2.1381 11.1033c-.07474-1.1211.81447-2.07156 1.93806-2.07156H28.5c1.3807 0 2.5 1.11926 2.5 2.49996v24.4239c0 1.1236-.9505 2.0128-2.0716 1.938C14.5483 36.935 3.09678 25.4834 2.1381 11.1033Z"
                                                                                ></path>
                                                                                <path
                                                                                    fill="url(#product-icon-authorization-SiteMenu-b)"
                                                                                    fill-rule="evenodd"
                                                                                    d="M30.9998 30.1351c-10.4-2.5385-18.5648-10.7033-21.10332-21.10336H28.4998c1.3807 0 2.5 1.11926 2.5 2.49996v18.6034Z"
                                                                                    clip-rule="evenodd"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-authorization-SiteMenu-a"
                                                                                        x1="16.2942"
                                                                                        x2="16.2075"
                                                                                        y1="16.7651"
                                                                                        y2="36.4202"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#11EFE3">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset=".33"
                                                                                            stop-color="#15E8E2"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset=".74"
                                                                                            stop-color="#1FD3E0"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#21CFE0"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-authorization-SiteMenu-b"
                                                                                        x1="22.0036"
                                                                                        x2="26.4551"
                                                                                        y1="27.9902"
                                                                                        y2="5.55009"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#0048E5">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset=".63979"
                                                                                            stop-color="#625AF5"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#8A62FC"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Authorization&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span
                                                                            class="SiteNavItem__bodyLabel">Acceptance
                                                                            optimizations</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="SiteProductsNav__group">
                                                <h1 class="SiteProductsNav__groupTitle">

                                                    Embedded payments and Finance

                                                </h1>
                                                <div class="SiteProductsNav__groupMenuContainer">
                                                    <ul class="SiteProductsNav__groupMenuList">

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/connect"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="connect"
                                                                tabindex="-1"
                                                                data-testid="header-products-embedded-payments-and-finance-connect-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--Connect "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 40 40"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >

                                                                                <title>Connect</title>

                                                                                <path
                                                                                    d="M12.47.01a13.01 13.01 0 0 0 .5 25.99h10.55c1.37 0 2.48-1.1 2.48-2.48V13.01a12.99 12.99 0 0 0-13.53-13z"
                                                                                    fill="url(#product-icon-connect-SiteMenu-a)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M27.53 39.99a13.01 13.01 0 0 0-.5-25.99H16.48A2.48 2.48 0 0 0 14 16.48v10.51a12.99 12.99 0 0 0 13.53 13z"
                                                                                    fill="#0073E6"
                                                                                ></path>
                                                                                <path
                                                                                    d="M26 14v9.52A2.48 2.48 0 0 1 23.52 26H14v-9.52A2.48 2.48 0 0 1 16.32 14l.16-.01H26z"
                                                                                    fill="url(#product-icon-connect-SiteMenu-b)"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-connect-SiteMenu-a"
                                                                                        x1="13"
                                                                                        y1="1.71"
                                                                                        x2="13"
                                                                                        y2="15.25"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#11EFE3">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset=".33"
                                                                                            stop-color="#15E8E2"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset=".74"
                                                                                            stop-color="#1FD3E0"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#21CFE0"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-connect-SiteMenu-b"
                                                                                        x1="20"
                                                                                        y1="15.72"
                                                                                        x2="20"
                                                                                        y2="27.24"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#00299C">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#0073E6"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Connect&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span class="SiteNavItem__bodyLabel">Payments
                                                                            for platforms</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/treasury"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="treasury"
                                                                tabindex="-1"
                                                                data-testid="header-products-embedded-payments-and-finance-treasury-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--Banking "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 40 40"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >

                                                                                <title>Treasury</title>

                                                                                <path
                                                                                    d="M29 14.5c0-.36-.07-.71-.22-1.04l-3.92-8.94A2.52 2.52 0 0 0 22.56 3H2.52A2.54 2.54 0 0 0 0 5.56v17.88A2.54 2.54 0 0 0 2.52 26h20.04c1 0 1.9-.6 2.3-1.52l3.92-8.94c.15-.33.22-.68.22-1.04z"
                                                                                    fill="url(#product-icon-banking-SiteMenu-a)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M11 25.5c0 .36.07.71.22 1.04l3.92 8.94c.4.93 1.3 1.52 2.3 1.52h20.04c1.4 0 2.52-1.14 2.52-2.56V16.56A2.54 2.54 0 0 0 37.48 14H17.44c-1 0-1.9.6-2.3 1.52l-3.92 8.94c-.15.33-.22.68-.22 1.04z"
                                                                                    fill="#00D924"
                                                                                ></path>
                                                                                <path
                                                                                    d="M28.95 14a2.59 2.59 0 0 1-.17 1.54l-3.92 8.94c-.4.93-1.3 1.52-2.3 1.52H11.05a2.59 2.59 0 0 1 .17-1.54l3.92-8.94c.4-.93 1.3-1.52 2.3-1.52h11.51z"
                                                                                    fill="url(#product-icon-banking-SiteMenu-b)"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-banking-SiteMenu-a"
                                                                                        x1="14.5"
                                                                                        y1="6.13"
                                                                                        x2="14.5"
                                                                                        y2="28.22"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#11EFE3">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset=".35"
                                                                                            stop-color="#14E8E2"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset=".86"
                                                                                            stop-color="#1ED6E1"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#21CFE0"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-banking-SiteMenu-b"
                                                                                        x1="25.31"
                                                                                        y1="29.5"
                                                                                        x2="25.31"
                                                                                        y2="9"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#00D924">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#00A600"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Treasury&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span class="SiteNavItem__bodyLabel">Financial
                                                                            accounts</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                    <ul class="SiteProductsNav__groupMenuList">

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/capital/platforms"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="capital"
                                                                tabindex="-1"
                                                                data-testid="header-products-embedded-payments-and-finance-capital-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--Capital "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 40 40"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >

                                                                                <title>Capital</title>

                                                                                <path
                                                                                    d="M23.95 14.05l-9.74 2.12-12.18 2.52A2.59 2.59 0 0 0 0 21.22v16.26A2.5 2.5 0 0 0 2.54 40H27V16.57a2.55 2.55 0 0 0-3.05-2.52z"
                                                                                    fill="url(#product-icon-capital-SiteMenu-a)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M36.85.05l-21.82 4.6A2.57 2.57 0 0 0 13 7.15V40h24.46c1.42-.2 2.54-1.3 2.54-2.7V2.55c0-1.6-1.52-2.8-3.15-2.5z"
                                                                                    fill="url(#product-icon-capital-SiteMenu-b)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M23.95 14.05c1.63-.3 3.05.9 3.05 2.52V40H13V16.42l1.21-.25 9.74-2.12z"
                                                                                    fill="url(#product-icon-capital-SiteMenu-c)"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-capital-SiteMenu-a"
                                                                                        x1="13.52"
                                                                                        y1="36.35"
                                                                                        x2="13.52"
                                                                                        y2="18.21"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#00D0E1">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#00F5E7"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-capital-SiteMenu-b"
                                                                                        x1="26.46"
                                                                                        x2="26.46"
                                                                                        y2="40"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#00D924">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#00D924"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-capital-SiteMenu-c"
                                                                                        x1="19.93"
                                                                                        y1="40"
                                                                                        x2="19.93"
                                                                                        y2="14"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#00D722">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset=".85"
                                                                                            stop-color="#00BD01"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Capital&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span class="SiteNavItem__bodyLabel">Customer
                                                                            financing</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/issuing"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="issuing"
                                                                tabindex="-1"
                                                                data-testid="header-products-embedded-payments-and-finance-issuing-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--Issuing "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 40 40"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >

                                                                                <title>Issuing</title>

                                                                                <path
                                                                                    d="M7.62 26.48l-.02-.03a2.44 2.44 0 0 1-.7-1.48 2.49 2.49 0 0 1 .11-1.05c.05-.28.13-.54.24-.77l.08-.17L14.67 10h21.85A2.52 2.52 0 0 1 39 12.37l.01.16v22.92A2.52 2.52 0 0 1 36.67 38l-.16.01H19a2.5 2.5 0 0 0 .64-1.97c-.07-.66-.43-1.09-.95-1.47l-.15-.1-10.62-7.73-.14-.1v-.01l.14.1a2.52 2.52 0 0 1-.27-.21l-.03-.03z"
                                                                                    fill="url(#product-icon-issuing-SiteMenu-a)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M22.05 2.1c.7-.15 1.41 0 1.99.41l6.56 4.72a2.5 2.5 0 0 1 .92 2.8V10l-8.5 26-.05.2-.03.08-.03.09-.15.32-.02.04-.19.29-.03.04a2.9 2.9 0 0 1-.23.25l-.03.02a2.24 2.24 0 0 1-.58.4l-.03.03c-.1.05-.2.1-.31.13h-.05l-.33.08h-.05a2.3 2.3 0 0 1-.36.03H3.53A2.53 2.53 0 0 1 1 35.45v-22.9C1 11.14 2.13 10 3.53 10H16.6l3.8-6.7a2.5 2.5 0 0 1 1.46-1.15l.18-.05z"
                                                                                    fill="#0073E6"
                                                                                ></path>
                                                                                <path
                                                                                    d="M31.38 10l-8.37 26-.02.1-.02.1-.03.08-.03.09-.07.16-.08.16-.02.04-.1.15-.09.14-.03.04-.11.13-.12.12-.03.02c-.08.09-.17.16-.26.23l-.15.1-.17.08-.03.02-.15.07-.16.06h-.05l-.16.05-.1.01.1-.1c.4-.51.59-1.17.51-1.82-.07-.66-.43-1.09-.95-1.47l-.15-.1-10.62-7.73-.14-.1a2.54 2.54 0 0 1-.26-.26l-.04-.05a2.48 2.48 0 0 1-.12-.14l-.02-.04-.03-.04a2.43 2.43 0 0 1-.17-.3l-.03-.06a2.5 2.5 0 0 1-.15-.42l-.01-.07-.02-.1-.01-.06a2.51 2.51 0 0 1 .05-1.01l.02-.09a2.5 2.5 0 0 1 .04-.1c.03-.25.1-.5.21-.74l.1-.17L16.66 10h14.71z"
                                                                                    fill="url(#product-icon-issuing-SiteMenu-b)"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-issuing-SiteMenu-a"
                                                                                        x1="22.92"
                                                                                        y1="11.68"
                                                                                        x2="22.92"
                                                                                        y2="39.68"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop
                                                                                            offset=".1"
                                                                                            stop-color="#FF80FF"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset=".39"
                                                                                            stop-color="#FF7BF9"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset=".77"
                                                                                            stop-color="#FF6EEA"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#FF62DC"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-issuing-SiteMenu-b"
                                                                                        x1="31.38"
                                                                                        y1="27.93"
                                                                                        x2="11.62"
                                                                                        y2="27.93"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#0073E6">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#00299C"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Issuing&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span class="SiteNavItem__bodyLabel">Physical
                                                                            and virtual cards</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="SiteProductsNav__group">
                                                <h1 class="SiteProductsNav__groupTitle">

                                                    Revenue and Finance Automation

                                                </h1>
                                                <div class="SiteProductsNav__groupMenuContainer">
                                                    <ul class="SiteProductsNav__groupMenuList">

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/billing"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="billing"
                                                                tabindex="-1"
                                                                data-testid="header-products-revenue-and-finance-automation-billing-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--Billing "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 40 40"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >

                                                                                <title>Billing</title>

                                                                                <path
                                                                                    d="M26 2.46C26 1.1 24.9 0 23.53 0H2.47A2.47 2.47 0 0 0 0 2.46v30.08a2.46 2.46 0 0 0 3.47 2.25l10.2-4.53 10.86-4.83c.9-.4 1.47-1.27 1.47-2.25V2.46z"
                                                                                    fill="url(#product-icon-billing-SiteMenu-a)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M26.5 39a13.5 13.5 0 1 0 0-27 13.5 13.5 0 0 0 0 27z"
                                                                                    fill="#00D924"
                                                                                ></path>
                                                                                <path
                                                                                    d="M26 12v11.18c0 .98-.57 1.86-1.47 2.25l-10.7 4.76A13.5 13.5 0 0 1 26 12z"
                                                                                    fill="url(#product-icon-billing-SiteMenu-b)"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-billing-SiteMenu-a"
                                                                                        x1="13"
                                                                                        y1="6.35"
                                                                                        x2="13"
                                                                                        y2="35.03"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#FFD748">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#FFC148"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-billing-SiteMenu-b"
                                                                                        x1="19.5"
                                                                                        y1="12.01"
                                                                                        x2="19.5"
                                                                                        y2="30.19"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#00A600">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#00D924"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Billing&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span
                                                                            class="SiteNavItem__bodyLabel">Subscriptions
                                                                            and usage-based</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/revenue-recognition"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="revenue-recognition"
                                                                tabindex="-1"
                                                                data-testid="header-products-revenue-and-finance-automation-revenue-recognition-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--RevRec "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 40 40"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >

                                                                                <title>Revenue Recognition</title>

                                                                                <path
                                                                                    d="M24.4531 3.37679c.0004-.4707-.1391-.9309-.4008-1.32216-.2616-.39126-.6337-.69594-1.0689-.87535-.4351-.179408-.9138-.225461-1.3752-.1323-.4614.09315-.8847.32131-1.2161.65551L3.57784 18.493c-.33493.3321-.56335.7565-.65614 1.219-.09278.4626-.04573.9422.13515 1.3779.18089.4356.48742.8076.88051 1.0683.39309.2608.85494.3986 1.32665.3958h4.74979L24.4531 8.12657V3.37679z"
                                                                                    fill="url(#product-icon-revrec-SiteMenu-a)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M33.7627 8.12634h-9.3096V20.1789c0 .6299-.2502 1.2339-.6956 1.6793-.4453.4454-1.0494.6956-1.6793.6956H10.0138V36.625c0 .6299.2502 1.234.6956 1.6793.4454.4454 1.0494.6956 1.6793.6956h21.374c.6299 0 1.2339-.2502 1.6793-.6956.4454-.4453.6956-1.0494.6956-1.6793V10.5012c0-.62983-.2502-1.23389-.6956-1.67927-.4454-.44538-1.0494-.69559-1.6793-.69559z"
                                                                                    fill="#9A66FF"
                                                                                ></path>
                                                                                <path
                                                                                    d="M24.4531 20.1789V8.12634L10.0138 22.5538h12.0644c.6299 0 1.234-.2502 1.6793-.6956.4454-.4454.6956-1.0494.6956-1.6793z"
                                                                                    fill="url(#product-icon-revrec-SiteMenu-b)"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-revrec-SiteMenu-a"
                                                                                        x1="13.7647"
                                                                                        y1="1"
                                                                                        x2="13.7647"
                                                                                        y2="22.3532"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop
                                                                                            offset=".270725"
                                                                                            stop-color="#FF5091"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#E03071"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-revrec-SiteMenu-b"
                                                                                        x1="16.0302"
                                                                                        y1="22.3652"
                                                                                        x2="24.2719"
                                                                                        y2="6.84356"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#6E00F5">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#9860FE"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Revenue Recognition&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span
                                                                            class="SiteNavItem__bodyLabel">Accounting
                                                                            automation</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/tax"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="tax"
                                                                tabindex="-1"
                                                                data-testid="header-products-revenue-and-finance-automation-tax-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--Tax "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 40 40"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >

                                                                                <title>Tax</title>

                                                                                <path
                                                                                    d="M19.049.00995851C22.4341.325767 25.7367 1.28014 28.7794 2.83046c3.0426 1.55031 5.756 3.66123 8.0012 6.2142.9142 1.03954.6576 2.61624-.4624 3.42994L20.5259 23.9483c-1.6569 1.2039-3.98.0202-3.98-2.0279V2.40011c0-1.38439 1.1247-2.518749 2.5031-2.39015149z"
                                                                                    fill="url(#product-icon-tax-SiteMenu-a)"
                                                                                ></path>
                                                                                <circle
                                                                                    cx="17.6666"
                                                                                    cy="24.3334"
                                                                                    transform="rotate(-90 17.6666 24.3334)"
                                                                                    fill="#96F"
                                                                                    r="15.6666"
                                                                                ></circle>
                                                                                <path
                                                                                    d="M31.099 16.2665l-10.5731 7.6818c-1.6569 1.2038-3.98.0201-3.98-2.028V8.70618c.37-.02614.7436-.03943 1.1202-.03943 5.7019 0 10.6924 3.04605 13.4329 7.59975z"
                                                                                    fill="url(#product-icon-tax-SiteMenu-b)"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-tax-SiteMenu-a"
                                                                                        x1="27.6927"
                                                                                        y1="-.106484"
                                                                                        x2="27.6927"
                                                                                        y2="20.5734"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop
                                                                                            offset=".23665"
                                                                                            stop-color="#FF5191"
                                                                                        ></stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#E03071"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-tax-SiteMenu-b"
                                                                                        x1="23.3061"
                                                                                        y1="24.96"
                                                                                        x2="18.8407"
                                                                                        y2="7.43349"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#6E00F5">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#9860FE"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Tax&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span class="SiteNavItem__bodyLabel">Sales tax
                                                                            &amp; VAT automation</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                    <ul class="SiteProductsNav__groupMenuList">

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/invoicing"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="invoicing"
                                                                tabindex="-1"
                                                                data-testid="header-products-revenue-and-finance-automation-data-invoicing-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--Invoicing "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 40 40"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >

                                                                                <title>Invoicing</title>

                                                                                <path
                                                                                    d="M12.5001 1C11.1194 1 10.0001 2.11929 10.0001 3.5V36.3314C10.0001 37.4628 9.24028 38.4532 8.14746 38.7462L36.1472 31.24C37.2401 30.9472 38.0001 29.9567 38.0001 28.8252V3.5C38.0001 2.11929 36.8808 1 35.5001 1H12.5001Z"
                                                                                    fill="#00D924"
                                                                                ></path>
                                                                                <path
                                                                                    d="M1.25338 24.5476C0.0575759 25.238 -0.352092 26.7668 0.338338 27.9626L5.81522 37.449C6.38097 38.4289 7.53438 38.9067 8.62734 38.6138L34.7744 31.6076L24.5869 13.9626C23.8969 12.7668 22.3676 12.3571 21.1718 13.0476L1.25338 24.5476Z"
                                                                                    fill="url(#product-icon-invoicing-SiteMenu-a)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M8.40173 38.6633C8.4771 38.6504 8.55237 38.6339 8.62737 38.6138L34.7744 31.6076L24.5869 13.9626C23.897 12.7668 22.3677 12.3571 21.1719 13.0476L10.0002 19.4976V36.3314C10.0002 37.3728 9.35638 38.2947 8.40173 38.6633Z"
                                                                                    fill="url(#product-icon-invoicing-SiteMenu-b)"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-invoicing-SiteMenu-a"
                                                                                        x1="17.3897"
                                                                                        y1="20.25"
                                                                                        x2="17.3893"
                                                                                        y2="38"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#FFD748">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#FFC148"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-invoicing-SiteMenu-b"
                                                                                        x1="21.5889"
                                                                                        y1="12.7122"
                                                                                        x2="21.5881"
                                                                                        y2="38.6633"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#00A600">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#00D924"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Invoicing&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span class="SiteNavItem__bodyLabel">Online
                                                                            invoices</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/sigma"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="sigma"
                                                                tabindex="-1"
                                                                data-testid="header-products-revenue-and-finance-automation-sigma-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--Sigma "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 40 40"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >

                                                                                <title>Sigma</title>

                                                                                <path
                                                                                    d="M5 35V7a3 3 0 0 1 5.48-1.69L21.2 21 9.32 38H8a3 3 0 0 1-3-3z"
                                                                                    fill="url(#product-icon-sigma-SiteMenu-a)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M8.06 4h25.16a1.5 1.5 0 0 1 1.1 2.51L21.15 21 5.84 4.92A3 3 0 0 1 8.05 4z"
                                                                                    fill="url(#product-icon-sigma-SiteMenu-b)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M7.88 38H33.2a1.5 1.5 0 0 0 1.11-2.51L21.11 21 7.14 36.33A1 1 0 0 0 7.88 38z"
                                                                                    fill="#9A66FF"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-sigma-SiteMenu-a"
                                                                                        x1="13.1"
                                                                                        y1="38"
                                                                                        x2="13.1"
                                                                                        y2="12.99"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#9860FE">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#6E00F5"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-sigma-SiteMenu-b"
                                                                                        x1="20.28"
                                                                                        y1="8.42"
                                                                                        x2="20.28"
                                                                                        y2="19.47"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#FF5091">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#E03071"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Sigma&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span class="SiteNavItem__bodyLabel">Custom
                                                                            reports</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden


  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href=/data-pipeline"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Product"
                                                                data-analytics-description="data-pipeline"
                                                                tabindex="-1"
                                                                data-testid="header-products-revenue-and-finance-automation-data-pipeline-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><span
                                                                        class="SiteProductsNavIcon"
                                                                    >
                                                                        <span
                                                                            class="SiteProductsNavIcon__productIconWrapper"
                                                                        >
                                                                            <svg
                                                                                class="ProductIcon ProductIcon--DataPipeline "
                                                                                width="40"
                                                                                height="40"
                                                                                viewBox="0 0 30 31"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                            >
                                                                                <path
                                                                                    d="M9.375 10.813h-.938C3.75 10.813 0 14.957 0 19.718c0 4.761 3.75 8.906 8.438 8.906H18.75c1.035 0 1.875-.84 1.875-1.875v-6.563H11.25a1.875 1.875 0 0 1-1.875-1.875v-7.5Z"
                                                                                    fill="url(#product-icon-data-pipeline-SiteMenu-a)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M20.625 12.688c0-1.036-.84-1.876-1.875-1.876H9.375v7.5c0 1.036.84 1.875 1.875 1.875h9.375v-7.5Z"
                                                                                    fill="url(#product-icon-data-pipeline-SiteMenu-b)"
                                                                                ></path>
                                                                                <path
                                                                                    d="M9.375 4.25c0-1.036.84-1.875 1.875-1.875h10.313C26.25 2.375 30 6.52 30 11.281c0 4.762-3.75 8.906-8.438 8.906h-.937v-7.5c0-1.035-.84-1.874-1.875-1.874H9.375V4.25Z"
                                                                                    fill="#9A66FF"
                                                                                ></path>
                                                                                <defs>
                                                                                    <lineargradient
                                                                                        id="product-icon-data-pipeline-SiteMenu-a"
                                                                                        x1="9.375"
                                                                                        y1="11.75"
                                                                                        x2="4.875"
                                                                                        y2="29"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#E03071">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#FF5091"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                    <lineargradient
                                                                                        id="product-icon-data-pipeline-SiteMenu-b"
                                                                                        x1="12.375"
                                                                                        y1="20"
                                                                                        x2="15.078"
                                                                                        y2="9.056"
                                                                                        gradientUnits="userSpaceOnUse"
                                                                                    >
                                                                                        <stop stop-color="#9860FE">
                                                                                        </stop>
                                                                                        <stop
                                                                                            offset="1"
                                                                                            stop-color="#6E00F5"
                                                                                        ></stop>
                                                                                    </lineargradient>
                                                                                </defs>
                                                                            </svg>
                                                                        </span>
                                                                    </span></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Data Pipeline&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">
                                                                        <span class="SiteNavItem__bodyLabel">Data
                                                                            sync</span>

                                                                    </p>

                                                                </span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>

                                        </div>

                                        <aside class="SiteProductsNav__aside">
                                            <h2 class="SiteProductsNav__asideTitle">More</h2>

                                            <ul class="SiteProductsNav__asideMenuList">
                                                <li
                                                    class="SiteProductsNavCollapsedItem"
                                                    data-js-controller="SiteProductsNavCollapsedItem"
                                                >
                                                    <a
                                                        class="SiteProductsNavCollapsedItem__link"
                                                        href=/payments/payment-methods"
                                                        data-js-controller="AnalyticsButton"
                                                        data-analytics-category="Navigation"
                                                        data-analytics-action="Clicked"
                                                        data-analytics-label="Product"
                                                        data-analytics-description="payment-methods"
                                                        tabindex="-1"
                                                        data-testid="header-products-global-payments-payment-methods-nav-item"
                                                    >
                                                        <span class="SiteProductsNavCollapsedItem__label">Payment
                                                            methods&nbsp;<svg
                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteProductsNavCollapsedItem__arrow
  "
                                                                width="10"
                                                                height="10"
                                                                viewBox="0 0 10 10"
                                                                aria-hidden="true"
                                                            >
                                                                <g fill-rule="evenodd">

                                                                    <path
                                                                        class="HoverArrow__linePath"
                                                                        d="M0 5h6.5"
                                                                    ></path>
                                                                    <path
                                                                        class="HoverArrow__tipPath"
                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                    ></path>

                                                                </g>
                                                            </svg></span>
                                                        <p
                                                            data-js-target="SiteProductsNavCollapsedItem.body"
                                                            class="SiteProductsNavCollapsedItem__body"
                                                            style="--expanded-height: 21px;"
                                                        >
                                                            <span
                                                                data-js-target="SiteProductsNavCollapsedItem.bodyContent"
                                                                class="SiteProductsNavCollapsedItem__bodyContent"
                                                            >Access to 100+ globally</span>
                                                        </p>
                                                    </a>
                                                </li>

                                                <li
                                                    class="SiteProductsNavCollapsedItem"
                                                    data-js-controller="SiteProductsNavCollapsedItem"
                                                >
                                                    <a
                                                        class="SiteProductsNavCollapsedItem__link"
                                                        href=/payments/link"
                                                        data-js-controller="AnalyticsButton"
                                                        data-analytics-category="Navigation"
                                                        data-analytics-action="Clicked"
                                                        data-analytics-label="Product"
                                                        data-analytics-description="link"
                                                        tabindex="-1"
                                                        data-testid="header-products-global-payments-link-nav-item"
                                                    >
                                                        <span
                                                            class="SiteProductsNavCollapsedItem__label">Link&nbsp;<svg
                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteProductsNavCollapsedItem__arrow
  "
                                                                width="10"
                                                                height="10"
                                                                viewBox="0 0 10 10"
                                                                aria-hidden="true"
                                                            >
                                                                <g fill-rule="evenodd">

                                                                    <path
                                                                        class="HoverArrow__linePath"
                                                                        d="M0 5h6.5"
                                                                    ></path>
                                                                    <path
                                                                        class="HoverArrow__tipPath"
                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                    ></path>

                                                                </g>
                                                            </svg></span>
                                                        <p
                                                            data-js-target="SiteProductsNavCollapsedItem.body"
                                                            class="SiteProductsNavCollapsedItem__body"
                                                            style="--expanded-height: 21px;"
                                                        >
                                                            <span
                                                                data-js-target="SiteProductsNavCollapsedItem.bodyContent"
                                                                class="SiteProductsNavCollapsedItem__bodyContent"
                                                            >Accelerated checkout</span>
                                                        </p>
                                                    </a>
                                                </li>

                                                <li
                                                    class="SiteProductsNavCollapsedItem"
                                                    data-js-controller="SiteProductsNavCollapsedItem"
                                                >
                                                    <a
                                                        class="SiteProductsNavCollapsedItem__link"
                                                        href=/financial-connections"
                                                        data-js-controller="AnalyticsButton"
                                                        data-analytics-category="Navigation"
                                                        data-analytics-action="Clicked"
                                                        data-analytics-label="Product"
                                                        data-analytics-description="financial-connections"
                                                        tabindex="-1"
                                                        data-testid="header-products-global-payments-financial-connections-nav-item"
                                                    >
                                                        <span class="SiteProductsNavCollapsedItem__label">Financial
                                                            Connections&nbsp;<svg
                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteProductsNavCollapsedItem__arrow
  "
                                                                width="10"
                                                                height="10"
                                                                viewBox="0 0 10 10"
                                                                aria-hidden="true"
                                                            >
                                                                <g fill-rule="evenodd">

                                                                    <path
                                                                        class="HoverArrow__linePath"
                                                                        d="M0 5h6.5"
                                                                    ></path>
                                                                    <path
                                                                        class="HoverArrow__tipPath"
                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                    ></path>

                                                                </g>
                                                            </svg></span>
                                                        <p
                                                            data-js-target="SiteProductsNavCollapsedItem.body"
                                                            class="SiteProductsNavCollapsedItem__body"
                                                            style="--expanded-height: 21px;"
                                                        >
                                                            <span
                                                                data-js-target="SiteProductsNavCollapsedItem.bodyContent"
                                                                class="SiteProductsNavCollapsedItem__bodyContent"
                                                            >Linked financial account data</span>
                                                        </p>
                                                    </a>
                                                </li>

                                                <li
                                                    class="SiteProductsNavCollapsedItem"
                                                    data-js-controller="SiteProductsNavCollapsedItem"
                                                >
                                                    <a
                                                        class="SiteProductsNavCollapsedItem__link"
                                                        href=/identity"
                                                        data-js-controller="AnalyticsButton"
                                                        data-analytics-category="Navigation"
                                                        data-analytics-action="Clicked"
                                                        data-analytics-label="Product"
                                                        data-analytics-description="identity"
                                                        tabindex="-1"
                                                        data-testid="header-products-global-payments-identity-nav-item"
                                                    >
                                                        <span
                                                            class="SiteProductsNavCollapsedItem__label">Identity&nbsp;<svg
                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteProductsNavCollapsedItem__arrow
  "
                                                                width="10"
                                                                height="10"
                                                                viewBox="0 0 10 10"
                                                                aria-hidden="true"
                                                            >
                                                                <g fill-rule="evenodd">

                                                                    <path
                                                                        class="HoverArrow__linePath"
                                                                        d="M0 5h6.5"
                                                                    ></path>
                                                                    <path
                                                                        class="HoverArrow__tipPath"
                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                    ></path>

                                                                </g>
                                                            </svg></span>
                                                        <p
                                                            data-js-target="SiteProductsNavCollapsedItem.body"
                                                            class="SiteProductsNavCollapsedItem__body"
                                                            style="--expanded-height: 21px;"
                                                        >
                                                            <span
                                                                data-js-target="SiteProductsNavCollapsedItem.bodyContent"
                                                                class="SiteProductsNavCollapsedItem__bodyContent"
                                                            >Online identity verification</span>
                                                        </p>
                                                    </a>
                                                </li>

                                                <li
                                                    class="SiteProductsNavCollapsedItem"
                                                    data-js-controller="SiteProductsNavCollapsedItem"
                                                >
                                                    <a
                                                        class="SiteProductsNavCollapsedItem__link"
                                                        href=/atlas"
                                                        data-js-controller="AnalyticsButton"
                                                        data-analytics-category="Navigation"
                                                        data-analytics-action="Clicked"
                                                        data-analytics-label="Product"
                                                        data-analytics-description="atlas"
                                                        tabindex="-1"
                                                        data-testid="header-products-global-payments-atlas-nav-item"
                                                    >
                                                        <span
                                                            class="SiteProductsNavCollapsedItem__label">Atlas&nbsp;<svg
                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteProductsNavCollapsedItem__arrow
  "
                                                                width="10"
                                                                height="10"
                                                                viewBox="0 0 10 10"
                                                                aria-hidden="true"
                                                            >
                                                                <g fill-rule="evenodd">

                                                                    <path
                                                                        class="HoverArrow__linePath"
                                                                        d="M0 5h6.5"
                                                                    ></path>
                                                                    <path
                                                                        class="HoverArrow__tipPath"
                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                    ></path>

                                                                </g>
                                                            </svg></span>
                                                        <p
                                                            data-js-target="SiteProductsNavCollapsedItem.body"
                                                            class="SiteProductsNavCollapsedItem__body"
                                                            style="--expanded-height: 21px;"
                                                        >
                                                            <span
                                                                data-js-target="SiteProductsNavCollapsedItem.bodyContent"
                                                                class="SiteProductsNavCollapsedItem__bodyContent"
                                                            >Startup incorporation</span>
                                                        </p>
                                                    </a>
                                                </li>

                                            </ul>
                                        </aside>
                                    </div>
                                </div>

                            </section>
                        </div>
                        <div
                            class="SiteMenu__section SiteMenu__section--left"
                            data-js-target-list="SiteHeader.menuSections"
                            aria-hidden="true"
                            hidden=""
                        >
                            <div class="SiteMenu__sectionWrapper">
                                <section class="
    SiteMenuSection
    SiteMenuSection--variantNoPadding
  ">
                                    <div class="SiteMenuSection__body">
                                        <div class="SiteSolutionsNav">
                                            <div class="SiteSolutionsNav__groupList">
                                                <div class="SiteSolutionsNav__group">
                                                    <h1 class="SiteSolutionsNav__groupTitle">By stage</h1>
                                                    <div class="SiteSolutionsNav__groupMenuContainer">
                                                        <ul class="SiteSolutionsNav__groupMenuList">
                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/enterprise"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Hubs"
                                                                    data-analytics-description="enterprise"
                                                                    tabindex="-1"
                                                                    data-testid="header-use-cases-enterprise-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--office SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M9.84619 14.1016H9.8461V1.00061C9.8461 0.33623 9.21019 -0.143434 8.57138 0.0390845L1.95599 1.92919C1.52669 2.05185 1.23071 2.44424 1.23071 2.89072V14.1016H0.923077C0.413276 14.1016 0 14.5148 0 15.0246C0 15.5344 0.413276 15.9477 0.923077 15.9477H15.0769C15.5867 15.9477 16 15.5344 16 15.0246C16 14.5148 15.5867 14.1016 15.0769 14.1016H14.7693V6.26716C14.7693 5.80829 14.457 5.40831 14.0118 5.29702L9.84619 4.25562V14.1016ZM2.99994 5.50007C2.99994 5.22393 3.2238 5.00007 3.49994 5.00007H4.49994C4.77608 5.00007 4.99994 5.22393 4.99994 5.50007V6.50007C4.99994 6.77622 4.77608 7.00007 4.49994 7.00007H3.49994C3.2238 7.00007 2.99994 6.77622 2.99994 6.50007V5.50007ZM2.99994 8.50007C2.99994 8.22393 3.2238 8.00007 3.49994 8.00007H4.49994C4.77608 8.00007 4.99994 8.22393 4.99994 8.50007V9.50007C4.99994 9.77622 4.77608 10.0001 4.49994 10.0001H3.49994C3.2238 10.0001 2.99994 9.77622 2.99994 9.50007V8.50007ZM3.49994 11.0001C3.2238 11.0001 2.99994 11.2239 2.99994 11.5001V12.5001C2.99994 12.7762 3.2238 13.0001 3.49994 13.0001H4.49994C4.77608 13.0001 4.99994 12.7762 4.99994 12.5001V11.5001C4.99994 11.2239 4.77608 11.0001 4.49994 11.0001H3.49994ZM5.99994 5.50007C5.99994 5.22393 6.2238 5.00007 6.49994 5.00007H7.49994C7.77608 5.00007 7.99994 5.22393 7.99994 5.50007V6.50007C7.99994 6.77622 7.77608 7.00007 7.49994 7.00007H6.49994C6.2238 7.00007 5.99994 6.77622 5.99994 6.50007V5.50007ZM6.49994 8.00007C6.2238 8.00007 5.99994 8.22393 5.99994 8.50007V9.50007C5.99994 9.77622 6.2238 10.0001 6.49994 10.0001H7.49994C7.77608 10.0001 7.99994 9.77622 7.99994 9.50007V8.50007C7.99994 8.22393 7.77608 8.00007 7.49994 8.00007H6.49994ZM5.99994 11.5001C5.99994 11.2239 6.2238 11.0001 6.49994 11.0001H7.49994C7.77608 11.0001 7.99994 11.2239 7.99994 11.5001V12.5001C7.99994 12.7762 7.77608 13.0001 7.49994 13.0001H6.49994C6.2238 13.0001 5.99994 12.7762 5.99994 12.5001V11.5001ZM11.5 8C11.2239 8 11 8.22386 11 8.5V9.5C11 9.77614 11.2239 10 11.5 10H12.5C12.7762 10 13 9.77614 13 9.5V8.5C13 8.22386 12.7762 8 12.5 8H11.5ZM11.5 11C11.2239 11 11 11.2239 11 11.5V12.5C11 12.7761 11.2239 13 11.5 13H12.5C12.7762 13 13 12.7761 13 12.5V11.5C13 11.2239 12.7762 11 12.5 11H11.5Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Enterprises&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <ul class="SiteSolutionsNav__groupMenuList">
                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/startups"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Hubs"
                                                                    data-analytics-description="startups"
                                                                    tabindex="-1"
                                                                    data-testid="header-use-cases-startups-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--rocket SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M1.7602 11.0312C2.05309 10.7383 2.52796 10.7383 2.82086 11.0312L4.96945 13.1798C5.26234 13.4727 5.26235 13.9475 4.96945 14.2404C4.67656 14.5333 4.20169 14.5333 3.90879 14.2404L1.7602 12.0919C1.4673 11.799 1.4673 11.3241 1.7602 11.0312Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                            <path
                                                                                fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M14.2577 1.15777C14.5522 1.21791 14.7823 1.44805 14.8425 1.74253C15.2421 3.69914 14.9478 5.76273 14.0354 7.29055C13.0727 8.90275 12.0075 9.97924 10.7799 10.7446C9.56527 11.502 8.23047 11.9295 6.78183 12.2976C6.52549 12.3628 6.25378 12.2881 6.06676 12.1011L3.89913 9.93346C3.7121 9.74643 3.63742 9.47472 3.70257 9.21837C4.07077 7.76977 4.49831 6.43499 5.25572 5.22036C6.02117 3.99285 7.09773 2.92771 8.71003 1.96508C10.2378 1.05291 12.301 0.75814 14.2577 1.15777ZM10.2426 5.75745C10.7949 6.3098 11.6904 6.3098 12.2428 5.75745C12.7951 5.2051 12.7951 4.30958 12.2428 3.75723C11.6904 3.20489 10.7949 3.20489 10.2426 3.75723C9.69021 4.30958 9.69021 5.2051 10.2426 5.75745Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                            <path
                                                                                d="M6.00056 3.07324C5.50375 3.58639 5.08372 4.12879 4.72414 4.70545C3.88214 6.05573 3.41576 7.52597 3.02402 9.0672C2.98283 9.22924 2.97346 9.39478 2.99366 9.55562L1.03466 9.06587C0.79804 9.00672 0.604964 8.8362 0.517015 8.60872C0.429066 8.38123 0.457228 8.12518 0.592519 7.92225L3.45731 3.62508C3.58021 3.44073 3.77833 3.32016 3.99853 3.29569L6.00056 3.07324Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                            <path
                                                                                d="M6.43921 12.9849C6.59424 13.0022 6.75333 12.992 6.90919 12.9524C8.45046 12.5607 9.9207 12.0944 11.271 11.2524C11.8588 10.8859 12.411 10.4566 12.9329 9.94727L12.7046 12.0018C12.6801 12.222 12.5596 12.4201 12.3752 12.543L8.07803 15.4078C7.87509 15.5431 7.61904 15.5712 7.39155 15.4833C7.16406 15.3953 6.99355 15.2023 6.93439 14.9656L6.43921 12.9849Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Startups&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="SiteSolutionsNav__group">
                                                    <h1 class="SiteSolutionsNav__groupTitle">By business model</h1>
                                                    <div class="SiteSolutionsNav__groupMenuContainer">
                                                        <ul class="SiteSolutionsNav__groupMenuList">
                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/use-cases/ecommerce"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Use cases"
                                                                    data-analytics-description="ecommerce"
                                                                    tabindex="-1"
                                                                    data-testid="header-use-cases-ecommerce-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--cart SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M5.43 6.00003L5.1 7.22003C4.99757 7.60087 4.97115 7.99815 5.02226 8.38919C5.07336 8.78023 5.20099 9.15738 5.39785 9.4991C5.79542 10.1892 6.45087 10.6932 7.22 10.9C7.98913 11.1069 8.80893 10.9998 9.49907 10.6022C10.1892 10.2046 10.6931 9.54916 10.9 8.78003L11.64 6.00003H15C15.2652 6.00003 15.5196 6.10539 15.7071 6.29293C15.8946 6.48046 16 6.73482 16 7.00003C16 7.26525 15.8946 7.5196 15.7071 7.70714C15.5196 7.89468 15.2652 8.00003 15 8.00003L14.1 15.11C14.0728 15.3558 13.9556 15.5827 13.7709 15.747C13.5862 15.9114 13.3472 16.0015 13.1 16H2.9C2.65279 16.0015 2.41378 15.9114 2.22911 15.747C2.04443 15.5827 1.92719 15.3558 1.9 15.11L1 8.00003C0.734784 8.00003 0.48043 7.89468 0.292893 7.70714C0.105357 7.5196 0 7.26525 0 7.00003C0 6.73482 0.105357 6.48046 0.292893 6.29293C0.48043 6.10539 0.734784 6.00003 1 6.00003H5.43ZM9.61 0.0200324L10.58 0.280032C10.7047 0.315197 10.8109 0.397406 10.8762 0.509333C10.9415 0.62126 10.9608 0.754163 10.93 0.880032L9.57 6.00003L8.97 8.26003C8.90104 8.51729 8.73272 8.73662 8.50205 8.86977C8.27138 9.00292 7.99726 9.03899 7.74 8.97003C7.48274 8.90108 7.26341 8.73275 7.13026 8.50208C6.99711 8.27141 6.96104 7.99729 7.03 7.74003L9.03 0.290032C9.07988 0.184336 9.16521 0.0994519 9.27116 0.0501273C9.37712 0.000802785 9.49701 -0.00984548 9.61 0.0200324Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Ecommerce&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/use-cases/saas"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Use cases"
                                                                    data-analytics-description="saas"
                                                                    tabindex="-1"
                                                                    data-testid="header-use-cases-saas-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--saas SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M2.88 1H14.13C15.15 1 16 1.84 16 2.88V14.13C16 15.16 15.16 16 14.12 16H2.88C2.63311 16 2.38865 15.9514 2.16056 15.8569C1.93246 15.7624 1.72521 15.6239 1.55064 15.4494C1.37607 15.2748 1.23759 15.0675 1.14311 14.8394C1.04863 14.6114 1 14.3669 1 14.12L1 2.88C1 1.83 1.84 1 2.88 1ZM11.85 5.22H12.48C12.6657 5.22 12.8437 5.14625 12.975 5.01497C13.1062 4.8837 13.18 4.70565 13.18 4.52C13.18 4.33435 13.1062 4.1563 12.975 4.02503C12.8437 3.89375 12.6657 3.82 12.48 3.82H9.2C9.01435 3.82 8.8363 3.89375 8.70503 4.02503C8.57375 4.1563 8.5 4.33435 8.5 4.52V6.86C8.5 7.04565 8.57375 7.2237 8.70503 7.35497C8.8363 7.48625 9.01435 7.56 9.2 7.56C9.38565 7.56 9.5637 7.48625 9.69497 7.35497C9.82625 7.2237 9.9 7.04565 9.9 6.86V5.53C10.4204 5.77577 10.8669 6.15413 11.1948 6.62707C11.5227 7.10001 11.7203 7.65089 11.768 8.2244C11.8156 8.79791 11.7115 9.37385 11.4661 9.8944C11.2207 10.4149 10.8427 10.8618 10.37 11.19V12.79C11.0648 12.4861 11.6756 12.0183 12.15 11.4267C12.6244 10.835 12.9482 10.1371 13.0937 9.39283C13.2392 8.64856 13.2021 7.8801 12.9854 7.15334C12.7688 6.42657 12.3792 5.76317 11.85 5.22ZM5.15 11.86H4.52C4.33435 11.86 4.1563 11.9338 4.02503 12.065C3.89375 12.1963 3.82 12.3743 3.82 12.56C3.82 12.7457 3.89375 12.9237 4.02503 13.055C4.1563 13.1862 4.33435 13.26 4.52 13.26H7.8C7.89193 13.26 7.98295 13.2419 8.06788 13.2067C8.15281 13.1715 8.22997 13.12 8.29497 13.055C8.35998 12.99 8.41154 12.9128 8.44672 12.8279C8.48189 12.743 8.5 12.6519 8.5 12.56V10.22C8.5 10.0343 8.42625 9.8563 8.29497 9.72503C8.1637 9.59375 7.98565 9.52 7.8 9.52C7.61435 9.52 7.4363 9.59375 7.30503 9.72503C7.17375 9.8563 7.1 10.0343 7.1 10.22V11.54C6.58187 11.2935 6.13748 10.9153 5.81121 10.4433C5.48494 9.97129 5.28819 9.42195 5.24063 8.85012C5.19306 8.2783 5.29633 7.70401 5.54013 7.18458C5.78393 6.66515 6.15973 6.21877 6.63 5.89V4.29C5.93518 4.59386 5.3244 5.06167 4.85002 5.65335C4.37565 6.24502 4.05183 6.9429 3.90632 7.68717C3.7608 8.43144 3.79795 9.1999 4.01455 9.92666C4.23116 10.6534 4.62078 11.3168 5.15 11.86Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            SaaS&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <ul class="SiteSolutionsNav__groupMenuList">
                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/use-cases/platforms"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Use cases"
                                                                    data-analytics-description="platforms"
                                                                    tabindex="-1"
                                                                    data-testid="header-use-cases-platforms-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--platform SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                d="M7.98001 -1.71977e-05C7.89121 0.00483193 7.80513 0.0323761 7.73001 0.0799828L1.24001 4.02998C1.1663 4.07485 1.10546 4.13804 1.0634 4.21339C1.02134 4.28874 0.999506 4.37369 1.00001 4.45998C1.00001 4.62998 1.10001 4.78998 1.24001 4.87998L7.73001 8.82998C7.90001 8.92998 8.10001 8.92998 8.27001 8.82998L14.76 4.87998C14.8323 4.836 14.8922 4.77439 14.9342 4.70094C14.9762 4.62748 14.9988 4.54458 15 4.45998C15.0005 4.37369 14.9787 4.28874 14.9366 4.21339C14.8946 4.13804 14.8337 4.07485 14.76 4.02998L8.27001 0.0799828C8.18049 0.0233876 8.07582 -0.00452356 7.97001 -1.71977e-05H7.98001ZM2.48001 6.81998L1.24001 7.57998C1.16774 7.62397 1.10781 7.68557 1.06584 7.75903C1.02386 7.83248 1.00121 7.91539 1.00001 7.99998C1.00001 8.16998 1.10001 8.32998 1.24001 8.41998L7.73001 12.38C7.90001 12.48 8.10001 12.48 8.27001 12.38L14.76 8.41998C14.8323 8.376 14.8922 8.31439 14.9342 8.24094C14.9762 8.16748 14.9988 8.08458 15 7.99998C14.9988 7.91539 14.9762 7.83248 14.9342 7.75903C14.8922 7.68557 14.8323 7.62397 14.76 7.57998L13.51 6.81998L8.81001 9.67998C8.56512 9.8262 8.28523 9.90341 8.00001 9.90341C7.71479 9.90341 7.43489 9.8262 7.19001 9.67998L2.49001 6.81998H2.48001ZM2.48001 10.36L1.24001 11.12C1.1663 11.1649 1.10546 11.228 1.0634 11.3034C1.02134 11.3787 0.999506 11.4637 1.00001 11.55C1.00001 11.72 1.10001 11.88 1.24001 11.97L7.73001 15.92C7.90001 16.02 8.10001 16.02 8.27001 15.92L14.76 11.97C14.8323 11.926 14.8922 11.8644 14.9342 11.7909C14.9762 11.7175 14.9988 11.6346 15 11.55C15.0005 11.4637 14.9787 11.3787 14.9366 11.3034C14.8946 11.228 14.8337 11.1649 14.76 11.12L13.51 10.36L8.81001 13.23C8.56512 13.3762 8.28523 13.4534 8.00001 13.4534C7.71479 13.4534 7.43489 13.3762 7.19001 13.23L2.49001 10.36H2.48001Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Platforms&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/use-cases/marketplaces"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Use cases"
                                                                    data-analytics-description="marketplaces"
                                                                    tabindex="-1"
                                                                    data-testid="header-use-cases-marketplaces-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--marketplace SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M13.57 7.65001C12.86 7.65001 12.17 7.38001 11.63 6.91001C11.11 7.37001 10.43 7.65001 9.7 7.65001C8.97 7.65001 8.28 7.38001 7.76 6.91001C7.22 7.37001 6.53 7.65001 5.82 7.65001C5.08 7.65001 4.39 7.38001 3.87 6.91001C3.48206 7.24216 3.01622 7.4705 2.51605 7.57368C2.01588 7.67686 1.49771 7.65152 1.01 7.50001C0.83743 7.45391 0.672402 7.38318 0.52 7.29001V14.46C0.52 14.78 0.8 15.06 1.12 15.06H8.67V9.80001C8.67 9.69001 8.77 9.60001 8.87 9.60001H12.01C12.12 9.60001 12.21 9.70001 12.21 9.80001V15.06H14.36C14.69 15.06 14.96 14.78 14.96 14.46V7.29001C14.82 7.39001 14.66 7.45001 14.47 7.49001C14.2 7.59001 13.89 7.65001 13.57 7.65001ZM6.83 11.7C6.83 11.82 6.73 11.9 6.63 11.9H3.51C3.45696 11.9 3.40609 11.8789 3.36858 11.8414C3.33107 11.8039 3.31 11.7531 3.31 11.7V9.80001C3.31 9.68001 3.41 9.60001 3.51 9.60001H6.61C6.73 9.60001 6.81 9.70001 6.81 9.80001V11.7H6.83ZM15.14 3.38001L13.04 0.420014C12.84 0.160014 12.54 1.44387e-05 12.22 1.44387e-05H3.32C3.15966 -0.000847123 3.00146 0.0368602 2.85875 0.109957C2.71604 0.183053 2.593 0.289395 2.5 0.420014L0.38 3.38001C0.13 3.72001 0 4.15001 0 4.58001C0 5.44001 0.5 6.28001 1.32 6.52001C2.24 6.80001 3.1 6.42001 3.56 5.73001C3.71 5.51001 4.03 5.51001 4.2 5.73001C4.54 6.26001 5.15 6.62001 5.82 6.62001C6.14177 6.62013 6.45829 6.53853 6.7399 6.38286C7.0215 6.22719 7.25896 6.00255 7.43 5.73001C7.58 5.51001 7.91 5.51001 8.07 5.73001C8.41 6.26001 9.02 6.62001 9.69 6.62001C10.0118 6.62013 10.3283 6.53853 10.6099 6.38286C10.8915 6.22719 11.129 6.00255 11.3 5.73001C11.45 5.51001 11.78 5.51001 11.94 5.73001C12.38 6.42001 13.24 6.80001 14.18 6.52001C15 6.27001 15.5 5.42001 15.5 4.57001C15.52 4.15001 15.39 3.74001 15.14 3.38001Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Marketplaces&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="SiteSolutionsNav__group">
                                                    <h1 class="SiteSolutionsNav__groupTitle">By use case</h1>
                                                    <div class="SiteSolutionsNav__groupMenuContainer">
                                                        <ul class="SiteSolutionsNav__groupMenuList">
                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/use-cases/finance-automation"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Use cases"
                                                                    data-analytics-description="finance automation"
                                                                    tabindex="-1"
                                                                    data-testid="header-use-cases-finance-automation-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--barGraph SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                d="M0 16V5.75C0 5.55109 0.0790176 5.36032 0.21967 5.21967C0.360322 5.07902 0.551088 5 0.75 5H2.75C2.94891 5 3.13968 5.07902 3.28033 5.21967C3.42098 5.36032 3.5 5.55109 3.5 5.75V16H0ZM6.25 16V0.75C6.25 0.551088 6.32902 0.360322 6.46967 0.21967C6.61032 0.0790176 6.80109 0 7 0L9 0C9.19891 0 9.38968 0.0790176 9.53033 0.21967C9.67098 0.360322 9.75 0.551088 9.75 0.75V16H6.25ZM12.5 16V8.75C12.5 8.55109 12.579 8.36032 12.7197 8.21967C12.8603 8.07902 13.0511 8 13.25 8H15.25C15.4489 8 15.6397 8.07902 15.7803 8.21967C15.921 8.36032 16 8.55109 16 8.75V16H12.5Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Finance automation&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/use-cases/embedded-finance"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Use cases"
                                                                    data-analytics-description="embedded finance"
                                                                    tabindex="-1"
                                                                    data-testid="header-use-cases-embedded-finance-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--fee SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                d="M15.8 4.3017L9.17296 6.83905L11.0102 0C13.205 0.586598 14.9856 2.18579 15.8 4.3017Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                            <path
                                                                                d="M14.1568 10.7505C14.4814 9.54186 14.4781 8.27343 14.1536 7.07364L9.8881 8.70682C8.36219 9.29106 6.81754 7.89816 7.24145 6.32017L8.42187 1.92604C4.87204 1.35507 1.39439 3.54605 0.443587 7.08543C-0.57108 10.8625 1.67617 14.7449 5.46296 15.757C9.24975 16.7691 13.1421 14.5276 14.1568 10.7505Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Embedded finance&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/use-cases/global-businesses"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Use cases"
                                                                    data-analytics-description="global businesses"
                                                                    tabindex="-1"
                                                                    data-testid="header-company-global-businesses-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--globalBusinesses SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M4.37 16H9C9.55228 16 10 15.5523 10 15C10 14.717 9.88242 14.4614 9.69344 14.2795C11.1565 13.6157 12.4332 12.5077 13.2984 11.0156C15.5075 7.20541 14.1965 2.33337 10.3702 0.133575C9.89187 -0.141401 9.28028 0.0217819 9.00414 0.498053C8.72799 0.974323 8.89187 1.58333 9.37016 1.8583C12.2399 3.50815 13.2232 7.16218 11.5663 10.0198C9.90946 12.8774 6.23992 13.8565 3.37016 12.2067C2.89187 11.9317 2.28028 12.0949 2.00414 12.5712C1.72799 13.0474 1.89187 13.6564 2.37016 13.9314C2.74373 14.1462 3.12746 14.3275 3.51786 14.4764C3.42409 14.6287 3.37 14.808 3.37 15C3.37 15.5523 3.81771 16 4.37 16ZM1.62 7C1.62 9.62335 3.74664 11.75 6.37 11.75C8.99335 11.75 11.12 9.62335 11.12 7C11.12 4.37665 8.99335 2.25 6.37 2.25C3.74664 2.25 1.62 4.37665 1.62 7Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Global businesses&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <ul class="SiteSolutionsNav__groupMenuList">
                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/use-cases/crypto"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Use cases"
                                                                    data-analytics-description="crypto"
                                                                    tabindex="-1"
                                                                    data-testid="header-use-cases-crypto-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--crypto SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M13.915 3.845H3.30625C3.05151 3.845 2.845 4.05151 2.845 4.30625V5.22875C2.845 5.48349 3.05151 5.69 3.30625 5.69H14.8375C15.347 5.69 15.76 6.10302 15.76 6.6125V13.07C15.76 14.089 14.934 14.915 13.915 14.915H2.845C1.82604 14.915 1 14.089 1 13.07V3.845C1 2.82604 1.82604 2 2.845 2H13.915C14.4245 2 14.8375 2.41302 14.8375 2.9225C14.8375 3.43198 14.4245 3.845 13.915 3.845ZM12.07 9.38C11.5605 9.38 11.1475 9.79302 11.1475 10.3025C11.1475 10.812 11.5605 11.225 12.07 11.225H12.9925C13.502 11.225 13.915 10.812 13.915 10.3025C13.915 9.79302 13.502 9.38 12.9925 9.38H12.07Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Crypto&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/use-cases/creator-economy"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Use cases"
                                                                    data-analytics-description="creator economy"
                                                                    tabindex="-1"
                                                                    data-testid="header-use-cases-creator-economy-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--creatorEconomy SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                d="M8.0004 0H7.9996C5.2388 0 3 2.2388 3 4.9998C3 6.3808 3.5594 7.6306 4.4648 8.5356C5.1668 9.2384 5.612 10.0974 5.8084 11H10.1922C10.3882 10.0972 10.8334 9.2382 11.5352 8.5356C12.4406 7.6306 13 6.3808 13 4.9998C13 2.2388 10.7614 0 8.0004 0ZM6.5862 6.4142L5.5254 7.4754C4.1586 6.1084 4.1586 3.8922 5.5254 2.525L6.5862 3.5858C5.8048 4.367 5.805 5.6332 6.5862 6.4142ZM10.0707 12.5H5.92871V13.929C5.92851 15.0726 6.85531 16 7.99971 16C9.14311 16 10.0705 15.0726 10.0705 13.929L10.0707 12.5Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Creator economy&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/industries/retail"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Industries"
                                                                    data-analytics-description="retail"
                                                                    tabindex="-1"
                                                                    data-testid="header-use-cases-retail-industry"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--retail SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                d="M1.70313 0.4453L0 3C0 4.65685 1.34315 6 3 6C4.04349 6 4.96254 5.46725 5.5 4.6589C6.03746 5.46725 6.95651 6 8 6C9.04349 6 9.96254 5.46725 10.5 4.6589C11.0375 5.46725 11.9565 6 13 6C14.6569 6 16 4.65685 16 3L14.2969 0.4453C14.1114 0.167101 13.7992 0 13.4648 0H2.53518C2.20083 0 1.8886 0.167101 1.70313 0.4453Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                            <path
                                                                                d="M3 12V7.5C2.28158 7.5 1.60248 7.33165 1 7.03224V15C1 15.5523 1.44772 16 2 16H14C14.5523 16 15 15.5523 15 15V7.03224C14.3975 7.33165 13.7184 7.5 13 7.5V12H3Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Retail&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="SiteSolutionsNav__group">
                                                    <h1 class="SiteSolutionsNav__groupTitle">Ecosystem</h1>
                                                    <div class="SiteSolutionsNav__groupMenuContainer">
                                                        <ul class="SiteSolutionsNav__groupMenuList">
                                                            <li
                                                                class="
    SiteNavItem
    SiteSolutionsNav__externalMenu

    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href="https://marketplace.stripe.com/"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="App Marketplace"
                                                                    target="_blank"
                                                                    tabindex="-1"
                                                                    data-testid="header-solutions-app-marketplaces-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--appsMarketplace SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M0 13.3333C0 14.8061 1.19391 16 2.66667 16L13.3333 16C14.8061 16 16 14.8061 16 13.3333L16 2.66667C16 1.19391 14.8061 0 13.3333 0H2.66667C1.19391 0 3.21315e-06 1.19391 3.02002e-06 2.66667L0 13.3333ZM8.66667 12C8.66667 12.3682 8.36819 12.6667 8 12.6667C7.63181 12.6667 7.33333 12.3682 7.33333 12L7.33333 8.66667H4C3.63181 8.66667 3.33333 8.36819 3.33333 8C3.33333 7.63181 3.63181 7.33333 4 7.33333H7.33333V4C7.33333 3.63181 7.63181 3.33333 8 3.33333C8.36819 3.33333 8.66667 3.63181 8.66667 4V7.33333H12C12.3682 7.33333 12.6667 7.63181 12.6667 8C12.6667 8.36819 12.3682 8.66667 12 8.66667H8.66667V12Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Stripe App Marketplace&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                        <svg
                                                                            class="SiteNavItem__externalIcon"
                                                                            fill="none"
                                                                            viewBox="0 0 10 10"
                                                                            width="10"
                                                                            height="10"
                                                                        >
                                                                            <path
                                                                                fill="var(--iconLightColor, var(--iconHoverLightColor, #0A2540))"
                                                                                fill-rule="evenodd"
                                                                                d="M1.25 2.5v6.25H7.5V6.875c0-.34518.27982-.625.625-.625s.625.27982.625.625v2.5c0 .34518-.27982.625-.625.625h-7.5C.279822 10 0 9.72018 0 9.375v-7.5c0-.34518.279822-.625.625-.625h2.5c.34518 0 .625.27982.625.625s-.27982.625-.625.625H1.25Zm3.56694 3.56694c-.24408.24408-.6398.24408-.88388 0-.24408-.24408-.24408-.6398 0-.88388l3.93797-3.93594H5.63508c-.34438 0-.62356-.279178-.62356-.62356C5.01152.279177 5.2907 0 5.63508 0h3.74136c.15958 0 .31917.0608788.44092.182636C9.93912.304394 10 .463977 10 .62356v3.74136c0 .34438-.27918.62356-.62356.62356s-.62356-.27918-.62356-.62356V2.12897L4.81694 6.06694Z"
                                                                                clip-rule="evenodd"
                                                                            ></path>
                                                                        </svg>

                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/partners"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Partner Ecosystem"
                                                                    tabindex="-1"
                                                                    data-testid="header-solutions-partners-ecosystem-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--partners SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                d="M15.8 1.96C15.92 2.13 15.99 2.33 16 2.54V11.06C15.98 11.48 15.74 11.86 15.36 12.03L8.46 15.23C8.16 15.36 7.83 15.36 7.54 15.23L0.64 12.03C0.453404 11.9442 0.294559 11.8078 0.18145 11.6364C0.0683411 11.465 0.00548564 11.2653 0 11.06L0 2.54C0 2.34 0.07 2.13 0.2 1.96L8 5.56L15.8 1.96ZM4.37 0C4.75 0.82 6.23 1.43 8 1.43C9.77 1.43 11.24 0.82 11.63 0H11.73V1.23C11.73 2.24 10.06 3.07 8 3.07C5.93 3.07 4.26 2.24 4.26 1.23V0H4.36H4.37Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Partners&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>

                                                        <ul class="SiteSolutionsNav__groupMenuList">
                                                            <li
                                                                class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden


  ">
                                                                <a
                                                                    class="SiteNavItem__link"
                                                                    href=/professional-services"
                                                                    data-js-controller="AnalyticsButton"
                                                                    data-analytics-category="Navigation"
                                                                    data-analytics-action="Clicked"
                                                                    data-analytics-label="Professional Services"
                                                                    tabindex="-1"
                                                                    data-testid="header-solutions-professional-services-nav-item"
                                                                >

                                                                    <span class="SiteNavItem__iconContainer"><svg
                                                                            class="BasicIcon BasicIcon--team SiteNavItem__basicIcon"
                                                                            width="16"
                                                                            height="16"
                                                                            viewBox="0 0 16 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <circle
                                                                                cx="4.79997"
                                                                                cy="5.79997"
                                                                                r="2.66667"
                                                                                fill="var(--basicIconColor)"
                                                                            ></circle>
                                                                            <circle
                                                                                cx="11.2"
                                                                                cy="3.66667"
                                                                                r="2.66667"
                                                                                fill="var(--basicIconColor)"
                                                                            ></circle>
                                                                            <path
                                                                                d="M0 13.5334C0 11.3243 1.79086 9.53345 4 9.53345H5.60002C7.80915 9.53345 9.60002 11.3243 9.60002 13.5334V13.8668C9.60002 14.4191 9.1523 14.8668 8.60002 14.8668H1C0.447717 14.8668 0 14.4191 0 13.8668V13.5334Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                            <path
                                                                                d="M8.73921 8.65956C8.40389 8.55492 8.27708 8.11391 8.58349 7.94215C9.1996 7.5968 9.91015 7.3999 10.6667 7.3999H11.7334C14.0898 7.3999 16 9.31016 16 11.6666C16 12.2557 15.5225 12.7332 14.9334 12.7332H11.7334C11.7334 10.82 10.4741 9.20093 8.73921 8.65956Z"
                                                                                fill="var(--basicIconColor)"
                                                                            ></path>
                                                                        </svg></span>

                                                                    <span class="SiteNavItem__labelContainer">
                                                                        <span class="SiteNavItem__label">
                                                                            Professional services&nbsp;<svg
                                                                                class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                                width="10"
                                                                                height="10"
                                                                                viewBox="0 0 10 10"
                                                                                aria-hidden="true"
                                                                            >
                                                                                <g fill-rule="evenodd">

                                                                                    <path
                                                                                        class="HoverArrow__linePath"
                                                                                        d="M0 5h6.5"
                                                                                    ></path>
                                                                                    <path
                                                                                        class="HoverArrow__tipPath"
                                                                                        d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                    ></path>

                                                                                </g>
                                                                            </svg>
                                                                        </span>

                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </section>
                            </div>
                        </div>
                        <div
                            class="SiteMenu__section SiteMenu__section--left"
                            data-js-target-list="SiteHeader.menuSections"
                            aria-hidden="true"
                            hidden=""
                        >
                            <div class="SiteMenu__sectionWrapper">
                                <section class="
    SiteMenuSection

  ">
                                    <div class="SiteMenuSection__body">
                                        <div class="SiteDevelopersNav__bodyLayout">
                                            <header class="SiteDevelopersNav__header">
                                                <section
                                                    class="
    SiteNavList
    SiteNavList--iconSizeNormal


  "
                                                >

                                                    <ul class="SiteNavList__list">
                                                        <li
                                                            class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasBody


    SiteNavItem--isArrowHidden

  ">
                                                            <a
                                                                class="SiteNavItem__link"
                                                                href="https://docs.stripe.com/"
                                                                data-js-controller="AnalyticsButton"
                                                                data-analytics-category="Navigation"
                                                                data-analytics-action="Clicked"
                                                                data-analytics-label="Docs"
                                                                data-analytics-description="documentation"
                                                                tabindex="-1"
                                                                data-testid="header-developers-docs-nav-item"
                                                            >

                                                                <span class="SiteNavItem__iconContainer"><svg
                                                                        class="BasicIcon BasicIcon--docs SiteNavItem__basicIcon"
                                                                        width="16"
                                                                        height="16"
                                                                        viewBox="0 0 16 16"
                                                                        fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                    >
                                                                        <path
                                                                            fill-rule="evenodd"
                                                                            clip-rule="evenodd"
                                                                            d="M4.04001 2C5.95001 2 7.50001 2.9 7.50001 4.55V15C7.05001 15 6.60001 14.7 6.33001 14.47C5.47001 13.76 3.81001 13.72 2.02001 13.72H0.830009C0.71992 13.7201 0.610944 13.698 0.509579 13.655C0.408213 13.6121 0.316535 13.5491 0.240009 13.47C0.0850522 13.3088 -0.00103162 13.0936 9.33181e-06 12.87V2.85C9.33181e-06 2.38 0.370009 2 0.830009 2H4.03001H4.04001ZM15.17 2C15.39 2 15.6 2.1 15.76 2.25C15.91 2.41 16 2.63 16 2.85V12.87C16 13.1 15.91 13.31 15.76 13.47C15.6823 13.5504 15.589 13.614 15.4858 13.657C15.3827 13.7 15.2718 13.7214 15.16 13.72H13.98C12.18 13.72 10.53 13.76 9.68001 14.47C9.40001 14.7 8.95001 15 8.50001 15V4.55C8.50001 2.91 10.05 2 11.96 2H15.16H15.17Z"
                                                                            fill="var(--basicIconColor)"
                                                                        ></path>
                                                                    </svg></span>

                                                                <span class="SiteNavItem__labelContainer">
                                                                    <span class="SiteNavItem__label">
                                                                        Documentation&nbsp;<svg
                                                                            class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            aria-hidden="true"
                                                                        >
                                                                            <g fill-rule="evenodd">

                                                                                <path
                                                                                    class="HoverArrow__linePath"
                                                                                    d="M0 5h6.5"
                                                                                ></path>
                                                                                <path
                                                                                    class="HoverArrow__tipPath"
                                                                                    d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                                ></path>

                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                    <p class="SiteNavItem__body">Start integrating
                                                                        Stripe’s products and tools</p>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </section>
                                            </header>

                                            <section
                                                class="
    SiteNavList
    SiteNavList--iconSizeNormal


  "
                                            >
                                                <h1 class="SiteNavList__title">Get started</h1>
                                                <ul class="SiteNavList__list">
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasNoIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href="https://docs.stripe.com/payments/checkout"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Docs"
                                                            data-analytics-description="checkout"
                                                            tabindex="-1"
                                                            data-testid="header-developers-checkout-nav-item"
                                                        >

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Prebuilt checkout&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasNoIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href="https://docs.stripe.com/development"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Docs"
                                                            data-analytics-description="libraries &amp; sdks"
                                                            tabindex="-1"
                                                            data-testid="header-developers-libraries-nav-item"
                                                        >

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Libraries and SDKs&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasNoIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href="https://marketplace.stripe.com/"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Apps"
                                                            data-analytics-description="app integrations"
                                                            tabindex="-1"
                                                            data-testid="header-developers-app-integrations-nav-item"
                                                        >

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    App integrations&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasNoIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href="https://github.com/stripe-samples"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Docs"
                                                            data-analytics-description="code samples"
                                                            tabindex="-1"
                                                            data-testid="header-developers-code-samples-nav-item"
                                                        >

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Code samples&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </section>

                                            <section
                                                class="
    SiteNavList
    SiteNavList--iconSizeNormal


  "
                                            >
                                                <h1 class="SiteNavList__title">Guides</h1>
                                                <ul class="SiteNavList__list">
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasNoIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href="https://docs.stripe.com/payments"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Docs"
                                                            data-analytics-description="payments"
                                                            tabindex="-1"
                                                            data-testid="header-developers-payments-guide-nav-item"
                                                        >

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Accept online payments&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasNoIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href="https://docs.stripe.com/billing"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Docs"
                                                            data-analytics-description="billing"
                                                            tabindex="-1"
                                                            data-testid="header-developers-billing-guide-nav-item"
                                                        >

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Manage subscriptions&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasNoIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href="https://docs.stripe.com/connect"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Docs"
                                                            data-analytics-description="connect"
                                                            tabindex="-1"
                                                            data-testid="header-developers-connect-guide-nav-item"
                                                        >

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Send payments&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasNoIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href="https://docs.stripe.com/terminal"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Docs"
                                                            data-analytics-description="terminal"
                                                            tabindex="-1"
                                                            data-testid="header-developers-terminal-guide-nav-item"
                                                        >

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Set up in-person payments&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </section>
                                        </div>
                                    </div>

                                    <footer class="SiteMenuSection__footer">
                                        <div class="SiteDevelopersNav__footerLayout">
                                            <section
                                                class="
    SiteNavList
    SiteNavList--iconSizeNormal


  "
                                            >

                                                <ul class="SiteNavList__list">
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href="https://docs.stripe.com/api"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Docs"
                                                            data-analytics-description="api"
                                                            tabindex="-1"
                                                            data-testid="header-developers-api-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--api SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        d="M1 2.5H15M1 14.5H15H1ZM1 10.5H15H1ZM1 6.5H15H1Z"
                                                                        stroke="var(--basicIconColor)"
                                                                        stroke-width="2"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Full API reference&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href="https://status.stripe.com/"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="System status"
                                                            data-analytics-description="api status"
                                                            tabindex="-1"
                                                            data-testid="header-developers-system-status-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--status SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        d="M1 8.07H3.75L6.55 2L9.35 13.2L12.15 8.11L15 8.07"
                                                                        stroke="var(--basicIconColor)"
                                                                        stroke-width="2"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    API status&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </section>

                                            <section
                                                class="
    SiteNavList
    SiteNavList--iconSizeNormal


  "
                                            >

                                                <ul class="SiteNavList__list">
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href="https://docs.stripe.com/upgrades#api-versions"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Docs"
                                                            data-analytics-description="api changelog"
                                                            tabindex="-1"
                                                            data-testid="header-developers-changelog-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--changelog SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        d="M8 16C5.87827 16 3.84344 15.1571 2.34315 13.6569C0.842855 12.1566 0 10.1217 0 8C0 5.87827 0.842855 3.84344 2.34315 2.34315C3.84344 0.842855 5.87827 0 8 0C10.1217 0 12.1566 0.842855 13.6569 2.34315C15.1571 3.84344 16 5.87827 16 8C16 10.1217 15.1571 12.1566 13.6569 13.6569C12.1566 15.1571 10.1217 16 8 16ZM6.58 5.72C6.70067 5.598 6.76794 5.43306 6.767 5.26146C6.76607 5.08987 6.697 4.92567 6.575 4.805C6.453 4.68433 6.28806 4.61706 6.11646 4.618C5.94487 4.61893 5.78067 4.688 5.66 4.81L2.93 7.54C2.86983 7.59952 2.82207 7.67038 2.78947 7.74848C2.75687 7.82658 2.74008 7.91037 2.74008 7.995C2.74008 8.07963 2.75687 8.16342 2.78947 8.24152C2.82207 8.31962 2.86983 8.39048 2.93 8.45L5.66 11.18C5.78067 11.302 5.94487 11.3711 6.11646 11.372C6.28806 11.3729 6.453 11.3057 6.575 11.185C6.697 11.0643 6.76607 10.9001 6.767 10.7285C6.76794 10.5569 6.70067 10.392 6.58 10.27L4.3 7.99L6.58 5.72ZM13.16 7.56L10.43 4.82C10.3093 4.69933 10.1457 4.63153 9.975 4.63153C9.80434 4.63153 9.64067 4.69933 9.52 4.82C9.39933 4.94067 9.33153 5.10434 9.33153 5.275C9.33153 5.44566 9.39933 5.60933 9.52 5.73L11.79 8.01L9.52 10.29C9.42075 10.4129 9.37048 10.5682 9.37886 10.726C9.38724 10.8838 9.45369 11.0329 9.56541 11.1446C9.67713 11.2563 9.82623 11.3228 9.984 11.3311C10.1418 11.3395 10.2971 11.2893 10.42 11.19L13.16 8.46C13.2785 8.34019 13.3449 8.17849 13.3449 8.01C13.3449 7.84151 13.2785 7.67981 13.16 7.56Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    API changelog&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href=/apps"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Build on Stripe Apps"
                                                            data-analytics-description="apps"
                                                            tabindex="-1"
                                                            data-testid="header-developers-build-a-stripe-app-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--buildApp SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        clip-rule="evenodd"
                                                                        d="M5 1C5 0.447715 5.44772 0 6 0H15C15.5523 0 16 0.447715 16 1V10C16 10.5523 15.5523 11 15 11H13V4C13 3.44772 12.5523 3 12 3H5V1ZM1 5C0.447715 5 0 5.44771 0 6V15C0 15.5523 0.447715 16 1 16H10C10.5523 16 11 15.5523 11 15V6C11 5.44772 10.5523 5 10 5H1Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Build on Stripe Apps&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </section>
                                        </div>
                                    </footer>

                                </section>
                            </div>
                        </div>
                        <div
                            class="SiteMenu__section"
                            data-js-target-list="SiteHeader.menuSections"
                            aria-hidden="true"
                            hidden=""
                        >
                            <div class="SiteMenu__sectionWrapper">
                                <section
                                    class="
    SiteMenuSection

  "
                                    data-js-controller="SiteResourcesNav"
                                >
                                    <div class="SiteMenuSection__body">
                                        <div class="SiteResourcesNav__bodyLayout">
                                            <section
                                                class="
    SiteNavList
    SiteNavList--iconSizeNormal


  "
                                            >

                                                <ul class="SiteNavList__list">
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href="https://support.stripe.com/?referrerLocale=en-us"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Support"
                                                            tabindex="-1"
                                                            data-testid="header-resources-support-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--supportCenter SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        clip-rule="evenodd"
                                                                        d="M8 16C3.58172 16 0 12.4183 0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8C16 12.4183 12.4183 16 8 16ZM13.9082 4.24431C13.357 3.37902 12.621 2.64296 11.7557 2.09177L10.4731 3.65345C11.2531 4.09822 11.9018 4.7469 12.3465 5.52692L13.9082 4.24431ZM4.24431 2.09177L5.52692 3.65345C4.7469 4.09822 4.09822 4.7469 3.65345 5.52692L2.09177 4.24431C2.64296 3.37902 3.37902 2.64296 4.24431 2.09177ZM2.09177 11.7557L3.65345 10.4731C4.09822 11.2531 4.7469 11.9018 5.52692 12.3465L4.24431 13.9082C3.37902 13.357 2.64296 12.621 2.09177 11.7557ZM11.7557 13.9082L10.4731 12.3465C11.2531 11.9018 11.9018 11.2531 12.3465 10.4731L13.9082 11.7557C13.357 12.621 12.621 13.357 11.7557 13.9082ZM12 8C12 10.2091 10.2091 12 8 12C5.79086 12 4 10.2091 4 8C4 5.79086 5.79086 4 8 4C10.2091 4 12 5.79086 12 8Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Support center&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href=/support-plans"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Support Plans"
                                                            tabindex="-1"
                                                            data-testid="header-resources-support-plans-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--supportPlan SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        fill="var(--basicIconColor)"
                                                                        fill-rule="evenodd"
                                                                        clip-rule="evenodd"
                                                                        d="M7.68496 0.588407L15.706 8.63427C16.098 9.02489 16.098 9.65821 15.706 10.0488L10.0273 15.707C9.63525 16.0977 8.99964 16.0977 8.6076 15.707L0.581052 7.65562C0.208877 7.28229 0 6.77744 0 6.25124V2.00048C0 0.895646 0.898888 0 2.00772 0H6.26601C6.79877 0 7.30951 0.211792 7.68496 0.588407ZM3.5 5C4.32843 5 5 4.32843 5 3.5C5 2.67157 4.32843 2 3.5 2C2.67157 2 2 2.67157 2 3.5C2 4.32843 2.67157 5 3.5 5Z"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Support plans&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href=/guides"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Guides"
                                                            tabindex="-1"
                                                            data-testid="header-resources-guides-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--document SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        d="M7 5V0H4C2.89543 0 2 0.89543 2 2V14C2 15.1046 2.89543 16 4 16H12C13.1046 16 14 15.1046 14 14V7H9C7.89543 7 7 6.10457 7 5Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                    <path
                                                                        d="M14 5L9 0V5H14Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Guides&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href=/customers"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Customer Stories"
                                                            tabindex="-1"
                                                            data-testid="header-resources-customer-stories-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--customers SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        d="M12 5.21142e-08C12.5763 -0.000117575 13.135 0.198892 13.5815 0.563347C14.0279 0.927802 14.3347 1.43532 14.45 2H15C15.2652 2 15.5196 2.10536 15.7071 2.29289C15.8946 2.48043 16 2.73478 16 3V15C16 15.2652 15.8946 15.5196 15.7071 15.7071C15.5196 15.8946 15.2652 16 15 16H13V12H11V16H9C8.73478 16 8.48043 15.8946 8.29289 15.7071C8.10536 15.5196 8 15.2652 8 15V3C8 2.73478 8.10536 2.48043 8.29289 2.29289C8.48043 2.10536 8.73478 2 9 2H9.55C9.66527 1.43532 9.97209 0.927802 10.4185 0.563347C10.865 0.198892 11.4237 -0.000117575 12 5.21142e-08ZM3.5 4C4.42826 4 5.3185 4.36875 5.97487 5.02513C6.63125 5.6815 7 6.57174 7 7.5V15C7 15.2652 6.89464 15.5196 6.70711 15.7071C6.51957 15.8946 6.26522 16 6 16H1C0.734784 16 0.48043 15.8946 0.292893 15.7071C0.105357 15.5196 0 15.2652 0 15V7.5C0 6.57174 0.368749 5.6815 1.02513 5.02513C1.6815 4.36875 2.57174 4 3.5 4ZM3.5 6C3.10218 6 2.72064 6.15804 2.43934 6.43934C2.15804 6.72064 2 7.10218 2 7.5C2 7.89782 2.15804 8.27936 2.43934 8.56066C2.72064 8.84196 3.10218 9 3.5 9C3.89782 9 4.27936 8.84196 4.56066 8.56066C4.84196 8.27936 5 7.89782 5 7.5C5 7.10218 4.84196 6.72064 4.56066 6.43934C4.27936 6.15804 3.89782 6 3.5 6Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Customer stories&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </section>

                                            <section
                                                class="
    SiteNavList
    SiteNavList--iconSizeNormal


  "
                                            >

                                                <ul
                                                    class="SiteNavList__list"
                                                    data-js-target="SiteResourcesNav.columnTwoList"
                                                >
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href=/blog"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Blog"
                                                            tabindex="-1"
                                                            data-testid="header-resources-blog-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--blog SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="17"
                                                                    viewBox="0 0 16 17"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        d="M12 14.2C12.2652 14.2 12.5196 14.3054 12.7071 14.4929C12.8946 14.6804 13 14.9348 13 15.2C13 15.4652 12.8946 15.7196 12.7071 15.9071C12.5196 16.0946 12.2652 16.2 12 16.2H4C3.73478 16.2 3.48043 16.0946 3.29289 15.9071C3.10536 15.7196 3 15.4652 3 15.2C3 14.9348 3.10536 14.6804 3.29289 14.4929C3.48043 14.3054 3.73478 14.2 4 14.2H12ZM8.5 0L13 7.2L11.29 13.2H4.7L3 7.2L7.5 0V6.29C7.16639 6.40795 6.88522 6.64003 6.70618 6.94524C6.52715 7.25045 6.46177 7.60912 6.5216 7.95787C6.58144 8.30661 6.76264 8.62298 7.03317 8.85105C7.3037 9.07912 7.64616 9.20421 8 9.20421C8.35384 9.20421 8.6963 9.07912 8.96683 8.85105C9.23736 8.62298 9.41856 8.30661 9.4784 7.95787C9.53823 7.60912 9.47285 7.25045 9.29382 6.94524C9.11478 6.64003 8.83361 6.40795 8.5 6.29V0Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Blog&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href=/sessions"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Sessions Annual Conference"
                                                            tabindex="-1"
                                                            data-testid="header-resources-sessions-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--sessions SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        clip-rule="evenodd"
                                                                        d="M3 1C3 0.734784 3.10536 0.48043 3.29289 0.292893C3.48043 0.105357 3.73478 0 4 0C4.26522 0 4.51957 0.105357 4.70711 0.292893C4.89464 0.48043 5 0.734784 5 1V2H3V1ZM13 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6H0V4C0 2.9 0.9 2 2 2H3V3C3 3.26522 3.10536 3.51957 3.29289 3.70711C3.48043 3.89464 3.73478 4 4 4C4.26522 4 4.51957 3.89464 4.70711 3.70711C4.89464 3.51957 5 3.26522 5 3V2H11V3C11 3.26522 11.1054 3.51957 11.2929 3.70711C11.4804 3.89464 11.7348 4 12 4C12.2652 4 12.5196 3.89464 12.7071 3.70711C12.8946 3.51957 13 3.26522 13 3V2ZM13 2H11V1C11 0.734784 11.1054 0.48043 11.2929 0.292893C11.4804 0.105357 11.7348 0 12 0C12.2652 0 12.5196 0.105357 12.7071 0.292893C12.8946 0.48043 13 0.734784 13 1V2ZM16 8H0V14C0 15.1 0.9 16 2 16H14C14.5304 16 15.0391 15.7893 15.4142 15.4142C15.7893 15.0391 16 14.5304 16 14V8Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Sessions&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href=/contact/sales"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Contact Sales"
                                                            tabindex="-1"
                                                            data-testid="header-resources-contact-sales-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--letter SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        d="M8 8.73L16 2H0L8 8.73Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                    <path
                                                                        d="M16 13V4.59338L8.71037 10.7514C8.31804 11.0829 7.68196 11.0829 7.28963 10.7514L0 4.59338V13C0 13.5523 0.447715 14 1 14H15C15.5523 14 16 13.5523 16 13Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Contact sales&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </section>
                                        </div>
                                    </div>

                                    <footer class="SiteMenuSection__footer">
                                        <div class="SiteResourcesNav__footerLayout">
                                            <section
                                                class="
    SiteNavList
    SiteNavList--iconSizeNormal


  "
                                            >

                                                <ul class="SiteNavList__list">
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href=/jobs"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Jobs"
                                                            tabindex="-1"
                                                            data-testid="header-resources-jobs-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--jobs SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        d="M10.5 3.5C10.5 3.23478 10.3946 2.98043 10.2071 2.79289C10.0196 2.60536 9.76522 2.5 9.5 2.5H6.5C6.23478 2.5 5.98043 2.60536 5.79289 2.79289C5.60536 2.98043 5.5 3.23478 5.5 3.5V4H4V3.5C4 2.83696 4.26339 2.20107 4.73223 1.73223C5.20107 1.26339 5.83696 1 6.5 1H9.5C9.8283 1 10.1534 1.06466 10.4567 1.1903C10.76 1.31594 11.0356 1.50009 11.2678 1.73223C11.4999 1.96438 11.6841 2.23998 11.8097 2.54329C11.9353 2.84661 12 3.1717 12 3.5V4H14.5C15.33 4 16 4.67 16 5.5V13.5C16 14.33 15.33 15 14.5 15H1.5C1.10218 15 0.720644 14.842 0.43934 14.5607C0.158035 14.2794 0 13.8978 0 13.5L0 5.5C0 4.67 0.67 4 1.5 4H10.5V3.5Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Jobs&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href=/newsroom"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Newsroom"
                                                            tabindex="-1"
                                                            data-testid="header-resources-newsroom-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--article SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        d="M13.6296 1C14.9387 1 16 2.06125 16 3.37037V14.037C16 14.6916 15.4694 15.2222 14.8148 15.2222H2.64165C0.888889 15.2222 0 14.3666 0 12.9194C0 9.6247 0 7.31191 0 5.98108C0 3.98483 1.77778 3.37037 3.35802 3.37037C3.35802 2.06125 4.41928 1 5.7284 1H13.6296ZM6.22222 3.66667C5.7313 3.66667 5.33333 4.06464 5.33333 4.55556C5.33333 5.04648 5.7313 5.44444 6.22222 5.44444H10.6667C11.1576 5.44444 11.5556 5.04648 11.5556 4.55556C11.5556 4.06464 11.1576 3.66667 10.6667 3.66667H6.22222ZM6.22222 7.22222C5.7313 7.22222 5.33333 7.62019 5.33333 8.11111C5.33333 8.60203 5.7313 9 6.22222 9H13.3333C13.8243 9 14.2222 8.60203 14.2222 8.11111C14.2222 7.62019 13.8243 7.22222 13.3333 7.22222H6.22222ZM6.22222 10.7778C5.7313 10.7778 5.33333 11.1757 5.33333 11.6667C5.33333 12.1576 5.7313 12.5556 6.22222 12.5556H13.3333C13.8243 12.5556 14.2222 12.1576 14.2222 11.6667C14.2222 11.1757 13.8243 10.7778 13.3333 10.7778H6.22222ZM3.11111 5.44444C2.37473 5.44444 1.77778 6.0414 1.77778 6.77778V12.5556C1.77778 13.0465 2.17575 13.4444 2.66667 13.4444H3.55556V5.44444H3.11111Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Newsroom&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </section>

                                            <section
                                                class="
    SiteNavList
    SiteNavList--iconSizeNormal


  "
                                            >

                                                <ul class="SiteNavList__list">
                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href="https://press.stripe.com/"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Stripe Press"
                                                            tabindex="-1"
                                                            data-testid="header-resources-stripe-press-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--docs SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        clip-rule="evenodd"
                                                                        d="M4.04001 2C5.95001 2 7.50001 2.9 7.50001 4.55V15C7.05001 15 6.60001 14.7 6.33001 14.47C5.47001 13.76 3.81001 13.72 2.02001 13.72H0.830009C0.71992 13.7201 0.610944 13.698 0.509579 13.655C0.408213 13.6121 0.316535 13.5491 0.240009 13.47C0.0850522 13.3088 -0.00103162 13.0936 9.33181e-06 12.87V2.85C9.33181e-06 2.38 0.370009 2 0.830009 2H4.03001H4.04001ZM15.17 2C15.39 2 15.6 2.1 15.76 2.25C15.91 2.41 16 2.63 16 2.85V12.87C16 13.1 15.91 13.31 15.76 13.47C15.6823 13.5504 15.589 13.614 15.4858 13.657C15.3827 13.7 15.2718 13.7214 15.16 13.72H13.98C12.18 13.72 10.53 13.76 9.68001 14.47C9.40001 14.7 8.95001 15 8.50001 15V4.55C8.50001 2.91 10.05 2 11.96 2H15.16H15.17Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Stripe Press&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li
                                                        class="
    SiteNavItem


    SiteNavItem--hasIcon


    SiteNavItem--hasNoBody


    SiteNavItem--isArrowHidden

  ">
                                                        <a
                                                            class="SiteNavItem__link"
                                                            href=/partners/become-a-partner"
                                                            data-js-controller="AnalyticsButton"
                                                            data-analytics-category="Navigation"
                                                            data-analytics-action="Clicked"
                                                            data-analytics-label="Become a Partner"
                                                            tabindex="-1"
                                                            data-testid="header-resources-become-a-partner-nav-item"
                                                        >

                                                            <span class="SiteNavItem__iconContainer"><svg
                                                                    class="BasicIcon BasicIcon--certificate SiteNavItem__basicIcon"
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        d="M9.8279 10.7878C9.06146 10.1392 7.93854 10.1392 7.1721 10.7878C6.79426 11.1076 6.22873 11.0605 5.90896 10.6827C5.78846 10.5403 5.71538 10.3639 5.69991 10.178C5.61664 9.17739 4.82261 8.38336 3.82198 8.30009C3.32869 8.25903 2.96208 7.82586 3.00314 7.33257C3.01861 7.1467 3.09168 6.97028 3.21218 6.8279C3.86085 6.06146 3.86085 4.93854 3.21218 4.1721C2.8924 3.79426 2.93947 3.22873 3.31731 2.90896C3.45968 2.78846 3.6361 2.71538 3.82198 2.69991C4.82261 2.61664 5.61664 1.82261 5.69991 0.821979C5.74097 0.328691 6.17414 -0.0379164 6.66743 0.00313763C6.8533 0.0186074 7.02972 0.0916833 7.1721 0.21218C7.93854 0.860849 9.06146 0.860849 9.8279 0.21218C10.2057 -0.107597 10.7713 -0.060531 11.091 0.317306C11.2115 0.45968 11.2846 0.636101 11.3001 0.821979C11.3834 1.82261 12.1774 2.61664 13.178 2.69991C13.6713 2.74097 14.0379 3.17414 13.9969 3.66743C13.9814 3.8533 13.9083 4.02972 13.7878 4.1721C13.1392 4.93854 13.1392 6.06146 13.7878 6.8279C14.1076 7.20574 14.0605 7.77127 13.6827 8.09104C13.5403 8.21154 13.3639 8.28462 13.178 8.30009C12.1774 8.38336 11.3834 9.17739 11.3001 10.178C11.259 10.6713 10.8259 11.0379 10.3326 10.9969C10.1467 10.9814 9.97028 10.9083 9.8279 10.7878Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                    <path
                                                                        d="M4.5 16C4.5 16 6.5418 15.2343 7.70784 14H9.29637C10.4631 15.2317 12.5 15.9955 12.5 15.9955L12.1965 12.3757C11.1309 13.2108 9.57597 13.2149 8.5 12.31V12.3145L8.49697 12.317L8.48445 12.3L8.441 12.3628C7.36779 13.219 5.84973 13.2001 4.80355 12.3802L4.5 16Z"
                                                                        fill="var(--basicIconColor)"
                                                                    ></path>
                                                                </svg></span>

                                                            <span class="SiteNavItem__labelContainer">
                                                                <span class="SiteNavItem__label">
                                                                    Become a partner&nbsp;<svg
                                                                        class="
    HoverArrow
    HoverArrow--sizeSmall
    SiteNavItem__arrow
  "
                                                                        width="10"
                                                                        height="10"
                                                                        viewBox="0 0 10 10"
                                                                        aria-hidden="true"
                                                                    >
                                                                        <g fill-rule="evenodd">

                                                                            <path
                                                                                class="HoverArrow__linePath"
                                                                                d="M0 5h6.5"
                                                                            ></path>
                                                                            <path
                                                                                class="HoverArrow__tipPath"
                                                                                d="M1 1.5l3.25 3.5-3.25 3.5"
                                                                            ></path>

                                                                        </g>
                                                                    </svg>
                                                                </span>

                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </section>
                                        </div>
                                    </footer>

                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>
