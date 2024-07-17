<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Column;

trait DataTableHelper
{
    public function setHtml($tableName)
    {
        return $this->builder()
            ->parameters([
                'searchDelay' => 500,
                'responsive' => [
                    'details' => [
                        'display'=> '$.fn.dataTable.Responsive.display.childRowImmediate',
                    ]
                ]
            ])
            ->setTableId($tableName)
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    public function setColumns(array $columns)
    {
        return[
            Column::make('DT_RowIndex')->title('#')->orderable(false)->searchable(false),
            Column::make('id')->hidden(),
            ...$columns,
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }
}
