@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="{{ asset('img/logo1.svg') }}" alt="{{ config('app.name') }}" style="width: 100px;">
@endif
</a>
</td>
</tr>
