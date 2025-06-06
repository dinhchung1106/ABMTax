<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;
    protected $table = 'company_info';
    protected $fillable = ['id', 'name', 'address', 'email', 'hotline', 'slogan', 'about'];
}
