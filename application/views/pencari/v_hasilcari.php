<link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!-- Custom styles for this template-->
<link href="<?php echo base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">



</style>
<div class="container">
  <div id="content-wrapper" class="d-flex flex-column col-lg-12 col-md-12">
    <div id="content">
      <a href="<?php echo base_url('cari'); ?>"><img src="../assets/img/logo.png" style="margin-top: 30px; width: 10%"></a>
      <div class="text-center">
        <h2>HASIL PENCARIAN</h2>
      </div>
    </div>
  </div>
  <br>
  <h5>Results : <?php echo $total_rows; ?></h5>
  <div class="row">
      <div class="col-md-9" id='result'>
        <?php
          if($data_artikel != NULL){
            $x = 1;
            foreach ($data_artikel as $art):
        ?>
        <br>
          <p><?php echo $x++.'. '.$art[0]->judul.' ('.$art[0]->tahun.')' ?></p>
          <p><?php 
            $cut_text = substr($art[0]->abstrak, 0, 250);
            if ($art[0]->abstrak[250 - 1] != ' ') {
              $new_pos = strrpos($cut_text, ' '); // cari posisi spasi, pencarian dari huruf terakhir
              $cut_text = substr($art[0]->abstrak, 0, $new_pos);
            }echo $cut_text . ' ... '; ?><a href="<?php echo base_url('cari/detail/'.$art[0]->id); ?>" class="btn btn-outline-dark btn-sm" target="_blank">Detail</a><a href="<?php echo base_url('cari/hasilhitung/'.$art[0]->id); ?>" class="btn btn-outline-dark btn-sm" target="_blank">Text Processing</a></p>
            <p><?php
                $art['ranking'];
                $ranking_format = number_format($art['ranking'],2,",",".");
                echo "Nilai Cosine Similarity : ".$ranking_format; ?></p>
        </br>
        <?php        
          endforeach;
        }else{
        ?>
        <br>
          <center><?php  echo "Data tidak ditemukan"; ?></center>
        </br>
      <?php } ?>

      <p><?php echo "Perhitungan selesai dalam ".$waktu." detik    "; ?></p>
<!--       <p><?php foreach ($waktuvsm as $art):
      echo "Waktu VSM Selesai dalam ".$art." detik    ";
      endforeach; ?></p> -->
    </div>
  </div>
</div>
        
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>