<p>
	Hai, {{ $member->name }}
</p>
<p>
	Admin kami telah mendaftarkan email Anda ({{ $member->email }}) ke E-Library. Untuk login silahkan kunjungi <a href="{{ $login = url('login') }}">{{ $login }}</a>. Login dengan email Anda dan password <strong>{{ $password }}</strong>
</p>
<p>
	Jika anda ingin mengubah password, silahkan kunjungi <a href="{{ $reset = url('password/reset') }}">{{ $reset }}</a> dan masukkan email Anda.
</p>