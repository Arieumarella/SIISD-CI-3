<style type="text/css">
	.profile-user-img {
		width: 30%;
		/* 50% of the parent container's width */
		height: auto;
		/* Maintain the aspect ratio */
	}
</style>

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Profile</h1>
			</div>
		</div>
	</div>
</section>

<section class="content">
	<?= $this->session->flashdata('psn'); ?>
	<div class="card">
		<div class="card-body row">
			<div class="col-5 text-center d-flex align-items-center justify-content-center">
				<div class="">
					<div class="text-center">
						<img class="profile-user-img img-fluid img-circle" src="<?= base_url(); ?>assets/admin/Ite/dist/img/<?= $this->session->userdata('gambar') == null ? 'user.png' : $this->session->userdata('gambar'); ?>" alt="User profile picture">
					</div>
					<button class="mt-2 btn btn-primary btn-sm" onclick="showUploadModal()">Ubah Foto</button>
					<h2 class="profile-username text-center" style="font-size:40px;"><?= $dataPengguna->nama; ?></h2>
					<p class="text-muted text-center"><?= $dataPengguna->idpengguna; ?></p>
				</div>
			</div>

			<div class="col-7">
				<form action="<?= base_url(); ?>Profile/simpnProfil" method="POST">
					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" id="nama" name="nama" class="form-control" value="<?= $dataPengguna->nama; ?>" required>
					</div>
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" id="username" name="username" class="form-control" value="<?= $dataPengguna->idpengguna; ?>" required>
					</div>
					<div class="form-group">
						<label for="tlp">Nomor Telepon</label>
						<input type="text" id="tlp" name="tlp" class="form-control" value="<?= $dataPengguna->telpon; ?>" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" id="email" name="email" class="form-control" value="<?= $dataPengguna->email; ?>" required>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Simpan">
						<?php if ($this->session->userdata('prive') == 'admin') { ?>
							<input type="button" class="btn btn-danger" value="Reset Password" onclick="showModalRiset()">
						<?php } ?>
					</div>
				</form>
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
				<form action="<?= base_url(); ?>Profile/prs_reset" method="POST">
					<div class="form-group">
						<label for="pswBaru" class="col-form-label">Password Baru :</label>
						<input type="text" class="form-control" id="pswBaru" name="pswBaru" required>
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


<div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Ganti Foto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url(); ?>Profile/uploadGambar" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="fileUpload" class="col-form-label">Foto :</label>
						<input type="file" id="fileUpload" name="fileUpload" accept="image/*" required><br>
						<small>Maximal 5 MB.!</small>
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



		showUploadModal = function() {

			$('#modalUpload').modal('show');

		}

		showModalRiset = function() {

			$('#modalReset').modal('show');

		}


	});
</script>