<x-modal title="Form Hari Libur" action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-6">
            <x-forms.input label="Nama" name="nama" value="{{ $data->nama }}" />
        </div>
        <div class="col-md-12">
            {{-- <p>hai</p> --}}
            <x-forms.datepicker-range label="Tanggal libur" date_name1="tanggal_awal" date_name2="tanggal_akhir" 
            date_value1="{{ convertDate($data->tanggal_awal, 'd-m-Y') }}" 
            date_value2="{{ convertDate($data->tanggal_akhir, 'd-m-Y') }}" />
                {{-- <x-forms.datepicker-range label="Tanggal libur" date_name1="tanggal_awal" date_name2="tanggal_akhir" date_value1="{{ $data->tanggal_awal}}" date_value2=/> --}}
                {{-- <x-forms.input label="Nama" name="nama" value="{{ $data->nama }}" /> --}}
        </div>
    </div>
</x-modal>