<?= $this->session->flashdata('gagal') ?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="alert alert-light alert-elevate" role="alert">
        <!-- <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div> -->
        <div class="alert-text">
            <h3>Catatan</h3>
            <p> 1. Kolom isian dengan tanda bintang (<font color='red'>*</font>) adalah wajib untuk di isi.</p>
        </div>
    </div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-file-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Ubah Data Fisioterapi
                </h3>
            </div>
            <!-- <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <button type="button" class="btn btn-brand btn-icon-sm" >
                            <i class="flaticon2-plus"></i> Tambah Data
                        </button>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="kt-portlet__body">
            <form class="kt-form" action="<?=base_url('admin_side/perbarui_data_fisioterapi');?>" method="post" enctype='multipart/form-data'>
                <input type="hidden" name='id' value='<?= md5($data_utama->user_id); ?>'>
                <div class="kt-portlet__body">
                    <div class="form-group">
                        <label>Nama Lengkap <font color='red'>*</font></label>
                        <input type="text" class="form-control" name='nama' value='<?= $data_utama->nama; ?>' required>
                    </div>
                    <div class="form-group">
                        <label>Alamat </label>
                        <input type="text" class="form-control" name='alamat' value='<?= $data_utama->alamat; ?>'>
                    </div>
                    <div class="form-group">
                        <label>Nomor HP </label>
                        <input type="text" class="form-control" name='no_hp' value='<?= $data_utama->no_hp; ?>'>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <button type="reset" class="btn btn-secondary">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- end:: Content -->