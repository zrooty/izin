<x-modal title="List atasan">
    <div class="row">
        <div class="col-12">
            {{ $dataTable->table() }}
        </div>
        {{ $dataTable->scripts() }}
    </div>
</x-modal>