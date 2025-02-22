@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<div style="text-align: {{ $align }};margin: 24px 24px;">
    <a href="{{ $url }}" class="button button-{{ $color }}" style="background-color:var(--primary)!important;" target="_blank" rel="noopener">{{ $slot }}</a>
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
