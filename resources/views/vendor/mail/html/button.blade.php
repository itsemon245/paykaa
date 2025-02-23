@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<div style="text-align: {{ $align }};margin: 24px 24px;">
    <a
         style="background-color: #3f75a4 !important; border-radius: 4px; font-weight: bold; color: #fff; display: inline-block; padding: 8px 18px; text-decoration: none; text-align: center; border: 8px solid transparent; border-bottom-color: #3f75a4; border-left-color: #3f75a4; border-right-color: #3f75a4; border-top-color: #3f75a4;"
        href="{{ $url }}" class="button button-{{ $color }}" target="_blank" rel="noopener">{{ $slot }}</a>
</div>
{{--
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<a href="{{ $url }}" class="button button-primary" target="_blank" rel="noopener">{{ $slot }}</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table> --}}
