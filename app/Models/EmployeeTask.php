<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTask extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "tracking_id",
        "task_type",
        "due",
        "task_id",
        "status"
    ];
}
