<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReservableItem;

class ReservableItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [

            [
                'name' => 'Arduino Uno R3',
                'category' => 'Microcontroller',
                'description' => 'Arduino development board for IoT and embedded systems.',
                'image_url' => 'https://store.arduino.cc/cdn/shop/products/A000066_03.front_643x483.jpg',
                'faculty_access' => 'engineering',
                'quantity_total' => 20,
                'quantity_available' => 20,
                'max_borrow_days' => 7,
                'is_active' => true
            ],

            [
                'name' => 'Raspberry Pi 4',
                'category' => 'Microcomputer',
                'description' => 'Raspberry Pi 4 Model B for IoT and edge computing projects.',
                'image_url' => 'https://www.raspberrypi.com/app/uploads/2019/06/raspberry-pi-4-labelled.jpg',
                'faculty_access' => 'engineering',
                'quantity_total' => 10,
                'quantity_available' => 10,
                'max_borrow_days' => 7,
                'is_active' => true
            ],

            [
                'name' => 'Digital Multimeter',
                'category' => 'Measurement',
                'description' => 'Standard digital multimeter for voltage, current, and resistance.',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/3/3e/Digital_Multimeter.jpg',
                'faculty_access' => 'all',
                'quantity_total' => 15,
                'quantity_available' => 15,
                'max_borrow_days' => 5,
                'is_active' => true
            ],

            [
                'name' => 'Oscilloscope',
                'category' => 'Measurement',
                'description' => 'Digital oscilloscope for waveform analysis.',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/e/e5/Oscilloscope.jpg',
                'faculty_access' => 'engineering',
                'quantity_total' => 5,
                'quantity_available' => 5,
                'max_borrow_days' => 3,
                'is_active' => true
            ],

            [
                'name' => 'Physics Optics Kit',
                'category' => 'Laboratory Kit',
                'description' => 'Optics experiment kit for physics laboratory.',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/2/21/Optics_kit.jpg',
                'faculty_access' => 'science',
                'quantity_total' => 8,
                'quantity_available' => 8,
                'max_borrow_days' => 5,
                'is_active' => true
            ],

            [
                'name' => 'Soldering Station',
                'category' => 'Tools',
                'description' => 'Temperature controlled soldering station.',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/b/b9/Soldering_station.jpg',
                'faculty_access' => 'all',
                'quantity_total' => 12,
                'quantity_available' => 12,
                'max_borrow_days' => 3,
                'is_active' => true
            ],

        ];

        foreach ($items as $item) {
            ReservableItem::create($item);
        }
    }
}
