<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Location;
use App\Models\Role;
use App\Models\Speaker;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizerRole = Role::where('name', 'organizer')->first();
        $organizers = User::where('role_id', $organizerRole->id)->get();
        $locations = Location::all();
        $speakers = Speaker::all();

        $events = [
            [
                'title' => 'مؤتمر الذكاء الاصطناعي والمستقبل',
                'description' => 'مؤتمر شامل يناقش أحدث التطورات في مجال الذكاء الاصطناعي وتأثيره على المستقبل. يضم نخبة من الخبراء المحليين والدوليين لمناقشة التحديات والفرص في هذا المجال المتنامي.',
                'type' => 'conference',
                'location_id' => $locations->random()->id,
                'organizer_id' => $organizers->random()->id,
                'starts_at' => Carbon::now()->addDays(15)->setTime(9, 0),
                'ends_at' => Carbon::now()->addDays(15)->setTime(17, 0),
                'capacity' => 500,
                'audience_mask' => 7, // students + professionals + general
                'is_featured' => true,
                'registration_deadline' => Carbon::now()->addDays(10),
                'requirements' => 'خلفية تقنية أساسية، جهاز محمول',
                'agenda' => 'الجلسة الافتتاحية، عروض تقنية، ورش عمل تفاعلية، جلسة نقاش مفتوحة',
            ],
            [
                'title' => 'ورشة ريادة الأعمال للشباب',
                'description' => 'ورشة عمل تفاعلية مخصصة للشباب الطموح الذين يسعون لبدء مشاريعهم الخاصة. تغطي الورشة أساسيات ريادة الأعمال، كتابة خطة العمل، والحصول على التمويل.',
                'type' => 'workshop',
                'location_id' => $locations->random()->id,
                'organizer_id' => $organizers->random()->id,
                'starts_at' => Carbon::now()->addDays(8)->setTime(14, 0),
                'ends_at' => Carbon::now()->addDays(8)->setTime(18, 0),
                'capacity' => 50,
                'audience_mask' => 5, // students + general
                'is_featured' => false,
                'registration_deadline' => Carbon::now()->addDays(5),
                'requirements' => 'فكرة مشروع أولية، دفتر ملاحظات',
                'agenda' => 'مقدمة في ريادة الأعمال، ورشة خطة العمل، جلسة عصف ذهني',
            ],
            [
                'title' => 'ندوة الصحة النفسية في بيئة العمل',
                'description' => 'ندوة توعوية تهدف إلى تسليط الضوء على أهمية الصحة النفسية في بيئة العمل وكيفية التعامل مع ضغوط العمل والحفاظ على التوازن بين الحياة المهنية والشخصية.',
                'type' => 'webinar',
                'location_id' => $locations->random()->id,
                'organizer_id' => $organizers->random()->id,
                'starts_at' => Carbon::now()->addDays(5)->setTime(19, 0),
                'ends_at' => Carbon::now()->addDays(5)->setTime(21, 0),
                'capacity' => 200,
                'audience_mask' => 6, // professionals + general
                'is_featured' => true,
                'registration_deadline' => Carbon::now()->addDays(3),
                'requirements' => 'لا توجد متطلبات خاصة',
                'agenda' => 'محاضرة رئيسية، جلسة أسئلة وأجوبة، نصائح عملية',
            ],
            [
                'title' => 'لقاء مطوري التطبيقات المحمولة',
                'description' => 'لقاء شهري لمجتمع مطوري التطبيقات المحمولة لمشاركة الخبرات والتعلم من بعضهم البعض. يتضمن عروض تقنية قصيرة وجلسات نقاش حول أحدث التقنيات.',
                'type' => 'meetup',
                'location_id' => $locations->random()->id,
                'organizer_id' => $organizers->random()->id,
                'starts_at' => Carbon::now()->addDays(12)->setTime(18, 30),
                'ends_at' => Carbon::now()->addDays(12)->setTime(21, 0),
                'capacity' => 80,
                'audience_mask' => 2, // professionals
                'is_featured' => false,
                'registration_deadline' => Carbon::now()->addDays(10),
                'requirements' => 'خبرة في تطوير التطبيقات، جهاز محمول',
                'agenda' => 'عروض تقنية، جلسة نتورك، مناقشات مفتوحة',
            ],
            [
                'title' => 'مؤتمر الطاقة المتجددة والاستدامة',
                'description' => 'مؤتمر متخصص يناقش مستقبل الطاقة المتجددة في المملكة ودورها في تحقيق رؤية 2030. يضم خبراء محليين ودوليين في مجال الطاقة والاستدامة.',
                'type' => 'conference',
                'location_id' => $locations->random()->id,
                'organizer_id' => $organizers->random()->id,
                'starts_at' => Carbon::now()->addDays(25)->setTime(8, 0),
                'ends_at' => Carbon::now()->addDays(26)->setTime(16, 0),
                'capacity' => 800,
                'audience_mask' => 15, // all audiences
                'is_featured' => true,
                'registration_deadline' => Carbon::now()->addDays(20),
                'requirements' => 'اهتمام بمجال الطاقة والبيئة',
                'agenda' => 'جلسات متخصصة، معرض تقني، ورش عمل، جولات ميدانية',
            ],
            [
                'title' => 'ورشة التسويق الرقمي للمبتدئين',
                'description' => 'ورشة عملية تعلم أساسيات التسويق الرقمي ووسائل التواصل الاجتماعي. مناسبة لأصحاب الأعمال الصغيرة والمهتمين بدخول مجال التسويق.',
                'type' => 'workshop',
                'location_id' => $locations->random()->id,
                'organizer_id' => $organizers->random()->id,
                'starts_at' => Carbon::now()->addDays(18)->setTime(10, 0),
                'ends_at' => Carbon::now()->addDays(18)->setTime(15, 0),
                'capacity' => 40,
                'audience_mask' => 7, // students + professionals + general
                'is_featured' => false,
                'registration_deadline' => Carbon::now()->addDays(15),
                'requirements' => 'جهاز محمول، حساب على وسائل التواصل',
                'agenda' => 'أساسيات التسويق الرقمي، إنشاء حملات، قياس النتائج',
            ],
            [
                'title' => 'ندوة القيادة والإدارة الحديثة',
                'description' => 'ندوة تركز على مهارات القيادة الحديثة وكيفية إدارة الفرق في عصر التكنولوجيا. تستهدف المديرين والقادة في مختلف المجالات.',
                'type' => 'webinar',
                'location_id' => $locations->random()->id,
                'organizer_id' => $organizers->random()->id,
                'starts_at' => Carbon::now()->addDays(7)->setTime(16, 0),
                'ends_at' => Carbon::now()->addDays(7)->setTime(18, 0),
                'capacity' => 150,
                'audience_mask' => 10, // professionals + vip
                'is_featured' => true,
                'registration_deadline' => Carbon::now()->addDays(5),
                'requirements' => 'خبرة إدارية أو قيادية',
                'agenda' => 'محاضرة تفاعلية، دراسات حالة، جلسة نقاش',
            ],
            [
                'title' => 'لقاء مصممي الجرافيك والإبداع',
                'description' => 'لقاء إبداعي يجمع مصممي الجرافيك والفنانين الرقميين لمشاركة أعمالهم والتعلم من خبرات بعضهم البعض في عالم التصميم.',
                'type' => 'meetup',
                'location_id' => $locations->random()->id,
                'organizer_id' => $organizers->random()->id,
                'starts_at' => Carbon::now()->addDays(20)->setTime(17, 0),
                'ends_at' => Carbon::now()->addDays(20)->setTime(20, 0),
                'capacity' => 60,
                'audience_mask' => 7, // students + professionals + general
                'is_featured' => false,
                'registration_deadline' => Carbon::now()->addDays(18),
                'requirements' => 'أعمال تصميم للعرض، جهاز محمول',
                'agenda' => 'عرض أعمال، ورشة تصميم سريعة، جلسة نتورك',
            ],
        ];

        foreach ($events as $eventData) {
            $event = Event::create($eventData);

            // Attach random speakers to each event (1-3 speakers)
            $eventSpeakers = $speakers->random(rand(1, 3));
            $event->speakers()->attach($eventSpeakers->pluck('id'));
        }

        // Create some past events for testing
        $pastEvents = [
            [
                'title' => 'مؤتمر التكنولوجيا المالية السابق',
                'description' => 'مؤتمر سابق ناجح في مجال التكنولوجيا المالية',
                'type' => 'conference',
                'location_id' => $locations->random()->id,
                'organizer_id' => $organizers->random()->id,
                'starts_at' => Carbon::now()->subDays(30)->setTime(9, 0),
                'ends_at' => Carbon::now()->subDays(30)->setTime(17, 0),
                'capacity' => 300,
                'audience_mask' => 6, // professionals + general
                'is_featured' => false,
            ],
            [
                'title' => 'ورشة البرمجة للمبتدئين - منتهية',
                'description' => 'ورشة تعليمية سابقة في أساسيات البرمجة',
                'type' => 'workshop',
                'location_id' => $locations->random()->id,
                'organizer_id' => $organizers->random()->id,
                'starts_at' => Carbon::now()->subDays(15)->setTime(14, 0),
                'ends_at' => Carbon::now()->subDays(15)->setTime(18, 0),
                'capacity' => 25,
                'audience_mask' => 5, // students + general
                'is_featured' => false,
            ],
        ];

        foreach ($pastEvents as $eventData) {
            $event = Event::create($eventData);
            $eventSpeakers = $speakers->random(rand(1, 2));
            $event->speakers()->attach($eventSpeakers->pluck('id'));
        }
    }
}
