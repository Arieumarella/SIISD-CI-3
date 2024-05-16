
<style type="text/css">
	.profile-user-img {
		width: 30%; /* 50% of the parent container's width */
		height: auto; /* Maintain the aspect ratio */
	}

	table {
		width: 100% !important;
	}


	#example {
		width: 100% !important;
	}

</style>


<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Data User</h1>
			</div>
		</div>
	</div>
</section>

<section class="content">
	<?= $this->session->flashdata('psn'); ?>
	<div class="card">
		<div class="card-body row">
			<div class="col-sm-12">
				<table id="myTabel" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Prov/Kab/Kota</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Nomor Telepon</th>
							<th>Email</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($dataPengguna as $key => $val) { ?>
							<tr>
								<td><?= $val->kemendagri; ?></td>
								<td><?= $val->nama; ?></td>
								<td><?= $val->idpengguna; ?></td>
								<td class="text-right"><?= $val->telpon; ?></td>
								<td><?= $val->email; ?></td>
								<td class="text-center">
									<button class="btn btn-danger btn-sm" onclick="resetPassword('<?= $val->uid; ?>','<?= $val->idpengguna; ?>', '<?= $val->nama; ?>')">Reset Pasword</button>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modalReset" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Reset Password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url(); ?>DataUser/prs_reset" method="POST">
					<div class="form-group">
						<label for="pswBaru" class="col-form-label">Password Baru :</label>
						<input type="text" class="form-control" id="pswBaru" name="pswBaru" required>

						<input type="hidden" id="uid" name="uid">
						<input type="hidden" id="username" name="username">
						<input type="hidden" id="nama" name="nama">

					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>





<script type="text/javascript">
	$(document).ready(function() {

		resetPassword = function (uid, username, nama) {
			
			$('#uid').val(uid);			
			$('#username').val(username);
			$('#nama').val(nama);	
			
			$('#modalReset').modal('show');

		}


		let myTable = $('#myTabel').DataTable({

		});


	});
</script>
