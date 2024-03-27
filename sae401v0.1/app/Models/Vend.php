<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
/**
 * Class Vend
 * 
 * @property int $iditem
 * @property int $idmagasin
 * 
 * @property Item $item
 * @property Magasin $magasin
 *
 * @package App\Models
 */
class Vend extends Model
{
	use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'vend';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'iditem' => 'int',
		'idmagasin' => 'int'
	];

	public function item()
	{
		return $this->belongsTo(Item::class, 'iditem');
	}

	public function magasin()
	{
		return $this->belongsTo(Magasin::class, 'idmagasin');
	}
}
