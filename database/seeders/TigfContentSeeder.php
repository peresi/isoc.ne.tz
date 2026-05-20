<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\News;
use Illuminate\Database\Seeder;

class TigfContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsItems = [
            [
                'title' => 'TIGF 2026 Planning Committee Announced',
                'slug' => 'tigf-2026-planning-committee-announced',
                'image_url' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'The Tanzania Internet Governance Forum has announced the multi-stakeholder committee leading the 2026 forum preparations.',
                'content' => 'TIGF has officially launched the 2026 planning cycle with representation from civil society, academia, government, private sector, and youth leaders. The committee will coordinate thematic tracks on access, cybersecurity, digital rights, and digital economy growth in Tanzania.',
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Call for Youth Internet Governance Ambassadors',
                'slug' => 'call-for-youth-internet-governance-ambassadors',
                'image_url' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Applications are now open for youth ambassadors to support digital policy awareness across regions in Tanzania.',
                'content' => 'TIGF invites students and young professionals to apply for the Internet Governance Ambassador program. Selected ambassadors receive mentorship, policy training, and the opportunity to facilitate awareness sessions in schools, universities, and local innovation hubs.',
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Regional Dialogue on Safe and Inclusive Digital Spaces',
                'slug' => 'regional-dialogue-safe-inclusive-digital-spaces',
                'image_url' => 'https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Stakeholders met in Dar es Salaam for a dialogue focused on online safety, inclusion, and responsible internet use.',
                'content' => 'The regional policy dialogue emphasized community-driven approaches to online safety, digital literacy, and inclusion for underserved groups. Recommendations will feed into the TIGF annual policy brief and guide national and regional engagement priorities.',
                'published_at' => now()->subDays(3),
            ],
        ];

        foreach ($newsItems as $item) {
            News::updateOrCreate(['slug' => $item['slug']], $item);
        }

        $courses = [
            [
                'title' => 'Internet Governance Foundations',
                'slug' => 'internet-governance-foundations',
                'summary' => 'Understand internet governance actors, policy processes, and Tanzania context.',
                'description' => 'This beginner-friendly course introduces internet governance principles, institutions, and policy lifecycle. Learners explore how global and national actors shape internet policy and how citizens can participate meaningfully.',
                'level' => 'Beginner',
                'duration' => '4 Weeks',
                'image_url' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1200&q=80',
                'lessons' => [
                    ['title' => 'What is Internet Governance?', 'slug' => 'what-is-internet-governance', 'duration_minutes' => 18],
                    ['title' => 'Stakeholders and Their Roles', 'slug' => 'stakeholders-and-their-roles', 'duration_minutes' => 22],
                    ['title' => 'Policy Development in Tanzania', 'slug' => 'policy-development-in-tanzania', 'duration_minutes' => 25],
                ],
            ],
            [
                'title' => 'Digital Rights and Online Safety',
                'slug' => 'digital-rights-and-online-safety',
                'summary' => 'Learn practical frameworks for rights protection, privacy, and online safety.',
                'description' => 'This course covers rights-based approaches to internet policy, balancing freedom and safety online. It gives practical examples for students, community leaders, and policy practitioners working in digital ecosystems.',
                'level' => 'Intermediate',
                'duration' => '5 Weeks',
                'image_url' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=1200&q=80',
                'lessons' => [
                    ['title' => 'Digital Rights Principles', 'slug' => 'digital-rights-principles', 'duration_minutes' => 20],
                    ['title' => 'Privacy, Data, and Consent', 'slug' => 'privacy-data-and-consent', 'duration_minutes' => 24],
                    ['title' => 'Responding to Online Harms', 'slug' => 'responding-to-online-harms', 'duration_minutes' => 21],
                ],
            ],
            [
                'title' => 'Policy Leadership for Community Advocates',
                'slug' => 'policy-leadership-for-community-advocates',
                'summary' => 'Build advocacy and dialogue skills to influence digital policy outcomes.',
                'description' => 'Designed for practitioners and local champions, this course helps participants frame policy proposals, engage decision-makers, and organize community dialogues around digital inclusion and responsible technology use.',
                'level' => 'Advanced',
                'duration' => '6 Weeks',
                'image_url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1200&q=80',
                'lessons' => [
                    ['title' => 'Designing Community Policy Dialogues', 'slug' => 'designing-community-policy-dialogues', 'duration_minutes' => 19],
                    ['title' => 'Writing Policy Briefs', 'slug' => 'writing-policy-briefs', 'duration_minutes' => 28],
                    ['title' => 'Monitoring and Impact Storytelling', 'slug' => 'monitoring-and-impact-storytelling', 'duration_minutes' => 23],
                ],
            ],
        ];

        foreach ($courses as $courseData) {
            $lessons = $courseData['lessons'];
            unset($courseData['lessons']);

            $course = Course::updateOrCreate(['slug' => $courseData['slug']], $courseData);

            foreach ($lessons as $index => $lessonData) {
                Lesson::updateOrCreate(
                    ['course_id' => $course->id, 'slug' => $lessonData['slug']],
                    [
                        'title' => $lessonData['title'],
                        'content' => "This lesson explores {$lessonData['title']} with Tanzania-focused examples and actionable guidance for participants.",
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'duration_minutes' => $lessonData['duration_minutes'],
                        'position' => $index + 1,
                    ]
                );
            }
        }
    }
}
