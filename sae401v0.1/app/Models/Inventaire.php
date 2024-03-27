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
 * Class Inventaire
 * 
 * @property int $idinventaire
 * 
 * @property Collection|Contient[] $contients
 * @property Utilisateur $utilisateur
 *
 * @package App\Models
 */
class Inventaire extends Model
{
	use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'inventaire';
	protected $primaryKey = 'idinventaire';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'idinventaire' => 'int'
	];

	public function contients()
	{
		return $this->hasMany(Contient::class, 'idinventaire');
	}

	public function utilisateur()
	{
		return $this->hasOne(Utilisateur::class, 'idinventaire');
	}
	
}
