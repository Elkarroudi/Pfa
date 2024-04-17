<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BaseModel extends Model
{
    public $incrementing = false;

    public static function booted(): void
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function getId($tableName)
    {
        $id = DB::table('users')
            ->join("$tableName", 'users.id', '=', "$tableName.user_id")
            ->select("$tableName.id")
            ->get();

        return $id[0]->id;
    }
}
