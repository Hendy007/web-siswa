@extends('layouts.master')

@section('content')
	<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">Data Siswa</h3>
									<div class="right">
										<a href="/siswa/exportexcel" class="btn btn-sm btn-primary">Export Excel</a>
										<a href="/siswa/exportpdf" class="btn btn-sm btn-primary">Export Pdf</a>
										<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i></button>
									</div>	
								</div>
								<div class="panel-body">
								<table class="table table-hover" id="datatable">
									<thead>
										<tr>
											<th>NAMA LENGKAP</th>
											<th>JENIS KELAMIN</th>
											<th>AGAMA</th>
											<th>ALAMAT</th>
											<th>RATA-RATA NILAI</th>
											<th>AKSI</th>
											<th>
										</tr>
										</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
						</div>	
					</div>	
				</div>
			</div>
		</div>
	</div>


			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <a class="modal-title" id="exampleModalLabel">Siswa Baru</a>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			     <form action="/siswa/create" method="POST" enctype="multipart/form-data">
			     	{{csrf_field()}}

				  <div class="form-group">
				    <label for="exampleInputEmail1">Nama Depan</label>
				    <input name="nama_depan" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Depan">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Nama Belakang</label>
				    <input name="nama_belakang" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Belakang">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Email</label>
				    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
				  </div>

				<div class="form-group">
			    <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
			    <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
			      <option value="L">Laki-Laki</option>
			      <option value="P">Perempuan</option>
			    </select>
			  </div>

			    <div class="form-group">
				    <label for="exampleInputEmail1">Agama</label>
				    <input name="agama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Agama">
				  </div>

				<div class="form-group">
				    <label for="exampleFormControlTextarea1">Alamat</label>
				    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
				  </div>

				  <div class="form-group">
				    <label for="exampleFormControlTextarea1">Avatar</label>
				    <input type="file" name="avatar" class="form-control">
				  </div>
				  
				
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Submit</button>
			        </form>
			      </div>
			    </div>
			  </div>
			</div>
@stop

@section('footer')
<script >
	$(document).ready(function(){
		$('#datatable').DataTable({
			processing:true,
			serverside:true,
			ajax:"{{route('ajax.get.data.siswa')}}",
			columns:[
				{data:'nama_lengkap',name:'nama_lengkap'},
				{data:'jenis_kelamin',name:'jenis_kelamin'},
				{data:'agama',name:'agama'},
				{data:'alamat',name:'alamat'},
				{data:'rata_rata_nilai',name:'rata_rata_nilai'},
				{data:'aksi',name:'aksi'},

			]
		});

		$('.delete').click(function(){
			var siswa_id = $(this).attr('siswa-id');
			swal({
			  title: "Are you sure?",
			  text: "Yakin nih "+ siswa_id +"??",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
				console.log(willDelete);
			  if (willDelete) {
			    	window.location = "/siswa/"+siswa_id+"/delete";
			    }
			});		  
		});
	});
</script>
@stop