<table class="table table-sm table-striped" id="datamatkul">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Matakuliah</th>
            <th>Nama Matakuliah</th>
            <th>Nama Dosen Pengampu</th>
            <th>SKS</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 0;
        foreach ($tampildata as $row) : $nomor++; ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><?= $row['kode_matkul'] ?></td>
                <td><?= $row['nama_matkul'] ?></td>
                <td><?= $row['nama_dosen'] ?></td>
                <td><?= $row['sks'] ?></td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $row['id_matkul'] ?>')">Edit</button> |
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $row['id_matkul'] ?>')">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>  
    </tbody>
</table>
<script>
$(document).ready(function() {
    $('#datamatkul').DataTable(); // Initialize DataTable
});

function edit(id_matkul){
    $.ajax({
        type: "post",
        url: "<?= site_url('matakuliah/formedit') ?>",
        data: {
            id_matkul: id_matkul
        },
        dataType: "json",
        success: function(response) {
            if (response.sukses){
                $('.viewmodal').html(response.sukses).show();
                $('#modaledit').modal('show');
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

function hapus(id_matkul) {
    Swal.fire({
        title: "Hapus ?",
        text: "Apakah Anda Yakin Ingin Menghapus Data Ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "<?= site_url('matakuliah/hapus') ?>",
                data: {
                    id_matkul: id_matkul
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.sukses,
                        })
                        datamatkul();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
            });
        }
    });
}
</script>