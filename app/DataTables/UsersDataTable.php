<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use illuminate\Support\Facades\Route;

class UsersDataTable extends DataTable
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
        ->editColumn('valid', function ($user) {
            return $user->valid ? '<i class="fas fa-check"></i>' : '';
        })
        ->editColumn('created_at', function ($user) {
            return formatDate($user->created_at);
        })
        ->editColumn('updated_at', function ($user) {
            return formatDate($user->updated_at);
        })
        ->addColumn('action', function ($user) {
            return $edit = '<a id="show"  title ="Voir" href="' . route('detail', $user->id) . '" class="modal-trigger btn btn-xs btn-info btn-block"><i class="fas fa-eye"></i></a>
            <script>
                $(() => {
                $("a#show").click(e => {
                    let that = e.currentTarget;
                    e.preventDefault();
                    $.ajax({
                    method: $(that).attr("method"),
                    url: $(that).attr("href"),
                    data: $(that).serialize()
                    })
                    .done((data) => {
                    $("#detail").html(data);
                    $(".modale").modal("show");
                    })
                    .fail((data) => {
                    console.log(data);
                    });
                });
                });
            </script>'
            . $this->button(
                'users.edit',
                $user->id,
                'warning',
                __('Edit'),
                'edit'
            )
            . $this->button(
                'users.destroy',
                $user->id,
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
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        if(Route::currentRouteNamed('users.indexnew')) {
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
                ->setTableId('users-table')
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
            Column::make('nom_responsable_RESPONSABLES')->title(__('Nom')),
            Column::make('prenom_responsable_RESPONSABLES')->title(__('Prenom')),
            Column::make('adresse_responsable_RESPONSABLES')->title(__('Adresse')),
            Column::make('email')->title(__('Email')),
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
        return 'Users_' . date('YmdHis');
    }
}
