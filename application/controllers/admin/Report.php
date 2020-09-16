<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    public function pemeriksaan()
	{
		$data['parent'] = 'pemeriksaan';
		$data['child'] = 'pemeriksaan';
		$data['grand_child'] = '';
		$data['breadcrumbs1'] = 'Pemeriksaan';
		$data['breadcrumbs2'] = '';
        $data['breadcrumbs3'] = '';
        $data['fisioterapi'] = $this->Main_model->getSelectedData('fisioterapi a', 'a.*', array('a.company_id'=>$this->session->userdata('company_id'),'a.deleted'=>'0'))->result();
        $data['pasien'] = $this->Main_model->getSelectedData('pasien a', 'a.*', array('a.company_id'=>$this->session->userdata('company_id'),'a.deleted'=>'0'))->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/report/pemeriksaan',$data);
		$this->load->view('admin/template/footer');
	}
	public function simpan_pemeriksaan()
	{
		$this->db->trans_start();
		$get_data_fisioterapi = $this->Main_model->getSelectedData('fisioterapi a', 'a.*', array('a.user_id'=>$this->input->post('fisioterapi')))->row();
		$get_data_pasien = $this->Main_model->getSelectedData('pasien a', 'a.*', array('a.id_pasien'=>$this->input->post('pasien')))->row();

		$get_last_id = $this->Main_model->getLastID('pemeriksaan','id_pemeriksaan');
		$new_id = $get_last_id['id_pemeriksaan']+1;

		$data_insert1 = array(
			'id_pemeriksaan' => $new_id,
			'user_id' => $this->input->post('fisioterapi'),
			'id_pasien' => $this->input->post('pasien'),
			'enviromental_factors' => $this->input->post('enviromental_factors'),
			'personal_factors' => $this->input->post('personal_factors'),
			'catatan' => $this->input->post('catatan'),
			'created_by' => $this->session->userdata('id'),
			'created_at' => date('Y-m-d H:i:s'),
			'company_id'=>$this->session->userdata('company_id')
		);
		$this->Main_model->insertData('pemeriksaan',$data_insert1);
		// print_r($data_insert1);

		for ($i=0; $i < count($this->input->post('body_function_and_body_structure')); $i++) { 
			$data_insert2 = array(
				'id_pemeriksaan' => $new_id,
				'body_function_and_body_structure' => $this->input->post('body_function_and_body_structure')[$i]
			);
			$this->Main_model->insertData('detail_pemeriksaan_1',$data_insert2);
			// print_r($data_insert2);
		}

		for ($i=0; $i < count($this->input->post('activities')); $i++) { 
			$data_insert3 = array(
				'id_pemeriksaan' => $new_id,
				'activities' => $this->input->post('activities')[$i]
			);
			$this->Main_model->insertData('detail_pemeriksaan_2',$data_insert3);
			// print_r($data_insert3);
		}

		for ($i=0; $i < count($this->input->post('participation_restriction')); $i++) { 
			$data_insert4 = array(
				'id_pemeriksaan' => $new_id,
				'participation_restriction' => $this->input->post('participation_restriction')[$i]
			);
			$this->Main_model->insertData('detail_pemeriksaan_3',$data_insert4);
			// print_r($data_insert4);
		}

		for ($i=0; $i < count($this->input->post('diagnosa')); $i++) { 
			$data_insert5 = array(
				'id_pemeriksaan' => $new_id,
				'diagnosa' => $this->input->post('diagnosa')[$i]
			);
			$this->Main_model->insertData('detail_pemeriksaan_4',$data_insert5);
			// print_r($data_insert5);
		}

		$count = count($_FILES['files']['name']);
    
		for($i=0;$i<$count;$i++){
			if($i>3){
				echo'';
			}else{
				if(!empty($_FILES['files']['name'][$i])){
			
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];
			
					$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/dokumentasi_pemeriksaan/';
					$config['allowed_types'] = 'jpg|jpeg|png|bmp';
					$config['max_size'] = '3072';
					$config['file_name'] = "file_".time().$i;
			
					$this->upload->initialize($config); 
			
					if($this->upload->do_upload('file')){
						$uploadData = $this->upload->data();
						$data_insert_file = array(
							'id_pemeriksaan' => $new_id,
							'nama_file' => $uploadData['file_name']
						);
						$this->Main_model->insertData("dokumentasi_pemeriksaan",$data_insert_file);
					}
				}
			}
	
		}

		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',$get_data_fisioterapi->nama." melakukan pemeriksaan terhadap ".$get_data_pasien->nama,$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon2-cancel-music"></i></div><div class="alert-text"><strong>Oops!!!</strong> Data gagal ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/pemeriksaan/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-check-mark"></i></div><div class="alert-text"><strong>Yeah!!!</strong> Data sukses ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_pemeriksaan/".md5($new_id)."'</script>";
		}
    }
    public function hasil_pemeriksaan()
	{
		$data['parent'] = 'pemeriksaan';
		$data['child'] = 'hasil_pemeriksaan';
		$data['grand_child'] = '';
		$data['breadcrumbs1'] = 'Pemeriksaan';
		$data['breadcrumbs2'] = 'Hasil Data';
		$data['breadcrumbs3'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/report/hasil_pemeriksaan',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_data_pemeriksaan()
	{
		$get_data = $this->Main_model->getSelectedData('pemeriksaan a', 'a.*,b.nama AS fisioterapi,c.nomor_pasien,c.nama AS pasien', array('a.company_id'=>$this->session->userdata('company_id')), '', '', '', '', array(
			array(
				'table' => 'fisioterapi b',
				'on' => 'a.user_id=b.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'pasien c',
				'on' => 'a.id_pasien=c.id_pasien',
				'pos' => 'LEFT'
			)
		))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['fisioterapi'] = $value->fisioterapi;
			$isi['nomor_pasien'] = $value->nomor_pasien;
			$isi['pasien'] = $value->pasien;
			$isi['waktu'] = $this->Main_model->convert_datetime($value->created_at);
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['aksi'] =	'
			<div class="kt-section__content">
				<div class="dropdown dropdown-inline">
					<button type="button" class="btn btn-brand btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="flaticon-more-1"></i>
					</button>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="'.site_url('admin_side/detail_pemeriksaan/'.md5($value->id_pemeriksaan)).'"><i class="la la-share"></i> Detil Data </a>
						<a class="dropdown-item" href="'.site_url('admin_side/ubah_pemeriksaan/'.md5($value->id_pemeriksaan)).'"><i class="la la-pencil"></i> Ubah Data </a>
						<a class="dropdown-item" onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_pemeriksaan/'.md5($value->id_pemeriksaan)).'" onclick="'.$return_on_click.'"><i class="la la-trash"></i> Hapus Data </a>
					</div>
				</div>
			</div>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function detail_pemeriksaan()
	{
		$data['parent'] = 'pemeriksaan';
		$data['child'] = 'hasil_pemeriksaan';
		$data['grand_child'] = '';
		$data['breadcrumbs1'] = 'Pemeriksaan';
		$data['breadcrumbs2'] = 'Detail Data';
		$data['breadcrumbs3'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('pemeriksaan a', 'a.*,b.nama AS fisioterapi,b.alamat AS alamat_fisioterapi,b.no_hp AS nomor_hp_fisioterapi,c.nomor_pasien,c.nama AS pasien,c.jenis_kelamin,c.alamat AS alamat_pasien,c.no_hp AS nomor_hp_pasien,c.tanggal_lahir,c.nama_wali,(SELECT COUNT(z.id_pemeriksaan) FROM pemeriksaan z WHERE z.id_pasien=a.id_pasien) AS jumlah_periksa', array('md5(a.id_pemeriksaan)'=>$this->uri->segment(3)), '', '', '', '', array(
			array(
				'table' => 'fisioterapi b',
				'on' => 'a.user_id=b.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'pasien c',
				'on' => 'a.id_pasien=c.id_pasien',
				'pos' => 'LEFT'
			)
		))->row();
		$data['body_function_and_body_structure'] = $this->Main_model->getSelectedData('detail_pemeriksaan_1 a', 'a.*', array('md5(a.id_pemeriksaan)'=>$this->uri->segment(3)))->result();
		$data['activities'] = $this->Main_model->getSelectedData('detail_pemeriksaan_2 a', 'a.*', array('md5(a.id_pemeriksaan)'=>$this->uri->segment(3)))->result();
		$data['participation_restriction'] = $this->Main_model->getSelectedData('detail_pemeriksaan_3 a', 'a.*', array('md5(a.id_pemeriksaan)'=>$this->uri->segment(3)))->result();
		$data['diagnosa'] = $this->Main_model->getSelectedData('detail_pemeriksaan_4 a', 'a.*', array('md5(a.id_pemeriksaan)'=>$this->uri->segment(3)))->result();
		$data['dokumentasi'] = $this->Main_model->getSelectedData('dokumentasi_pemeriksaan a', 'a.*', array('md5(a.id_pemeriksaan)'=>$this->uri->segment(3)))->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/report/detail_pemeriksaan',$data);
		$this->load->view('admin/template/footer');
	}
	public function ubah_pemeriksaan()
	{
		$data['parent'] = 'pemeriksaan';
		$data['child'] = 'hasil_pemeriksaan';
		$data['grand_child'] = '';
		$data['breadcrumbs1'] = 'Pemeriksaan';
		$data['breadcrumbs2'] = 'Ubah Data';
		$data['breadcrumbs3'] = '';
		// $data['fisioterapi'] = $this->Main_model->getSelectedData('fisioterapi a', 'a.*', array('a.deleted'=>'0'))->result();
        // $data['pasien'] = $this->Main_model->getSelectedData('pasien a', 'a.*', array('a.deleted'=>'0'))->result();
		$data['data_utama'] = $this->Main_model->getSelectedData('pemeriksaan a', 'a.*,b.nama AS fisioterapi,b.alamat AS alamat_fisioterapi,b.no_hp AS nomor_hp_fisioterapi,c.nomor_pasien,c.nama AS pasien,c.jenis_kelamin,c.alamat AS alamat_pasien,c.no_hp AS nomor_hp_pasien,c.tanggal_lahir,c.nama_wali,(SELECT COUNT(z.id_pemeriksaan) FROM pemeriksaan z WHERE z.id_pasien=a.id_pasien) AS jumlah_periksa', array('md5(a.id_pemeriksaan)'=>$this->uri->segment(3)), '', '', '', '', array(
			array(
				'table' => 'fisioterapi b',
				'on' => 'a.user_id=b.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'pasien c',
				'on' => 'a.id_pasien=c.id_pasien',
				'pos' => 'LEFT'
			)
		))->row();
		$data['body_function_and_body_structure'] = $this->Main_model->getSelectedData('detail_pemeriksaan_1 a', 'a.*', array('md5(a.id_pemeriksaan)'=>$this->uri->segment(3)))->result();
		$data['activities'] = $this->Main_model->getSelectedData('detail_pemeriksaan_2 a', 'a.*', array('md5(a.id_pemeriksaan)'=>$this->uri->segment(3)))->result();
		$data['participation_restriction'] = $this->Main_model->getSelectedData('detail_pemeriksaan_3 a', 'a.*', array('md5(a.id_pemeriksaan)'=>$this->uri->segment(3)))->result();
		$data['diagnosa'] = $this->Main_model->getSelectedData('detail_pemeriksaan_4 a', 'a.*', array('md5(a.id_pemeriksaan)'=>$this->uri->segment(3)))->result();
		$data['dokumentasi'] = $this->Main_model->getSelectedData('dokumentasi_pemeriksaan a', 'a.*', array('md5(a.id_pemeriksaan)'=>$this->uri->segment(3)))->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/report/ubah_pemeriksaan',$data);
		$this->load->view('admin/template/footer');
	}
	public function perbarui_data_pemeriksaan()
	{
		$this->db->trans_start();
		$data_utama = $this->Main_model->getSelectedData('pemeriksaan a', 'a.*,b.nama AS fisioterapi,b.alamat AS alamat_fisioterapi,b.no_hp AS nomor_hp_fisioterapi,c.nomor_pasien,c.nama AS pasien,c.jenis_kelamin,c.alamat AS alamat_pasien,c.no_hp AS nomor_hp_pasien,c.tanggal_lahir,c.nama_wali,(SELECT COUNT(z.id_pemeriksaan) FROM pemeriksaan z WHERE z.id_pasien=a.id_pasien) AS jumlah_periksa', array('md5(a.id_pemeriksaan)'=>$this->input->post('id_pemeriksaan')), '', '', '', '', array(
			array(
				'table' => 'fisioterapi b',
				'on' => 'a.user_id=b.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'pasien c',
				'on' => 'a.id_pasien=c.id_pasien',
				'pos' => 'LEFT'
			)
		))->row();
		$dokumentasi = $this->Main_model->getSelectedData('dokumentasi_pemeriksaan a', 'a.*', array('md5(a.id_pemeriksaan)'=>$this->input->post('id_pemeriksaan')))->result();
		$this->Main_model->deleteData('detail_pemeriksaan_1',array('id_pemeriksaan'=>$data_utama->id_pemeriksaan));
		$this->Main_model->deleteData('detail_pemeriksaan_2',array('id_pemeriksaan'=>$data_utama->id_pemeriksaan));
		$this->Main_model->deleteData('detail_pemeriksaan_3',array('id_pemeriksaan'=>$data_utama->id_pemeriksaan));
		$this->Main_model->deleteData('detail_pemeriksaan_4',array('id_pemeriksaan'=>$data_utama->id_pemeriksaan));

		$data_insert1 = array(
			'enviromental_factors' => $this->input->post('enviromental_factors'),
			'personal_factors' => $this->input->post('personal_factors'),
			'catatan' => $this->input->post('catatan')
		);
		$this->Main_model->updateData('pemeriksaan',$data_insert1,array('md5(id_pemeriksaan)'=>$this->input->post('id_pemeriksaan')));
		// print_r($data_insert1);

		for ($i=0; $i < count($this->input->post('body_function_and_body_structure')); $i++) { 
			$data_insert2 = array(
				'id_pemeriksaan' => $data_utama->id_pemeriksaan,
				'body_function_and_body_structure' => $this->input->post('body_function_and_body_structure')[$i]
			);
			$this->Main_model->insertData('detail_pemeriksaan_1',$data_insert2);
			// print_r($data_insert2);
		}

		for ($i=0; $i < count($this->input->post('activities')); $i++) { 
			$data_insert3 = array(
				'id_pemeriksaan' => $data_utama->id_pemeriksaan,
				'activities' => $this->input->post('activities')[$i]
			);
			$this->Main_model->insertData('detail_pemeriksaan_2',$data_insert3);
			// print_r($data_insert3);
		}

		for ($i=0; $i < count($this->input->post('participation_restriction')); $i++) { 
			$data_insert4 = array(
				'id_pemeriksaan' => $data_utama->id_pemeriksaan,
				'participation_restriction' => $this->input->post('participation_restriction')[$i]
			);
			$this->Main_model->insertData('detail_pemeriksaan_3',$data_insert4);
			// print_r($data_insert4);
		}

		for ($i=0; $i < count($this->input->post('diagnosa')); $i++) { 
			$data_insert5 = array(
				'id_pemeriksaan' => $data_utama->id_pemeriksaan,
				'diagnosa' => $this->input->post('diagnosa')[$i]
			);
			$this->Main_model->insertData('detail_pemeriksaan_4',$data_insert5);
			// print_r($data_insert5);
		}

		if(count($dokumentasi)>3){
			echo'';
		}else{
			$batas = 3 - (count($dokumentasi));
			$count = count($_FILES['files']['name']);
		
			for($i=0;$i<$count;$i++){
				if($i>$batas){
					echo'';
				}else{
					if(!empty($_FILES['files']['name'][$i])){
				
						$_FILES['file']['name'] = $_FILES['files']['name'][$i];
						$_FILES['file']['type'] = $_FILES['files']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['files']['error'][$i];
						$_FILES['file']['size'] = $_FILES['files']['size'][$i];
				
						$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/dokumentasi_pemeriksaan/';
						$config['allowed_types'] = 'jpg|jpeg|png|bmp';
						$config['max_size'] = '3072';
						$config['file_name'] = "file_".time().$i;
				
						$this->upload->initialize($config); 
				
						if($this->upload->do_upload('file')){
							$uploadData = $this->upload->data();
							$data_insert_file = array(
								'id_pemeriksaan' => $data_utama->id_pemeriksaan,
								'nama_file' => $uploadData['file_name']
							);
							$this->Main_model->insertData("dokumentasi_pemeriksaan",$data_insert_file);
						}
					}
				}
			}
		}

		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Mengubah data pemeriksaan",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon2-cancel-music"></i></div><div class="alert-text"><strong>Oops!!!</strong> Data gagal ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/ubah_pemeriksaan/".$this->input->post('id_pemeriksaan')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-check-mark"></i></div><div class="alert-text"><strong>Yeah!!!</strong> Data sukses ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_pemeriksaan/".$this->input->post('id_pemeriksaan')."'</script>";
		}
    }
    public function rekap_pemeriksaan()
	{
		$data['parent'] = 'pemeriksaan';
		$data['child'] = 'rekap_pemeriksaan';
		$data['grand_child'] = '';
		$data['breadcrumbs1'] = 'Pemeriksaan';
		$data['breadcrumbs2'] = 'Rekap Data';
		$data['breadcrumbs3'] = '';
		if($this->input->post('jenis_data')==NULL){
			$data['jenis_data'] = '';
		}else{
			$data['jenis_data'] = $this->input->post('jenis_data');
		}
		if($this->input->post('tampilan_data')==NULL){
			$data['tampilan_data'] = '';
		}else{
			$data['tampilan_data'] = $this->input->post('tampilan_data');
		}
		if($this->input->post('tanggal')==NULL){
			$data['tanggal'] = '';
		}else{
			$data['tanggal'] = $this->input->post('tanggal');
		}
		if($this->input->post('jenis_data')!=NULL AND $this->input->post('tampilan_data')!=NULL AND $this->input->post('tanggal')!=NULL){
			$data['ajax'] = 'open';
			$pecah_tanggal = explode(' / ',$this->input->post('tanggal'));
			$up_date = date('Y-m-d', strtotime('+1 day', strtotime($pecah_tanggal[1])));
			$data['tanggal_depan'] = $pecah_tanggal[0];
			$data['tanggal_belakang'] = $up_date;
			$data['periode'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' - '.$this->Main_model->convert_tanggal($pecah_tanggal[1]);
			$data['data_fisioterapi'] = $this->Main_model->getSelectedData('fisioterapi b', "b.*,(SELECT COUNT(a.id_pemeriksaan) FROM pemeriksaan a WHERE a.user_id=b.user_id AND a.created_at BETWEEN '".$pecah_tanggal[0]."' AND '".$up_date."') jml", array('b.deleted' => '0','b.company_id'=>$this->session->userdata('company_id')), 'jml DESC')->result();
			$data['data_pasien'] = $this->Main_model->getSelectedData('pasien b', "b.*,(SELECT COUNT(a.id_pemeriksaan) FROM pemeriksaan a WHERE a.id_pasien=b.id_pasien AND a.created_at BETWEEN '".$pecah_tanggal[0]."' AND '".$up_date."') jml", array('b.deleted' => '0','b.company_id'=>$this->session->userdata('company_id')), 'jml DESC')->result();
			// $get_data = $this->db->query("SELECT COUNT(a.id_pemeriksaan) FROM pemeriksaan a WHERE a.created_at BETWEEN '".$pecah_tanggal[0]."' AND '".$up_date."'")->result();
		}else{
			$data['ajax'] = 'close';
		}
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/report/rekap_pemeriksaan',$data);
		$this->load->view('admin/template/footer');
	}
	public function hapus_foto_pemeriksaan()
	{
		$this->db->trans_start();
		$id = '';
		$get_data = $this->Main_model->getSelectedData('dokumentasi_pemeriksaan a', 'a.*', array('md5(a.id_dokumentasi)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_pemeriksaan;

		$this->Main_model->deleteData('dokumentasi_pemeriksaan',array('id_dokumentasi'=>$get_data->id_dokumentasi));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus dokumentasi pemeriksaan",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon2-cancel-music"></i></div><div class="alert-text"><strong>Oops!!!</strong> Data gagal dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/ubah_pemeriksaan/".md5($id)."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-check-mark"></i></div><div class="alert-text"><strong>Yeah!!!</strong> Data sukses dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/ubah_pemeriksaan/".md5($id)."'</script>";
		}
	}
	public function hapus_data_pemeriksaan()
	{
		$this->db->trans_start();
		$id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('pemeriksaan a', 'a.*,b.nama AS fisioterapi,c.nomor_pasien,c.nama AS pasien', array('md5(a.id_pemeriksaan)'=>$this->uri->segment(3)), '', '', '', '', array(
			array(
				'table' => 'fisioterapi b',
				'on' => 'a.user_id=b.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'pasien c',
				'on' => 'a.id_pasien=c.id_pasien',
				'pos' => 'LEFT'
			)
		))->row();
		$id = $get_data->id_pemeriksaan;
		$name = $get_data->fisioterapi.' pemeriksaan terhadap '.$get_data->pasien.' dengan nomor pasien '.$get_data->nomor_pasien;

		$this->Main_model->deleteData('pemeriksaan',array('id_pemeriksaan'=>$id));
		$this->Main_model->deleteData('detail_pemeriksaan_1',array('id_pemeriksaan'=>$id));
		$this->Main_model->deleteData('detail_pemeriksaan_2',array('id_pemeriksaan'=>$id));
		$this->Main_model->deleteData('detail_pemeriksaan_3',array('id_pemeriksaan'=>$id));
		$this->Main_model->deleteData('detail_pemeriksaan_4',array('id_pemeriksaan'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data pemeriksaan (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon2-cancel-music"></i></div><div class="alert-text"><strong>Oops!!!</strong> Data gagal dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/hasil_pemeriksaan/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-check-mark"></i></div><div class="alert-text"><strong>Yeah!!!</strong> Data sukses dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/hasil_pemeriksaan/'</script>";
		}
	}
}