<?php

namespace Modules\Product\DataTables;

use Modules\Product\Entities\Product;
use App\Models\Test;


use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('product::products.partials.actions', compact('data'));
            });
    }

    public function query(Test $model)
    {
        return $model->whereIn('hubSerial', $this->hubs)->groupBy('dateString')->groupBy('hubSerial')->groupBy('testType')->distinct('dateString');
    }

    public function html()
    {
        
        return $this->builder()
                    ->setTableId('test-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
                    ->orderBy(1)
                    ->buttons(
                        Button::make('excel')
                            ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                        Button::make('print')
                            ->text('<i class="bi bi-printer-fill"></i> Print'),
                        Button::make('reset')
                            ->text('<i class="bi bi-x-circle"></i> Reset'),
                        Button::make('reload')
                            ->text('<i class="bi bi-arrow-repeat"></i> Reload')
                    );
    }

    protected function getColumns()
    {
        return [

            Column::make('hubSerial')
                ->title('Hub Serial')
                ->className('text-center align-middle'),

            Column::make('dateString')
                ->title('Date')
                ->className('text-center align-middle'),
            Column::make('testType')
                ->title('Type')
                ->className('text-center align-middle'),



            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Tests_' . date('YmdHis');
    }
}
