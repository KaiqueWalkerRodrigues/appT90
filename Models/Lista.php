<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{User,ListaProduto};

class Lista extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lista';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_lista';

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_user','status','nome'];

     /**
     * Mostra nome do usuario
     *
     * @return void
     */
    public function usuario()
    {
        return $this->hasOne(User::class,'id','id_user');
    }

    /**
     * Retorna os produtos da lista
     *
     * @return void
     */ 
    public function produtos()
    {
        return $this->hasMany(ListaProduto::class,'id_lista','id_lista');
    }
}
