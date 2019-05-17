<?php
namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 *
 * @package App
 * @property string $title
 * @property text $description
 * @property tinyInteger $published
*/
class Course extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'published'];
    protected $hidden = [];
    
    
    
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'course_user');
    }

    // public function scopeOfTeacher($query){
    //     if(!Auth::user()->isAdmin){
    //         return $query->whereHas('teachers', function($q){
    //             $q->where('user_id', Auth::user()->id);
    //         });
    //     }
    //     return $query;
    // }
    
}
