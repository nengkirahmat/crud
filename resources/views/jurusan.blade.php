@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Jurusan</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="mb-2">
                                <button type="button" id="createNewJurusan" class="btn btn-primary" data-toggle="modal"
                                    data-target="#success-header-modal"><i class="mdi mdi-plus-circle me-2"></i>
                                    Tambah</button>

                            </div>

                            <div class="table-responsive">
                                <table id="datatable" class="table table-centered w-100 dt-responsive nowrap table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Jurusan</th>
                                            <th>Nama Jurusan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Success Header Modal -->

    <div id="ajaxModel" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="success-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-success">
                    <h4 class="modal-title" id="success-header-modalLabel">Jurusan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="jurusanForm" name="jurusanForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_jurusan" id="id_jurusan">

                        <div class="mb-2">
                            <label for="kode_jurusan" class="col-sm-3 control-label">Kode Jurusan</label>

                            <input type="text" class="form-control" id="kode_jurusan" name="kode_jurusan"
                                placeholder="Masukkan Kode Jurusan" required="">

                        </div>

                        <div class="mb-2">
                            <label for="nama_jurusan" class="col-sm-3 control-label">Nama Jurusan</label>

                            <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan"
                                placeholder="Masukkan Nama Jurusan" required="">

                        </div>
                        <button id="addRow" type="button" class="btn btn-sm btn-info">Tambah Prodi</button>
                        <h4>Daftar Progran Studi</h4>

                        <div id="listProdi">
                        
                            <div id="inputFormRow">
                                <div class="input-group mb-3">
                                    <div class="col-3">
                                        <input type="text" name="kodeProdi[]" class="form-control m-input"
                                            placeholder="Kode Prodi" autocomplete="off">
                                    </div>
                                    <div class="col-7">
                                        <input type="text" name="namaProdi[]" class="form-control m-input"
                                            placeholder="Nama Prodi" autocomplete="off">
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-append">
                                            <button id="removeRow" type="button" class="btn btn-danger">X</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="newRow"></div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->






    <script type="text/javascript">
        $(document).ready(function() {
            //ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $("#addRow").click(function() {
                var html = '';
                html += '<div id="inputFormRow">';
                html += '<div class="input-group mb-3">';
                html +=
                    '<div class="col-3"><input type="text" name="kodeProdi[]" class="form-control m-input" placeholder="Kode Prodi" autocomplete="off"></div>';
                html +=
                    '<div class="col-7"><input type="text" name="namaProdi[]" class="form-control m-input" placeholder="Nama Prodi" autocomplete="off"></div>';
                html += '<div class="col-2"><div class="input-group-append">';
                html += '<button id="removeRow" type="button" class="btn btn-danger">X</button>';
                html += '</div></div>';
                html += '</div>';

                $('#newRow').append(html);
            });

            // remove row
            $(document).on('click', '#removeRow', function() {
                $(this).closest('#inputFormRow').remove();
            });

            // datatable
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                retrieve: true,
                paging: true,
                destroy: true,
                "scrollX": false,
                ajax: {
                    url: "{{ url('/jurusanTable') }}",
                    type: "POST",

                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kodeJurusan',
                        name: 'kodeJurusan'
                    },
                    {
                        data: 'namaJurusan',
                        name: 'namaJurusan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });






            $('#createNewJurusan').click(function() {
                $('#saveBtn').html("Simpan");
                $('#id_jurusan').val('');
                $('#newRow').html('');
                $("#listProdi").html('');
                $('#jurusanForm').trigger("reset");
                $('#modelHeading').html("Tambah Jurusan ");
                $('#ajaxModel').modal('show');
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                kode_jurusan = $("#kode_jurusan").val();
                nama_jurusan = $("#nama_jurusan").val();
                id = $('#id_jurusan').val();
                file = $("#file").val();
                if (kode_jurusan == '') {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Kode Jurusan Tidak Boleh Kosong!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                } else if (nama_jurusan == '') {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Nama Jurusan Tidak Boleh Kosong!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                } else {


                    $(this).html('Menyimpan..');

                    var form = $('#jurusanForm')[0];
                    var formData = new FormData(form);
                    $("#canvasloading").show();
                    $("#loading").show();
                    $.ajax({
                        data: formData,
                        url: "{{ url('/jurusan/simpan') }}",
                        type: "POST",
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data.success == true) {

                                $('#jurusanForm').trigger("reset");
                                $('#ajaxModel').modal('hide');
                                table.draw();
                                $('#saveBtn').html('Simpan');
                                $("#canvasloading").hide();
                                $("#loading").hide();
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Data Berhasil Disimpan!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                })
                            } else {
                                $('#saveBtn').html('Simpan');
                                $("#canvasloading").hide();
                                $("#loading").hide();
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.message,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                })
                            }
                        },
                        error: function(xhr) {
                            var res = xhr.responseJSON;
                            if ($.isEmptyObject(res) == false) {
                                err = '';
                                $.each(res.errors, function(key, value) {
                                    err += value + ', ';
                                });
                                $('#saveBtn').html('Simpan');
                                $("#canvasloading").hide();
                                $("#loading").hide();
                                Swal.fire({
                                    title: 'Error!',
                                    text: err,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                })
                            }
                        }
                    });
                }
            });

            $('body').on('click', '.editJurusan', function() {
                $("#newRow").html('');
                $("#listProdi").html('');
                var id_jurusan = $(this).data('id_jurusan');
                $("#canvasloading").show();
                $("#loading").show();
                $.get("{{ url('/jurusan') }}" + '/' + id_jurusan + '/edit', function(data) {
                    $("#canvasloading").hide();
                    $("#loading").hide();
                    $('#modelHeading').html("Ubah Jurusan ");
                    $('#saveBtn').html('Perbaharui');
                    $('#ajaxModel').modal('show');
                    $('#id_jurusan').val(id_jurusan);
                    $('#kode_jurusan').val(data.kodeJurusan);
                    $('#nama_jurusan').val(data.namaJurusan);
                    if(id_jurusan!=''){
                    $("#listProdi").load('/prodi/get' + '/' + id_jurusan);
                    }
                })

            });

            $('body').on('click', '.deleteJurusan', function() {
                var id_jurusan = $(this).data("id_jurusan");

                swal.fire({
                    title: "Yakin hapus data ini?",
                    text: '',
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Hapus Data!",
                    cancelButtonText: "Batal!",
                    closeOnConfirm: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#canvasloading").show();
                        $("#loading").show();
                        $.ajax({
                            type: "get",
                            url: "{{ url('/jurusan/hapus') }}" + '/' + id_jurusan,
                            success: function(data) {
                                if (data.success == true) {
                                    table.draw();
                                    tableTrashed.draw();
                                    $("#canvasloading").hide();
                                    $("#loading").hide();
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    })
                                } else {
                                    table.draw();
                                    tableTrashed.draw();
                                    $("#canvasloading").hide();
                                    $("#loading").hide();
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: data.message,
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    })
                                }
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                $("#canvasloading").hide();
                                $("#loading").hide();
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi Kesalahan',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                })
                            }
                        });

                    }

                });


            });


        });
    </script>
@endsection
