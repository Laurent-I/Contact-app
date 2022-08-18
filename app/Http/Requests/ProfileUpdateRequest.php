<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company' => ['nullable'],
            'bio' => ['nullable'],
            'profile_picture' => ['nullable', 'mimes:jpeg,bmp,gif,png']
        ];
    }

    public function handleRequest($request)
    {
        $profileData = $request->validated();
        $profile = $request->user();

        if($request->hasFile('profile_picture'))
        {
            $picture = $request->profile_picture;
            $fileName = "profile-picture-{$profile->id}." . $picture->getClientOriginalExtension();
            $picture->move(public_path('upload'), $fileName);


            $profileData['profile_picture'] = $fileName;
        }

        return $profileData;
    }
}
