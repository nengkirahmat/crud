<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class JurusanController extends Controller
{

    public function index(Request $request)
    {
        $jurusan = Jurusan::orderBy('created_at', 'DESC')->get();
        if ($request->ajax()) {
            return Datatables::of($jurusan)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn = "";

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id_jurusan="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-xs editJurusan"> <i class="mdi mdi-square-edit-outline"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id_jurusan="' . $row->id . '" data-status="trash" data-original-title="Delete" class="btn btn-danger btn-xs deleteJurusan"> <i class="mdi mdi-delete"></i></a>';


                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('jurusan', compact('jurusan'));
    }



    public function store(Request $request)
    {

        $save = Jurusan::updateOrCreate([
            'id' => $request->id_jurusan
        ], [
            'kodeJurusan' => $request->kode_jurusan,
            'namaJurusan' => $request->nama_jurusan,
        ]);
        if(!empty($request->id_jurusan)){
        Prodi::where('jurusan_id', $request->id_jurusan)->delete();
        }
        $namaProdi = $request->namaProdi;
        $index = 0;
        foreach ($request->kodeProdi as $k) {

            Prodi::updateOrCreate([
                'kodeProdi' => $k,
             ],[
                'namaProdi' => $namaProdi[$index],
                'jurusan_id' => $save->id,
            ]);

            $index++;
        }


        // return response
        $response = [
            'success' => true,
            'message' => 'Berhasil Disimpan.',
        ];
        return response()->json($response, 200);
    }

    public function edit($id)
    {
        $jurusan = Jurusan::find($id);
        return response()->json($jurusan);
    }

    public function delete($id)
    {
        Prodi::where('jurusan_id', $id)->delete();
        Jurusan::find($id)->delete();
        $response = [
            'success' => true,
            'message' => 'Berhasil Dihapus.',
        ];
        return response()->json($response, 200);
    }
}
