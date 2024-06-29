<table class="table table-sm table-striped" id="datadosen">
    <thead>
        <tr>
            <th>No</th>
            <th>NIDN</th>
            <th>Nama Dosen</th>
            <th>Tempat - Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Tanggal Entry</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 0;
        foreach ($tampildata as $row) : $nomor++; ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><?= $row['nidn'] ?></td>
                <td><?= $row['nama_dosen'] ?></td>
                <td><?= $row['tempat_lahir'] ?> - <?= $row['tanggal_lahir'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['tanggal_entry'] ?></td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $row['id_dosen'] ?>')">Edit</button> |
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $row['id_dosen'] ?>')">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>  
    </tbody>
</table>
<script>
$(document).ready(function() {
    $('#datadosen').DataTable(); // Initialize DataTable
});

function edit(id_dosen){
    $.ajax({
        type: "post",
        url: "<?= site_url('Dosen/formedit') ?>",
        data: {
            id_dosen: id_dosen
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

function hapus(id_dosen) {
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
                url: "<?= site_url('dosen/hapus') ?>",
                data: {
                    id_dosen: id_dosen
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.sukses,
                        })
                        datadosen();
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