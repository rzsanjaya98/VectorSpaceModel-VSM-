<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<div class="content-wrapper">
	<section class="content">
		<?php foreach($artikel as $art) {
			echo form_open_multipart('kelola/update'); ?>
			<div class="form-group">
				<label>Judul</label>
				<input type="hidden" name="id" class="form-control" value="<?php echo $art->id ?>">
				<input type="text" name="judul" class="form-control" value="<?php echo $art->judul ?>">
			</div>

			<div class="form-group">
				<label>Abstrak</label>
				<textarea name="abstrak" class="form-control" value="<?php echo $art->abstrak ?>"></textarea>
			</div>

			<div class="form-group">
				<label>Tahun</label>
				<input type="text" name="tahun" class="form-control" value="<?php echo $art->tahun ?>">
			</div>

			<div class="form-group">
        		<label>Upload File</label>
        		<input type="file" name="berkas" class="form-control" value="<?php echo $art->file ?>">
        	</div>

			<button type="reset" class="btn btn-danger">Reset</button>
			<button type="submit" class="btn btn-primary">Simpan</button>
		
		<?php } echo form_close(); ?>
	</section>
</div>