@php
    $ourMission = $ourMission ?? 'not set yet';
@endphp
<section id="how-it-works" class="w-full max-w-5xl p-3 mx-auto mb-4 md:mb-8">
    <x-section-title title="Our Mission" />
    <div class="text-lg text-gray-600 leading-loose">
        {!! nl2br($ourMission) !!}
    </div>
</section>
