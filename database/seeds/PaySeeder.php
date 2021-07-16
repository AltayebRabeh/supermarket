<?php

use App\Models\Pay;
use Illuminate\Database\Seeder;

class PaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pay::create([
            'name' => 'الاماني سوبر ماركت',
            'acount_number' => '5574693154879688',
            'password' => bcrypt('2255')
        ]);

        Pay::create([
            'name' => 'محمد علي عمر',
            'acount_number' => '5574693454879674',
            'money' => 800000,
            'password' => bcrypt('2255')
        ]);

        Pay::create([
            'name' => 'ريان ابراهيم علي',
            'acount_number' => '5574692454849677',
            'money' => 2557454,
            'password' => bcrypt('2255')
        ]);

        Pay::create([
            'name' => 'روئ عثمان انور',
            'acount_number' => '5574592454849622',
            'money' => 1700800,
            'password' => bcrypt('2255')
        ]);
    }
}