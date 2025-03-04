<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
    <img src="https://paykaa.com/assets/logo-long.png" style="max-height:50px; width:auto; margin: 0 auto;box-shadow: 0px 0px 8px rgba(255, 255, 255, 0.6);" alt="PayKaa Logo">
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{!! $slot !!}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
    You have received this email because your email address was specified on the **PayKaa** website during the signup process. If you did not sign up please ignore this email
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
<div style="text-align:center;">© {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}</div>
<div style="text-align:center;font-size:11px;color:gray;margin-top:6px">MessageID: {{ \Illuminate\Support\Str::uuid()->toString() }}</div>
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
