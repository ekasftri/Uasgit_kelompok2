<table class="table table-sm table-striped" id="databarang">
    <thead>
    <tr>
        <th>No</th>
        <th>kode_barang</th>
        <th>Nama pembeli</th>
            <th> merk</th>
        <th>warna </th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    <?php $nomor = 0;
    foreach ($tampildata as $row) : $nomor++; ?>
    <tr>
        <td><?= $nomor; ?></td>
        <td><?= $row['kode_barang']?></td>
        <td><?= $row['nama']?> </td> 
        <td><?= $row['merk']?></td>
        <td><?= $row['warna']?> </td>
        <td>
            <button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $row['id_barang'] ?>')"><i class="fa fa-tags"></i></button> 
                | <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $row['id_barang'] ?>')"><i class="fa fa-trash"></i></button></td>
    </tr>
    <?php endforeach; ?>
</tbody>
            </table>

<script>
    $(document).ready(function(){
        $('#databarang').DataTable();
    });

    function edit(id_barang) {
    $.ajax({
        type: "post",
        url: "<?= site_url('barang/formedit')?>",
        data: {
            id_barang : id_barang
        },
        dataType: "json",
        success: function(response){
            if(response.sukses){
                $('.viewmodal').html(response.sukses).show();
                $('#modaledit').modal('show'); // Pastikan selector modal edit diinisialisasi dengan #modaledit
            }
        },
        error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}
function hapus(id_barang){
    swal.fire({
        title: "hapus?",
        text:"Yakin Mau hapus?",
        icon:"warning",
        showCancelButton:true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor:"#d33",
        confirmButtonText:"Ya",
        cancelmButtonText:'Tidak',
    }).then((result)=>{
        if(result.isConfirmed){
            $.ajax({
                type: "post",
                url: "<?= site_url('barang/hapus')?>",
                data: {
            id_barang : id_barang
        },
        dataType: "json",
        success: function(response){
            if(response.sukses){
                swal.fire({
                    icon: "success",
                    title:"Berhasil",
                    text: response.sukses,
                })
                    databarang();
                
            }
        },
        error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
            });
        }
    })
}

</script>

