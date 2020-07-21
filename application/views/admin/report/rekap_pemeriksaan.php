<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="alert alert-light alert-elevate" role="alert">
        <div class="alert-text">
            <h3>Catatan</h3>
            <p> 1. Data yang mempunyai nilai 0 tidak akan ditampilkan.</p>
        </div>
    </div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-file-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Data Pemeriksaan
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <button type="button" onclick="window.location.href='<?= base_url().'admin_side/rekap_pemeriksaan'; ?>'" class="btn btn-brand btn-icon-sm" >
                            <i class="flaticon2-refresh"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Berdasarkan penanganan tiap fisioterapi -> ini grafik garis,yg garis fisioterapinya, sumbu x adalah hari sumbu y jumlah pemeriksaan (bisa grafik bisa tabel)
        Berdasarkan kunjungan pasien -> grafik batang, sumbu x hari, sumbu y jumlah pasien (bisa grafik bisa tabel) -->
        <div class="kt-portlet__body">
            <form class="kt-form kt-form--label-right" action="<?=base_url('admin_side/rekap_pemeriksaan');?>" method="post" enctype='multipart/form-data'>
                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Jenis data:</label>
                            <select class="form-control" name='jenis_data' required>
                                <option value=''>-- Pilih --</option>
                                <option value='1' <?php if($jenis_data=='1'){echo'selected';}else{echo'';} ?>>Berdasarkan penanganan tiap fisioterapi</option>
                                <option value='2' <?php if($jenis_data=='2'){echo'selected';}else{echo'';} ?>>Berdasarkan kunjungan pasien</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="">Tampilan data:</label>
                            <select class="form-control" name='tampilan_data' required>
                                <option value=''>-- Pilih --</option>
                                <option value='1' <?php if($tampilan_data=='1'){echo'selected';}else{echo'';} ?>>Grafik</option>
                                <option value='2' <?php if($tampilan_data=='2'){echo'selected';}else{echo'';} ?>>Tabel</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Rentang waktu:</label>
                            <div class="kt-input-icon" id='kt_daterangepicker_2'>
                                <input type='text' class="form-control" name='tanggal' value='<?= $tanggal; ?>' placeholder="Select date range" required/>
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-calendar"></i></span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary">Proses</button>
                                <button type="reset" class="btn btn-secondary">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    if($ajax=='open'){
    ?>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__body">
            <?php
            if($jenis_data=='1' AND $tampilan_data=='1'){
            ?>
                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                <script src="https://code.highcharts.com/modules/export-data.js"></script>
                <script src="https://code.highcharts.com/modules/accessibility.js"></script>
                <figure class="highcharts-figure">
                    <div id="grafik1"></div>
                </figure>
                <script>
                    Highcharts.chart('grafik1', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        credits: {
                            enabled: false
                        },
                        title: {
                            text: 'Rekap pemeriksaan berdasarkan penanganan tiap fisioterapi'
                        },
                        subtitle: {
                            text: 'Periode <?= $periode; ?>'
                        },
                        tooltip: {
                            formatter: function () {
                                return '<b>' + this.point.name + '</b><br>Pasien: <b>' + this.y +
                                    '</b> (' + Math.round(this.percentage) + '%)';
                            }
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Pasien',
                            colorByPoint: true,
                            data: [
                            <?php
                            foreach ($data_fisioterapi as $key => $value) {
                                if($value->jml=='0'){
                                    echo'';
                                }else{
                                    echo'
                                    {
                                        name: "'.$value->nama.'",
                                        y: '.$value->jml.'
                                    },
                                    ';
                                }
                            }
                            ?>
                            ]
                        }]
                    });
                </script>
            <?php
            }elseif($jenis_data=='1' AND $tampilan_data=='2'){
            ?>
                <div style="text-align: center;">
                <h5>Rekap pemeriksaan berdasarkan penanganan tiap fisioterapi</h5>
                Periode <?= $periode; ?>
                </div><br>
                <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel1">
                    <thead>
                        <tr>
                            <th style="text-align: center;" width="1%"> # </th>
                            <th style="text-align: center;"> Nama </th>
                            <th style="text-align: center;"> Alamat </th>
                            <th style="text-align: center;"> No. HP </th>
                            <th style="text-align: center;"> Pemeriksaan </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data_fisioterapi as $key => $value) {
                            if($value->jml==0){
                                echo'';
                            }else{
                                echo'
                                <tr>
                                    <td style="text-align: center;">'.$no++.'.</td>
                                    <td>'.$value->nama.'</td>
                                    <td style="text-align: center;">'.$value->alamat.'</td>
                                    <td style="text-align: center;">'.$value->no_hp.'</td>
                                    <td style="text-align: center;">'.number_format($value->jml,0).' Pemeriksaan</td>
                                </tr>
                                ';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }elseif($jenis_data=='2' AND $tampilan_data=='1'){
            ?>
                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script src="https://code.highcharts.com/highcharts-3d.js"></script>
                <script src="https://code.highcharts.com/modules/cylinder.js"></script>
                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                <script src="https://code.highcharts.com/modules/export-data.js"></script>
                <script src="https://code.highcharts.com/modules/accessibility.js"></script>
                <figure class="highcharts-figure">
                    <div id="grafik2"></div>
                </figure>
                <script>
                    Highcharts.chart('grafik2', {
                        chart: {
                            type: 'cylinder',
                            options3d: {
                                enabled: true,
                                alpha: 15,
                                beta: 0,
                                depth: 0,
                                viewDistance: 25
                            }
                        },
                        credits: {
                            enabled: false
                        },
                        title: {
                            text: 'Rekap pemeriksaan berdasarkan kunjungan pasien'
                        },
                        subtitle: {
                            text: 'Periode <?= $periode; ?>'
                        },
                        tooltip: {
                            formatter: function () {
                                return '<b>' + this.point.name + '</b><br>Pemeriksaan: <b>' + this.y +
                                    'x';
                            }
                        },
                        plotOptions: {
                            series: {
                                depth: 25,
                                colorByPoint: true
                            }
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            title: {
                                text: 'Total'
                            }
                        },
                        series: [{
                            data: [<?php
                                foreach ($data_pasien as $key => $value) {
                                    if($value->jml=='0'){
                                        echo'';
                                    }else{
                                        echo'
                                        {
                                            name: "'.$value->nama.'",
                                            y: '.$value->jml.'
                                        },
                                        ';
                                    }
                                }
                                ?>],
                            name: 'Pemeriksaan per pasien',
                            showInLegend: true
                        }]
                    });
                </script>
            <?php
            }elseif($jenis_data=='2' AND $tampilan_data=='2'){
            ?>
                <div style="text-align: center;">
                <h5>Rekap pemeriksaan berdasarkan kunjungan pasien</h5>
                Periode <?= $periode; ?>
                </div><br>
                <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel2">
                    <thead>
                        <tr>
                            <th style="text-align: center;" width="1%"> # </th>
                            <th style="text-align: center;"> Nomor Pasien </th>
                            <th style="text-align: center;"> Nama </th>
                            <th style="text-align: center;"> Alamat </th>
                            <th style="text-align: center;"> No. HP </th>
                            <th style="text-align: center;"> Pemeriksaan </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data_pasien as $key => $value) {
                            if($value->jml==0){
                                echo'';
                            }else{
                                echo'
                                <tr>
                                    <td style="text-align: center;">'.$no++.'.</td>
                                    <td style="text-align: center;">'.$value->nomor_pasien.'</td>
                                    <td>'.$value->nama.'</td>
                                    <td style="text-align: center;">'.$value->alamat.'</td>
                                    <td style="text-align: center;">'.$value->no_hp.'</td>
                                    <td style="text-align: center;">'.number_format($value->jml,0).' Pemeriksaan</td>
                                </tr>
                                ';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }else{
                echo'';
            }
            ?>
        </div>
    </div>
    <?php }else{
        echo'';
    } ?>
</div>




                                        