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
            		<h4><strong>HASIL PERHITUNGAN</strong></h4>
          		</div>
    		</div>
  		</div>

		<br>
		<div>
			<table class="table">
				<tr>
					<th>PDFtoText</th>
					<td><?php echo $detail->pdftotext ?></td>
				</tr>
				<tr>
					<th>Text Preprocessing</th>
					<td><?php echo $detail->textpreprocessing ?></td>
				</tr>
				<tr>
					<th>Indexing</th>
					<td><?php echo $detail->indexing ?></td>
				</tr>
			</table>
		</div>
	</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>