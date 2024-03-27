<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
/**
 * Class Item
 * 
 * @property int $iditem
 * @property string|null $item
 * @property int|null $prix
 * @property string|null $image
 * 
 * @property Collection|Contient[] $contients
 * @property Collection|Vend[] $vends
 *
 * @package App\Models
 */
class Item extends Model
{
	use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'item';
	protected $primaryKey = 'iditem';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'iditem' => 'int',
		'prix' => 'int'
	];

	protected $fillable = [
		'item',
		'prix',
		'image'
	];

	public function contients()
	{
		return $this->hasMany(Contient::class, 'iditem');
	}

	public function vends()
	{
		return $this->hasMany(Vend::class, 'iditem');
	}
}
