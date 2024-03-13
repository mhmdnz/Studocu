<?php

namespace App\Modules\FlashCard\Repositories;

use App\Models\FlashCard;
use App\Modules\FlashCard\Interfaces\FlashCardRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FlashCardRepository implements FlashCardRepositoryInterface
{

    public function getFlashCard(int $flashCardId): FlashCard
    {
        return FlashCard::find($flashCardId);
    }

    public function create(string $question, string $answer): FlashCard
    {
        return FlashCard::create([
            'question' => $question,
            'answer' => $answer
        ]);
    }

    public function getList(array $fileds): Collection
    {
        return FlashCard::all($fileds);
    }

    public function getFlashCardsByUserId(int $userId): Collection
    {
        return DB::table('flash_cards')
            ->leftJoin('user_flash_cards', function($join) use ($userId) {
                $join->on('flash_cards.id', '=', 'user_flash_cards.flash_card_id')
                    ->where(function($query) use ($userId) {
                        $query->where('user_flash_cards.user_id', $userId)
                            ->orWhereNull('user_flash_cards.user_id');
                    });
            })
            ->select('flash_cards.id', 'flash_cards.question',
                DB::raw("COALESCE(user_flash_cards.status, 'not_answered') as status"))
            ->get();
    }
}
