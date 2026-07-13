<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'shift_name',
        'date',
        'start_time',
        'end_time',
    ];

    /**
     * Get the employee that owns the shift.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
