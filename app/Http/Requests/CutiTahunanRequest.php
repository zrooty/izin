<?php

namespace App\Http\Requests;

use App\Models\CutiTahunan;
use Illuminate\Foundation\Http\FormRequest;

class CutiTahunanRequest extends FormRequest
{
    public function validateExistingData()
    {
        $isExist = CutiTahunan::where('tahun', $this->tahun)->where('user_id', $this->user_id)->count();
        if ($isExist) throw new \Exception ('Sudah ada cuti pada tahun '.$this->tahun. ' untuk user '.$this->user_name);
    }

    public function fillData(CutiTahunan $cutiTahunan)
    {
        $cutiTahunan->fill($this->validated());
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'total'=> 'required',
            'tahun'=> 'required',
            'user_id'=> 'required',
            'user_name'=> 'required',
        ];
    }
}
