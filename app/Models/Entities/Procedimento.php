<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimento extends Model
{
    use HasFactory;

    protected $table = 'procedimentos';

    protected $fillable = [
        'id',
        'nome', 
        'valor', 
    ];

    protected $hidden = ['created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];

    public function servicos(){
        return $this->belongsToMany(Servico::class, "procedimentos_servicos", "procedimento_id", "servico_id");
    }
}
