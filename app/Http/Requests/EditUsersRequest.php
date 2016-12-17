<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditUsersRequest extends Request
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
    public function rules() // edit oldal miatt hoztuk külön létre, password ne legyen required.. adminuserscontroller-ben ilyen
        // típusú request-et kapunk UPDATE metódusnál
    {
        return [
            'name'=>'required',
            'email'=>'required',
            'role_id'=>'required',
            'is_active'=>'required',
            //
        ];
    }
}
