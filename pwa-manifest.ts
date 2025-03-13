export const pwaManifest = {
    "name": "PayKaa",
    "short_name": "PayKaa",
    "id": "/dashboard",
    "start_url": "/",
    "scope": "/",
    "description": "Protecting your money is our responsibility",
    "theme_color": "#4177a6",
    "background_color": "#d8e5f0",
    "display": "standalone",
    "prefer_related_applications": false,
    "icons": [
        {
            "src": "/assets/icons/android/android-mask-512-512.png",
            "sizes": "512x512",
            "type": "image/png",
            "purpose": "maskable"
        },
        {
            "src": "/assets/icons/android/android-mask-192-192.png",
            "sizes": "192x192",
            "type": "image/png",
            "purpose": "maskable"
        },
        {
            "src": "/assets/icons/android/android-mask-192-192.png",
            "sizes": "192x192",
            "type": "image/png",
            "purpose": "any"
        },
        {
            "src": "/assets/icons/android/android-mask-512-512.png",
            "sizes": "512x512",
            "type": "image/png",
            "purpose": "any"
        },

        {
            "src": "/assets/icons/android/android-launchericon-144-144.png",
            "sizes": "144x144",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/android/android-launchericon-96-96.png",
            "sizes": "96x96",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/android/android-launchericon-72-72.png",
            "sizes": "72x72",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/android/android-launchericon-48-48.png",
            "sizes": "48x48",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/1024.png",
            "sizes": "1024x1024",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/512.png",
            "sizes": "512x512",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/256.png",
            "sizes": "256x256",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/180.png",
            "sizes": "180x180",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/152.png",
            "sizes": "152x152",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/120.png",
            "sizes": "120x120",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/87.png",
            "sizes": "87x87",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/80.png",
            "sizes": "80x80",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/76.png",
            "sizes": "76x76",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/72.png",
            "sizes": "72x72",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/60.png",
            "sizes": "60x60",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/58.png",
            "sizes": "58x58",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/50.png",
            "sizes": "50x50",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/40.png",
            "sizes": "40x40",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/32.png",
            "sizes": "32x32",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/29.png",
            "sizes": "29x29",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/20.png",
            "sizes": "20x20",
            "type": "image/png"
        },
        {
            "src": "/assets/icons/ios/16.png",
            "sizes": "16x16",
            "type": "image/png"
        }
    ],
    "shortcuts": [
        {
            "name": "Deposit",
            "short_name": "Deposit",
            "url": "/wallet/deposit",
            "description": "Deposit Funds",
            "icons": [{ "src": "/assets/icons/shortcuts/deposit.png", "sizes": "96x96", "type": "image/png" }]
        },
        {
            "name": "Withdraw",
            "short_name": "Withdraw",
            "url": "/wallet/withdraw",
            "description": "Withdraw Funds",
            "icons": [{ "src": "/assets/icons/shortcuts/withdraw.png", "sizes": "96x96", "type": "image/png" }]
        },
        {
            "name": "Chats",
            "short_name": "Chats",
            "url": "/chats",
            "description": "Open Chats",
            "icons": [{ "src": "/assets/icons/shortcuts/chats.png", "sizes": "96x96", "type": "image/png" }]
        },
        {
            "name": "Help",
            "short_name": "Help",
            "url": "/helpline",
            "description": "Contact Helpline",
            "icons": [{ "src": "/assets/icons/shortcuts/help.png", "sizes": "96x96", "type": "image/png" }]
        }
    ],
    "categories": ["finance", "security"],
    "screenshots": [
        {
            "src": "/assets/screenshots/desktop.png",
            "sizes": "1280x800",
            "type": "image/png",
            "form_factor": "wide"
        },
        {
            "src": "/assets/screenshots/mobile.png",
            "sizes": "750x1623",
            "type": "image/png",
            "form_factor": "narrow"
        }
    ]
}
