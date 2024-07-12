@props(['label' => null, 'date_name1' => '', 'date_name2' => '', 'date_value1' => '', 'date_value2' => ''])
<div class="mb-2 form-wrapper">
    @if ($label)
        <label class="form-label">{{ $label }}</label>
    @endif
    <div class="input-group input-daterange datepicker date" data-date-format="dd-mm-yyyy">
        <input class="form-control" required="" type="text" id="{{ $date_name1 }}" name="{{ $date_name1 }}" value="{{ $date_value1 }}" readonly="{{ $date_value1 }}">
        <span class="px-3 bg-primary text-light justify-content-center align-items-center d-flex">sd</span>
        <input class="form-control" required="" type="text" id="{{ $date_name2 }}" name="{{ $date_name2 }}" value="{{ $date_value2 }}" readonly="{{ $date_value2 }}">
    </div>
</div>