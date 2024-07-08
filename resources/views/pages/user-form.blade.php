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
            <x-forms.radio value="{{ $data->karyawan?->jenis_kelamin }}" :options="$jenisKelamin" label="Jenis kelamin" name="jenis_kelamin" />
        </div>
        <div class="col-md-6">
            <x-forms.select name="divisi" label="Divisi">
                @foreach ($divisi as $item)
                    <option @selected($data->karyawan?->divisi_id == $item->id) value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </x-forms.select>
        </div>
        <div class="col-md-6">
            <x-forms.select name="status_karyawan" label="Status karyawan">
                @foreach (['Tetap' => 'tetap', 'Kontrak' => 'kontrak', 'Training' => 'training'] as $key => $value)
                    <option @selected($data->karyawan?->status_karyawan == $value) value="{{ $value }}">{{ $key }}</option>
                @endforeach
            </x-forms.select>
        </div>
        <div class="col-md-6">
            <x-forms.datepicker label="Tanggal masuk" name="tanggal_masuk" value="{{ $data->karyawan?->tanggal_masuk }}" />
        </div>

        <hr class="mt-3 mb-3"/>
        <div class="col-12">
            <div class="mb-3">
                <button type="button" class="btn btn-info add-atasan" data-action="{{ route('users.list-atasan').'?except='.$data->id }}">Tambah Atasan</button>

            </div>
            <table class="table">
                <thead>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                </thead>
                <tbody id="listAtasan">
                    @foreach ($data->atasan as $item)
                        <tr>
                            <td> <button type="button" class="btn btnsm btn-danger btn-delete me-1"><i class="ti ti-trash"></i></button> {{ $item->nama }}</td>
                            <td>{{ $item->email}}</td>
                            <td> <input class="form-control" name="atasan[{{ $item->id }}]" value="{{ $item->pivot->level }}"/></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-modal>