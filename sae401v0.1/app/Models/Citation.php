<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Citation
 * 
 * @property int $idcitation
 * @property string|null $citation
 * @property string $auteur
 * 
 * @property Collection|Favori[] $favoris
 *
 * @package App\Models
 */
class Citation extends Model
{
	use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'citation';
	protected $primaryKey = 'idcitation';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'idcitation' => 'int'
	];

	protected $fillable = [
		'citation',
		'auteur'
	];

	public function favoris()
	{
		return $this->hasMany(Favori::class, 'idcitation');
	}
}
