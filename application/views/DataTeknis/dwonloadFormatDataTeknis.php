<style type="text/css">
	.fontLabel {
		font-size: 18px;
	}
</style>
<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body align-self-center">
						<?= $this->session->flashdata('psn'); ?>
						<div class="row">
							<h3 class="font-weight-bolder">FORM DOWNLOAD FORMAT DATA TEKNIS TA. <?= $this->session->userdata('thang'); ?></h3>
						</div>
						<div class="form-group text-center row p-2 mt-4">
							<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left">1. File Data Teknis</label>
							<div class="col-sm-2 text-center">
								<a href="<?= base_url(); ?>DataTeknis/downloadFile/1" class="btn btn-primary">Download</a>
							</div>
						</div>
						<div class="form-group  row p-2">
							<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left">2. File Data Teknis fsdgdf dsfsd</label>
							<div class="col-sm-2 text-center">
								<a href="<?= base_url(); ?>DataTeknis/downloadFile/2" class="btn btn-primary">Download</a>
							</div>
						</div>
						<div class="form-group text-center row p-2">
							<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left">3. File Data Teknis sdgfsd sdfsd</label>
							<div class="col-sm-2 text-center">
								<a href="<?= base_url(); ?>DataTeknis/downloadFile/3" class="btn btn-primary">Download</a>
							</div>
						</div>
						<div class="form-group text-center row p-2">
							<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left">4. File Data Teknis sdgfsdv zxc</label>
							<div class="col-sm-2 text-center">
								<a href="<?= base_url(); ?>DataTeknis/downloadFile/4" class="btn btn-primary">Download</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function() {


	})
</script>