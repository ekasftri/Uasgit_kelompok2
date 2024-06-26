<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('barang/simpandata', ['class' => 'formbarang']) ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="kode_barang" class="col-sm-2 col-form-label">kode_barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control is-valid" id="kode_barang" name="kode_barang" placeholder="Masukan kode_barang">
                        <div class="invalid-feedback errorkode_barang"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">NAMA</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control is-valid" id="nama" name="nama" placeholder="Masukan Nama">
                        <div class="invalid-feedback errornama"></div>
                    </div>
                </div>
                <div class="form-group row">
                   
                   <label for="merk" class="col-sm-2 col-form-label"> merk</label>
                   <div class="col-sm-10">
                       <select name="merk" id="merk" class="form-control is-valid">
                           <option value="">------Silahkan Pilih------</option>
                           <option value="samsung">samsung</option>
                           <option value="oppo">oppo</option>
                           <option value="vivo">vivo</option>
                           <option value="infinix">infinix</option>
                           <option value="apple">apple</option>
                       </select>
                       <div class="invalid-feedback errorwarna"></div>
                   
               </div>
           </div>
               
                <div class="form-group row">
                    <label for="merk" class="col-sm-2 col-form-label">warna</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control is-valid" id="warna" name="warna" placeholder="Masukan warna">
                        <div class="invalid-feedback errormerk"></div>
                    </div></div>
                   
                    
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
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
                    $('.btnsimpan').attr('disabled', 'disabled');
                    $('.btnsimpan').html('<i class="bi bi-arrow-repeat"></i>');
                },
                complete: function(){
                    $('.btnsimpan').removeAttr('disabled');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response){
                    //validasi
                    if(response.error){
                        if(response.error.kode_barang){
                            $('#kode_barang').addClass('is-invalid');
                            $('.errorkode_barang').html(response.error.kode_barang);
                        } else {
                            $('#kode_barang').removeClass('is-invalid');
                            $('.errorkode_barang').html('');
                        }

                        if(response.error.nama){
                            $('#nama').addClass('is-invalid');
                            $('.errornama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errornama').html('');
                        }

                        if(response.error.merk){
                            $('#merk').addClass('is-invalid');
                            $('.errormerk').html(response.error.merk);
                        } else {
                            $('#merk').removeClass('is-invalid');
                            $('.errormerk').html('');
                        }

                        if(response.error.warna){
                            $('#warna').addClass('is-invalid');
                            $('.errorwarna').html(response.error.warna);
                        } else {
                            $('#warna').removeClass('is-invalid');
                            $('.errorwarna').html('');
                        }
                    } else {

                    //jika valid
                    Swal.fire({
                    title: "Berhasill!!!",
                    icon: "success",
                    text: response.sukses,
                    });
                        // jika tidak ada error, modal akan ditutup
                        $('#modaltambah').modal('hide');
                       databarang();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>
