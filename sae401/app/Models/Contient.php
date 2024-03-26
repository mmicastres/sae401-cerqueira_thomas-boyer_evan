<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



/**
 * Class Contient
 * 
 * @property int $idinventaire
 * @property int $iditem
 * 
 * @property Inventaire $inventaire
 * @property Item $item
 *
 * @package App\Models
 */
class Contient extends Model
{
	use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'contient';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idinventaire' => 'int',
		'iditem' => 'int'
	];

	public function inventaire()
	{
		return $this->belongsTo(Inventaire::class, 'idinventaire');
	}

	public function item()
	{
		return $this->belongsTo(Item::class, 'iditem');
	}
}
