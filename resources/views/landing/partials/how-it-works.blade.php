@php
    $howItWorks = $howItWorks ?? [];
@endphp
@push('styles')
@endpush
<section class="w-full max-w-5xl p-3 mx-auto"
         x-data="sectionAnimation">
    <div class="grid grid-cols-2 gap-10 items-center relative">
        <!-- Left Content -->
        <div class="h-[600px] overflow-scroll hide-scrollbar flex items-center">
            <div class="flex flex-col gap-60 items-center">
                @foreach ($howItWorks as $item)
                    <div>
                        <p class="text-sm uppercase text-blue-400">Tagline</p>
                        <h2 class="text-4xl font-bold leading-tight">Hello</h2>
                        <p class="mt-4 text-gray-300">Hei</p>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Right Images -->
        <div x-intersect="onVisible()"
             class="absolute top-0 right-0 h-max !w-[550px] flex justify-center items-center gap-20 mb-[200px]">
            <template x-for="(image, index) in images"
                      :key="index">
                <div :class="{ 'translate-y-[150px]': index == 1 }">
                    <img x-show="visible && currentIndex >= index"
                         class="rounded-lg w-[150px] h-[150px]"
                         :src="image.src"
                         :class="{
                             'animate__animated animate__zoomIn': visible && currentIndex >= index,
                             'animate__animated animate__zoomOut': !visible && currentIndex >= index,
                         }" />
                </div>
            </template>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('sectionAnimation', () => ({
                currentIndex: 0,
                visible: false,
                onVisible() {
                    console.log('I am visible!')
                    this.visible = true
                    setTimeout(() => {
                        this.currentIndex = 1
                        setTimeout(() => {
                            this.currentIndex = 2
                        }, 2000)
                    }, 2000)
                },
                content: [{
                        title: 'First Section',
                        description: 'This is the first section of content.'
                    },
                    {
                        title: 'Second Section',
                        description: 'This is the second section of content.'
                    },
                    {
                        title: 'Third Section',
                        description: 'This is the third section of content.'
                    }
                ],
                images: [{
                        src: 'https://placehold.co/400/green/white'
                    },
                    {
                        src: 'https://placehold.co/400/red/white'
                    },
                    {
                        src: 'https://placehold.co/400/blue/white'
                    },
                ],
            }));
        });
    </script>
@endpush
