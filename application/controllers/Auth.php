<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		$cek = $this->Main_model->getSelectedData('user_to_role a', 'a.role_id,b.route', array('a.user_id'=>$this->session->userdata('id'),'b.deleted'=>'0'), "",'1','','',array(
			'table' => 'user_role b',
			'on' => 'a.role_id=b.id',
			'pos' => 'LEFT'
		))->result();
		if($cek!=NULL){
			foreach ($cek as $key => $value) {
				if($value->role_id!=NULL){
					redirect($value->route);
				}
				else{
					$this->session->sess_destroy();
					$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<strong>Ups!</strong>&nbsp;&nbsp;Akun Anda tidak dikenali sistem.
											</div>' );
					echo "<script>window.location='".base_url()."'</script>";
				}
			}
		}
		else{
			$this->load->view('auth/login');
		}
	}
	public function login_process()
	{
		$cek = $this->Main_model->getSelectedData('user a', '*', array("a.username" => $this->input->post('username'), "a.is_active" => '1', 'a.deleted' => '0'), 'a.username ASC', '1')->result();
		if($cek!=NULL){
			$cek2 = $this->Main_model->getSelectedData('user a', '*', array("a.username" => $this->input->post('username'),'pass' => $this->input->post('password'), "a.is_active" => '1', 'deleted' => '0'), 'a.username ASC','','','','')->result();
			if($cek2!=NULL){
				foreach ($cek as $key => $value) {
					$total_login = ($value->total_login)+1;
					$login_attempts = ($value->login_attempts)+1;
					$data_log = array(
						'total_login' => $total_login,
						'last_login' => date('Y-m-d H-i-s'),
						'last_activity' => date('Y-m-d H-i-s'),
						'login_attempts' => $login_attempts,
						'last_login_attempt' => date('Y-m-d H-i-s'),
						'ip_address' => $this->input->ip_address()
					);
					$this->Main_model->updateData('user',$data_log,array('id'=>$value->id));
					$this->Main_model->log_activity($value->id,'Login to system','Login via web browser',$this->input->post('location'));
					$role = $this->Main_model->getSelectedData('user_to_role a', 'b.route,a.user_id,a.role_id', array('a.user_id'=>$value->id,'b.deleted'=>'0'), "",'1','','',array(
						'table' => 'user_role b',
						'on' => 'a.role_id=b.id',
						'pos' => 'LEFT'
					))->result();
					if($role==NULL){
						$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<strong>Ups!</strong>&nbsp;&nbsp;Akun Anda tidak dikenali sistem.
														</div>' );
						echo "<script>window.location='".base_url()."'</script>";
					}else{
						foreach ($role as $key => $value2) {
							if($value2->role_id!=NULL){
								$sess_data['id'] = $value2->user_id;
								$sess_data['role_id'] = $value2->role_id;
								$sess_data['location'] = $this->input->post('location');
								$this->session->set_userdata($sess_data);
								redirect($value2->route);
							}
							else{
								$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<strong>Ups!</strong>&nbsp;&nbsp;Akun Anda tidak dikenali sistem.
														</div>' );
								echo "<script>window.location='".base_url()."'</script>";
							}
						}
					}
				}
			}else{
				foreach ($cek as $key => $value) {
					$login_attempts = ($value->login_attempts)+1;
					$data_log = array(
						'login_attempts' => $login_attempts,
						'last_login_attempt' => date('Y-m-d H-i-s')
					);
					$this->Main_model->updateData('user',$data_log,array('id'=>$value->id));
					$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<strong>Ups!</strong>&nbsp;&nbsp;Password yg Anda masukkan tidak valid.
												</div>' );
					echo "<script>window.location='".base_url()."'</script>";
				}
			}
		}
		else{
			$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<strong>Ups!</strong>&nbsp;&nbsp;Username/ Email yang Anda masukkan tidak terdaftar.
										</div>' );
			echo "<script>window.location='".base_url()."'</script>";
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		echo "<script>window.location='".base_url()."'</script>";
	}
}