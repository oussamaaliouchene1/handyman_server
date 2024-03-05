<?php

namespace App\DataTables;

use App\Models\SaveCcpPaymentProof;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CcpPaymentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('image', function () {
                return view('handyman.image');
            })
            ->addColumn('duration', function () {
                return view('handyman.duration');
            })
            ->rawColumns(['image', 'duration']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SaveCcpPaymentProof $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SaveCcpPaymentProof $model)
    {
        $model =$model->where('status','pending');
        return [$model->list];
    }


  

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('image_path')
                ->title(__('messages.image')),
            Column::make('status')
                ->title(__('messages.status')),
            Column::make('duration')
                ->title(__('messages.duration')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'CcpPayment_' . date('YmdHis');
    }
}
