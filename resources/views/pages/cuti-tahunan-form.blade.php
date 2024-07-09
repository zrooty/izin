<x-modal title="Form Divisi" action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-6">
            <x-forms.input label="Nama" name="nama" value="{{ $data->nama }}" />
        </div>
        <div class="col-md-6">
            <x-forms.datepicker label="Tahun" name="tahun" value="{{ $data->tahun }}" />
        </div>
        <div class="col-md-6">
            <input hidden name="user_id"/>
            <x-forms.input readonly label="User name" id="user_name" data-action="{{ route('users.list-atasan') }}" name="user_name" value="{{ $data->nama }}" />
        </div>
    </div>
</x-modal>