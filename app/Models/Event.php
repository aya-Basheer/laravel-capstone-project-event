<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    // إن أردت تعطيل الحماية مؤقتاً أثناء التطوير:
    // protected $guarded = [];

    protected $fillable = [
        'organizer_id',   // <-- أُضيفت
        'title',
        'type',
        'location_id',
        'starts_at',
        'ends_at',
        'audience_mask',
        'description',
    ];

    protected $casts = [
        'starts_at'     => 'datetime',
        'ends_at'       => 'datetime',
        'audience_mask' => 'integer',
    ];

    /**
     * منظم الفعالية
     */
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    /**
     * الموقع
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * المتحدثون
     */
    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speaker::class, 'event_speakers');
    }

    /**
     * التسجيلات
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * فحص التعارضات
     */
    public function hasConflicts()
    {
        return self::where('location_id', $this->location_id)
            ->where('id', '!=', $this->id)
            ->where(function ($query) {
                $query->whereBetween('starts_at', [$this->starts_at, $this->ends_at])
                    ->orWhereBetween('ends_at', [$this->starts_at, $this->ends_at])
                    ->orWhere(function ($q) {
                        $q->where('starts_at', '<=', $this->starts_at)
                          ->where('ends_at', '>=', $this->ends_at);
                    });
            })
            ->exists();
    }

    /**
     * تحويل قناع الجمهور إلى مصفوفة
     */
    public function getAudienceTypesAttribute()
    {
        $types = [];
        $mask = $this->audience_mask;

        if ($mask & 1)  $types[] = 'students';
        if ($mask & 2)  $types[] = 'professionals';
        if ($mask & 4)  $types[] = 'general';
        if ($mask & 8)  $types[] = 'vip';

        return $types;
    }
}
