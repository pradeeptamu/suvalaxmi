<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = [
            ['district' => 'Achham'],
            ['district' => 'Arghakhanchi'],
            ['district' => 'Baglung'],
            ['district' => 'Baidadi'],
            ['district' => 'Bajhang'],
            ['district' => 'Bajura'],
            ['district' => 'Banke'],
            ['district' => 'Bara'],
            ['district' => 'Bardiya'],
            ['district' => 'Bhaktapur'],
            ['district' => 'Bhojpur'],
            ['district' => 'Chitwan'],
            ['district' => 'Dadeldhura'],
            ['district' => 'Dailekh'],
            ['district' => 'Dang'],
            ['district' => 'Darchula'],
            ['district' => 'Deokhuri'],
            ['district' => 'Dhading'],
            ['district' => 'Dhankuta'],
            ['district' => 'Dhanusa'],
            ['district' => 'Dolkha'],
            ['district' => 'Dolpa'],
            ['district' => 'Doti'],
            ['district' => 'Gorkha'],
            ['district' => 'Gulmi'],
            ['district' => 'Humla'],
            ['district' => 'Illam'],
            ['district' => 'Jajarkot'],
            ['district' => 'Jhapa'],
            ['district' => 'Jumla'],
            ['district' => 'Kailali'],
            ['district' => 'Kalikot'],
            ['district' => 'Kanchanpur'],
            ['district' => 'Kapilvastu'],
            ['district' => 'Kaski'],
            ['district' => 'Kathmandu'],
            ['district' => 'Kavrepalanchok'],
            ['district' => 'Khotang'],
            ['district' => 'Lalitpur'],
            ['district' => 'Lamjung'],
            ['district' => 'Mahottari'],
            ['district' => 'Makwanpur'],
            ['district' => 'Manang'],
            ['district' => 'Morang'],
            ['district' => 'Mugu'],
            ['district' => 'Mustang'],
            ['district' => 'Myagdi'],
            ['district' => 'Nawalparasi'],
            ['district' => 'Nuwakot'],
            ['district' => 'Okhaldhunga'],
            ['district' => 'Palpa'],
            ['district' => 'Panchthar'],
            ['district' => 'Parbat'],
            ['district' => 'Parsa'],
            ['district' => 'Pyuthan'],
            ['district' => 'Ramechhap'],
            ['district' => 'Rasuwa'],
            ['district' => 'Rautahat'],
            ['district' => 'Rolpa'],
            ['district' => 'Rukum'],
            ['district' => 'Rupandehi'],
            ['district' => 'Salyan'],
            ['district' => 'Sankhuwasabha'],
            ['district' => 'Saptari'],
            ['district' => 'Sarlahi'],
            ['district' => 'Sindhuli'],
            ['district' => 'Sindhupalchowk'],
            ['district' => 'Siraha'],
            ['district' => 'Solukhumbu'],
            ['district' => 'Sunsari'],
            ['district' => 'Surkhet'],
            ['district' => 'Syangja'],
            ['district' => 'Tanahu'],
            ['district' => 'Taplejung'],
            ['district' => 'Terathum'],
            ['district' => 'Udayapur']
        ];
        foreach($districts as $district){
            Location::create($district);
        }
    }
}
