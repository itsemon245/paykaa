@php
    $howItWorks = $howItWorks ?? [];
@endphp
<style>
.custom-border {
    width: var(--image-size);
    height: var(--image-size);
    position: absolute;
    background-color: transparent;
    border-color: var(--primary-500);
    padding: 0.5rem; /* Equivalent to p-2 */
    width: var(--image-size);
    height: var(--image-size);
}

</style>
<section id="how-it-works" class="w-full max-w-5xl p-3 mx-auto"
         data-content="{{json_encode($howItWorks)}}"
         x-data="sectionAnimation">
    <div class="grid grid-cols-2 gap-10 items-center relative">
        <!-- Left Content -->
        <div class="overflow-y-auto hide-scrollbar flex flex-col items-center h-[500px] snap-y snap-mandatory">
            <template x-for="(item, index) in content" :key="index">
                <div style="height: 500px!important;" class="snap-start snap-always flex flex-col justify-center px-3 py-40">
                    <p class="text-sm uppercase text-cyan-500 !font-bold" x-text="item.name"></p>
                    <h2 class="text-4xl font-bold leading-tight text-gray-800" x-text="item.title"></h2>
                    <p class="mt-4 text-gray-600" x-text="item.description"></p>
                </div>
            </template>
        </div>
        <!-- Right Images -->
        <div x-intersect="onVisible()"
             class="h-max flex justify-center items-center gap-20 mb-[var(--translate-y)] relative" style="--image-size: 105px;--translate-y: calc(var(--image-size) + 30%);">
            <template x-for="(image, index) in images"
                      :key="index">
                <div :class="{ 'translate-y-[var(--translate-y)]': index == 1 }" class="rounded-lg !w-[var(--image-size)] !h-[var(--image-size)] relative">
                    <div
                    x-show="visible && currentIndex >= index"
                         class="!z-20 relative !max-w-full !w-[var(--image-size)] !h-[var(--image-size)] !rounded-lg object-cover"
                         :style="{
                             'background-image': `url(${image})`,
                             'background-size': 'cover',
                             'background-position': 'center',
                         }"
                         :class="{
                             'animate__animated animate__zoomIn': visible && currentIndex >= index,
                             'animate__animated animate__zoomOut': !visible && currentIndex >= index,
                             }"></div>
                    <div
                         x-show="visible && currentIndex >= index"
                         x-transition.duration.2000ms
                        :class="{
                        'rounded-bl-lg border-b-4 border-l-4': index == 1,
                        'right-[41.9%]': true,
                        'top-[50%]': index != 1,
                        'bottom-[50%]': index == 1,
                        }"
                        class="custom-border"></div>

                    <div
                        x-show="index == 2 && visible && currentIndex >= index"
                        x-transition.duration.2000ms
                        :class="{
                            'rounded-br-lg border-b-4 border-r-4': index == 2,
                            'top-[80%] z-[-1]': true,
                            'left-[-135%]': true,
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
                content: [],
                init(){
                    const data = document.querySelector('[data-content]').getAttribute('data-content')
                    const content = JSON.parse(data)
                    this.content = content
                    console.log(this.content)
                },
                currentIndex: 0,
                visible: false,
                onVisible() {
                    this.visible = true
                    setTimeout(() => {
                        this.currentIndex = 1
                        setTimeout(() => {
                            this.currentIndex = 2
                        }, 2000)
                    }, 2000)
                },
                get images(){
                    return this.content.map(item => item.image?.startsWith('http') ? item.image : `/storage/${item.image}`)
                },
            }));
        });
    </script>
@endpush
