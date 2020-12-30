<?php

class Cari extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_cari');
		$this->load->model('m_kelola');
		$this->load->library('session');
		$this->load->library('Preprocessing');
		$this->load->library('VSM');
	}
	
	// public function index(){
 //        $this->load->view('templates/header');
 //        $this->load->view('templates/sidebar');
 //        $this->load->view('pencari/v_cari');
 //        // $this->load->view('templates/footer');
 //    }
    public function index(){
		$this->load->view('templates/header');
		// $this->load->view('templates/sidebar');
		$this->load->view('pencari/v_cari');
		$this->load->view('templates/footer');
	}

	public function searchquery()
    {
        $start = microtime(TRUE);
        $cari = $this->input->post('keyword');
        
        // STEP 1 == PREPROCESSING
        $query = $this->preprocessing::preprocess($cari);
        
        // STEP 2 == GET DATA & MAKE TO ARRAY
        $dokumen = $this->m_kelola->tampil_data()->result(); // return object

        //GET Term dari database
        $term = $this->m_kelola->tampil_term();
        $term = json_decode($term[0]->term, true);

        //GET df dari database
        $df = $this->m_kelola->tampil_df();
        $df = json_decode($df[0]->df, true);

        $arrayDokumen = [];
        $arrayIndexing = [];
        foreach ($dokumen as $doc) {
            $arrayDoc = [
                "id_doc"    => $doc->id,
                "dokumen"   => $doc->textpreprocessing
            ];
            $arrayDok = [
                "id_doc"    => $doc->id,
                "dokumen"   => json_decode($doc->indexing, true)
            ];
            array_push($arrayDokumen , $arrayDoc);
            array_push($arrayIndexing, $arrayDok);
        }

        // STEP 3 == VSM 
        $rank_tmp = $this->vsm->get_rank($query, $arrayDokumen, $arrayIndexing, $term, $df, $idf);
        $rank=$rank_tmp[0];
        
        // echo json_encode($rank_tmp);
        foreach ($rank as $param => $row) {
			$id_doc[$param] = $row['id_doc'];
			$ranking[$param] = $row['ranking'];
		}
		array_multisort($ranking, SORT_DESC, $rank);
        $data['data_artikel'] = $this->m_kelola->tampil_data()->result();
		// echo var_dump(json_decode($dokumen[0]->indexing, true));

        $data = [];
        for ($i=0; $i <count($rank) ; $i++) { 
        	if($rank[$i]['ranking']>0){
        		$data[$i] = $this->m_kelola->detail_data($rank[$i]['id_doc']);
        		$nilai[$i] = $rank[$i]['ranking'];
        		$hasil[$i] = [$data[$i], "ranking" => $rank[$i]['ranking']];
        	}
        }
        
        $finish = microtime(TRUE);
        $waktu = $finish - $start;

        $hasil['data_artikel'] = $hasil;
        $hasil['waktu'] = $waktu;
        $hasil['waktuvsm'] = [$rank_tmp[1],$rank_tmp[2],$rank_tmp[3],$rank_tmp[4],$rank_tmp[5]];

        $hasil['total_rows'] = count($hasil['data_artikel']);
        
        $this->load->view('templates/header');
		// $this->load->view('templates/sidebar');
		$this->load->view('pencari/v_hasilcari', $hasil);
		// $this->load->view('pencari/v_cari');
		// $this->load->view('templates/footer');
    }

    public function detail($id){
		$this->load->model('m_kelola');
		$detail = $this->m_kelola->detail_data($id);
		$data['detail'] = $detail;
		$this->load->view('templates/header');
		// $this->load->view('templates/sidebar');
		$this->load->view('pencari/v_detail', $data);
		$this->load->view('templates/footer');
	}

    public function hasilhitung($id){
        $this->load->model('m_kelola');
        $detail = $this->m_kelola->detail_data($id);
        $data['detail'] = $detail;
        $this->load->view('templates/header');
        // $this->load->view('templates/sidebar');
        $this->load->view('pencari/v_hasilhitung', $data);
        $this->load->view('templates/footer');
    }

}