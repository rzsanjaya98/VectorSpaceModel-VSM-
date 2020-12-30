<div class="container-fluid">
  <center>
    <img src="assets/img/kertas.png" style="margin-top: 130px; width: 100px; margin-bottom: 30px;">
  </center>
  <section class="content">
    <center>
    <div class="navbar-form navbar-right">
      <?php echo form_open('cari/searchquery') ?>

        <input type="text" name="keyword" class="form-control" placeholder="Search" autocomplete="off">
        <input type="submit" name="search_submit" class="btn btn-success" value="Cari">

      <?php echo form_close() ?>

    </div>
      
    </center>
  </section>
</div>
