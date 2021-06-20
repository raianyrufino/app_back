<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $table = 'servicos';

    protected $fillable = [
        'id',
        'nome', 
        'valor',
    ];

    protected $hidden = ['created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];

    public function procedimentos(){
        return $this->belongsToMany(Procedimento::class, "procedimentos_servicos", "servico_id", "procedimento_id");
    }
}
