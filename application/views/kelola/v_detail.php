<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<div class="content-wrapper">
	<section class="content">
		<div class="text-center">
            <h4><strong>DETAIL DATA ARTIKEL</strong></h4>
       	</div>
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
	</section>
</div>