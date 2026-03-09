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
                'short'       => 'Embedded Systems Lab',
                'name'        => 'Embedded Systems Laboratory',
                'category'    => 'Hardware & Firmware',
                'description' => 'Our flagship lab for microcontroller programming, PCB design, RTOS development, and edge computing platforms supporting real-time IoT solutions.',
                'image'       => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=1600',
                'students'    => 80,
                'projects'    => 12,
                'founded'     => 2015,
                'head'        => 'Asst. Prof. Dr. Siriporn Chaiyarak',
                'location'    => 'Building A, Room 301',
                'capacity'    => 30,
                'email'       => 'embedded@iote.kmitl.ac.th',
                'about'       => [
                    'The Embedded Systems Laboratory is the cornerstone of the IoTe programme, providing students with hands-on exposure to the hardware fundamentals that underpin all IoT solutions. Established in 2015, the lab has supported over 400 student projects and produced award-winning research recognised at national and international competitions.',
                    'Students work with ARM Cortex-M and Cortex-A processors, FPGA platforms, and a variety of sensor ecosystems. The lab maintains close ties with semiconductor companies including STMicroelectronics and Texas Instruments, ensuring access to the latest development kits and software tools.',
                    'Research conducted here spans from ultra-low-power sensor node design to real-time control systems for industrial automation, making it a hub for both undergraduate learning and graduate-level investigation.',
                ],
                'focus' => [
                    ['title' => 'Microcontroller Programming', 'desc' => 'ARM Cortex-M, ESP32, PIC — from bare metal to RTOS'],
                    ['title' => 'PCB Design & Fabrication', 'desc' => 'Schematic capture, layout, and in-house rapid prototyping'],
                    ['title' => 'FPGA Development', 'desc' => 'Xilinx and Intel FPGA for custom hardware accelerators'],
                    ['title' => 'Edge AI / TinyML', 'desc' => 'Running inference on resource-constrained embedded devices'],
                ],
                'equipment' => [
                    'STM32 Nucleo & Discovery Boards (×20)',
                    'ESP32-S3 Development Kits (×30)',
                    'Xilinx Artix-7 FPGA Boards (×10)',
                    'Oscilloscopes (Rigol DS1054Z) ×8',
                    'Logic Analysers (Saleae) ×10',
                    'PCB Fabrication Machine (LPKF S103)',
                    'Soldering Stations & Reflow Oven',
                    'Power Supplies (bench) ×15',
                    'Raspberry Pi 4 Cluster ×6',
                    'JTAG/SWD Debuggers ×15',
                    'Multimeters & Handheld Scopes',
                    'Component Inventory (10,000+ parts)',
                    '3D Printer (Bambu Lab X1C)',
                    'Laser Cutter (for enclosures)',
                ],
                'research' => [
                    ['title' => 'Ultra-Low-Power IoT Node for Remote Sensing', 'status' => 'Active', 'desc' => 'Developing sub-10µA sensor nodes with multi-year battery life for remote environmental monitoring in national parks.'],
                    ['title' => 'Edge AI on Microcontrollers for Predictive Maintenance', 'status' => 'Active', 'desc' => 'Deploying neural network inference on STM32 hardware to predict motor failures without cloud connectivity.'],
                    ['title' => 'Custom RISC-V Processor for IoT Security', 'status' => 'Research', 'desc' => 'Designing a lightweight RISC-V core with hardware security extensions suitable for resource-constrained IoT devices.'],
                    ['title' => 'Smart Agricultural Sensor Arrays', 'status' => 'Completed', 'desc' => 'Deployed in 3 provinces across Thailand — monitoring soil moisture, temperature, and nutrient levels in real time.'],
                ],
                'team' => [
                    ['name' => 'Dr. Siriporn Chaiyarak', 'role' => 'Lab Head', 'avatar' => '👩‍🔬'],
                    ['name' => 'Lect. Panida Boonsri', 'role' => 'PCB Specialist', 'avatar' => '👩‍💻'],
                    ['name' => 'Rungroj (RA)', 'role' => 'PhD Researcher', 'avatar' => '🧑‍🎓'],
                    ['name' => 'Kannika (RA)', 'role' => 'MSc Researcher', 'avatar' => '👩‍🎓'],
                ],
            ],
            2 => [
                'number'      => '02',
                'short'       => 'Network & Comms Lab',
                'name'        => 'Network & Communications Laboratory',
                'category'    => 'Connectivity & Protocols',
                'description' => 'A dedicated facility for wireless protocol research, 5G testbeds, network security, LPWAN technologies, and large-scale cloud IoT deployments.',
                'image'       => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1600',
                'students'    => 60,
                'projects'    => 9,
                'founded'     => 2017,
                'head'        => 'Assoc. Prof. Dr. Nattapong Phongsiri',
                'location'    => 'Building B, Room 205',
                'capacity'    => 25,
                'email'       => 'netcomms@iote.kmitl.ac.th',
                'about'       => [
                    'The Network & Communications Laboratory serves as the connectivity backbone of the IoTe research ecosystem. Equipped with both licensed spectrum and unlicensed wireless infrastructure, the lab enables students to experiment with the full stack of IoT communication — from physical layer encoding up to cloud platform integration.',
                    'A private 5G NSA testbed funded by NECTEC provides rare national-level access to next-generation network slicing and ultra-reliable low-latency communications research. The lab also houses one of Thailand\'s few academic LoRaWAN gateways, supporting wide-area IoT research across the KMITL campus.',
                    'Collaborative projects with the National Telecommunications Commission and private telecom operators give students direct exposure to real-world deployment challenges and regulatory frameworks.',
                ],
                'focus' => [
                    ['title' => 'LPWAN Technologies', 'desc' => 'LoRaWAN, Sigfox, NB-IoT — for wide-area low-power IoT'],
                    ['title' => '5G & Private Networks', 'desc' => 'Network slicing, MEC, URLLC for industrial applications'],
                    ['title' => 'IoT Network Security', 'desc' => 'Penetration testing, TLS/DTLS, hardware security modules'],
                    ['title' => 'Protocol Simulation', 'desc' => 'COOJA, NS-3 and Wireshark-based protocol analysis'],
                ],
                'equipment' => [
                    'Private 5G NSA Testbed (NECTEC-funded)',
                    'LoRaWAN Gateways (RAK7289) ×4',
                    'Semtech LoRa Dev Kits ×20',
                    'Cisco Network Switches (managed) ×6',
                    'Fortinet Firewall UTM Appliance',
                    'Wireshark Capture Nodes ×10',
                    'Raspberry Pi 4 Edge Gateways ×12',
                    'AWS IoT / Azure IoT Hub Subscriptions',
                    'SDR (USRP B210) for protocol research ×4',
                    'Zigbee & Z-Wave Dev Kits ×15',
                    'NB-IoT Modules (Quectel BC66) ×20',
                    'Network Traffic Analyser (SolarWinds)',
                ],
                'research' => [
                    ['title' => 'Adaptive LoRaWAN Spreading Factor Optimisation', 'status' => 'Active', 'desc' => 'Developing AI-driven ADR algorithms that improve spectral efficiency by up to 40% in dense IoT deployments.'],
                    ['title' => 'Private 5G for Smart Factory Applications', 'status' => 'Active', 'desc' => 'Evaluating 5G URLLC performance for time-sensitive industrial control applications in collaboration with a local electronics manufacturer.'],
                    ['title' => 'Zero-Trust Security Framework for IoT Gateways', 'status' => 'Research', 'desc' => 'Designing a lightweight mutual authentication and authorisation system suitable for resource-limited IoT gateways.'],
                    ['title' => 'Campus-Wide LoRaWAN Sensor Network', 'status' => 'Completed', 'desc' => 'Deployed 120 sensor nodes across 9 campus buildings monitoring energy, CO₂, and occupancy data for KMITL\'s sustainability initiative.'],
                ],
                'team' => [
                    ['name' => 'Dr. Nattapong Phongsiri', 'role' => 'Lab Head', 'avatar' => '👨‍🔬'],
                    ['name' => 'Lect. Jiraporn Tanasit', 'role' => 'Protocol Engineer', 'avatar' => '👩‍💻'],
                    ['name' => 'Pattarapon (RA)', 'role' => 'PhD Researcher', 'avatar' => '🧑‍🎓'],
                    ['name' => 'Suda (RA)', 'role' => 'MSc Researcher', 'avatar' => '👩‍🎓'],
                ],
            ],
            3 => [
                'number'      => '03',
                'short'       => 'Smart Systems & AI Lab',
                'name'        => 'Smart Systems & AI Laboratory',
                'category'    => 'AI & Intelligent Systems',
                'description' => 'Pushing boundaries in machine learning on embedded devices, computer vision, predictive maintenance, and data analytics for intelligent environments.',
                'image'       => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=1600',
                'students'    => 70,
                'projects'    => 15,
                'founded'     => 2019,
                'head'        => 'Asst. Prof. Dr. Theerapong Kamon',
                'location'    => 'Building C, Room 401',
                'capacity'    => 28,
                'email'       => 'smartai@iote.kmitl.ac.th',
                'about'       => [
                    'The Smart Systems & AI Laboratory is the newest and fastest-growing lab in the IoTe department, reflecting the industry\'s rapid convergence of AI and IoT. Founded in 2019, it focuses on making machine intelligence practical — running directly on sensors, microcontrollers, and edge devices rather than relying on cloud connectivity.',
                    'The lab houses GPU workstations for model training and a diverse fleet of edge hardware for deployment testing, from sub-1W microcontrollers to NVIDIA Jetson AGX platforms. Students learn the full AI pipeline: data collection, labelling, model training, quantisation, and on-device inference.',
                    'Collaborative research with Thailand\'s Precision Agriculture Initiative and NECTEC\'s Smart City programme ensures that projects have real-world impact and deployment opportunities beyond the campus.',
                ],
                'focus' => [
                    ['title' => 'TinyML & On-Device Inference', 'desc' => 'TensorFlow Lite, Edge Impulse — AI on microcontrollers'],
                    ['title' => 'Computer Vision for IoT', 'desc' => 'Object detection, anomaly detection, person tracking'],
                    ['title' => 'Predictive Maintenance', 'desc' => 'Vibration & acoustic analysis for industrial equipment health'],
                    ['title' => 'Digital Twins', 'desc' => 'Real-time simulation models synced with physical sensor data'],
                ],
                'equipment' => [
                    'NVIDIA Jetson AGX Orin Devkits ×6',
                    'NVIDIA Jetson Nano ×10',
                    'GPU Workstations (RTX 4090) ×4',
                    'Industrial USB Cameras ×15',
                    'Thermal Imaging Cameras (FLIR) ×4',
                    'Vibration & Acoustic Sensors ×20',
                    'Edge Impulse Studio Licences',
                    'TensorFlow / PyTorch Deep Learning Stack',
                    'Data Labelling Workstations ×8',
                    'Digital Twin Platform (Azure Digital Twins)',
                    '3-Phase AC Motor Test Benches ×3',
                    'Industrial Robot Arm (UR5e) for AI integration',
                ],
                'research' => [
                    ['title' => 'Real-Time Crop Disease Detection via Drone Cameras', 'status' => 'Active', 'desc' => 'A TinyML model running on Jetson Nano that identifies leaf diseases with 94% accuracy from drone footage without internet connectivity.'],
                    ['title' => 'Predictive Maintenance for Water Pump Networks', 'status' => 'Active', 'desc' => 'Acoustic emission sensors combined with LSTM models predict pump failures 48–72 hours in advance, reducing unplanned downtime by 60%.'],
                    ['title' => 'Digital Twin for KMITL\'s Campus Energy Grid', 'status' => 'Active', 'desc' => 'A real-time digital replica of campus electrical systems, enabling simulation of renewable integration scenarios and demand-response optimisation.'],
                    ['title' => 'Anomaly Detection for Smart Building Security', 'status' => 'Completed', 'desc' => 'Deployed computer vision models across 3 KMITL buildings detecting unauthorised access with <0.2% false positive rate.'],
                ],
                'team' => [
                    ['name' => 'Dr. Theerapong Kamon', 'role' => 'Lab Head', 'avatar' => '👨‍🔬'],
                    ['name' => 'Lect. Wanchai Prom', 'role' => 'ML Engineer', 'avatar' => '👨‍💻'],
                    ['name' => 'Thanyarat (RA)', 'role' => 'PhD Researcher', 'avatar' => '👩‍🎓'],
                    ['name' => 'Narut (RA)', 'role' => 'MSc Researcher', 'avatar' => '🧑‍🎓'],
                ],
            ],
        ];
    }
}
