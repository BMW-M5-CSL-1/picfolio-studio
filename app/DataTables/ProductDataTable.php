<?php

namespace App\DataTables;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $columns = array_column($this->getColumns(), 'data');
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($model) {
                return  '<div class="d-flex justify-content-cetner align-items-center">
                    <div class="btn-group">
                        <button class="btn btn-flat-primary custom_dotted" type="button" id="dropdownMenuButton100"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span><i class="ti ti-dots-vertical" style="font-size: 21px;"></i></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton100" id="">
                            <div id="dropDownMenu_">' . view('app.product.action', ['model' => $model,]) . '
                            </div>
                        </div>
                    </div>
                </div>';
            })
            ->editColumn('description', function ($model) {
                if (strlen($model->description) > 20) {
                    $span = '<span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="tooltip-primary"
                        data-bs-title="' . $model->description . '">';
                    return $span . substr($model->description, 0, 20) . ' ...</span>';
                }
                return $model->description ?? '-';
            })
            ->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->toDayDateTimeString();
            })
            ->addIndexColumn()
            ->rawColumns(array_merge($columns, ['status', 'arieal_view', 'created_at', 'action']))
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        $buttons = [];
        if (Auth::user()->can('product.create')) {
            $buttons[] = [
                Button::make()->text('<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Create</span>')->addClass('add-new btn btn-sm btn-primary ms-3')
                    ->attr([
                        'onClick' => 'create()',
                    ]),
            ];
        }
        return $this->builder()
            // ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom(
                '<"row me-2"' .
                    '<"col-md-2"<"me-3"l>>' .
                    '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' .
                    '>t' .
                    '<"row mx-2"' .
                    '<"col-sm-12 col-md-6"i>' .
                    '<"col-sm-12 col-md-6"p>' .
                    '>'
            )
            ->processing(false)
            ->serverSide(true)
            ->scrollX()
            ->scrollY('1000px')
            // ->fixedColumns()
            // ->fixedColumnsLeftColumns(2)
            ->searchDelay(900)
            ->lengthMenu([30, 50, 100])
            ->select([
                'style' => 'multi',
            ])
            ->pageLength(50)
            ->language([
                'sLengthMenu' => '_MENU_',
                'search' => '',
                'searchPlaceholder' => 'Search..',
                'processing' => '<img width="50" src="assets/img/loader.gif"/>',
            ])->select([
                'style' => 'multi',
            ])
            ->buttons($buttons);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('Sr. #')->addClass('text-nowrap')->orderable(false),
            Column::make('name')->addClass('text-nowrap'),
            Column::make('price')->addClass('text-nowrap'),
            Column::make('stock')->addClass('text-nowrap'),
            Column::make('description')->addClass('text-nowrap'),
            Column::make('created_at')->addClass('text-nowrap'),
            Column::computed('action')->addClass('text-nowrap'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
