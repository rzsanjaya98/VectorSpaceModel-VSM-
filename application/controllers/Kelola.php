<?php

class Kelola extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_kelola');
		$this->load->library('session');
		$this->load->library('Preprocessing');
		
		if($this->session->userdata('username') == ''){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Anda Belum Login!</strong>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
			redirect('admin/login');
		}
	}

	public function index(){
			$data['artikel'] = $this->m_kelola->tampil_data()->result();
			$this->load->view('templates_admin/header');
			$this->load->view('templates_admin/sidebar');
			$this->load->view('kelola/v_kelola', $data);
			$this->load->view('templates_admin/footer');
	}

	public function tambah_aksi(){

		$this->load->library('form_validation');
		$this->load->helper(array('form','url'));

		$judul 		= $this->input->post('judul');
		$abstrak 	= $this->input->post('abstrak');
		$tahun 		= $this->input->post('tahun');
		$berkas	 	= $this->input->post('berkas');
		
			$config['upload_path']		= './assets/dokumen';
			$config['allowed_types']	= 'pdf';
			$config['berkas']	= "upload";
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
		if(!$this->upload->do_upload('berkas')){
				echo "Upload Gagal"; die();
		}else{
			$file = $this->upload->data('file_name');
			$pdfparser = $this->parsepdf($file);
			$textpreprocessing = implode(" ", $this->preprocessing::preprocess($pdfparser));

			// $arrayDokumen = array('id' => '1', 'dokumen' => $textpreprocessing,);
        
			$indexing = json_encode($this->dokumen_term($textpreprocessing));

		// var_dump($abstrak);
		// var_dump($judul);
		// var_dump($file);
			$data = array(
			'judul'				=> $judul,
			'abstrak'			=> $abstrak,
			'tahun'				=> $tahun,
			'file'				=> $file,
			'pdftotext'			=> $pdfparser,
			'textpreprocessing'	=> $textpreprocessing,
			'indexing'			=> $indexing,
			);
		}

		$this->m_kelola->input_data($data, 'tb_artikel');
		redirect('kelola');
	}

	public function hapus($id){
		$where = array('id' => $id);
		$this->m_kelola->hapus_data($where, 'tb_artikel');
		redirect('kelola');
	}

	public function edit($id){
		$where = array('id' => $id);
		$data['artikel'] = $this->m_kelola->edit_data($where, 'tb_artikel')->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('kelola/v_edit', $data);
		$this->load->view('templates_admin/footer');
	}

	public function update(){
		$this->load->library('form_validation');
		$this->load->helper(array('form','url'));

		$id 		= $this->input->post('id');
		$judul 		= $this->input->post('judul');
		$abstrak	= $this->input->post('abstrak');
		$tahun 		= $this->input->post('tahun');
		$berkas	 	= $this->input->post('berkas');
		
			$config['upload_path']		= './assets/dokumen';
			$config['allowed_types']	= 'pdf';
			$config['berkas']	= "upload";
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
		if(!$this->upload->do_upload('berkas')){
				echo "Upload Gagal"; die();
		}else{
			$file = $this->upload->data('file_name');
			$pdfparser = $this->parsepdf($file);
			$textpreprocessing = implode(" ", $this->preprocessing::preprocess($pdfparser));
			$indexing = json_encode($this->dokumen_term($textpreprocessing));

		// var_dump($abstrak);
		// var_dump($judul);
		// var_dump($file);
			$data = array(
			'judul'				=> $judul,
			'abstrak'			=> $abstrak,
			'tahun'				=> $tahun,
			'file'				=> $file,
			'pdftotext'			=> $pdfparser,
			'textpreprocessing'	=> $textpreprocessing,
			'indexing'			=> $indexing,
			);
		}

		$where = array(
			'id' => $id
		);

		$this->m_kelola->update_data($where, $data, 'tb_artikel');
		redirect ('kelola');
	}

	public function detail($id){
		$this->load->model('m_kelola');
		$detail = $this->m_kelola->detail_data($id);
		$data['detail'] = $detail;
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('kelola/v_detail', $data);
		$this->load->view('templates_admin/footer');
	}

	public function cariart(){
		$keyword = $this->input->post('keyword');
		$data['artikel'] = $this->m_kelola->get_keyword($keyword);
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('kelola/v_kelola', $data);
		$this->load->view('templates_admin/footer');
	}

	public function parsepdf($file){
		$dokumen = $this->m_kelola->tampil_data()->result();
		$server_file = 'assets/dokumen/'.$file;
		// echo $server_file;
		
		// require 'third_party/vendor/autoload.php';
		// include APPPATH.'third_party/Smalot/PdfParser/Parser.php';
		// echo APPPATH.'third_party\Smalot\PdfParser\Parser.php';
		include APPPATH.'third_party\vendor\autoload.php';
		// echo APPPATH.'third_party/vendor/autoload.php';
 
		$parser = new \Smalot\PdfParser\Parser();
		$pdf    = $parser->parseFile($server_file);
		 
		$text = $pdf->getText();
		return $text;
		 
	}

	public function dokumen_term($dokumen)
    {
        $arrayTampung = [];
        // foreach ($dokumen as $key => $value) {
            // semua string jadi array | untuk mendapatkan term
            $string_array = explode(" ", $dokumen);
            // mendapatkan term
            $word       = str_word_count($dokumen, 1); // auto string to array
            $term       = array_count_values($word);
            // array_push($arrayTampung, [$term]);
        // }
        return $term;
    }

    public function term()
    {
    	$this->m_kelola->clearterm( );
    	$dokumen = $this->m_kelola->tampil_data()->result();
    	// $query = "ragam";

    	$arrayDokumen = [];
        foreach ($dokumen as $doc) {
            $arrayDoc = [
                "id_doc"    => $doc->id,
                "dokumen"   => $doc->textpreprocessing
            ];
            array_push($arrayDokumen, $arrayDoc);
        }

    	// query to string
        $query = implode(" ",  $query);

        // dokumen to array | remove nested array
        $arrayTampung = [];
        foreach ($arrayDokumen as $key => $value) {
            foreach ($value as $key1 => $value1) {
                if ($key1 == 'dokumen') {
                    array_push($arrayTampung, $value1);
                }
            }
        }

        // menggabungkan query ke term
        array_push($arrayTampung, $query);

        // semua value $arrayTampung jadi satu string
        $string_term = implode(" ", $arrayTampung);
        // semua string jadi array | untuk mendapatkan term
        $string_array = explode(" ", $string_term);

        // mendapatkan term
        $word       = str_word_count($string_term, 1); // auto string to array
        $term       = array_count_values($word);

        // echo json_encode($term);
        $data = array(
			'term'		=> json_encode($term),
			);

        $this->m_kelola->input_data($data, 'tb_term');
		redirect('kelola');
    }

    public function df()
    {
    	$this->m_kelola->cleardf( );
    	$term = $this->m_kelola->tampil_term();
        $term = json_decode($term[0]->term, true);

        $dokumen = $this->m_kelola->tampil_data()->result();
        $dokumen_term = [];
        foreach ($dokumen as $doc) {
            $arrayDok = [
                "id_doc"    => $doc->id,
                "dokumen"   => json_decode($doc->indexing, true)
            ];
            array_push($dokumen_term, $arrayDok);
        }

        // start from 0 | start dari nol
        $arrayDf = [];
        foreach ($term as $key => $value) {
            $arrayDf[$key] = 0;
        }

        // pengisian df dari dokumen
        foreach ($term as $key => $value) {
            foreach ($dokumen_term as $key1 => $value1) {
                foreach ($value1['dokumen'] as $key2 => $value2) {
                    if ($key == $key2) {
                        $arrayDf[$key] += 1;
                    }
                }
            }
        }

        // echo json_encode($arrayDf);
        $data = array(
			'df'		=> json_encode($arrayDf),
			);

        $this->m_kelola->input_data($data, 'tb_df');
		redirect('kelola');
    }

  //   public function idf()
  //   {
  //   	$arrayDf = $this->m_kelola->tampil_df();
  //       $arrayDf = json_decode($arrayDf[0]->df, true);

  //       // echo var_dump($arrayDf);
  //       $dokumen = $this->m_kelola->tampil_data()->result();
  //       $dokumen_term = [];
  //       foreach ($dokumen as $doc) {
  //           $arrayDok = [
  //               "id_doc"    => $doc->id,
  //               "dokumen"   => json_decode($doc->indexing, true)
  //           ];
  //           array_push($dokumen_term, $arrayDok);
  //       }

  //       // n = jumlah dokumen + query
  //       $N_count = count($dokumen_term);

  //       $arrayIdf =[];
  //       foreach ($arrayDf as $key => $value) {
  //           $arrayIdf[$key] = log10( $N_count / $value);
  //       }

  //       // echo json_encode($arrayIdf);
  //       $data = array(
		// 	'idf'		=> json_encode($arrayIdf),
		// 	);

  //       $this->m_kelola->input_data($data, 'tb_idf');
		// redirect('kelola');
  //   }

}