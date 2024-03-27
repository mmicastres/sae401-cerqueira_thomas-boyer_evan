<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
/**
 * Class Magasin
 * 
 * @property int $idmagasin
 * 
 * @property Collection|Vend[] $vends
 *
 * @package App\Models
 */
class Magasin extends Model
{
	use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'magasin';
	protected $primaryKey = 'idmagasin';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idmagasin' => 'int'
	];

	public function vends()
	{
		return $this->hasMany(Vend::class, 'idmagasin');
	}
}
