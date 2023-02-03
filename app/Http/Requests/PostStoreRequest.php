<?php

    namespace App\Http\Requests;

    use App\Rules\IntegerArray;
    use Illuminate\Foundation\Http\FormRequest;

    class PostStoreRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize() : bool
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, mixed>
         */
        public function rules() : array
        {
            return [
                'title' => ['required', 'string'],
                'body' => ['required', 'string'],
                'user_ids' => ['required', 'array', new IntegerArray()
                ]];
        }

        public function messages() : array
        {
            return [
                'title.string' => 'Hmm, the :attribute must be a string!',
                'body.required' => 'Hey, you forgot the :attribute!',
            ];
        }

        public function attributes() : array
        {
            return [
                'title' => 'Post Title',
                'body' => 'Post Body',
                'user_ids' => 'User IDs',
            ];
        }
    }
