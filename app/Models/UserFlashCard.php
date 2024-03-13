<?php

namespace App\Models;

use App\Modules\FlashCard\Enums\FlashCardStatus;
use Carbon\Carbon;
use Database\Factories\UserFlashCardFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserFlashCard
 * @package App\Models
 * @property int id
 * @property string status
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property User user_id
 * @property FlashCard flashCard_id
 * @method static UserFlashCardFactory factory($count = null, $state = [])
 */
class UserFlashCard extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => FlashCardStatus::class,
    ];
}
