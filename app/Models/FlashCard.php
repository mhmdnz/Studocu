<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\FlashCardFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class FlashCard
 * @package App\Models
 * @property int id
 * @property string question
 * @property string answer
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property Collection users
 * @method static FlashCardFactory factory($count = null, $state = [])
 */
class FlashCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_flash_cards')
            ->withPivot('status');
    }
}
