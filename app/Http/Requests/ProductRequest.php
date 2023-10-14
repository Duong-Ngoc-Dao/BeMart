<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Requests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'addStudent': //name của route
                        $rules = [
                            "name" => 'required',
                            'price' => 'required|unique:products|max:10',
                          'description'=>'required',
                            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                            'quantity'=>'required',
                        ];
                        break;

                    default:
                        # code...
                        break;
                }
                break;
        }
        return $rules;
    }
    public function messages()
    {
        return [
            //
            'name.required' => 'Zui lòng điền tên',
            'price.required' => 'Zui lòng điền giá',
            'description.required'=>'Zui lòng điền đánh giá',
        
            'image.required' => 'Zui lòng nhập ảnh',
            'quantity'=>'Zui lòng điền số lượng'
           
        ];
    }
    }

