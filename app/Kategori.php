<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
class Kategori extends Model
{
	protected $fillable = ['name'];

	public function beritas()
	{
		return $this->hasMany('App\Berita');
	}    

	public static function boot()
	{
		parent::boot();
		self::deleting(function($kategori){
			if($kategori->beritas->count()>0){
				$html= 'Kategori tidak bisa di hapus ,masih memiliki berita :';
				$html .='<ul>';
				foreach ($kategori->$beritas as $berita) {
					$html .="<li>$berita->title</li>";
				}
				$html .='</ul>';

				Session::flash("flash_notification",[
					"level"=>"danger",
					"message"=>$html]);
				return false;
			}
		});
	}
}

