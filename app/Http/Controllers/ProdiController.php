<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller
{

    public function index(Request $request)
    {
        $prodi = Prodi::orderBy('created_at', 'DESC')->get();
        if ($request->ajax()) {
            return Datatables::of($prodi)
                ->addIndexColumn()
                ->addColumn('namaJurusan', function ($row) {
                    $namaJurusan = '';
                    if (!empty($row->jurusan->namaJurusan)) {
                        $namaJurusan = $row->jurusan->namaJurusan;
                    }
                    return $namaJurusan;
                })
                ->addColumn('action', function ($row) {
                    $btn = "";

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id_prodi="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-xs editProdi"> <i class="mdi mdi-square-edit-outline"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id_prodi="' . $row->id . '" data-status="trash" data-original-title="Delete" class="btn btn-danger btn-xs deleteProdi"> <i class="mdi mdi-delete"></i></a>';


                    return $btn;
                })
                ->rawColumns(['namaJurusan', 'action'])
                ->make(true);
        }


        $jurusan = Jurusan::orderBy('namaJurusan', 'ASC')->get();

        return view('prodi', compact('prodi', 'jurusan'));
    }



    public function store(Request $request)
    {
        Prodi::updateOrCreate([
            'id' => $request->id_prodi
        ], [
            'kodeProdi' => $request->kode_prodi,
            'namaProdi' => $request->nama_prodi,
            'jurusan_id' => $request->id_jurusan_prodi,
        ]);

        // return response
        $response = [
            'success' => true,
            'message' => 'Berhasil Disimpan.',
        ];
        return response()->json($response, 200);
    }

    public function edit($id)
    {
        $prodi = Prodi::find($id);
        return response()->json($prodi);
    }

    public function delete($id)
    {

        Prodi::find($id)->delete();
        $response = [
            'success' => true,
            'message' => 'Berhasil Dihapus.',
        ];

        return response()->json($response, 200);
    }


    public function getData($id)
    {
        $prodi = Prodi::where('jurusan_id', $id)->get();
        foreach ($prodi as $p) {
?>
            <div id="inputFormRow">
                <div class="input-group mb-3">
                    <div class="col-3"><input type="text" name="kodeProdi[]" class="form-control m-input" value="<?= $p->kodeProdi ?>" placeholder="Kode Prodi" autocomplete="off"></div>
                    <div class="col-7"><input type="text" name="namaProdi[]" class="form-control m-input" value="<?= $p->namaProdi ?>" placeholder="Nama Prodi" autocomplete="off"></div>
                    <div class="col-2">
                        <div class="input-group-append">
                            <button id="removeRow" type="button" class="btn btn-danger">X</button>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    }
}
?>