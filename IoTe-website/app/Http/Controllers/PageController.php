<?php

namespace App\Http\Controllers;

use App\Models\AdmissionRound;
use App\Models\AdmissionProject;
use App\Models\FacultyMember;
use Illuminate\Http\Request;
use App\Models\course;

class PageController extends Controller
{
    public function home()
    {
        return view('index');
    }

    public function laboratoriesIndex()
    {
        return view('laboratories.index');
    }

    public function laboratoriesShow($id)
    {
        $labs = $this->getLabsData();

        if (!isset($labs[$id])) {
            abort(404);
        }

        return view('laboratories.show', ['lab' => $labs[$id]]);
    }

    public function admission()
    {
        $rounds = AdmissionRound::with('projects')   // eager load = load related projects in one query
            ->orderBy('sort_order')
            ->get();
        return view('admission.index', compact('rounds'));
    }

    public function syllabus()
    {
        $allCourses = Course::orderBy('courseDegree')
            ->orderBy('courseYear')
            ->orderBy('courseSemester')
            ->orderBy('courseID')
            ->get();
        $grouped = $allCourses
            ->groupBy('courseDegree')
            ->map(
                fn($degreeGroup) =>
                $degreeGroup->groupBy('courseYear')
                    ->map(
                        fn($yearGroup) =>
                        // For EACH year group, group again by semester
                        $yearGroup->groupBy('courseSemester')
                    )
            );
        // $grouped = course::OrderBy('courseDegree')
        //     ->orderBy('courseYear')
        //     ->orderBy('courseSemester')
        //     ->orderBy('courseID')
        //     ->get()
        //     ->groupBy('courseDegree')
        //     ->map(
        //         fn($degreeGroup) =>
        //         $degreeGroup->groupBy('courseYear')
        //             ->map(
        //                 fn($yearGroup) =>
        //                 $yearGroup->groupBy('courseSemester')
        //             )
        //     );
        $credits = $allCourses
            ->groupBy('courseDegree')
            ->map(
                fn($degreeGroup) =>
                $degreeGroup->groupBy('courseType')
                    ->map(
                        fn($typeGroup) =>
                        $typeGroup->sum('courseCredit')
                    )
            );
        // $credits = Course::get()
        //     ->groupBy('courseDegree')
        //     ->map(
        //         fn($degreeGroup) =>
        //         $degreeGroup->groupBy('courseType')
        //             ->map(
        //                 fn($typeGroup) =>
        //                 $typeGroup->sum('courseCredit')
        //             )
        //     );
        return view('syllabus', compact('grouped'), compact('credits'));
    }

    public function faculty()
    {
        $faculty = FacultyMember::orderBy('sort_order')->get()->map(function ($f) {

            return [
                'rank' => $f->rank ?? 0,
                'rank_label' => $f->rank_label ?? $f->position,
                'en' => $f->name_en,
                'th' => $f->name_th,
                'role' => $f->role,
                'position' => $f->position,
                'email' => $f->email,
                'research_interests' => $f->research_interests ? explode(',', $f->research_interests) : [],
                'img' => $f->photo_url,

                // convert expertise string → array
                'expertise' => $f->expertise
                    ? explode(',', $f->expertise)
                    : []
            ];
        });

        return view('faculty.index', compact('faculty'));
    }

    public function addCourse()
    {
        return view('add_course');
    }

    // public function test_contact()
    // {
    //     return view('test_contact');
    // }

    public function contact()
    {
        return view('contact');
    }
    public function about_us()
    {
        return view('about_us');
    }
    public function syllabusDual()
    {
        return view('syllabus.dual');
    }

    //Lab Data

    private function getLabsData(): array
    {
        return [
            1 => [
                'number'      => '01',
                'short'       => 'Cybersecurity Lab',
                'name'        => 'Cybersecurity Laboratory',
                'category'    => 'Hardware & Software',
                'description' => '',
                'image'       => 'https://www.iote.kmitl.ac.th/wp-content/uploads/2025/09/landscape.png',
                'students'    => 17,
                'projects'    => 12,
                'founded'     => 2020,
                'head'        => 'Asst.Prof.Dr.Auttapon Pomsathit',
                'location'    => 'E-12 Building, IoTe Department',
                'capacity'    => null,
                'email'       => 'iote@kmitl.ac.th',
                'about'       => [
                    'IT and IoT Cyber Security Laboratory** is a dedicated environment where students, professionals, and researchers can practice and enhance their skills in defending against and analyzing cyber threats. These labs are equipped with tools and technologies that simulate real-world cyber attacks and defense strategies, allowing users to test their knowledge in a controlled, safe setting.',
                ],
                'focus' => [
                    ['title' => 'AI Data analytics', 'desc' => 'AI data analysis for cyber security'],
                    ['title' => 'Penetration Testing', 'desc' => 'Penetration testing for testing security on system'],
                    ['title' => 'Network Infrastructure', 'desc' => 'Network Infrastructure focus on improvement of network security'],
                ],
                'equipment' => [
                    'Cybersecurity Research Workstations (High-performance PCs ×15)',
                    'Virtualization Servers for Cyber Range (Proxmox / VMware Cluster ×4)',
                    'Network Security Lab (Managed Switches & Enterprise Routers ×10)',
                    'Hardware Firewalls (pfSense / Fortinet) ×6',
                    'Penetration Testing Toolkit (Kali Linux Lab Machines ×12)',
                    'Network Packet Analysis Tools (Wireshark & TAP Devices)',
                    'Software Defined Radio Kits (HackRF One / RTL-SDR) ×6',
                    'IoT Security Testing Boards (ESP32 / Raspberry Pi / ARM Devices ×25)',
                    'Hardware Security Modules (HSM) for Cryptography Research',
                    'USB & Firmware Analysis Tools (Bus Pirate / Logic Analyzer)',
                    'RF Signal Analysis Equipment',
                    'Cyber Range Simulation Platform',
                    'Digital Forensics Workstations',
                    'Password Cracking GPU Servers ×2',
                    'Secure Network Sandbox Environment',
                ],
                'research' => [],
                'team' => [
                    [
                        'name' => 'Asst. Prof. Dr. Auttapon Pomsathit',
                        'role' => 'Cybersecurity Research Lead',
                        'avatar' => '👨‍🔬'
                    ],

                    [
                        'name' => 'Chinnawat Silathanasan',
                        'role' => 'AI Data Analytics Research Assistant',
                        'avatar' => '🧑‍💻'
                    ],

                    [
                        'name' => 'Thitipan Sornkot',
                        'role' => 'AI Data Analytics Research Assistant',
                        'avatar' => '🧑‍💻'
                    ],

                    [
                        'name' => 'Supareak Harasan',
                        'role' => 'Penetration Testing Research Assistant',
                        'avatar' => '🛡️'
                    ],

                    [
                        'name' => 'Sorrapat Pisil',
                        'role' => 'Penetration Testing Research Assistant',
                        'avatar' => '🛡️'
                    ],

                    [
                        'name' => 'Krit Kasemtewin',
                        'role' => 'Network Infrastructure Research Assistant',
                        'avatar' => '🌐'
                    ],

                    [
                        'name' => 'Teeramet Pintupaisitwong',
                        'role' => 'Network Infrastructure Research Assistant',
                        'avatar' => '🌐'
                    ],
                ]
            ],
        ];
    }
}
