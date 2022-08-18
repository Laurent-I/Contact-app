<?php

namespace App\Models;

use App\Scopes\ContactSearchScope;
use App\Scopes\FilterSearchScope;
use App\Scopes\SearchScope;
use App\Scopes\FilterScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory, FilterSearchScope;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'company_id'];
    public array $searchColumns = ['first_name', 'last_name', 'email'];
    public array $filterColumns = ['company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class)->withoutGlobalScopes();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id', 'desc');
    }



}
