@php
    $howItWorks = $howItWorks ?? [];
@endphp
<style>
.custom-border {
    width: var(--image-size);
    height: var(--image-size);
    position: absolute;
    background-color: transparent;
    padding: 0.5rem; /* Equivalent to p-2 */
}

</style>
<section id="how-it-works" class="w-full max-w-5xl p-3 mx-auto"
         x-data="sectionAnimation">
    <div class="grid grid-cols-2 gap-10 items-center relative h-[500px]">
        <!-- Left Content -->
        <div class="overflow-scroll hide-scrollbar flex items-center">
            <div class="flex flex-col gap-60 items-center">
                <div>
                    <p class="text-sm uppercase text-blue-400">Tagline</p>
                    <h2 class="text-4xl font-bold leading-tight">Hello</h2>
                    <p class="mt-4 text-gray-300">Hei</p>
                </div>
            </div>
        </div>
        <!-- Right Images -->
        <div x-intersect="onVisible()"
             class="h-max flex justify-center items-center gap-20 mb-[var(--translate-y)] relative" style="--image-size: 105px;--translate-y: calc(var(--image-size) + 30%);">
            <template x-for="(image, index) in images"
                      :key="index">
                <div :class="{ 'translate-y-[var(--translate-y)]': index == 1 }" class="rounded-lg !w-[var(--image-size)] !h-[var(--image-size)] relative">
                    <div
                    x-show="visible && currentIndex >= index"
                         class="!z-20 relative border-primary border-2 !max-w-full !w-[var(--image-size)] !h-[var(--image-size)] !rounded-lg object-cover"
                         :style="{
                             'background-image': `url(${image.src})`,
                             'background-size': 'cover',
                             'background-position': 'center',
                         }"
                         :class="{
                             'animate__animated animate__zoomIn': visible && currentIndex >= index,
                             'animate__animated animate__zoomOut': !visible && currentIndex >= index,
                             }"></div>
                    <div x-show="index == 1 && visible && currentIndex >= index"
                        x-transition.delay.2000ms
                        x-transition.duration.2000ms
                        :class="{
                        'rounded-bl-lg border-b-4 border-l-4': index == 1,
                        'right-[41.9%]': true,
                        'top-[50%]': index != 1,
                        'bottom-[50%]': index == 1,
                        }"
                        class="custom-border"></div>

                    <div x-show="visible && currentIndex > index"
                        x-transition.duration.2000ms
                        :class="{
                        'rounded-br-lg border-b-4 border-r-4': index == 1,
                        'left-[41.9%]': true,
                        'top-[50%]': index != 1,
                        'bottom-[50%]': index == 1,
                        }"
                        class="custom-border"></div>
                    <div x-show="visible && currentIndex >= index"
                        x-transition.duration.2000ms
                        :class="{
                        'rounded-tr-lg border-t-4 border-r-4': index == 0,
                        'rounded-tl-lg border-t-4 border-l-4': index == 2,
                        'left-[39%]': index == 0,
                        'right-[39%]': index == 2,
                        'top-[50%]': index != 1,
                        'bottom-[50%]': index == 1,
                        }"
                        class="custom-border">
                    </div>
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
