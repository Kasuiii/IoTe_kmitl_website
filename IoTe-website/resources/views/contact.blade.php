@extends('layouts.app')
@section('title', 'Contact Us')
@push('styles')
    <style>
        body {
            background: #e1e2e6;
        }

        .main_layout {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px;
        }

        .left_content {
            width: 55%;
        }

        .header_contact {
            text-align: left;
            margin-top: 20px;
        }

        .header_contact h2 {
            font-size: 20px;
            color: #ff751f;
            margin-left: 20px;
        }

        .header_contact h3 {
            font-size: 24px;
            color: #ff751f;
            margin-left: 20px;
        }

        .header_contact p {
            font-size: 18px;
            margin-left: 20px;
        }

        .hero {
            padding: 10px 0;
        }

        .hero-box {
            background: #ff7a2f;
            display: inline-block;
            padding: 10px 20px;
            border-bottom-right-radius: 60px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .corner1 {
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: #ff751f;
            clip-path: polygon(100% 0, 0 0, 100% 100%);
        }

        .corner2 {
            position: absolute;
            top: 0;
            right: 0;
            width: 160px;
            height: 160px;
            background: #ff3131;
            clip-path: polygon(100% 0, 0 0, 100% 100%);
        }

        .contact_row {
            display: flex;
            gap: 80px;
            margin-left: 20px;
            margin-top: 40px;
        }

        .contact_item {
            display: flex;
            flex-direction: column;
        }

        .contact_icon {
            font-size: 20px;
            color: #000;
            background: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }

        .contact_text {
            font-size: 16px;
            margin-top: 10px;
            margin-left: 20px;
        }

        .contact_text h4 {
            margin: 5px 0;
        }

        a {
            color: #ff751f;
            font-weight: bold;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .map_box {
            width: 420px;
            background: #8e948a;
            padding: 15px;
            border-radius: 25px;
        }

        .map_box img {
            width: 100%;
            border-radius: 15px;
        }

        .background_shape {
            position: absolute;
            right: 0;
            top: 0;
            width: 55%;
            height: 100%;
            background: #c7c8cc;
            clip-path: polygon(25% 0, 100% 0, 100% 100%, 0% 100%);
            z-index: -1;
        }

        .map_box {
            width: 420px;
            background: #8e948a;
            padding: 18px;
            border-radius: 28px;
            margin-top: 120px;
        }

        .map_box img {
            width: 100%;
            border-radius: 18px;
        }

        .main_layout {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 40px;
        }

        .section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 40px;
            margin-top: 80px;
        }

        .background_shape_bottom {
            position: absolute;
            right: 0;
            top: 520px;
            width: 55%;
            height: 100%;
            background: #d3d4d8;
            clip-path: polygon(25% 0, 100% 0, 100% 100%, 0% 100%);
            z-index: -1;
        }
    </style>
@endpush

@section('content')
    <div class="background_shape"></div>

    <!-- hero -->
    <section class="hero">
        <div class="hero-box">
            <h1>CONTACT US</h1>
        </div>
    </section>

    <div class="corner1"></div>
    <div class="corner2"></div>

    <div class="main_layout">
        <!-- LEFT CONTENT -->
        <div class="left_content">
            <div class="header_contact">
                <h2>KMITL</h2>
                <h3>ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ</h3>
                <h3>Department of IoT and Information Engineering</h3>

                <p>
                    สามารถตรวจสอบเส้นทางได้จากภาพแผนที่ในเว็บไซต์
                    <a href="https://kmitl-map.vercel.app/" target="_blank">คลิกที่นี่</a>
                </p>
            </div>

            <!-- EMAIL + PHONE -->
            <div class="contact_row">
                <div class="contact_item">
                    <div class="contact_icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>

                    <div class="contact_text">
                        <h4>Email</h4>
                        pikulkaew.ta@kmitl.ac.th
                        <br />
                        iote@kmitl.ac.th
                    </div>
                </div>

                <div class="contact_item">
                    <div class="contact_icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>

                    <div class="contact_text">
                        <h4>Phone</h4>
                        02-329-8000 ext.5129
                        <br />
                        02-329-8301 ext.235
                    </div>
                </div>
            </div>

            <!-- LOCATION -->
            <div class="contact_item" style="margin-left: 20px; margin-top: 30px">
                <div class="contact_icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <div class="contact_text">
                    <h4>Location</h4>
                    ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ
                    <br />
                    คณะวิศวกรรมศาสตร์ สจล.
                    <br />
                    ชั้น 12 อาคารเรียนรวม 12 ชั้น
                    <br />
                    เลขที่ 1 ซอยฉลองกรุง 1 เขตลาดกระบัง
                    <br />
                    กรุงเทพมหานคร 10520
                    <br />

                    <a href="https://www.google.com/maps/search/13.727629,+100.772419" target="_blank">Get Directions</a>
                </div>
            </div>
        </div>

        <!-- MAP RIGHT -->
        <div class="map_box">
            <img src="https://old-engineer.kmitl.ac.th/wp-content/uploads/2020/06/4-11.jpg" alt="KMITL Map" />
        </div>
    </div>

    <div class="background_shape_bottom"></div>

    <div class="section">
        <!-- LEFT CONTENT -->
        <div class="left_content">
            <div class="header_contact">
                <h2>KMITL</h2>
                <h3>ภาควิชาฟิสิกส์อุตสาหกรรม</h3>
                <h3>Industrial Physics</h3>

                <p>
                    สามารถตรวจสอบเส้นทางได้จากภาพแผนที่ในเว็บไซต์
                    <a href="#">คลิกที่นี่</a>
                </p>
            </div>

            <!-- EMAIL + PHONE -->
            <div class="contact_row">
                <div class="contact_item">
                    <div class="contact_icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>

                    <div class="contact_text">
                        <h4>Email</h4>
                        science@kmitl.ac.th
                    </div>
                </div>

                <div class="contact_item">
                    <div class="contact_icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>

                    <div class="contact_text">
                        <h4>Phone</h4>
                        02-329-8000 ext.6214
                    </div>
                </div>
            </div>

            <!-- LOCATION -->
            <div class="contact_item" style="margin-left: 20px; margin-top: 30px">
                <div class="contact_icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <div class="contact_text">
                    <h4>Location</h4>

                    หลักสูตรฟิสิกส์อุตสาหกรรม ภาควิชาฟิสิกส์
                    <br />
                    คณะวิทยาศาสตร์ สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง
                    <br />
                    ตึกจุฬาภรณ์วลัยลักษณ์ 1 ชั้น 3
                    <br />
                    เลขที่ 1 ซอยฉลองกรุง 1 แขงลาดกระบัง เขตลาดกระบัง
                    <br />
                    กรุงเทพมหานคร 10520
                    <br />

                    <a
                        href="https://www.google.com/maps/place/Applied+Physics+KMITL/@13.7296467,100.7796526,70m/data=!3m1!1e3!4m6!3m5!1s0x311d67391385d037:0xf91039cb76a0f9db!8m2!3d13.729576!4d100.7799348!16s%2Fg%2F11f7nl5lzg?entry=tts&g_ep=EgoyMDI2MDExMy4wIPu8ASoASAFQAw%3D%3D&skid=0a868dcb-10ce-4ab5-a156-a9fad64eeff1"
                    >
                        Get Directions
                    </a>
                </div>
            </div>
        </div>

        <!-- MAP -->
        <div class="map_box">
            <img src="https://old-engineer.kmitl.ac.th/wp-content/uploads/2020/06/2-11.jpg" alt="Science Map" />
        </div>
    </div>
@endsection
