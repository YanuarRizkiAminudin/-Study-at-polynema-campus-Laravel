<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use App\DataTables\PenjualanDataTable;
use App\Models\BarangModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object)[
            'title' => 'Daftar penjualan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function indexSelf()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan Sendiri']
        ];

        $page = (object)[
            'title' => 'Daftar penjualan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'penjualan_self';

        return view('penjualan.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'self' => true
        ]);
    }

    public function list(PenjualanDataTable $dataTable)
    {
        return $dataTable->render();
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah penjualan baru'
        ];

        $activeMenu = 'penjualan';
        $user = UserModel::all();
        $barang = BarangModel::all();

        return view('penjualan.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'barang' => $barang,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create_ajax()
    {
        $user = UserModel::all();
        $barang = BarangModel::all();

        return view('penjualan.create_ajax', [
            'user' => $user,
            'barang' => $barang
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'penjualan_kode' => 'required|string|max:20|unique:t_penjualan,penjualan_kode',
            'penjualan_tanggal' => 'required|date',
            'barang_nama' => 'required|array',
            'barang_nama.*' => 'required|string|max:50',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        $pembeli = UserModel::find($request->user_id)->nama;
        $penjualan = PenjualanModel::create([
            'user_id' => $request->user_id,
            'pembeli' => $pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);

        foreach ($request->barang_nama as $key => $barang_nama) {
            $barang_id = BarangModel::where('barang_nama', $barang_nama)->first()->barang_id;
            $harga = BarangModel::where('barang_id', $barang_id)->first()->harga_jual;

            $stok = StokModel::where('barang_id', $barang_id)->first();
            if (!empty($stok) && $request->kurangi_stok) {
                $stok->update([
                    'stok_jumlah' => $stok->stok_jumlah - $request->jumlah[$key]
                ]);
            }

            PenjualanDetailModel::create([
                'penjualan_id' => $penjualan->penjualan_id,
                'barang_id' => $barang_id,
                'jumlah' => $request->jumlah[$key],
                'harga' => $harga
            ]);
        }

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil disimpan');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'user_id' => 'required|integer',
                'penjualan_kode' => 'required|string|max:20|unique:t_penjualan,penjualan_kode',
                'penjualan_tanggal' => 'required|date',
                'barang_nama' => 'required|array',
                'barang_nama.*' => 'required|string|max:50',
                'jumlah' => 'required|array',
                'jumlah.*' => 'required|integer|min:1',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            try {
                $pembeli = UserModel::find($request->user_id)->nama;
                $penjualan = PenjualanModel::create([
                    'user_id' => $request->user_id,
                    'pembeli' => $pembeli,
                    'penjualan_kode' => $request->penjualan_kode,
                    'penjualan_tanggal' => $request->penjualan_tanggal,
                ]);

                foreach ($request->barang_nama as $key => $barang_nama) {
                    $barang_id = BarangModel::where('barang_nama', $barang_nama)->first()->barang_id;
                    $harga = BarangModel::where('barang_id', $barang_id)->first()->harga_jual;

                    $stok = StokModel::where('barang_id', $barang_id)->first();
                    if (!empty($stok) && $request->kurangi_stok) {
                        $stok->update([
                            'stok_jumlah' => $stok->stok_jumlah - $request->jumlah[$key]
                        ]);
                    }

                    PenjualanDetailModel::create([
                        'penjualan_id' => $penjualan->penjualan_id,
                        'barang_id' => $barang_id,
                        'jumlah' => $request->jumlah[$key],
                        'harga' => $harga
                    ]);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data penjualan berhasil disimpan'
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data penjualan gagal disimpan'
                ]);
            }
        }
    }

    public function show(string $id)
    {
        $penjualan = PenjualanModel::with('user')->find($id);
        $detail = PenjualanDetailModel::with('barang')->where('penjualan_id', $id)->get();

        $breadcrumb = (object) [
            'title' => 'Detail penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'penjualan' => $penjualan,
            'detail' => $detail,
            'activeMenu' => $activeMenu
        ]);
    }

    public function show_ajax(string $id)
    {
        $penjualan = PenjualanModel::with('user')->find($id);
        $detail = PenjualanDetailModel::with('barang')->where('penjualan_id', $id)->get();

        return view('penjualan.show_ajax', [
            'penjualan' => $penjualan,
            'detail' => $detail,
        ]);
    }

    public function edit(string $id)
    {
        $penjualan = PenjualanModel::with('user')->find($id);
        $penjualanDetail = PenjualanDetailModel::with('barang')->where('penjualan_id', $id)->get();
        $user = UserModel::all();
        $barang = BarangModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'penjualan' => $penjualan,
            'penjualanDetail' => $penjualanDetail,
            'barang' => $barang,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit_ajax(string $id)
    {
        $penjualan = PenjualanModel::with('user')->find($id);
        $penjualanDetail = PenjualanDetailModel::with('barang')->where('penjualan_id', $id)->get();
        $user = UserModel::all();
        $barang = BarangModel::all();

        return view('penjualan.edit_ajax', [
            'penjualan' => $penjualan,
            'penjualanDetail' => $penjualanDetail,
            'barang' => $barang,
            'user' => $user
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'penjualan_kode' => 'required|string|max:20|unique:t_penjualan,penjualan_kode,' . $id . ',penjualan_id',
            'penjualan_tanggal' => 'required|date',
            'barang_nama' => 'required|array',
            'barang_nama.*' => 'required|string|max:50',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        $pembeli = UserModel::find($request->user_id)->nama;
        $penjualan = PenjualanModel::find($id);
        $penjualan->update([
            'user_id' => $request->user_id,
            'pembeli' => $pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);

        $penjualanDetail = PenjualanDetailModel::where('penjualan_id', $id)->get();
        $barangIdArray = [];
        foreach ($request->barang_nama as $key => $barang_nama) {
            $barang_id = BarangModel::where('barang_nama', $barang_nama)->first()->barang_id;
            $harga = BarangModel::where('barang_id', $barang_id)->first()->harga_jual;
            $barangIdArray[] = $barang_id;
            $check = $penjualanDetail->where('barang_id', $barang_id)->first();
            if ($check) {
                $check->update([
                    'penjualan_id' => $penjualan->penjualan_id,
                    'barang_id' => $barang_id,
                    'jumlah' => $request->jumlah[$key],
                    'harga' => $harga
                ]);
            } else {
                PenjualanDetailModel::create([
                    'penjualan_id' => $penjualan->penjualan_id,
                    'barang_id' => $barang_id,
                    'jumlah' => $request->jumlah[$key],
                    'harga' => $harga
                ]);
            }
        }

        foreach ($penjualanDetail as $detail) {
            if (!in_array($detail->barang_id, $barangIdArray)) {
                $detail->delete();
            }
        }

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah');
    }

    public function update_ajax(Request $request, string $id)
    {
        $rules = [
            'user_id' => 'required|integer',
            'penjualan_kode' => 'required|string|max:20|unique:t_penjualan,penjualan_kode,' . $id . ',penjualan_id',
            'penjualan_tanggal' => 'required|date',
            'barang_nama' => 'required|array',
            'barang_nama.*' => 'required|string|max:50',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'msgField' => $validator->errors()
            ]);
        }

        try {
            $pembeli = UserModel::find($request->user_id)->nama;
            $penjualan = PenjualanModel::find($id);
            $penjualan->update([
                'user_id' => $request->user_id,
                'pembeli' => $pembeli,
                'penjualan_kode' => $request->penjualan_kode,
                'penjualan_tanggal' => $request->penjualan_tanggal,
            ]);

            $penjualanDetail = PenjualanDetailModel::where('penjualan_id', $id)->get();
            $barangIdArray = [];
            foreach ($request->barang_nama as $key => $barang_nama) {
                $barang_id = BarangModel::where('barang_nama', $barang_nama)->first()->barang_id;
                $harga = BarangModel::where('barang_id', $barang_id)->first()->harga_jual;
                $barangIdArray[] = $barang_id;
                $check = $penjualanDetail->where('barang_id', $barang_id)->first();
                if ($check) {
                    $check->update([
                        'penjualan_id' => $penjualan->penjualan_id,
                        'barang_id' => $barang_id,
                        'jumlah' => $request->jumlah[$key],
                        'harga' => $harga
                    ]);
                } else {
                    PenjualanDetailModel::create([
                        'penjualan_id' => $penjualan->penjualan_id,
                        'barang_id' => $barang_id,
                        'jumlah' => $request->jumlah[$key],
                        'harga' => $harga
                    ]);
                }
            }

            foreach ($penjualanDetail as $detail) {
                if (!in_array($detail->barang_id, $barangIdArray)) {
                    $detail->delete();
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Data penjualan berhasil diubah'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data penjualan gagal diubah'
            ]);
        }
    }

    public function destroy(string $id)
    {
        $checkPenjualan = PenjualanModel::find($id);

        if (!$checkPenjualan) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            PenjualanDetailModel::where('penjualan_id', $id)->delete();
            PenjualanModel::destroy($id);
            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function confirm_ajax(string $id)
    {
        $penjualan = PenjualanModel::with('user')->find($id);
        $detail = PenjualanDetailModel::with('barang')->where('penjualan_id', $id)->get();

        return view('penjualan.confirm_ajax', [
            'penjualan' => $penjualan,
            'detail' => $detail,
        ]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $penjualan = PenjualanModel::find($id);

            if ($penjualan) {
                try {
                    PenjualanDetailModel::where('penjualan_id', $id)->delete();
                    $penjualan->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data tidak bisa dihapus'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function import()
    {
        return view('penjualan.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_penjualan' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_penjualan');
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);
            $insertDetail = [];

            if (count($data) > 1) {
                try {
                    $kodePenjualan = '';
                    foreach ($data as $baris => $value) {
                        if ($baris > 1) {  // skip header
                            if ($kodePenjualan != $value['A']) {

                                if (PenjualanModel::where('penjualan_kode', $value['A'])->first()) {
                                    continue;
                                }

                                // Konversi tanggal
                                $tanggalExcel = $value['B'];
                                if (is_numeric($tanggalExcel)) {
                                    $tanggal = Carbon::instance(Date::excelToDateTimeObject($tanggalExcel))->format('Y-m-d H:i:s');
                                } else {
                                    $tanggal = Carbon::parse($tanggalExcel)->format('Y-m-d H:i:s');
                                }

                                $penjualan = PenjualanModel::create([
                                    'penjualan_kode' => $value['A'],
                                    'penjualan_tanggal' => $tanggal,
                                    'pembeli' => $value['C'],
                                    'user_id' => $value['D'],
                                    'created_at' => now(),
                                    'updated_at' => now()
                                ]);

                                $kodePenjualan = $value['A'];
                            }

                            $insertDetail[] = [
                                'penjualan_id' => $penjualan->penjualan_id,
                                'barang_id' => $value['E'],
                                'jumlah' => $value['F'],
                                'harga' => $value['G'],
                                'created_at' => now(),
                                'updated_at' => now()
                            ];
                        }
                    }

                    if (count($insertDetail) > 0) {
                        PenjualanDetailModel::insertOrIgnore($insertDetail);
                    }

                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil diimport'
                    ]);
                } catch (Exception $e) {
                    return response()->json([
                        'status' => false,
                        'message' => $e->getMessage()
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }

    public function export_excel()
    {
        $penjualan = PenjualanModel::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Penjualan');
        $sheet->setCellValue('C1', 'Tanggal Penjualan');
        $sheet->setCellValue('D1', 'Pembeli');
        $sheet->setCellValue('E1', 'User ID');
        $sheet->setCellValue('F1', 'Barang ID');
        $sheet->setCellValue('G1', 'Jumlah');
        $sheet->setCellValue('H1', 'Harga');
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);

        $no = 1;
        $baris = 2;
        foreach ($penjualan as $item) {
            $details = PenjualanDetailModel::where('penjualan_id', $item->penjualan_id)->get();
            foreach ($details as $detail) {
                $sheet->setCellValue('A' . $baris, $no);
                $sheet->setCellValue('B' . $baris, $item->penjualan_kode);
                $sheet->setCellValue('C' . $baris, $item->penjualan_tanggal);
                $sheet->setCellValue('D' . $baris, $item->pembeli);
                $sheet->setCellValue('E' . $baris, $item->user_id);
                $sheet->setCellValue('F' . $baris, $detail->barang_id);
                $sheet->setCellValue('G' . $baris, $detail->jumlah);
                $sheet->setCellValue('H' . $baris, $detail->harga);
                $baris++;
                $no++;
            }
        }

        foreach (range('A', 'H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Penjualan');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Penjualan ' . date('Y-m-d H:i:s') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, dMY H:i:s') . 'GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $writer->save('php://output');
        exit;
    }

    public function export_pdf()
    {
        $penjualanModel = PenjualanModel::all();
        $penjualan =  [];
        foreach ($penjualanModel as $item) {
            $details = PenjualanDetailModel::where('penjualan_id', $item->penjualan_id)->get();
            foreach ($details as $detail) {
                $penjualan[] = (object) [
                    'penjualan_kode' => $item->penjualan_kode,
                    'penjualan_tanggal' => $item->penjualan_tanggal,
                    'pembeli' => $item->pembeli,
                    'barang_nama' => $detail->barang->barang_nama,
                    'jumlah' => $detail->jumlah,
                    'harga' => $detail->harga
                ];
            }
        }

        $pdf = Pdf::loadView('penjualan.export_pdf', ['penjualan' => $penjualan]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url 
        $pdf->render();
        return $pdf->stream('Data Barang ' . date('Y-m-d H:i:s') . '.pdf');
    }
}