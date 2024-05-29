<?php

namespace Modules\Product\DataTables;

use Modules\Product\Entities\Category;
use App\Models\Test;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductCategoriesDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query);
    }

    public function query(Test $model) {
        return $model->whereIn('hubSerial', $this->hubs);
    }

    public function html() {
        return $this->builder()
            ->setTableId('test-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(4)
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

    protected function getColumns() {
        return [
            Column::make('hubSerial')
                ->title('Hub Serial')
                ->className('text-center align-middle'),
            Column::make('deviceSerial')
                ->title('Device Serial')
                ->className('text-center align-middle'),

            Column::make('dateString')
                ->title('Date')
                ->className('text-center align-middle'),
            Column::make('testType')
                ->title('Type')
                ->className('text-center align-middle'),
            Column::make('testResult')
                ->title('Result')
                ->className('text-center align-middle'),


        ];
    }

    protected function filename() {
        return 'DeviceTests_' . date('YmdHis');
    }
}
