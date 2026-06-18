<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

const STATES = [
        'AL'=>['Alabama'=>251],
        'AK'=>['Alaska'=> 251],
        'AZ'=>['Arizona'=> 251],
        'AR'=>['Arkansas'=> 251],
        'CA'=>['California'=> 251],
        'CO'=>['Colorado'=> 251],
        'CT'=>['Connecticut'=> 251],
        'DE'=>['Delaware'=> 251],
        'DC'=>['District of Columbia'=> 251],
        'FL'=>['Florida'=> 251],
        'GA'=>['Georgia'=> 251],
        'HI'=>['Hawaii'=> 251],
        'ID'=>['Idaho'=> 251],
        'IL'=>['Illinois'=> 251],
        'IN'=>['Indiana'=> 251],
        'IA'=>['Iowa'=> 251],
        'KS'=>['Kansas'=> 251],
        'KY'=>['Kentucky'=> 251],
        'LA'=>['Louisiana'=> 251],
        'ME'=>['Maine'=> 251],
        'MD'=>['Maryland'=> 251],
        'MA'=>['Massachusetts'=> 251],
        'MI'=>['Michigan'=> 251],
        'MN'=>['Minnesota'=> 251],
        'MS'=>['Mississippi'=> 251],
        'MO'=>['Missouri'=> 251],
        'MT'=>['Montana'=> 251],
        'NE'=>['Nebraska'=> 251],
        'NV'=>['Nevada'=> 251],
        'NH'=>['New Hampshire'=> 251],
        'NJ'=>['New Jersey'=> 251],
        'NM'=>['New Mexico'=> 251],
        'NY'=>['New York'=> 251],
        'NC'=>['North Carolina'=> 251],
        'ND'=>['North Dakota'=> 251],
        'OH'=>['Ohio'=> 251],
        'OK'=>['Oklahoma'=> 251],
        'OR'=>['Oregon'=> 251],
        'PA'=>['Pennsylvania'=> 251],
        'RI'=>['Rhode Island'=> 251],
        'SC'=>['South Carolina'=> 251],
        'SD'=>['South Dakota'=> 251],
        'TN'=>['Tennessee'=> 251],
        'TX'=>['Texas'=> 251],
        'UT'=>['Utah'=> 251],
        'VT'=>['Vermont'=> 251],
        'VA'=>['Virginia'=> 251],
        'WA'=>['Washington'=> 251],
        'WV'=>['West Virginia'=> 251],
        'WI'=>['Wisconsin'=> 251],
        'WY'=>['Wyoming'=> 251],
        'BC' =>['British Columbia' => 41],
        'ON' =>['Ontario' => 41],
        'NL' =>['Newfoundland and Labrador' => 41],
        'NS' =>['Nova Scotia' => 41],
        'PE' =>['Prince Edward Island' => 41],
        'NB' =>['New Brunswick' => 41],
        'QC' =>['Quebec' => 41],
        'MB' =>['Manitoba' => 41],
        'SK' =>['Saskatchewan' => 41],
        'AB' =>['Alberta' => 41],
        'NT' =>['Northwest Territories' => 41],
        'NU' =>['Nunavut' => 41],
        'YT' =>['Yukon Territory' => 41],
];

class TenantStatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //load countries
        foreach (STATES as $abbrev => $state) {
            State::query()->create([
                'name' => key($state),
                'country_id' => $state[key($state)],
                'abbrev' => $abbrev
            ]);
        }
    }
}
