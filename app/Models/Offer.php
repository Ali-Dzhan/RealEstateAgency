<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'agent_id',
        'client_id',
        'signed_on',
        'price',
        'status',
        'notes',
    ];

    /**
     * Relationships
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function histories()
    {
        return $this->hasMany(OfferHistory::class);
    }

    /**
     * Accessors & Helpers
     */
    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    // Event which automatically logs changes to the offer
    protected static function booted()
    {
        static::updating(function ($offer) {
            $user = auth()->check() ? auth()->user() : null;

            $dirty = $offer->getDirty(); // fields that changed
            foreach ($dirty as $field => $newValue) {
                $oldValue = $offer->getOriginal($field);

                if (in_array($field, ['price', 'status'])) {
                    OfferHistory::create([
                        'offer_id' => $offer->id,
                        'user_id' =>  $user?->id,
                        'field_changed' => $field,
                        'old_value' => $oldValue,
                        'new_value' => $newValue,
                    ]);
                }
            }
        });
    }
}
