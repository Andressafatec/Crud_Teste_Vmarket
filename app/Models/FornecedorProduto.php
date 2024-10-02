<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FornecedorProduto extends Model
{
    use HasFactory;

    protected $table = 'fornecedor_produto';

    protected $fillable = [
        'id_fornecedor', 
        'id_produto', 
    ];


}
