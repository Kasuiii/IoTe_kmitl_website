<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdmissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admission_projects')->delete();
        DB::table('admission_rounds')->delete();

        // ROUND 1 – PORTFOLIO
        $round1 = DB::table('admission_rounds')->insertGetId([
            'round_number' => 1,
            'round_name'   => 'Portfolio',
            'round_name_th' => 'รอบที่ 1 พอร์ตโฟลิโอ',
            'total_seats'  => 75,
            'badge_color'  => 'crimson',
            'description'  => 'การรับสมัครรอบ Portfolio สำหรับนักเรียนที่มีผลงานดีเด่น',
            'sort_order'   => 1,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $portfolioProjects = [
            [
                'project_name'    => 'Young Engineering Talent',
                'project_name_th' => 'โครงการ Young Engineering Talent',
                'seats'           => 30,
                'requirements'    => "- รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง / นานาชาติ / อาชีวะ\n- เคยได้รับรางวัลการแข่งขันระดับชาติหรือนานาชาติ ด้านคณิตศาสตร์ – วิทยาศาสตร์ หรือเทคโนโลยีที่เกี่ยวข้อง\n- ไม่มีโรคสำคัญที่เป็นอุปสรรคต่อการศึกษา",
                'score_criteria'  => null,
                'gpax_min'        => '3.50',
                'notes'           => 'รับร่วมกัน 30 คน (ขั้นต่ำ 5 ภาคการศึกษา)',
                'sort_order'      => 1,
            ],
            [
                'project_name'    => 'Academic Excellence (General Curriculum)',
                'project_name_th' => 'โครงการเรียนดี ช้างเผือก กลุ่มโรงเรียนสายสามัญ',
                'seats'           => 30,
                'requirements'    => "- รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง / นานาชาติ\n- โรงเรียนเสนอชื่อนักเรียนที่มีผลการเรียนเฉลี่ยสะสม 5 ภาคการศึกษาสูงที่สุด",
                'score_criteria'  => null,
                'gpax_min'        => null,
                'notes'           => 'รับร่วมกัน 30 คน โรงเรียนเป็นผู้เสนอชื่อ',
                'sort_order'      => 2,
            ],
            [
                'project_name'    => 'Academic Awards and Certificates',
                'project_name_th' => 'โครงการรางวัลและประกาศนียบัตรทางวิชาการ',
                'seats'           => 30,
                'requirements'    => "- รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง / นานาชาติ\n- มีผลงาน รางวัล หรือประกาศนียบัตร\n- ไม่มีโรคสำคัญที่เป็นอุปสรรคต่อการศึกษา",
                'score_criteria'  => null,
                'gpax_min'        => '3.00',
                'notes'           => 'รับร่วมกัน 30 คน (ขั้นต่ำ 5 ภาคการศึกษา)',
                'sort_order'      => 3,
            ],
            [
                'project_name'    => 'Science School',
                'project_name_th' => 'โครงการโรงเรียนวิทยาศาสตร์',
                'seats'           => 30,
                'requirements'    => "- รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง / นานาชาติ\n- กำลังศึกษา ม.6 สายวิทยาศาสตร์ – คณิตศาสตร์ ในโรงเรียนวิทยาศาสตร์ หรือโรงเรียนที่มีโครงการห้องเรียนพิเศษด้านวิทยาศาสตร์/คณิตศาสตร์\n- ไม่มีโรคสำคัญที่เป็นอุปสรรคต่อการศึกษา",
                'score_criteria'  => null,
                'gpax_min'        => '3.00',
                'notes'           => 'รับร่วมกัน 30 คน (ขั้นต่ำ 5 ภาคการศึกษา)',
                'sort_order'      => 4,
            ],
            [
                'project_name'    => 'Engineering Pathway',
                'project_name_th' => 'โครงการ Engineering Pathway',
                'seats'           => 30,
                'requirements'    => "- รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง / นานาชาติ / อาชีวะ\n- เข้าร่วมโครงการ Pre-Engineering School ที่จัดโดยคณะวิศวกรรมศาสตร์ สจล.\n- คะแนนเฉลี่ยสะสมรวมอย่างน้อย 3.5 จาก 6 วิชา\n- ไม่มีโรคสำคัญที่เป็นอุปสรรคต่อการศึกษา",
                'score_criteria'  => null,
                'gpax_min'        => '3.50',
                'notes'           => 'รับร่วมกัน 30 คน (คะแนนเฉลี่ยจาก Pre-Engineering School)',
                'sort_order'      => 5,
            ],
            [
                'project_name'    => 'POSN Quota',
                'project_name_th' => 'โครงการโควตานักเรียนมูลนิธิ สอวน.',
                'seats'           => 40,
                'requirements'    => "- รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง / นานาชาติ\n- กำลังศึกษาหรือสำเร็จการศึกษา ม.6 สายวิทย์-คณิต หรือ ศิลป์-คำนวณ\n- สำเร็จการอบรมค่าย 2 ของมูลนิธิ สอวน.",
                'score_criteria'  => null,
                'gpax_min'        => '2.75',
                'notes'           => 'รวมทุกหลักสูตร 40 คน (ขั้นต่ำ 4 ภาคการศึกษา)',
                'sort_order'      => 6,
            ],
            [
                'project_name'    => 'KMITL Staff Children',
                'project_name_th' => 'โครงการบุตรของบุคลากร สจล.',
                'seats'           => 5,
                'requirements'    => "- รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง / นานาชาติ\n- กำลังศึกษา ม.6 สายวิทยาศาสตร์ – คณิตศาสตร์\n- เป็นบุตรโดยชอบด้วยกฎหมายของพนักงาน / ข้าราชการ / ลูกจ้างประจำ สจล. (ยกเว้นบุตรบุญธรรม)\n- ไม่มีโรคสำคัญที่เป็นอุปสรรคต่อการศึกษา",
                'score_criteria'  => null,
                'gpax_min'        => '2.75',
                'notes'           => 'รวมทุกหลักสูตร 5 คน (ขั้นต่ำ 5 ภาคการศึกษา)',
                'sort_order'      => 7,
            ],
        ];

        foreach ($portfolioProjects as $project) {
            DB::table('admission_projects')->insert(array_merge($project, [
                'admission_round_id' => $round1,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]));
        }

        // ROUND 2 – QUOTA
        $round2 = DB::table('admission_rounds')->insertGetId([
            'round_number'  => 2,
            'round_name'    => 'Quota',
            'round_name_th' => 'รอบที่ 2 โควตา',
            'total_seats'   => 15,
            'badge_color'   => 'steelblue',
            'description'   => 'การรับสมัครรอบโควตา',
            'sort_order'    => 2,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        $quotaProjects = [
            [
                'project_name'    => 'Academic Excellence Quota',
                'project_name_th' => 'โควตาเรียนดี',
                'seats'           => 15,
                'requirements'    => "- รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง / นานาชาติ / อาชีวะ\n- มีผลการเรียนเฉลี่ยสะสมรวมอย่างน้อย 5 ภาคการศึกษา ไม่น้อยกว่า 3.00",
                'score_criteria'  => null,
                'gpax_min'        => '3.00',
                'notes'           => 'รับร่วมกัน 15 คน',
                'sort_order'      => 1,
            ],
            [
                'project_name'    => 'K-Engineering Activity Quota',
                'project_name_th' => 'โควตากิจกรรม K-Engineering',
                'seats'           => 15,
                'requirements'    => "- รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง / นานาชาติ / อาชีวะ\n- ผ่านการเข้าร่วมกิจกรรมและได้รับประกาศนียบัตรในโครงการทางวิชาการกับคณะวิศวกรรมศาสตร์ สจล.",
                'score_criteria'  => null,
                'gpax_min'        => '2.75',
                'notes'           => 'รับร่วมกัน 15 คน (ขั้นต่ำ 5 ภาคการศึกษา)',
                'sort_order'      => 2,
            ],
            [
                'project_name'    => 'KMITL One Quota',
                'project_name_th' => 'โควตา KMITL One',
                'seats'           => 15,
                'requirements'    => "- รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง / นานาชาติ / อาชีวะ\n- GPAX 5 ภาคการศึกษา > 3.00 หรือ > 2.75 สำหรับผู้สมัครโครงการ K-Engineering",
                'score_criteria'  => null,
                'gpax_min'        => '2.75',
                'notes'           => 'รับร่วมกัน 15 คน',
                'sort_order'      => 3,
            ],
        ];

        foreach ($quotaProjects as $project) {
            DB::table('admission_projects')->insert(array_merge($project, [
                'admission_round_id' => $round2,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]));
        }

        // ROUND 3 – ADMISSION
        $round3 = DB::table('admission_rounds')->insertGetId([
            'round_number'  => 3,
            'round_name'    => 'Admission',
            'round_name_th' => 'รอบที่ 3 แอดมิชชัน',
            'total_seats'   => 5,
            'badge_color'   => 'seagreen',
            'description'   => 'การรับสมัครรอบ Admission ใช้คะแนน TGAT / TPAT3 / A-Level',
            'sort_order'    => 3,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        DB::table('admission_projects')->insert([
            'admission_round_id' => $round3,
            'project_name'       => 'Central Admission',
            'project_name_th'    => 'แอดมิชชัน',
            'seats'              => 5,
            'requirements'       => "- รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง / นานาชาติ / อาชีวะ\n- กำลังศึกษาหรือสำเร็จการศึกษา ม.ปลาย สายวิทย์-คณิต หรือ ปวช. สายช่างอุตสาหกรรม",
            'score_criteria'     => "TGAT (ความถนัดทั่วไป) 20%\nTPAT3 (วิทยาศาสตร์ เทคโนโลยี วิศวกรรมศาสตร์) 25%\nA-Level คณิตศาสตร์ประยุกต์ 1 (พื้นฐาน+เพิ่มเติม) 25%\nA-Level ฟิสิกส์ 30%",
            'gpax_min'           => null,
            'notes'              => '5 คน',
            'sort_order'         => 1,
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);
    }
}
