@extends('layouts.frontend')

@section('content')
	<section class="banner-area relative about-banner" id="home">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1 class="text-white">
						PENDAFTARAN
					</h1>
					<p class="text-white link-nav">Home </a><span class="lnr lnr-arrow-right"></span>Pendaftaran</a></p>
				</div>
				</div>
			</div>
		</div>
	</section>

	<section class="search-course-area relative bg-light" style="background: unset;">
		<div class="container">
			<div class="row justify-content-between align-items-center">
				<div class="col-lg-6 col-md-6 search-course-left">
					<h1 class="font-weight-light">
						Pendaftaran Online <br>
						Silahkan Mendaftar
					</h1>
					<h4 class="font-weight-light">
						Dengan Kurikulum Update Dengan Kebutuhan Pasar, <br>
						Kami Menjamin Lulusan Akan Mudah Mendapatkan Pekerjaan.
					</h4>
				</div>
				<div class="col-lg-49 col-md-6 search-course-right section-gap">
					{!! Form::open(['url' => '/postregister','class' => 'form-warp']) !!}
					<h4 class="pb-20 text-center mb-30">Formulir Pendaftaran</h4>
					{!!Form::text('nama_depan','',['class' => 'form-control','placeholder' => 'Nama Depan'])!!}
					{!!Form::text('nama_belakang','',['class' => 'form-control','placeholder' => 'Nama Belakang'])!!}
					{!!Form::text('agama','',['class' => 'form-control','placeholder' => 'Agama'])!!}
					<div class="form-select mb-1" id="service-select">
						{!!Form::select('jenis_kelamin', [' ' => 'Pilih Jenis Kelamin','L' => 'Laki-Laki', 'P' => 'Perempuan'],['style' => 'display: none;']);!!}
					</div>
					{!!Form::email('email','',['class' => 'form-control','placeholder' => 'Email'])!!}
					{!!Form::password('password',['class' => 'form-control','placeholder' => 'Password'])!!}
					{!!Form::textarea('alamat','',['class' => 'form-control','placeholder' => 'Alamat'])!!}
					<br>
					<input type="submit" class="input-group primary-btn text-uppercase text-center" value="Simpan">
					{!!Form::close()!!}
				</form>

			</div>
		</div>
	</div>	
</section>
@stop