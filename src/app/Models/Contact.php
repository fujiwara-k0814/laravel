<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    //ラベル化(性別、お問い合わせ種類)
    public function getGenderLabelAttribute()
    {
        return [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ][$this->gender];
    }

    public function getCategoryLabelAttribute()
    {
        return [
            1 => '商品のお届けについて',
            2 => '商品の交換について',
            3 => '商品トラブル',
            4 => 'ショップへのお問い合わせ',
            5 => 'その他'
        ][$this->category_id];
    }


    //検索項目
    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            
            $keyword = trim($keyword);
            $parts = preg_split('/\s+/', $keyword);

            if (count($parts) === 2) {
                $query
                    ->where('last_name', $parts[0])
                    ->where('first_name', $parts[1]);
            } else {
                $query
                    ->Where('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                ;
            }
        }
    }

    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender) && $gender != -1) {
            $query->where('gender', 'like', '%' . $gender . '%');
        }
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', 'like', '%' . $category_id . '%');
        }
    }

    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
            $query->where('created_at', 'like', '%' . $date . '%');
        }
    }


}
