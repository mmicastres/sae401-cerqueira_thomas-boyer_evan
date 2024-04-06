<?php



namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Utilisateur
 * 
 * @property int $idutilisateur
 * @property int $idinventaire
 * @property string|null $nom
 * @property string|null $prenom
 * @property string|null $email
 * @property string|null $motdepasse
 * @property int|null $pieces
 * 
 * @property Inventaire $inventaire
 * @property Collection|Favori[] $favoris
 *
 * @package App\Models
 */
class Utilisateur extends Model
{
	use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'utilisateur';
	protected $primaryKey = 'idutilisateur';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'idutilisateur' => 'int',
		'idinventaire' => 'int',
		'pieces' => 'int'
	];

	protected $fillable = [
		'idinventaire',
		'nom',
		'prenom',
		'email',
		'motdepasse',
		'pieces'
	];

	public function inventaire()
	{
		return $this->hasOne(Inventaire::class, 'idinventaire');
	}

	public function favoris()
	{
		return $this->hasMany(Favori::class, 'idutilisateur');
	}
	public function tokens()
	{
		return $this->hasMany(PersonalAccessToken::class,'tokenable_id');
	}
}
