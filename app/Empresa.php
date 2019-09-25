<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ['nome', 'telefone', 'endereco', 'cep', 'cnpj'];
}
