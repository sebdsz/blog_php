<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostRequest extends Request
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
        return [
            'title' => 'required|string',
            'content' => 'required|max:999',
            'category_id' => 'regex:/[0-9]{1,}/',
            'user_id' => 'integer',
            'status' => 'in:published,unpublished',
            'published_at' => 'date',
            'tag_id' => 'tags',
            'picture' => 'image|max:1000',
            'name' => 'string|max:50',
            'score' => 'in:0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20',
        ];
    }
}
