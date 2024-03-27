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
 * Class Favori
 * 
 * @property int $idcitation
 * @property int $idutilisateur
 * 
 * @property Citation $citation
 * @property Utilisateur $utilisateur
 *
 * @package App\Models
 */
class Favori extends Model
{
	use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'favoris';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idcitation' => 'int',
		'idutilisateur' => 'int'
	];

	public function citation()
	{
		return $this->belongsTo(Citation::class, 'idcitation');
	}

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'idutilisateur');
	}
}
