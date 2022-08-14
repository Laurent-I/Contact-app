<?php

namespace App\Models;

use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'email', 'website', 'contact'];

    public $searchColumns = ['name','address','email','website'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SearchScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function userCompanies()
    {
        return self::where('user_id', auth()->id())->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
    }
}
