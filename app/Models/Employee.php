<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'position',
        'department',
        'phone',
    ];

    /**
     * Get the shifts for the employee.
     */
    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }
}
