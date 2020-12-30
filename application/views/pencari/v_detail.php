<link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  
<div class="content-wrapper">
	<br>
	<section class="content">
		<div id="content-wrapper" class="col-md-12">
    		<div id="content">
          		<div class="text-center">
            		<h4><strong>DETAIL DATA ARTIKEL</strong></h4>
          		</div>
    		</div>
  		</div>

		<br>
		<div class="col-md-12">
			<table class="table">
				<tr>
					<th>Judul</th>
					<td><?php echo $detail->judul ?></td>
				</tr>
				<tr>
					<th>Abstrak</th>
					<td><?php echo $detail->abstrak ?></td>
				</tr>
				<tr>
					<th>Isi</th>
					<td><embed width="1000" height="600" src="<?php echo base_url('assets/dokumen/'.$detail->file); ?>" type="application/pdf"></embed></td>
				</tr>
				<!-- <tr>
					<?php if($detail->file != 0) { ?>
						<a href="<?php echo base_url('assets/dokumen/'.$detail->file); ?>">PDF</a>
					<?php } ?>
				</tr> -->
			</table>
		<!-- <a href="<?php echo base_url('cari'); ?>" class="btn btn-primary">Kembali</a> -->
		</div>
	</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>