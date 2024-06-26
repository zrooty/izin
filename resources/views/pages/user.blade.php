<x-master-layout>
    <div class="row">
        <div class="col-12">
            {{$dataTable->table()}}
        </div>
    </div>
    @push('jsModule')
        @vite(['resources/js/pages/user.js'])
    @endpush
    @push('js')
        {{$dataTable->scripts(attributes: ['type'=>'module'])}}
    @endpush
</x-master-layout>