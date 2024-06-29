<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Matakuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('matakuliah/updatedata', ['class' => 'formmatakuliah']) ?>
            <!-- Autentifikasi Menjaga Serangan Injeksi -->
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="kode" class="col-sm-2 col-form-label">Kode Matakuliah</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control is-valid" id="id_matkul" name="id_matkul" placeholder="Masukkan ID" value="<?= $id_matkul ?>" readonly>
                        <input type="text" class="form-control is-valid" id="kode" name="kode" placeholder="Masukkan Kode Matakuliah" value="<?= $kode ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Matakuliah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control is-valid" id="nama" name="nama" placeholder="Masukkan Nama Matakuliah" value="<?= $nama ?>">
                        <div class="valid-feedback errornama"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_dosen" class="col-sm-2 col-form-label">Nama Dosen Pengampu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control is-valid" id="nama_dosen" name="nama_dosen" placeholder="Masukkan Nama Dosen Pengampu Matakuliah" value="<?= $nama_dosen ?>">
                        <div class="valid-feedback errornama_dosen"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sks" class="col-sm-2 col-form-label">SKS</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control is-valid" id="sks" name="sks" placeholder="Masukkan Jumlah SKS Matakuliah" value="<?= $sks ?>">
                        <div class="valid-feedback errorsks"></div>
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
        $('.formmatakuliah').submit( function(e) {
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
                    // Panggil Fungsi Data Matakuliah Yang Berada Pada View Tampil Data
                    datamatkul();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>