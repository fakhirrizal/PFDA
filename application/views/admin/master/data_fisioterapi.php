<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="alert alert-light alert-elevate" role="alert">
        <!-- <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div> -->
        <div class="alert-text">
            <h3>Catatan</h3>
            <p> 1. Ketika mengklik <b>Atur Ulang Kata Sandi</b>, maka kata sandi otomatis menjadi "<b>1234</b>"</p>
        </div>
    </div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-file-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Data Fisioterapi
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <button type="button" onclick="window.location.href='<?= base_url().'admin_side/tambah_data_fisioterapi'; ?>'" class="btn btn-brand btn-icon-sm" >
                            <i class="flaticon2-plus"></i> Tambah Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="tbl">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="1%"> # </th>
                        <th style="text-align: center;"> Nama </th>
                        <th style="text-align: center;"> Alamat </th>
                        <th style="text-align: center;"> No. HP </th>
                        <th style="text-align: center;" width="1%"> Aksi </th>
                    </tr>
                </thead>
            </table>
            <!-- </div> -->
            <script type="text/javascript" language="javascript" >
                $(document).ready(function(){
                    $('#tbl').dataTable({
                        "order": [[ 0, "asc" ]],
                        "bProcessing": true,
                        "ajax" : {
                            url:"<?= site_url('admin/Master/json_data_fisioterapi'); ?>"
                        },
                        "aoColumns": [
                                    { mData: 'no', sClass: "alignCenter" },
                                    { mData: 'nama' },
                                    { mData: 'alamat', sClass: "alignCenter" },
                                    { mData: 'hp', sClass: "alignCenter" },
                                    { mData: 'aksi', sClass: "alignCenter" }
                                ]
                    });

                });
            </script>
            <!--end: Datatable -->
        </div>
    </div>
</div>

<!-- end:: Content -->