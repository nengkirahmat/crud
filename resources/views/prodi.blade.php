@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Prodi</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="mb-2">
                                <button type="button" id="createNewProdi" class="btn btn-primary" data-toggle="modal"
                                    data-target="#success-header-modal"><i class="mdi mdi-plus-circle me-2"></i>
                                    Tambah</button>

                            </div>

                            <div class="table-responsive">
                                <table id="datatable" class="table table-centered w-100 dt-responsive nowrap table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Prodi</th>
                                            <th>Nama Prodi</th>
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
                    <h4 class="modal-title" id="success-header-modalLabel">Prodi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="prodiForm" name="prodiForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_prodi" id="id_prodi">

                        <div class="mb-2">
                            <label for="id_jurusan" class="control-label">Nama Jurusan</label>

                            <!-- Single Select -->
                            <select id="id_jurusan" name="id_jurusan" class="form-control select2">
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusan as $j)
                                    <option value="{{ $j->id }}">{{ $j->namaJurusan.' - '.$j->kodeJurusan }}</option>
                                @endforeach
                                </optgroup>
                            </select>

                        </div>

                        <div class="mb-2">
                            <label for="kode_prodi" class="col-sm-3 control-label">Kode Prodi</label>

                            <input type="text" class="form-control" id="kode_prodi" name="kode_prodi"
                                placeholder="Masukkan Kode Prodi" required="">

                        </div>

                        <div class="mb-2">
                            <label for="nama_prodi" class="col-sm-3 control-label">Nama Prodi</label>

                            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi"
                                placeholder="Masukkan Nama Prodi" required="">

                        </div>


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
                    url: "{{ url('/prodiTable') }}",
                    type: "POST",

                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kodeProdi',
                        name: 'kodeProdi'
                    },
                    {
                        data: 'namaProdi',
                        name: 'namaProdi'
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



            $('#createNewProdi').click(function() {
                $('#saveBtn').html("Simpan");
                $('#id_prodi').val('');
                $('#prodiForm').trigger("reset");
                $('#modelHeading').html("Tambah Prodi ");

                $('#ajaxModel').modal('show');
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                kode_prodi = $("#kode_prodi").val();
                nama_prodi = $("#nama_prodi").val();
                id = $('#id_prodi').val();
                file = $("#file").val();
                if (kode_prodi == '') {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Kode Prodi Tidak Boleh Kosong!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                } else if (nama_prodi == '') {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Nama Prodi Tidak Boleh Kosong!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                } else {


                    $(this).html('Menyimpan..');

                    var form = $('#prodiForm')[0];
                    var formData = new FormData(form);
                    $("#canvasloading").show();
                    $("#loading").show();
                    $.ajax({
                        data: formData,
                        url: "{{ url('/prodi/simpan') }}",
                        type: "POST",
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data.success == true) {

                                $('#prodiForm').trigger("reset");
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

            $('body').on('click', '.editProdi', function() {

                var id_prodi = $(this).data('id_prodi');
                $("#canvasloading").show();
                $("#loading").show();
                $.get("{{ url('/prodi') }}" + '/' + id_prodi + '/edit', function(data) {
                    $("#canvasloading").hide();
                    $("#loading").hide();
                    $('#modelHeading').html("Ubah Prodi ");
                    $('#saveBtn').html('Perbaharui');
                    $('#ajaxModel').modal('show');
                    $('#id_prodi').val(data.id);
                    $('#kode_prodi').val(data.kodeProdi);
                    $('#nama_prodi').val(data.namaProdi);
                    $('#id_jurusan').val(data.jurusan_id);

                })

            });

            $('body').on('click', '.deleteProdi', function() {
                var id_prodi = $(this).data("id_prodi");

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
                            url: "{{ url('/prodi/hapus') }}" + '/' + id_prodi,
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
