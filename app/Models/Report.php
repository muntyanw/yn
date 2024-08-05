<?php

// app/Models/Report.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['month', 'year', 'text'];

    public function photos()
    {
        return $this->hasMany(ReportPhoto::class);
    }

    public function files()
    {
        return $this->hasMany(ReportFile::class);
    }
}

// app/Models/ReportPhoto.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['report_id', 'photo', 'html_link'];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportFile extends Model
{
    use HasFactory;

    protected $fillable = ['report_id', 'file_path'];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
