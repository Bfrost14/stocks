<?php

namespace App\DataTables;

use App\Models\Stock;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;


class StocksDataTable extends DataTable
{
    use DataTableTrait;
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
        ->editColumn('valid', function ($stock) {
            return $stock->valid ? '<i class="fas fa-check"></i>' : '';
        })
        ->editColumn('created_at', function ($stock) {
            return formatDate($stock->created_at);
        })
        ->editColumn('updated_at', function ($stock) {
            return formatDate($stock->updated_at);
        })
        ->addColumn('action', function ($stock) {
            return $this->button(
                'stocks.edit',
                $stock->id,
                'warning',
                __('Edit'),
                'edit'
            ). $this->button(
                'stocks.destroy',
                $stock->id,
                'danger',
                __('Supprimer'),
                'trash-alt',
                '',
                __('Voulez vous vraiment supprimer cet article?')
            );
        })
        ->rawColumns(['valid', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Stock $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Stock $model)
    {
        if(Route::currentRouteNamed('stocks.indexnew')) {
            return $model->has('unreadNotifications');
        }

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                ->setTableId('stocks-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom('Blfrtip')
                ->lengthMenu();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title(__('Numéro Stock')),
            Column::make('lieu_STOCK')->title(__('Lieu de Stock')),
            Column::make('emplacement_STOCK')->title(__('Emplacement Stock')),
            Column::make('created_at')->title(__('Creation')),
            Column::make('updated_at')->title(__('Modification')),
            Column::computed('action')->title(__('Action'))->addClass('align-middle text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Stocks_' . date('YmdHis');
    }
}
