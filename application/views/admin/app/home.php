<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-xl-4 col-lg-6 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Daftar Fisioterapi
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_widget4r_tab1_content" role="tab">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget4r_tab1_content">
                            <div class="kt-widget4">
                                <?php
                                if($data_fisioterapi_limit==NULL){
                                    echo'Data Kosong.';
                                }else{
                                    foreach ($data_fisioterapi_limit as $key => $value) {
                                        $foto = base_url().'data_upload/photo_profile/no-image.png';
                                        if($value->photo=='' OR $value->photo==NULL){
                                            echo'';
                                        }else{
                                            $foto = base_url().'data_upload/photo_profile/'.$value->photo;
                                        }
                                ?>
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <img src="<?= $foto; ?>" alt="">
                                    </div>
                                    <div class="kt-widget4__info">
                                        <a href="javascript:void(0)" class="kt-widget4__username">
                                            <?= $value->nama; ?>
                                        </a>
                                        <p class="kt-widget4__text">
                                            <?= $value->alamat; ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                                    }
                                if(count($data_fisioterapi_limit)==count($data_fisioterapi)){
                                    echo'';
                                }else{
                                ?>
                                <div style='text-align:right;'>
                                    <br>
                                    <a href="<?= base_url().'admin_side/data_fisioterapi'; ?>" class="btn btn-sm btn-label-brand btn-bold">Lihat selengkapnya</a>
                                </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Daftar Pasien
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_widget4_tab1_content" role="tab">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget4_tab1_content">
                            <div class="kt-widget4">
                                <?php
                                if($data_pasien_limit==NULL){
                                    echo'Data Kosong.';
                                }else{
                                    foreach ($data_pasien_limit as $key => $value) {
                                        $get_data_pemeriksaan_per_pasien = $this->Main_model->getSelectedData('pemeriksaan a', 'a.*', array('a.id_pasien'=>$value->id_pasien))->result();
                                        $foto = base_url().'data_upload/photo_profile/no-image.png';
                                ?>
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <img src="<?= $foto; ?>" alt="">
                                    </div>
                                    <div class="kt-widget4__info">
                                        <a href="javascript:void(0)" class="kt-widget4__username">
                                            <?= $value->nama; ?>
                                        </a>
                                        <p class="kt-widget4__text">
                                            <?= $value->nomor_pasien; ?>
                                        </p>
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-label-primary btn-bold"><?= number_format(count($get_data_pemeriksaan_per_pasien),0); ?>x Pemeriksaan</a>
                                </div>
                                <?php
                                    }
                                if(count($data_pasien_limit)==count($data_pasien)){
                                    echo'';
                                }else{
                                ?>
                                <div style='text-align:right;'>
                                    <br>
                                    <a href="<?= base_url().'admin_side/data_pasien'; ?>" class="btn btn-sm btn-label-brand btn-bold">Lihat selengkapnya</a>
                                </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Riwayat Pemeriksaan
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_widget3_tab1_content" role="tab">
                                    Hari ini
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget3_tab1_content">
                            <div class="kt-timeline-v3">
                                <div class="kt-timeline-v3__items">
                                    <?php
                                    if($data_pemeriksaan==NULL){
                                        echo'Data Kosong.';
                                    }else{
                                        foreach ($data_pemeriksaan as $key => $value) {
                                    ?>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--info">
                                        <span class="kt-timeline-v3__item-time"><?= date('H:i', strtotime($value->created_at)); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                Pemeriksaan kepada <?= $value->pasien; ?>
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="<?= base_url().'admin_side/detail_pemeriksaan/'.md5($value->id_pemeriksaan); ?>" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    Oleh <?= $value->fisioterapi; ?>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>