<x-modal title="Form Setup Aplikasi" action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-6">
            <x-forms.input label="H min cuti" name="hmin_cuti" value="{{ $data->hmin_cuti }}" />
        </div>
        <div class="col-md-6">
            <x-forms.select label="Hari Kerja" data-placeholder="Pilih hari kerja" name="hari_kerja[]" multiple class="select2">
                @foreach ($hariKerja as $key =>$hari)
                    <option @selected(in_array($hari, $data->hari_kerja ??= [])) value="{{ $hari }}">{{ $key }}</option>
                @endforeach
            </x-forms.select>
        </div>
    </div>
</x-modal>


{{-- <x-modal title="Form Divisi" action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-6">
            <x-forms.input label="Nama" name="nama" value="{{ $data->nama }}" />
        </div>
    </div>
</x-modal> --}}