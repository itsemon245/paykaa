@php
    $whyUs = $whyUs ?? 'not set yet';
@endphp
<section id="how-it-works" class="w-full max-w-5xl p-3 mx-auto mb-4 md:mb-8">
    <x-section-title title="Why Choose Paykaa" />
    <div class="text-lg text-gray-600 leading-loose">
        {!! nl2br($whyUs) !!}
    </div>
</section>
