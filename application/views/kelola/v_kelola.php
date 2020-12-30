<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">KELOLA ARTIKEL</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <section class="content">
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Artikel</button>
            <a href="<?php echo base_url('kelola/term'); ?>" class="btn btn-outline-info">Term</a>
            <a href="<?php echo base_url('kelola/df'); ?>" class="btn btn-outline-secondary">df</a>
            <div class="row mb-1 float-sm-right">
            <div class="col-sm-12">
              <div class="navbar-form navbar-right form-group row">
                <?php echo form_open('kelola/cariart') ?>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Search..." name="keyword">
                  <div class="input-group-append">
                    <input class="btn btn-primary" type="submit" name="submit">
                  </div>
                </div>
                <?php echo form_close() ?>
              </div>
            </div>
            </div>
            
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th colspan="2">Aksi</th>
                </tr>
                <?php
                    $no = 1;
                    foreach ($artikel as $art):
                    ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $art->judul ?></td>
                    <td><?php echo anchor('kelola/detail/'.$art->id, '<div class="btn btn-success btn-sm"><i class="fa fa-search-plus"></i></div>'); ?></td>
                    <td onclick="javascript: return confirm('Anda yakin hapus?')"><?php echo anchor('kelola/hapus/'.$art->id, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>') ?></td>
                    <td><?php echo anchor('kelola/edit/'.$art->id, '<div class="btn btn-warning btn-sm"><i class="fa fa-edit">') ?></i></div></td>
                </tr>
                <?php
                    endforeach;
                ?>
            </table>
        </section>
      </div><!-- /.container-fluid -->
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Form Tambah Artikel</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"> -->
         <!-- <?php echo form_open_multipart('kelola/tambah_aksi'); ?>  -->
         <form action="<?php echo base_url('kelola/tambah_aksi') ?>" method="POST" enctype="multipart/form-data">
        	<div class="form-group">
        		<label>Judul</label>
        		<input type="text" name="judul" class="form-control">
        	</div>
        	<div class="form-group">
        		<label>Abstrak</label>
            <textarea name="abstrak" class="form-control"></textarea>
        	</div>
          <div class="form-group">
            <label>Tahun</label>
            <input type="text" name="tahun" class="form-control">
          </div>
        	<div class="form-group">
        		<label>Upload File</label>
        		<input type="file" name="berkas" id="berkas" class="form-control">
        	</div>

        	<button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
        	<button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>