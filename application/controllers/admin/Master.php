<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	/* Data Fisioterapi */
	public function data_fisioterapi()
	{
		$data['parent'] = 'master';
		$data['child'] = 'master_fisioterapi';
		$data['grand_child'] = '';
		$data['breadcrumbs1'] = 'Data Master';
		$data['breadcrumbs2'] = 'Fisioterapi';
		$data['breadcrumbs3'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/data_fisioterapi',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_data_fisioterapi()
	{
		$get_data = $this->Main_model->getSelectedData('fisioterapi a', 'a.*',array('a.deleted' => '0'))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['nama'] = $value->nama;
			$isi['alamat'] = $value->alamat;
			$isi['hp'] = $value->no_hp;
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['aksi'] =	'
			<div class="kt-section__content">
				<div class="dropdown dropdown-inline">
					<button type="button" class="btn btn-brand btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="flaticon-more-1"></i>
					</button>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="javascript:void(0)"><i class="la la-share"></i> Detil Data </a>
						<a class="dropdown-item" href="'.site_url('admin_side/ubah_data_fisioterapi/'.md5($value->user_id)).'"><i class="la la-edit"></i> Ubah Data </a>
						<a class="dropdown-item" onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_fisioterapi/'.md5($value->user_id)).'" onclick="'.$return_on_click.'"><i class="la la-trash"></i> Hapus Data </a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="'.site_url('admin_side/atur_ulang_kata_sandi_akun_fisioterapi/'.md5($value->user_id)).'"><i class="la la-refresh"></i> Atur Ulang Kata Sandi </a>
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
	public function tambah_data_fisioterapi()
	{
		$data['parent'] = 'master';
		$data['child'] = 'master_fisioterapi';
		$data['grand_child'] = '';
		$data['breadcrumbs1'] = 'Data Master';
		$data['breadcrumbs2'] = 'Fisioterapi';
		$data['breadcrumbs3'] = 'Tambah Data';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/tambah_data_fisioterapi',$data);
		$this->load->view('admin/template/footer');
	}
	public function simpan_data_fisioterapi()
	{
		$cek_ = $this->Main_model->getSelectedData('user a', 'a.*',array('a.username'=>$this->input->post('un')))->row();
		if($cek_==NULL){
			$this->db->trans_start();
			$get_user_id = $this->Main_model->getLastID('user','id');

			$data_insert1 = array(
				'id' => $get_user_id['id']+1,
				'username' => $this->input->post('un'),
				'pass' => $this->input->post('ps'),
				'fullname' => $this->input->post('nama'),
				'is_active' => '1',
				'created_by' => $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('user',$data_insert1);
			// print_r($data_insert1);

			$data_insert2 = array(
				'user_id' => $get_user_id['id']+1,
				'role_id' => '2'
			);
			$this->Main_model->insertData('user_to_role',$data_insert2);
			// print_r($data_insert2);

			$data_insert3 = array(
				'user_id' => $get_user_id['id']+1,
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_hp')
			);
			$this->Main_model->insertData('fisioterapi',$data_insert3);
			// print_r($data_insert3);

			$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data fisioterapi (".$this->input->post('nama').")",$this->session->userdata('location'));
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon2-cancel-music"></i></div><div class="alert-text"><strong>Oops!!!</strong> Data gagal ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_fisioterapi/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-check-mark"></i></div><div class="alert-text"><strong>Yeah!!!</strong> Data sukses ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/data_fisioterapi'</script>";
			}
		}else{
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon2-cancel-music"></i></div><div class="alert-text"><strong>Oops!!!</strong> Username telah digunakan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_fisioterapi/'</script>";
		}
	}
	public function ubah_data_fisioterapi()
	{
		$data['parent'] = 'master';
		$data['child'] = 'master_fisioterapi';
		$data['grand_child'] = '';
		$data['breadcrumbs1'] = 'Data Master';
		$data['breadcrumbs2'] = 'Fisioterapi';
		$data['breadcrumbs3'] = 'Ubah Data';
		$data['data_utama'] = $this->Main_model->getSelectedData('fisioterapi a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/ubah_data_fisioterapi',$data);
		$this->load->view('admin/template/footer');
	}
	public function perbarui_data_fisioterapi()
	{
		$this->db->trans_start();
		$data_insert1 = array(
			'fullname' => $this->input->post('nama')
		);
		$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('id')));

		$data_insert2 = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp')
		);
		$this->Main_model->updateData('fisioterapi',$data_insert2,array('md5(user_id)'=>$this->input->post('id')));

		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Mengubah data fisioterapi (".$this->input->post('nama').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon2-cancel-music"></i></div><div class="alert-text"><strong>Oops!!!</strong> Data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/ubah_data_fisioterapi/".$this->input->post('id')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-check-mark"></i></div><div class="alert-text"><strong>Yeah!!!</strong> Data sukses diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_fisioterapi/'</script>";
		}
	}
	public function atur_ulang_kata_sandi_akun_fisioterapi()
	{
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('fisioterapi a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->nama;

		$this->Main_model->updateData('user',array('pass'=>'1234'),array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengatur ulang kata sandi akun fisioterapi (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon2-cancel-music"></i></div><div class="alert-text"><strong>Oops!!!</strong> Data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_fisioterapi/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-check-mark"></i></div><div class="alert-text"><strong>Yeah!!!</strong> Data sukses diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_fisioterapi/'</script>";
		}
	}
	public function hapus_data_fisioterapi()
	{
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('fisioterapi a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->nama;

		$this->Main_model->updateData('user',array('is_active'=>'0','deleted_by'=>$this->session->userdata('id'),'deleted_at'=>date("Y-m-d H:i:s"),'deleted'=>'1'),array('id'=>$user_id));
		$this->Main_model->updateData('fisioterapi',array('deleted'=>'1'),array('user_id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus akun fisioterapi (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon2-cancel-music"></i></div><div class="alert-text"><strong>Oops!!!</strong> Data gagal dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_fisioterapi/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-check-mark"></i></div><div class="alert-text"><strong>Yeah!!!</strong> Data sukses dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_fisioterapi/'</script>";
		}
	}
	/* Data Pasien */
	public function data_pasien()
	{
		$data['parent'] = 'master';
		$data['child'] = 'master_pasien';
		$data['grand_child'] = '';
		$data['breadcrumbs1'] = 'Data Master';
		$data['breadcrumbs2'] = 'Pasien';
		$data['breadcrumbs3'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/data_pasien',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_data_pasien()
	{
		$get_data = $this->Main_model->getSelectedData('pasien a', 'a.*',array('a.deleted' => '0'))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['no_pasien'] = $value->nomor_pasien;
			$isi['nama'] = $value->nama;
			$isi['alamat'] = $value->alamat;
			$isi['hp'] = $value->no_hp;
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['aksi'] =	'
			<div class="kt-section__content">
				<div class="dropdown dropdown-inline">
					<button type="button" class="btn btn-brand btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="flaticon-more-1"></i>
					</button>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="'.site_url('admin_side/detail_data_pasien/'.md5($value->id_pasien)).'"><i class="la la-share"></i> Detil Data </a>
						<a class="dropdown-item" href="'.site_url('admin_side/ubah_data_pasien/'.md5($value->id_pasien)).'"><i class="la la-edit"></i> Ubah Data </a>
						<a class="dropdown-item" onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_pasien/'.md5($value->id_pasien)).'" onclick="'.$return_on_click.'"><i class="la la-trash"></i> Hapus Data </a>
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
	public function tambah_data_pasien()
	{
		$data['parent'] = 'master';
		$data['child'] = 'master_pasien';
		$data['grand_child'] = '';
		$data['breadcrumbs1'] = 'Data Master';
		$data['breadcrumbs2'] = 'Pasien';
		$data['breadcrumbs3'] = 'Tambah Data';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/tambah_data_pasien',$data);
		$this->load->view('admin/template/footer');
	}
	public function simpan_data_pasien()
	{
		$this->db->trans_start();
		$data_insert1 = array(
			'nomor_pasien' => $this->Main_model->get_nomor_pasien($this->input->post('nama')),
			'nama' => $this->input->post('nama'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'nama_wali' => $this->input->post('nama_wali')
		);
		$this->Main_model->insertData('pasien',$data_insert1);
		// print_r($data_insert1);

		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data pasien (".$this->input->post('nama').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon2-cancel-music"></i></div><div class="alert-text"><strong>Oops!!!</strong> Data gagal ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_pasien/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-check-mark"></i></div><div class="alert-text"><strong>Yeah!!!</strong> Data sukses ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_pasien'</script>";
		}
	}
	public function detail_data_pasien()
	{
		$data['parent'] = 'master';
		$data['child'] = 'master_pasien';
		$data['grand_child'] = '';
		$data['breadcrumbs1'] = 'Data Master';
		$data['breadcrumbs2'] = 'Pasien';
		$data['breadcrumbs3'] = 'Detail Data';
		$data['data_utama'] = $this->Main_model->getSelectedData('pasien a', 'a.*', array('md5(a.id_pasien)'=>$this->uri->segment(3)))->row();
		$data['data_pemeriksaan'] = $this->Main_model->getSelectedData('pemeriksaan a', 'a.*,b.nama', array('md5(a.id_pasien)'=>$this->uri->segment(3)), '', '', '', '', array(
			'table' => 'fisioterapi b',
			'on' => 'a.user_id=b.user_id',
			'pos' => 'LEFT'
		))->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/detail_data_pasien',$data);
		$this->load->view('admin/template/footer');
	}
	public function ubah_data_pasien()
	{
		$data['parent'] = 'master';
		$data['child'] = 'master_pasien';
		$data['grand_child'] = '';
		$data['breadcrumbs1'] = 'Data Master';
		$data['breadcrumbs2'] = 'Pasien';
		$data['breadcrumbs3'] = 'Ubah Data';
		$data['data_utama'] = $this->Main_model->getSelectedData('pasien a', 'a.*', array('md5(a.id_pasien)'=>$this->uri->segment(3)))->row();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/ubah_data_pasien',$data);
		$this->load->view('admin/template/footer');
	}
	public function perbarui_data_pasien()
	{
		$this->db->trans_start();
		$data_insert1 = array(
			'nama' => $this->input->post('nama'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'nama_wali' => $this->input->post('nama_wali')
		);
		$this->Main_model->updateData('pasien',$data_insert1,array('md5(id_pasien)'=>$this->input->post('id')));

		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Mengubah data pasien (".$this->input->post('nama').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon2-cancel-music"></i></div><div class="alert-text"><strong>Oops!!!</strong> Data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/ubah_data_pasien/".$this->input->post('id')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-check-mark"></i></div><div class="alert-text"><strong>Yeah!!!</strong> Data sukses diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_pasien/'</script>";
		}
	}
	public function hapus_data_pasien()
	{
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('pasien a', 'a.*',array('md5(a.id_pasien)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->id_pasien;
		$name = $get_data->nama;

		$this->Main_model->updateData('pasien',array('deleted'=>'1'),array('id_pasien'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data pasien (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon2-cancel-music"></i></div><div class="alert-text"><strong>Oops!!!</strong> Data gagal dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_pasien/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-check-mark"></i></div><div class="alert-text"><strong>Yeah!!!</strong> Data sukses dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_pasien/'</script>";
		}
	}
}