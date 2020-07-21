<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="alert alert-light alert-elevate" role="alert">
        <div class="alert-text">
            <h3>Catatan</h3>
            <p> 1. Kolom isian dengan tanda bintang (<font color='red'>*</font>) adalah wajib untuk di isi.</p>
            <p> 2. Ketentuan file yang diupload:</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Format berupa file <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b>, <b>.bmp</b></p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ukuran maksimum file <b>3 MB</b></p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Maksimal <b>4</b> file</p>
        </div>
    </div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-file-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Form Pemeriksaan
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form class="kt-form" action="<?=base_url('employee_side/perbarui_data_pemeriksaan');?>" method="post" enctype='multipart/form-data'>
                <input type='hidden' name='id_pemeriksaan' value='<?= md5($data_utama->id_pemeriksaan); ?>'>
                <div class="kt-portlet__body">
                    <div class="form-group">
                        <label>Fisioterapi </label>
                        <input class="form-control" value='<?= $data_utama->fisioterapi; ?>' disabled>
                    </div>
                    <div class="form-group">
                        <label>Pasien </label>
                        <input class="form-control" value='<?= $data_utama->pasien; ?>' disabled>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Diagnosa/ Condition </label>
                        <a href="javascript:void(0)" id="btAdd_diagnosa" title="Tambah" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-plus"></i></a> &nbsp;
                        <a href="javascript:void(0)" id="btRemove_diagnosa" title="Hapus" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-minus"></i></a></label> 
                        &nbsp;&nbsp;<a id='jml_diagnosa'></a>
                        <script>
                            $(document).ready(function() {
                                var iCntdiagnosa = <?= count($diagnosa); ?>;
                                $('#jml_diagnosa').html('<a>(' + iCntdiagnosa + ')</a>');
                                var containerdiagnosa = $(document.createElement('div'));
                                $('#btAdd_diagnosa').click(function() {
                                    if (iCntdiagnosa <= 19) {

                                        iCntdiagnosa = iCntdiagnosa + 1;

                                        $(containerdiagnosa).append('<div id=tb' + iCntdiagnosa + ' ' + '>'
                                        +'<div class="form-group"><input type="text" class="form-control" name="diagnosa[]"></div>');
                                        if (iCntdiagnosa == 1) {

                                            var divSubmitdiagnosa = $(document.createElement('div'));
                                            $(divSubmitdiagnosa).append('<input type="hidden" class="bt"' +
                                                'onclick="GetTextValue()"' +
                                                'id=btSubmit_diagnosa value=Submit />');
                                        }
                                        $('#keluaran_diagnosa').after(containerdiagnosa, divSubmitdiagnosa);
                                        $('#jml_diagnosa').html('<a>(' + iCntdiagnosa + ')</a>');
                                    }
                                    else {
                                        $(containerdiagnosa).append('<label>Reached the limit</label>');
                                        $('#btAdd_diagnosa').attr('class', 'bt-disable');
                                        $('#btAdd_diagnosa').attr('disabled', 'disabled');
                                    }
                                });
                                $('#btRemove_diagnosa').click(function() {
                                    if (iCntdiagnosa != 0) {
                                        $('#tb' + iCntdiagnosa).remove();
                                        iCntdiagnosa = iCntdiagnosa - 1;
                                    }
                                    if (iCntdiagnosa == 0) {
                                        $(containerdiagnosa)
                                            .empty()
                                            .remove();
                                        $('#btSubmit_diagnosa').remove();
                                        $('#jml_diagnosa').html('(0)');
                                        $('#btAdd_diagnosa')
                                            .removeAttr('disabled')
                                            .attr('class="btn btn-clear"', 'bt');
                                    }
                                    $('#jml_diagnosa').html('<a>(' + iCntdiagnosa + ')</a>');
                                });
                            });
                            var divValue, values = '';
                        </script>
                        <br>
                        <div id="keluaran_diagnosa">
                            <?php
                            $no = 1;
                            foreach ($diagnosa as $key => $d) {
                                echo'
                                <div id="tb'.$no++.'">
                                    <div class="form-group"><input type="text" class="form-control" name="diagnosa[]" value="'.$d->diagnosa.'"></div>
                                </div>
                                ';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Body function and body structure &nbsp;
                        <a href="javascript:void(0)" id="btAdd" title="Tambah" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-plus"></i></a> &nbsp;
                        <a href="javascript:void(0)" id="btRemove" title="Hapus" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-minus"></i></a></label> 
                        &nbsp;&nbsp;<a id='jml'></a>
                        <script>
                            $(document).ready(function() {
                                var iCnt = <?= count($body_function_and_body_structure); ?>;
                                $('#jml').html('<a>(' + iCnt + ')</a>');
                                var container = $(document.createElement('div'));
                                $('#btAdd').click(function() {
                                    if (iCnt <= 19) {

                                        iCnt = iCnt + 1;

                                        $(container).append('<div id=tb' + iCnt + ' ' + '>'
                                        +'<div class="form-group"><input type="text" class="form-control" name="body_function_and_body_structure[]"></div>');
                                        if (iCnt == 1) {

                                            var divSubmit = $(document.createElement('div'));
                                            $(divSubmit).append('<input type="hidden" class="bt"' +
                                                'onclick="GetTextValue()"' +
                                                'id=btSubmit value=Submit />');
                                        }
                                        $('#main').after(container, divSubmit);
                                        $('#jml').html('<a>(' + iCnt + ')</a>');
                                    }
                                    else {
                                        $(container).append('<label>Reached the limit</label>');
                                        $('#btAdd').attr('class', 'bt-disable');
                                        $('#btAdd').attr('disabled', 'disabled');
                                    }
                                });
                                $('#btRemove').click(function() {
                                    if (iCnt != 0) {
                                        $('#tb' + iCnt).remove();
                                        iCnt = iCnt - 1;
                                    }
                                    if (iCnt == 0) {
                                        $(container)
                                            .empty()
                                            .remove();
                                        $('#btSubmit').remove();
                                        $('#jml').html('(0)');
                                        $('#btAdd')
                                            .removeAttr('disabled')
                                            .attr('class="btn btn-clear"', 'bt');
                                    }
                                    $('#jml').html('<a>(' + iCnt + ')</a>');
                                });
                            });
                            var divValue, values = '';
                        </script>
                        <br>
                        <div id="main">
                            <?php
                            $no = 1;
                            foreach ($body_function_and_body_structure as $key => $b) {
                                echo'
                                <div id="tb'.$no++.'">
                                    <div class="form-group"><input type="text" class="form-control" name="body_function_and_body_structure[]" value="'.$b->body_function_and_body_structure.'"></div>
                                </div>
                                ';
                            }
                            ?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label>Activities (activity limitation) &nbsp;
                        <a href="javascript:void(0)" id="tomboltambah" title="Tambah" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-plus"></i></a> &nbsp;
                        <a href="javascript:void(0)" id="tombolhapus" title="Hapus" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-minus"></i></a></label> 
                        &nbsp;&nbsp;<a id='jumlah'></a>
                        <script>
                            $(document).ready(function() {
                                var penanda = <?= count($activities); ?>;
                                $('#jumlah').html('<a>(' + penanda + ')</a>');
                                var container = $(document.createElement('div'));
                                $('#tomboltambah').click(function() {
                                    if (penanda <= 19) {

                                        penanda = penanda + 1;

                                        $(container).append('<div id=awalan' + penanda + ' ' + '>'
                                        +'<div class="form-group"><input type="text" class="form-control" name="activities[]"></div>');
                                        if (penanda == 1) {

                                            var divSubmitHidden = $(document.createElement('div'));
                                            $(divSubmitHidden).append('<input type="hidden" class="tombolsubmitbawah"' +
                                                'onclick="GetTextValue()"' +
                                                'id=btnSubmit value=Submit />');
                                        }
                                        $('#keluaran').after(container, divSubmitHidden);
                                        $('#jumlah').html('<a>(' + penanda + ')</a>');
                                    }
                                    else {
                                        $(container).append('<label>Reached the limit</label>');
                                        $('#tomboltambah').attr('class', 'tombolsubmitbawah-disable');
                                        $('#tomboltambah').attr('disabled', 'disabled');
                                    }
                                });
                                $('#tombolhapus').click(function() {
                                    if (penanda != 0) {
                                        $('#awalan' + penanda).remove();
                                        penanda = penanda - 1;
                                    }
                                    if (penanda == 0) {
                                        $(container)
                                            .empty()
                                            .remove();
                                        $('#btnSubmit').remove();
                                        $('#jumlah').html('(0)');
                                        $('#tomboltambah')
                                            .removeAttr('disabled')
                                            .attr('class="btn btn-clear"', 'tombolsubmitbawah');
                                    }
                                    $('#jumlah').html('<a>(' + penanda + ')</a>');
                                });
                            });
                            var divValue, values = '';
                        </script>
                        <br>
                        <div id="keluaran">
                            <?php
                            $no = 1;
                            foreach ($activities as $key => $a) {
                                echo'
                                <div id="awalan'.$no++.'">
                                    <div class="form-group"><input type="text" class="form-control" name="activities[]" value="'.$a->activities.'"></div>
                                </div>
                                ';
                            }
                            ?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label>Participation restriction &nbsp;
                        <a href="javascript:void(0)" id="buttontambah" title="Tambah" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-plus"></i></a> &nbsp;
                        <a href="javascript:void(0)" id="buttonhapus" title="Hapus" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-minus"></i></a></label> 
                        &nbsp;&nbsp;<a id='jumlahhitung'></a>
                        <script>
                            $(document).ready(function() {
                                var flagging = <?= count($participation_restriction); ?>;
                                $('#jumlahhitung').html('<a>(' + flagging + ')</a>');
                                var container = $(document.createElement('div'));
                                $('#buttontambah').click(function() {
                                    if (flagging <= 19) {

                                        flagging = flagging + 1;

                                        $(container).append('<div id=depan' + flagging + ' ' + '>'
                                        +'<div class="form-group"><input type="text" class="form-control" name="participation_restriction[]"></div>');
                                        if (flagging == 1) {

                                            var HiddenDivSubmit = $(document.createElement('div'));
                                            $(HiddenDivSubmit).append('<input type="hidden" class="buttonsubmitbawah"' +
                                                'onclick="GetTextValue()"' +
                                                'id=btnSubmit value=Submit />');
                                        }
                                        $('#hasilkeluaran').after(container, HiddenDivSubmit);
                                        $('#jumlahhitung').html('<a>(' + flagging + ')</a>');
                                    }
                                    else {
                                        $(container).append('<label>Reached the limit</label>');
                                        $('#buttontambah').attr('class', 'buttonsubmitbawah-disable');
                                        $('#buttontambah').attr('disabled', 'disabled');
                                    }
                                });
                                $('#buttonhapus').click(function() {
                                    if (flagging != 0) {
                                        $('#depan' + flagging).remove();
                                        flagging = flagging - 1;
                                    }
                                    if (flagging == 0) {
                                        $(container)
                                            .empty()
                                            .remove();
                                        $('#btnSubmit').remove();
                                        $('#jumlahhitung').html('(0)');
                                        $('#buttontambah')
                                            .removeAttr('disabled')
                                            .attr('class="btn btn-clear"', 'buttonsubmitbawah');
                                    }
                                    $('#jumlahhitung').html('<a>(' + flagging + ')</a>');
                                });
                            });
                            var divValue, values = '';
                        </script>
                        <br>
                        <div id="hasilkeluaran">
                            <?php
                            $no = 1;
                            foreach ($participation_restriction as $key => $p) {
                                echo'
                                <div id="depan'.$no++.'">
                                    <div class="form-group"><input type="text" class="form-control" name="participation_restriction[]" value="'.$p->participation_restriction.'"></div>
                                </div>
                                ';
                            }
                            ?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label>Enviromental Factors </label>
                        <textarea class="form-control" name='enviromental_factors'><?= $data_utama->enviromental_factors; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Personal Factors </label>
                        <textarea class="form-control" name='personal_factors'><?= $data_utama->personal_factors; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Catatan </label>
                        <textarea class="form-control" name='catatan'><?= $data_utama->catatan; ?></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Dokumentasi </label>
                        <input name="files[]" type="file" class="form-control" id="customFile" multiple />
                    </div>
                    <?php
                    if($dokumentasi==NULL){
                        echo'';
                    }else{
                    ?>
                    <div class='row'>
                        <?php
                        foreach ($dokumentasi as $key => $value) {
                            echo'
                            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                                <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                                    <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
                                        <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url(data_upload/dokumentasi_pemeriksaan/'.$value->nama_file.')">
                                            <div class="kt-widget19__shadow"></div>
                                            <div class="kt-widget19__labels">
                                                <a href="'.base_url().'employee_side/hapus_foto_pemeriksaan/'.md5($value->id_dokumentasi).'" class="btn btn-label-light-o2 btn-bold "><font color="red">Hapus</font></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                        ?>
                    </div>
                    <?php
                    } ?>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>