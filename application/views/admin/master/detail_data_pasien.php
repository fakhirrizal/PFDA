<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="alert alert-light alert-elevate" role="alert">
        <div class="alert-text">
            <h3>Catatan</h3>
        </div>
    </div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-file-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Data Pasien
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-widget kt-widget--user-profile-3">
                <div class="kt-widget__top">
                    <div class="kt-widget__media kt-hidden-">
                        <img src="<?= base_url(); ?>data_upload/photo_profile/no-image.png" alt="image">
                    </div>
                    <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">
                        JM
                    </div>
                    <div class="kt-widget__content">
                        <div class="kt-widget__head">
                            <a class="kt-widget__username">
                                <?= $data_utama->nama; ?>
                                <i class="flaticon2-correct"></i>
                            </a>
                            <div class="kt-widget__action">
                                <!-- <button type="button" class="btn btn-label-success btn-sm btn-upper">ask</button>&nbsp;
                                <button type="button" class="btn btn-brand btn-sm btn-upper">hire</button> -->
                            </div>
                        </div>
                        <div class="kt-widget__subhead">
                            <a><i class="fa fa-address-card"></i>Nomor Pasien: <?= $data_utama->nomor_pasien; ?></a><br>
                            <a><i class="flaticon2-calendar-3"></i>Jenis Kelamin: <?= $data_utama->jenis_kelamin; ?></a><br>
                            <a><i class="flaticon2-placeholder"></i>Alamat: <?= $data_utama->alamat; ?></a><br>
                            <a><i class="flaticon2-phone"></i>Nomor HP: <?= $data_utama->no_hp; ?></a><br>
                            <a><i class="flaticon-calendar"></i>Tanggal Lahir: <?= $this->Main_model->convert_tanggal($data_utama->tanggal_lahir); ?></a><br>
                            <a><i class="flaticon-users"></i>Nama Wali: <?= $data_utama->nama_wali; ?></a>
                        </div>
                        <!-- <div class="kt-widget__info">
                            <div class="kt-widget__desc">
                                I distinguish three main text objektive could be merely to inform people.
                                <br> A second could be persuade people.You want people to bay objective
                            </div>
                            <div class="kt-widget__progress">
                                <div class="kt-widget__text">
                                    Progress
                                </div>
                                <div class="progress" style="height: 5px;width: 100%;">
                                    <div class="progress-bar kt-bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="kt-widget__stats">
                                    78%
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="kt-widget__bottom">
                    <div class="kt-portlet ">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Riwayat Pemeriksan
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">

                            <!--begin::Accordion-->
                            <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                                <?php
                                if($data_pemeriksaan==NULL){
                                    echo'Data Kosong.';
                                }else{
                                    foreach ($data_pemeriksaan as $key => $value) {
                                        $body_function_and_body_structure = $this->Main_model->getSelectedData('detail_pemeriksaan_1 a', 'a.*', array('a.id_pemeriksaan'=>$value->id_pemeriksaan))->result();
                                        $activities = $this->Main_model->getSelectedData('detail_pemeriksaan_2 a', 'a.*', array('a.id_pemeriksaan'=>$value->id_pemeriksaan))->result();
                                        $participation_restriction = $this->Main_model->getSelectedData('detail_pemeriksaan_3 a', 'a.*', array('a.id_pemeriksaan'=>$value->id_pemeriksaan))->result();
                                        $diagnosa = $this->Main_model->getSelectedData('detail_pemeriksaan_4 a', 'a.*', array('a.id_pemeriksaan'=>$value->id_pemeriksaan))->result();
                                ?>
                                <div class="card">
                                    <div class="card-header" id="headingTwo4<?= $value->id_pemeriksaan; ?>">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo4<?= $value->id_pemeriksaan; ?>" aria-expanded="false" aria-controls="collapseTwo4<?= $value->id_pemeriksaan; ?>">
                                            <i class="fa fa-thumbtack"></i> Pemeriksaan tanggal <?= $this->Main_model->convert_datetime($value->created_at); ?>
                                        </div>
                                    </div>
                                    <div id="collapseTwo4<?= $value->id_pemeriksaan; ?>" class="collapse" aria-labelledby="headingTwo1<?= $value->id_pemeriksaan; ?>" data-parent="#accordionExample4">
                                        <div class="card-body">
                                            <div class="kt-notification-v2">
												<a class="kt-notification-v2__item">
													<div class="kt-notification-v2__item-icon">
														<i class="flaticon-user kt-font-brand"></i>
													</div>
													<div class="kt-notification-v2__itek-wrapper">
														<div class="kt-notification-v2__item-title">
                                                            Fisioterapi
														</div>
														<div class="kt-notification-v2__item-desc">
															<?= $value->nama; ?>
														</div>
													</div>
												</a>
                                                <a class="kt-notification-v2__item">
													<div class="kt-notification-v2__item-icon">
														<i class="flaticon-file-2 kt-font-brand"></i>
													</div>
													<div class="kt-notification-v2__itek-wrapper">
														<div class="kt-notification-v2__item-title">
															Diagnosa/ Condition
														</div>
													</div>
                                                </a>
                                                <?php
                                                if($diagnosa==NULL){
                                                    echo'';
                                                }else{
                                                    echo'
                                                    <div class="kt-notification-v2__item">
                                                        <div class="kt-list-timeline">
                                                            <div class="kt-list-timeline__items">';
                                                            foreach ($diagnosa as $key => $row) {
                                                                echo'
                                                                <div class="kt-list-timeline__item">
                                                                    <span class="kt-list-timeline__badge"></span>
                                                                    <span class="kt-list-timeline__text">'.$row->diagnosa.'</span>
                                                                </div>';
                                                            }
                                                            echo'
                                                            </div>
                                                        </div>
                                                    </div>
                                                    ';
                                                }
                                                ?>
												<a class="kt-notification-v2__item">
													<div class="kt-notification-v2__item-icon">
														<i class="flaticon-file-2 kt-font-brand"></i>
													</div>
													<div class="kt-notification-v2__itek-wrapper">
														<div class="kt-notification-v2__item-title">
															Body function and body structure
														</div>
													</div>
                                                </a>
                                                <?php
                                                if($body_function_and_body_structure==NULL){
                                                    echo'';
                                                }else{
                                                    echo'
                                                    <div class="kt-notification-v2__item">
                                                        <div class="kt-list-timeline">
                                                            <div class="kt-list-timeline__items">';
                                                            foreach ($body_function_and_body_structure as $key => $row) {
                                                                echo'
                                                                <div class="kt-list-timeline__item">
                                                                    <span class="kt-list-timeline__badge"></span>
                                                                    <span class="kt-list-timeline__text">'.$row->body_function_and_body_structure.'</span>
                                                                </div>';
                                                            }
                                                            echo'
                                                            </div>
                                                        </div>
                                                    </div>
                                                    ';
                                                }
                                                ?>
                                                <a class="kt-notification-v2__item">
													<div class="kt-notification-v2__item-icon">
														<i class="flaticon-file-2 kt-font-brand"></i>
													</div>
													<div class="kt-notification-v2__itek-wrapper">
														<div class="kt-notification-v2__item-title">
															Activities (activity limitation)
														</div>
													</div>
                                                </a>
                                                <?php
                                                if($activities==NULL){
                                                    echo'';
                                                }else{
                                                    echo'
                                                    <div class="kt-notification-v2__item">
                                                        <div class="kt-list-timeline">
                                                            <div class="kt-list-timeline__items">';
                                                            foreach ($activities as $key => $row) {
                                                                echo'
                                                                <div class="kt-list-timeline__item">
                                                                    <span class="kt-list-timeline__badge"></span>
                                                                    <span class="kt-list-timeline__text">'.$row->activities.'</span>
                                                                </div>';
                                                            }
                                                            echo'
                                                            </div>
                                                        </div>
                                                    </div>
                                                    ';
                                                }
                                                ?>
												<a class="kt-notification-v2__item">
													<div class="kt-notification-v2__item-icon">
														<i class="flaticon-file-2 kt-font-brand"></i>
													</div>
													<div class="kt-notification-v2__itek-wrapper">
														<div class="kt-notification-v2__item-title">
															Participation restriction
														</div>
													</div>
                                                </a>
                                                <?php
                                                if($participation_restriction==NULL){
                                                    echo'';
                                                }else{
                                                    echo'
                                                    <div class="kt-notification-v2__item">
                                                        <div class="kt-list-timeline">
                                                            <div class="kt-list-timeline__items">';
                                                            foreach ($participation_restriction as $key => $row) {
                                                                echo'
                                                                <div class="kt-list-timeline__item">
                                                                    <span class="kt-list-timeline__badge"></span>
                                                                    <span class="kt-list-timeline__text">'.$row->participation_restriction.'</span>
                                                                </div>';
                                                            }
                                                            echo'
                                                            </div>
                                                        </div>
                                                    </div>
                                                    ';
                                                }
                                                ?>
												<a class="kt-notification-v2__item">
													<div class="kt-notification-v2__item-icon">
														<i class="flaticon-file-2 kt-font-brand"></i>
													</div>
													<div class="kt-notification-v2__itek-wrapper">
														<div class="kt-notification-v2__item-title">
															Enviromental factors
														</div>
														<div class="kt-notification-v2__item-desc">
															<?= $value->enviromental_factors; ?>
														</div>
													</div>
												</a>
												<a class="kt-notification-v2__item">
													<div class="kt-notification-v2__item-icon">
														<i class="flaticon-file-2 kt-font-brand"></i>
													</div>
													<div class="kt-notification-v2__itek-wrapper">
														<div class="kt-notification-v2__item-title">
															Personal factors
														</div>
														<div class="kt-notification-v2__item-desc">
															<?= $value->personal_factors; ?>
														</div>
													</div>
												</a>
                                                <a class="kt-notification-v2__item">
													<div class="kt-notification-v2__item-icon">
														<i class="flaticon-signs-1 kt-font-brand"></i>
													</div>
													<div class="kt-notification-v2__itek-wrapper">
														<div class="kt-notification-v2__item-title">
															Catatan
														</div>
														<div class="kt-notification-v2__item-desc">
															<?= $value->catatan; ?>
														</div>
													</div>
												</a>
                                            </div>
                                            <?php
                                            $dokumentasi = $this->Main_model->getSelectedData('dokumentasi_pemeriksaan a', 'a.*', array('a.id_pemeriksaan'=>$value->id_pemeriksaan))->result();
                                            if($dokumentasi==NULL){
                                                echo'';
                                            }else{
                                            ?>
                                            <div class="col-xl-12">
                                                <div class="kt-portlet kt-portlet--tabs">
                                                    <div class="kt-portlet__head">
                                                        <div class="kt-portlet__head-label">
                                                            <h3 class="kt-portlet__head-title">
                                                                Dokumentasi
                                                            </h3>
                                                        </div>
                                                        <div class="kt-portlet__head-toolbar">
                                                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-right" role="tablist">
                                                                <?php
                                                                $no = 1;
                                                                foreach ($dokumentasi as $key => $d) {
                                                                    if($no=='1'){
                                                                        echo'
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_1_tab_content'.$value->id_pemeriksaan.'" role="tab">
                                                                                <i class="flaticon2-image-file"></i> Gambar '.$no.'
                                                                            </a>
                                                                        </li>
                                                                        ';
                                                                    }else{
                                                                        echo'
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_'.$no.'_tab_content'.$value->id_pemeriksaan.'" role="tab">
                                                                                <i class="flaticon2-image-file"></i> Gambar '.$no.'
                                                                            </a>
                                                                        </li>
                                                                        ';
                                                                    }
                                                                    $no++;
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="kt-portlet__body">
                                                        <div class="tab-content">
                                                            <?php
                                                            $flag = 1;
                                                            foreach ($dokumentasi as $key => $d) {
                                                                if($flag=='1'){
                                                            ?>
                                                                <div class="tab-pane active" id="kt_portlet_base_demo_1_tab_content<?= $value->id_pemeriksaan; ?>" role="tabpanel">
                                                                    <img src='<?= base_url().'data_upload/dokumentasi_pemeriksaan/'.$d->nama_file; ?>' width='100%'/>
                                                                </div>
                                                            <?php
                                                                }else{
                                                            ?>
                                                                <div class="tab-pane" id="kt_portlet_base_demo_<?= $flag; ?>_tab_content<?= $value->id_pemeriksaan; ?>" role="tabpanel">
                                                                    <img src='<?= base_url().'data_upload/dokumentasi_pemeriksaan/'.$d->nama_file; ?>' width='100%'/>
                                                                </div>
                                                            <?php
                                                                }
                                                                $flag++;
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php }
                                } ?>
                            </div>

                            <!--end::Accordion-->
                        </div>
                    </div>
                    <!-- <div class="kt-widget__item">
                        <div class="kt-widget__icon">
                            <i class="flaticon-piggy-bank"></i>
                        </div>
                        <div class="kt-widget__details">
                            <span class="kt-widget__title">Earnings</span>
                            <span class="kt-widget__value"><span>$</span>249,500</span>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <div class="kt-widget__icon">
                            <i class="flaticon-confetti"></i>
                        </div>
                        <div class="kt-widget__details">
                            <span class="kt-widget__title">Expances</span>
                            <span class="kt-widget__value"><span>$</span>164,700</span>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <div class="kt-widget__icon">
                            <i class="flaticon-pie-chart"></i>
                        </div>
                        <div class="kt-widget__details">
                            <span class="kt-widget__title">Net</span>
                            <span class="kt-widget__value"><span>$</span>164,700</span>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <div class="kt-widget__icon">
                            <i class="flaticon-file-2"></i>
                        </div>
                        <div class="kt-widget__details">
                            <span class="kt-widget__title">73 Tasks</span>
                            <a class="kt-widget__value kt-font-brand">View</a>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <div class="kt-widget__icon">
                            <i class="flaticon-chat-1"></i>
                        </div>
                        <div class="kt-widget__details">
                            <span class="kt-widget__title">648 Comments</span>
                            <a class="kt-widget__value kt-font-brand">View</a>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <div class="kt-widget__icon">
                            <i class="flaticon-network"></i>
                        </div>
                        <div class="kt-widget__details">
                            <div class="kt-section__content kt-section__content--solid">
                                <div class="kt-media-group">
                                    <a class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="John Myer">
                                        <img src="assets/media/users/100_1.jpg" alt="image">
                                    </a>
                                    <a class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Alison Brandy">
                                        <img src="assets/media/users/100_10.jpg" alt="image">
                                    </a>
                                    <a class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Selina Cranson">
                                        <img src="assets/media/users/100_11.jpg" alt="image">
                                    </a>
                                    <a class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Luke Walls">
                                        <img src="assets/media/users/100_2.jpg" alt="image">
                                    </a>
                                    <a class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Micheal York">
                                        <img src="assets/media/users/100_3.jpg" alt="image">
                                    </a>
                                    <a class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Micheal York">
                                        <span>+3</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>