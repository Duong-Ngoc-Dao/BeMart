<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        //lấy phương thức đang hoạt động
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'addPost': //name của route
                        $rules = [
                            "content" => 'required',
                            'img' => ''
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
        return[
            'content.required' => 'Zui lòng điền content',
            'img.required' => 'Zui lòng điền img',
           
        ];
    }
}
