@props(['url'])
<tr style="background-color: #f7fbff!important;border-color: #f7fbff!important;">
<td style="text-align: center!important; padding: 20px 0!important;">
<a href="{{ $url }}" style="display: inline-block!important; margin: 0 auto!important;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
