<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [IT v 1.6.26]
// Copyright Reserved  [IT v 1.6.26]
class City extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];

protected $table    = 'cities';
protected $fillable = [
		'id',
		'admin_id',
        'name_ar',
        'name_en',
		'created_at',
		'updated_at',
		'deleted_at',
	];

 	/**
    * Static Boot method to delete or update or sort Data
    * @param void
    * @return void
    */
   protected static function boot() {
      parent::boot();
      // if you disable constraints should by run this static method to Delete children data
         static::deleting(function($city) {
         });
   }
		
}
