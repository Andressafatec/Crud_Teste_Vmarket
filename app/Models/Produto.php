<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'nome', 
        'descricao', 
        'preco',
        'qtd', 
        'status'
    ];

    public function fornecedores() {
        return $this->belongsToMany(Fornecedor::class, 'fornecedor_produto', 'id_produto', 'id_fornecedor');
    }
}
