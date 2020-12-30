<div class="container-fluid">
  <br>
  <div class="float-right" >
    <a href="<?php echo base_url('admin/login') ?>" class="btn btn-light" >
      <b>Login</b>      
    </a>
  </div>
  <center>
    <img src="assets/img/logo.png" style="margin-top: 30px; width: 30%">
  </center>
  <div class="row" >
        <div class="col" >     
        </div>
        <div class="col text-center " >
          <h3>Sistem Temu Kembali Informasi</h3>
        </div>
        <div class="col" >
        </div>
  </div>
  <br>
  <section class="content">
    <div class="row" >
        <div class="col" >
        </div>
        <div class="col" >
            <?php echo form_open('cari/searchquery') ?>
              <div class="input-group">
                <input type="text" class="form-control" name="keyword" placeholder="ex: Ragam Budaya Papua" autocomplete="off">
                <div class="input-group-prepend">
                  <button type="submit" name="search_submit" class="btn btn-primary" value="Cari">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            <?php echo form_close() ?>
        </div>
        <div class="col" >
        </div>
    </div>
  </section>
</div>
