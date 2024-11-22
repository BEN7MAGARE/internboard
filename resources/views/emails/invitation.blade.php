<x-mail::message>

<h5 style="color: #0b3d91;text-align: center;">{{ $subject }}</h5>

<p>{{ $message }}</p>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
