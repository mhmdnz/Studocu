<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class User
 * @package App\Models
 * @property int id
 * @property string name
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property Collection flashCards
 * @method UserFactory factory($count = null, $state = [])
 */
class User extends Model
{
    use HasFactory;

    public Const string DEFAULT_USER = 'studocu';

    public function flashCards()
    {
        return $this->belongsToMany(FlashCard::class, 'user_flash_cards')
            ->withPivot('status');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
}
