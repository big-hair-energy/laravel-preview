<div style="max-width: 600px; background-color: #eee; font-family: sans-serif; text-align: center; margin: auto; padding: 20px;">
    <p style="font-weight: 500px;">You have been invited to preview {{ $website }}.</p>
    <p>Use the following email and secret key at <a href="{{ $url }}?email={{ $email }}&secret_key={{ $secret_key }}">{{ $url }}</a>:</p>
    <p>Email:<br><kbd>{{ $email }}</kbd></p>
    <p>Secret key:<br><kbd>{{ $secret_key }}</kbd></p>
</div>
