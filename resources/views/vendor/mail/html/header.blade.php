@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{-- {!! $slot !!} --}}
<img 
    src="{{ config('app.url') . '/images/logo.png' }}"
    class="logo"
    alt="Footsyde"
/>
@endif
</a>
</td>
</tr>
