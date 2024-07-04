<x-modal title="Form User" action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-6">
            <x-forms.input label="Nama" name="nama" value="{{ $data->nama }}" />
        </div>
        <div class="col-md-6">
            <x-forms.input label="Email" name="email" value="{{ $data->email }}" />
        </div>
        <div class="col-md-6">
            <x-forms.input type="password" label="Password" name="password" />
        </div>
        <div class="col-md-6">
            <x-forms.input type="password" label="Password Confirmation" name="password_confirmation" />
        </div>
        <div class="col-md-12">
            <x-forms.radio value="{{ $data->karyaman?->jenis_kelamin }}" :options="$jenisKelamin" label="Jenis kelamin" name="jenis_kelamin" />
        </div>
        <div class="col-md-6">
            <x-forms.select name="divisi" label="Divisi">
                @foreach ($divisi as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </x-forms.select>
        </div>
        <div class="col-md-6">
            <x-forms.select name="status_karyawan" label="Status karyawan">
                @foreach (['Tetap' => 'tetap', 'Kontrak' => 'kontrak', 'Training' => 'training'] as $key => $value)
                    <option value="{{ $value }}">{{ $key }}</option>
                @endforeach
            </x-forms.select>
        </div>
        <div class="col-md-6">
            <x-forms.datepicker label="Tanggal masuk" name="tanggal_masuk" value="{{ $data->karyawan?->tanggal_masuk }}" />
        </div>
    </div>
</x-modal>