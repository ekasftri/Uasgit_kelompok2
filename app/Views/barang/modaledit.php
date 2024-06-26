<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('barang/updatedata', ['class' => 'formbarang']) ?>
            <?= csrf_field(); 
            // var_dump($id_barang);
            // exit;
            foreach ($row as $row) {
            ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="kode_barang" class="col-sm-2 col-form-label">kode_barang</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control is-valid" id="id_barang"
                         name="id_barang" placeholder="Masukan id"
                        value="<?= $row['id_barang'] ?>" readonly>
                        <input type="text" class="form-control is-valid" id="kode_barang" name="kode_barang" placeholder="Masukan kode_barang"
                        value="<?= $row['kode_barang'] ?>" readonly>
                      </div>
                    </div>
               
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">NAMA</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control is-valid" id="nama" name="nama" placeholder="Masukan nama"
                        value="<?= $row['nama'] ?>" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="merk" class="col-sm-2 col-form-label">merk</label>
                    <div class="col-sm-10">
                        <select name="merk" id="merk" class="form-control is-valid">
                            <option value="samsung" <?php if (($row['merk']) == 'samsung') echo 
                            "selected"; ?>>samsung</option>
                            <option value="oppo" <?php if (($row['merk']) == 'oppo') echo
                             "selected"; ?>>oppo</option>
                              <option value="vivo" <?php if (($row['merk']) == 'vivo') echo
                             "selected"; ?>>vivo</option>
                              <option value="infinix" <?php if (($row['merk']) == 'infinix') echo
                             "selected"; ?>>infinix</option>
                              <option value="apple" <?php if (($row['merk']) == 'apple') echo
                             "selected"; ?>>apple</option>
                        </select>
                    </div>
                </div>
               
            </div>
                <div class="form-group row">
                    <label for="warna" class="col-sm-2 col-form-label">warna</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control is-valid" id="warna" name="warna" placeholder="Masukan warna"
                        value="<?= $row['warna'] ?>" >
                  
                    </div>
                </div>

               
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan" id="tombolsimpan">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?php
            }
            ?>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div class="position-fixed align-items-center" style="position :absolute; top: 50%
left: 50%;">
<div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
    <div class="toast-header">
        <strong class="mr-auto">Simpan</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Data berhasil disimpam!!
    </div>
</div>
</div>
<script>
    $(document).ready(function(){
        $('.formbarang').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(){
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="bi bi-arrow-repeat"></i>');
                },
                complete: function(){
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Update');
                },
                success: function(response){
                
                    Swal.fire({
                    title: "Berhasill!!!",
                    icon: "success",
                    text: response.sukses,
                    });
                        // jika tidak ada error, modal akan ditutup
                        $('#modaledit').modal('hide');
                       databarang();
                    
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>
