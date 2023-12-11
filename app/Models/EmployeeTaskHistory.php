<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTaskHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        "employee_task_id",
        "status",
    ];
}
