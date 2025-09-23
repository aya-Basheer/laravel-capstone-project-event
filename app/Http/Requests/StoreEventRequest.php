<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role->name === 'organizer';
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'type' => 'required|in:conference,workshop,webinar,meetup',
            'location_id' => 'required|exists:locations,id',
            'starts_at' => 'required|date|after:now',
            'ends_at' => 'required|date|after:starts_at',
            'capacity' => 'nullable|integer|min:1|max:10000',
            'audience_types' => 'nullable|array',
            'audience_types.*' => 'in:students,professionals,general,vip',
            'speaker_ids' => 'nullable|array',
            'speaker_ids.*' => 'exists:speakers,id',
            'is_featured' => 'boolean',
            'registration_deadline' => 'nullable|date|before:starts_at',
            'requirements' => 'nullable|string|max:1000',
            'agenda' => 'nullable|string|max:5000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'عنوان الفعالية مطلوب',
            'title.max' => 'عنوان الفعالية يجب ألا يتجاوز 255 حرف',
            'type.required' => 'نوع الفعالية مطلوب',
            'type.in' => 'نوع الفعالية غير صحيح',
            'location_id.required' => 'الموقع مطلوب',
            'location_id.exists' => 'الموقع المحدد غير موجود',
            'starts_at.required' => 'تاريخ البداية مطلوب',
            'starts_at.date' => 'تاريخ البداية غير صحيح',
            'starts_at.after' => 'تاريخ البداية يجب أن يكون في المستقبل',
            'ends_at.required' => 'تاريخ النهاية مطلوب',
            'ends_at.date' => 'تاريخ النهاية غير صحيح',
            'ends_at.after' => 'تاريخ النهاية يجب أن يكون بعد تاريخ البداية',
            'capacity.integer' => 'السعة يجب أن تكون رقم صحيح',
            'capacity.min' => 'السعة يجب أن تكون على الأقل 1',
            'capacity.max' => 'السعة يجب ألا تتجاوز 10000',
            'audience_types.array' => 'أنواع الجمهور يجب أن تكون مصفوفة',
            'audience_types.*.in' => 'نوع الجمهور غير صحيح',
            'speaker_ids.array' => 'المتحدثون يجب أن يكونوا مصفوفة',
            'speaker_ids.*.exists' => 'أحد المتحدثين المحددين غير موجود',
            'registration_deadline.date' => 'موعد انتهاء التسجيل غير صحيح',
            'registration_deadline.before' => 'موعد انتهاء التسجيل يجب أن يكون قبل بداية الفعالية',
            'requirements.max' => 'المتطلبات يجب ألا تتجاوز 1000 حرف',
            'agenda.max' => 'جدول الأعمال يجب ألا يتجاوز 5000 حرف',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Convert boolean strings to actual booleans
        if ($this->has('is_featured')) {
            $this->merge([
                'is_featured' => filter_var($this->is_featured, FILTER_VALIDATE_BOOLEAN),
            ]);
        }
    }
}
