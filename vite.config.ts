import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import Icons from 'unplugin-icons/vite';
import AutoImport from 'unplugin-auto-import/vite';
import IconsResolver from 'unplugin-icons/resolver'


const iconCollection = [
    'hugeicons',
    'heroicons',
    'game-icons',
    'lucide-lab',
    'mingcute',
    'svg-spinners',
    'flowbite'
] as const satisfies string[];
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.tsx', 'resources/css/filament/admin/theme.css'],
            ssr: 'resources/js/ssr.tsx',
            refresh: true,
        }),
        react(),
        Icons({
            compiler: 'jsx',
            jsx: 'react',
            iconCustomizer(collection, icon, props) {
                if (iconCollection.find((c) => c === collection)) {
                    props.width = '4em'
                    props.height = '4em'
                }
            }
        }),
        AutoImport({
            resolvers: [
                IconsResolver({
                    prefix: false,
                    extension: 'tsx',
                    enabledCollections: iconCollection,
                }),
            ],
            ignore: [
                'false',
                'window',
            ],
            dts: "./resources/js/types/auto-imports.d.ts",
            eslintrc: {
                enabled: true,
            },
            imports: [
                'react',
            ],
            dirs: [
                'resources/js/Components/**',
                'resources/js/Hooks/**',
                'resources/js/Layouts/**',
                'resources/js/types/**',
            ]
        })
    ],
});
