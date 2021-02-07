<?php

namespace App\Http\Requests\V0\Sale;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // 
    }


    public function prepareForValidation()
    {
        // get the input
        $data = array_map(null, $this->all());
        $data['date'] = Carbon::now()->setTimezone('America/Sao_Paulo');
        $this->replace($data);

    }

}
