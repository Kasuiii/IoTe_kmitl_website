<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StarterFacultyMember extends Seeder
{
    public function run(): void
    {
        $faculty = [

            [
                'prefix' => 'ศ.',
                'name_en' => 'Apirat Siritaratiwat',
                'name_th' => 'อภิรัฐ ศิริธราธิวัตร',
                'position' => 'professor',
                'role' => 'รองหัวหน้าภาควิชา (ฝ่ายวิจัยและนวัตกรรม)',
                'email' => null,
                'research_interests' => 'Research & Innovation',
                'photo_url' => null,
            ],

            [
                'prefix' => 'ศ.',
                'name_en' => 'Pitikhate Sooraksa',
                'name_th' => 'ปิติเขต สู้รักษา',
                'position' => 'professor',
                'role' => 'อาจารย์ประจำหลักสูตร',
                'email' => 'pitikhate.so@kmitl.ac.th',
                'research_interests' => 'IT Automation, Industrial Informatics',
                'photo_url' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจปิติเขต.jpg',
            ],

            [
                'prefix' => 'รศ.',
                'name_en' => 'Boonchana Purahong',
                'name_th' => 'บุณย์ชนะ ภู่ระหงษ์',
                'position' => 'associate',
                'role' => 'ประธานหลักสูตรฯ',
                'email' => 'boonchana.pu@kmitl.ac.th',
                'research_interests' => 'Microprocessor, Microcontroller, Robotics, IoT & Smart System',
                'photo_url' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/kpboonch-251x300.jpg',
            ],

            [
                'prefix' => 'รศ.',
                'name_en' => 'Attasit Lasakul',
                'name_th' => 'อรรถสิทธิ์ หล่าสกุล',
                'position' => 'associate',
                'role' => 'อาจารย์พิเศษ',
                'email' => 'attasit.la@kmitl.ac.th',
                'research_interests' => 'Digital Processing, Image Watermarking, Embedded Systems, Machine Vision',
                'photo_url' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจอรรถ.jpg',
            ],

            [
                'prefix' => 'ผศ.',
                'name_en' => 'Vanvisa Chutchavong',
                'name_th' => 'วันวิสา ชัชวงษ์',
                'position' => 'assistant',
                'role' => 'รองหัวหน้าภาควิชา (ฝ่ายการเงิน)',
                'email' => 'vanvisa.ch@kmitl.ac.th',
                'research_interests' => 'Electronic, Bernstein Filter, Railway Signaling, Pattern Recognition',
                'photo_url' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจไก่.jpg',
            ],

            [
                'prefix' => 'ผศ.',
                'name_en' => 'Natchanai Roongmuanpha',
                'name_th' => 'นัชนัยน์ รุ่งเหมือนฟ้า',
                'position' => 'assistant',
                'role' => 'รองหัวหน้าภาควิชา (ฝ่ายต่างประเทศ)',
                'email' => 'natchanai.ro@kmitl.ac.th',
                'research_interests' => 'Immittance Simulators, Active Analog Filters, Oscillator Design, Chaotic Circuits',
                'photo_url' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/07/อจโอม.jpg',
            ],

            [
                'prefix' => 'ผศ.',
                'name_en' => 'Kleddao Satcharoen',
                'name_th' => 'เกล็ดดาว สัตย์เจริญ',
                'position' => 'assistant',
                'role' => 'อาจารย์ประจำภาควิชา',
                'email' => 'kleddao.sa@kmitl.ac.th',
                'research_interests' => 'Human Computer Interaction, User Interfaces',
                'photo_url' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจฝน.jpg',
            ],

            [
                'prefix' => 'ผศ.',
                'name_en' => 'Nitjaree Satayarak',
                'name_th' => 'นิจจารีย์ สัตยารักษ์',
                'position' => 'assistant',
                'role' => 'รองหัวหน้าภาควิชา (ฝ่ายกิจการนักศึกษา)',
                'email' => 'nitjaree.sa@kmitl.ac.th',
                'research_interests' => 'Software Engineering, Distributed Testing System',
                'photo_url' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจนิจ.jpg',
            ],

            [
                'prefix' => 'ดร.',
                'name_en' => 'Suwilai Phumpho',
                'name_th' => 'สุวิไล พุ่มโพธิ์',
                'position' => 'lecturer',
                'role' => 'รองหัวหน้าภาควิชา (ฝ่ายกิจการภายนอก)',
                'email' => 'suwilai.ph@kmitl.ac.th',
                'research_interests' => 'Immittance Function Simulators',
                'photo_url' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2025/10/images.jpg',
            ],

        ];

        foreach ($faculty as $index => $member) {
            DB::table('faculty_members')->insert([
                ...$member,
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
