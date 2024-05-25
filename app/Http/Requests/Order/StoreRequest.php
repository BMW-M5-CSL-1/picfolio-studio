<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        $rules = [
            'order_no' => 'required|unique:orders,order_no',
            'design_template' => 'required',
            'primary_color' => 'required',
            'secondary_color' => 'required',
            'tertiary_color' => 'required',
            'comments' => 'required',
        ];

        if ($this->input('type') == 'paper_media') {
            $rules['location'] = ['required', 'array'];
            $rules['paper'] = ['required'];
            $rules['paperQuality'] = ['required'];
            $rules['sides'] = ['required'];
            $rules['distributionType'] = ['required'];
            $rules['distributionDuaration'] = ['required'];
            $rules['no_of_copies'] = ['required'];
            $rules['price'] = ['required'];
            $rules['pm_attachments'] = ['required'];
        } elseif ($this->input('type') == 'vehicle_media') {
            $rules['routes'] = ['required', 'array'];
            $rules['banner'] = ['required'];
            $rules['vmQuality'] = ['required'];
            // $rules['sides'] = ['required'];
            $rules['adDuaration'] = ['required'];
            $rules['no_of_cars'] = ['required'];
            $rules['vmPrice'] = ['required'];
            $rules['vm_attachments'] = ['required'];
        }

        return $rules;
    }

    public function messages()
    {
        $rulesMessage = [
            'order_no.required' => 'The Order Number field is required.',
            'order_no.unique' => 'The Order Number has already been taken.',
            'location.required' => 'The Location field is required.',
            'routes.required' => 'The Route field is required.',
            'distributionType.required' => 'The Distribution Type field is required.',
            'paperType.required' => 'The Paper Type field is required.',
            'banner.required' => 'The Paper Type field is required.',
            'paperQuality.required' => 'The Paper Quality field is required.',
            'vmQuality.required' => 'The Paper Quality field is required.',
            'sides.required' => 'The Printing Side field is required.',
            'distributionDuaration.required' => 'The Distribution Duaration field is required.',
            'adDuaration.required' => 'The Duaration field is required.',
            'no_of_copies.required' => 'The Number of Copies field is required.',
            'no_of_cars.required' => 'The Number of Cars field is required.',
            'price.required' => 'The Price field is required.',
            'vmPrice.required' => 'The Price field is required.',
            'design_template.required' => 'The Select A Design Template field is required.',
            'primary_color.required' => 'The Primary Color field is required.',
            'secondary_color.required' => 'The Secondary Color field is required.',
            'tertiary_color.required' => 'The Tertiary Color field is required.',
            'pm_attachments.required' => 'The User Attachments field is required.',
            'vm_attachments.required' => 'The User Attachments field is required.',
            'comments.required' => 'The Details field is required.',
        ];

        return $rulesMessage;
    }
}
