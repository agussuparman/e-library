Klik link berikut untuk melakukan aktivasi akun E-Library:
<a href="{{ $link = url('auth/verify', $token) . '?email=' . urlencode($user->email) }}"> {{ $link }} </a>