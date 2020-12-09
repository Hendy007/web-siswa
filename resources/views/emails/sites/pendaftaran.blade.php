@component('mail::message')
# Pendaftaran Siswa

Selamat Anda Telah Terdaftar

@component('mail::button', ['url' => 'http://hendyapriandi@gmail.com'])
klik disini
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
