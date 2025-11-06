<?php

namespace App\Http\Requests;

use App\Rules\Cni;
use App\Rules\Email;
use App\Rules\Telephone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Unique;

class CreateCompte extends FormRequest
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
        return [
            "client.nom" => 'required|string',
            "client.prenom" => ['required', "string"],
            // "client.solde" => ["required", 'string'],
            "client.adresse" => ['required', "string"],
            "client.telephone" => ['required', "string", new Telephone()],
            "client.cni" => ['required', "string", new Cni()],
            "client.email" => ['required', "string", new Email()],
            "type" => ["required", "string", "in:epargne,cheque"]
        ];
    }
    public function messages(): array
    {
        return [
            "client.email.unique" => 'ce email  existe deja ',
            "client.telephone.unique" => 'ce telephone  existe deja ',
            'client.prenom.required' => 'Le prénom est obligatoire.',
            'client.nom.required' => 'Le nom est obligatoire.',
            'client.telephone.required'=> 'le telephone est requis',
            'type.in' => 'Le type de compte doit être  de type epargne,cheque.',
        ];
    }
}
