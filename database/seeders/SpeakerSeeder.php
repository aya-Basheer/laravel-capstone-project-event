<?php

namespace Database\Seeders;

use App\Models\Speaker;
use Illuminate\Database\Seeder;

class SpeakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $speakers = [
            [
                'name' => 'د. عبدالله الغامدي',
                'bio' => 'خبير في الذكاء الاصطناعي وعلوم البيانات مع أكثر من 15 عامًا من الخبرة في التطوير التقني. حاصل على دكتوراه في علوم الحاسوب من جامعة ستانفورد، ومؤسس عدة شركات تقنية ناشئة.',
                'email' => 'abdullah.alghamdi@example.com',
                'phone' => '+966501111001',
                'company' => 'مركز الذكاء الاصطناعي السعودي',
                'position' => 'المدير التنفيذي',
                'topics_json' => json_encode(['الذكاء الاصطناعي', 'علوم البيانات', 'التعلم الآلي', 'الابتكار التقني']),
                'is_featured' => true,
                'linkedin_url' => 'https://linkedin.com/in/abdullah-alghamdi',
                'twitter_url' => 'https://twitter.com/abdullah_ai',
            ],
            [
                'name' => 'أ. فاطمة الزهراني',
                'bio' => 'رائدة أعمال ومتخصصة في ريادة الأعمال والتطوير المؤسسي. مؤسسة ومديرة تنفيذية لعدة شركات ناجحة في مجال التكنولوجيا المالية والتجارة الإلكترونية.',
                'email' => 'fatima.alzahrani@example.com',
                'phone' => '+966501111002',
                'company' => 'صندوق الاستثمارات العامة',
                'position' => 'مديرة الاستثمار في التقنية',
                'topics_json' => json_encode(['ريادة الأعمال', 'الاستثمار', 'التكنولوجيا المالية', 'القيادة']),
                'is_featured' => true,
                'linkedin_url' => 'https://linkedin.com/in/fatima-alzahrani',
                'website_url' => 'https://fatimaalzahrani.com',
            ],
            [
                'name' => 'م. أحمد العتيبي',
                'bio' => 'مهندس برمجيات متخصص في تطوير التطبيقات المحمولة وتقنيات الويب الحديثة. يعمل كمستشار تقني لعدة شركات كبرى ولديه خبرة واسعة في إدارة المشاريع التقنية.',
                'email' => 'ahmed.alotaibi@example.com',
                'phone' => '+966501111003',
                'company' => 'شركة سابك للتقنية',
                'position' => 'كبير مهندسي البرمجيات',
                'topics_json' => json_encode(['تطوير التطبيقات', 'البرمجة', 'إدارة المشاريع', 'DevOps']),
                'is_featured' => false,
                'linkedin_url' => 'https://linkedin.com/in/ahmed-alotaibi',
                'twitter_url' => 'https://twitter.com/ahmed_dev',
            ],
            [
                'name' => 'د. نورا السعد',
                'bio' => 'أستاذة الطب النفسي والصحة النفسية في جامعة الملك سعود. متخصصة في علاج اضطرابات القلق والاكتئاب، ولها العديد من الأبحاث المنشورة في المجلات العلمية المحكمة.',
                'email' => 'nora.alsaad@example.com',
                'phone' => '+966501111004',
                'company' => 'جامعة الملك سعود',
                'position' => 'أستاذة الطب النفسي',
                'topics_json' => json_encode(['الصحة النفسية', 'علم النفس', 'التطوير الذاتي', 'الطب النفسي']),
                'is_featured' => true,
                'linkedin_url' => 'https://linkedin.com/in/nora-alsaad',
            ],
            [
                'name' => 'أ. خالد المطيري',
                'bio' => 'خبير في التسويق الرقمي ووسائل التواصل الاجتماعي مع خبرة تزيد عن 10 سنوات. يدير حملات تسويقية ناجحة لعلامات تجارية كبرى ويقدم استشارات في استراتيجيات التسويق الحديثة.',
                'email' => 'khalid.almutairi@example.com',
                'phone' => '+966501111005',
                'company' => 'وكالة الإبداع للتسويق',
                'position' => 'مدير التسويق الرقمي',
                'topics_json' => json_encode(['التسويق الرقمي', 'وسائل التواصل الاجتماعي', 'العلامات التجارية', 'التجارة الإلكترونية']),
                'is_featured' => false,
                'linkedin_url' => 'https://linkedin.com/in/khalid-almutairi',
                'twitter_url' => 'https://twitter.com/khalid_marketing',
            ],
            [
                'name' => 'د. سارة القحطاني',
                'bio' => 'باحثة في مجال الطاقة المتجددة والاستدامة البيئية. حاصلة على دكتوراه في الهندسة البيئية ولها مساهمات مهمة في مشاريع الطاقة الشمسية في المملكة.',
                'email' => 'sara.alqahtani@example.com',
                'phone' => '+966501111006',
                'company' => 'مدينة الملك عبدالله للطاقة الذرية والمتجددة',
                'position' => 'باحثة أولى',
                'topics_json' => json_encode(['الطاقة المتجددة', 'الاستدامة', 'البيئة', 'الطاقة الشمسية']),
                'is_featured' => true,
                'linkedin_url' => 'https://linkedin.com/in/sara-alqahtani',
            ],
            [
                'name' => 'أ. محمد الشهري',
                'bio' => 'مدرب ومستشار في التطوير المهني والقيادة. يقدم برامج تدريبية للشركات والمؤسسات في مجال تطوير المهارات القيادية وإدارة الفرق.',
                'email' => 'mohammed.alshahri@example.com',
                'phone' => '+966501111007',
                'company' => 'معهد القيادة والتطوير',
                'position' => 'مدرب معتمد',
                'topics_json' => json_encode(['القيادة', 'التطوير المهني', 'إدارة الفرق', 'التدريب']),
                'is_featured' => false,
                'linkedin_url' => 'https://linkedin.com/in/mohammed-alshahri',
            ],
            [
                'name' => 'د. ريم العمري',
                'bio' => 'أستاذة في كلية إدارة الأعمال متخصصة في الإدارة الاستراتيجية والتخطيط المؤسسي. لها خبرة واسعة في استشارات الأعمال وتطوير الاستراتيجيات.',
                'email' => 'reem.alamri@example.com',
                'phone' => '+966501111008',
                'company' => 'جامعة الأميرة نورة',
                'position' => 'أستاذة إدارة الأعمال',
                'topics_json' => json_encode(['إدارة الأعمال', 'التخطيط الاستراتيجي', 'الإدارة', 'الاستشارات']),
                'is_featured' => false,
                'linkedin_url' => 'https://linkedin.com/in/reem-alamri',
            ],
            [
                'name' => 'م. يوسف الدوسري',
                'bio' => 'مهندس معماري ومصمم حضري متخصص في التصميم المستدام والعمارة الذكية. شارك في تصميم عدة مشاريع مهمة في المملكة ضمن رؤية 2030.',
                'email' => 'youssef.aldosari@example.com',
                'phone' => '+966501111009',
                'company' => 'شركة نيوم للتطوير',
                'position' => 'كبير المهندسين المعماريين',
                'topics_json' => json_encode(['العمارة', 'التصميم الحضري', 'الاستدامة', 'المدن الذكية']),
                'is_featured' => true,
                'linkedin_url' => 'https://linkedin.com/in/youssef-aldosari',
            ],
            [
                'name' => 'أ. هند الراشد',
                'bio' => 'خبيرة في الأمن السيبراني وحماية المعلومات مع شهادات دولية متقدمة. تعمل كمستشارة أمنية لعدة مؤسسات حكومية وخاصة.',
                'email' => 'hind.alrashed@example.com',
                'phone' => '+966501111010',
                'company' => 'الهيئة الوطنية للأمن السيبراني',
                'position' => 'خبيرة أمن سيبراني',
                'topics_json' => json_encode(['الأمن السيبراني', 'حماية المعلومات', 'الأمن الرقمي', 'التقنية']),
                'is_featured' => true,
                'linkedin_url' => 'https://linkedin.com/in/hind-alrashed',
                'twitter_url' => 'https://twitter.com/hind_cyber',
            ],
        ];

        foreach ($speakers as $speaker) {
            Speaker::create($speaker);
        }
    }
}
