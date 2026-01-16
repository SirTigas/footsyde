@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
{{-- @if (trim($slot) === 'Footsyde')
<img src="https://i.ibb.co/fdfSxTnB/logo.png" class="logo" alt="logo-footsyde">
@else --}}
{{-- {!! $slot !!} --}}
<img src="https://i.ibb.co/fdfSxTnB/logo.png" alt="logo-footsyde" border="0">
{{-- @endif --}}
</a>
</td>
</tr>
