<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{User, Produto};

class ListaProduto extends Model
{
    use HasFactory, SoftDeletes;

    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lista_produtos';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_lista_produto';

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
    protected $fillable = ['id_lista','id_produto','status'];

    /**
     * ===================================
     *         RELACIONAMENTOS
     * https://laravel.com/docs/9.x/eloquent-relationships
     * ===================================
     */

    /**
     * Retorna o produto
     *
     * @return void
     */
    public function produto()
    {
        return $this->hasOne(Produto::class,'id_produto','id_produto');
    }

    public function iconeStatus()
    {
        switch ($this->attributes['status']) {
            case 0:
                return '<div class="btn btn-outline-warning"><i class="fa-solid fa-hourglass"></i></div>';
                break;
            case 1:
                return '<div class="btn btn-outline-success"><i class="fa-solid fa-circle-check"></i></div>';
                break;
                
            default:
                return '-';
                break;
        }
    }

}
