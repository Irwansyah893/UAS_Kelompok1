<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Dosen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('dosen/updatedata', ['class' => 'formdosen']) ?>
            <!-- Autentifikasi Menjaga Serangan Injeksi -->
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nidn" class="col-sm-2 col-form-label">NIDN</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control is-valid" id="id_dosen" name="id_dosen" placeholder="Masukkan ID" value="<?= $id_dosen ?>" readonly>
                        <input type="text" class="form-control is-valid" id="nidn" name="nidn" placeholder="Masukkan NIDN" value="<?= $nidn ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Dosen</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control is-valid" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" value="<?= $nama ?>">
                        <div class="valid-feedback errornama"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat & Tanggal Lahir</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control is-valid" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" value="<?= $tempat_lahir ?>">
                        <div class="valid-feedback errortmplahir"></div>
                    </div>
                    <div class="col-sm-5">
                        <input type="date" class="form-control is-valid" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan Tanggal Lahir" value="<?= $tanggal_lahir ?>">
                        <div class="valid-feedback errortgllahir"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control is-valid" id="alamat" name="alamat" placeholder="Masukkan Alamat" value="<?= $alamat ?>">
                        <div class="valid-feedback erroralamat"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div class="position-fixed align-items-center" style="position: absolute; top: 50%; left: 50%;">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class= "toast-header">
            <strong class="mr-auto">Simpan</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Data Berhasil Disimpan!!!
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formdosen').submit( function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="bi bi-arrow-repeat"></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Update');
                },
                success: function(response) {
                    // Alert(response.sukses);
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: response.sukses,
                    });

                    // Tutup Modal Tambah 
                    $('#modaledit').modal('hide');
                    // Panggil Fungsi Data Dosen Yang Berada Pada View Tampil Data
                    datadosen();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>