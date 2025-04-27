<?php

namespace App\DataTables;

use App\Models\PenjualanModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PenjualanDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) { // menambahkan kolom aksi
                $btn = '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id) . '/show_ajax' . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->setRowId('penjualan_id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PenjualanModel $model): QueryBuilder
    {
        return $model->select(
            'penjualan_id',
            'user_id',
            'pembeli',
            'penjualan_kode',
            'penjualan_tanggal'
        )
            ->with('user');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('penjualan-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('penjualan_id'),
            Column::make('user_id'),
            Column::make('pembeli'),
            Column::make('penjualan_kode'),
            Column::make('penjualan_tanggal'),
            Column::make('aksi')->exportable(false)->printable(false)->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Penjualan_' . date('YmdHis');
    }
}