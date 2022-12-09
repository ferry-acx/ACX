<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Admin;

use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'employee_id'=>'ACX-20-001',
                'username'=>'janmilton',
                'first_name'=>'Jan Milton',
                'last_name'=>'Ganapin',
                'position'=>'CEO',
                'password'=> bcrypt('ACX-20-001'),
            ],
            [
                'employee_id'=>'ACX-20-002',
                'username'=>'lordJulfer',
                'first_name'=>'Julfer Jayward',
                'last_name'=>'Casinillo',
                'position'=>'Operations Manager',
                'password'=> bcrypt('ACX-20-002'),
            ],
            [
                'employee_id'=>'ACX-20-003',
                'username'=>'herman',
                'first_name'=>'Herman',
                'last_name'=>'Mejorada',
                'position'=>'Designer - Quality Analyst',
                'password'=> bcrypt('ACX-20-003'),
            ],
            [
                'employee_id'=>'ACX-20-005',
                'username'=>'maryjoy',
                'first_name'=>'Mary Joy',
                'last_name'=>'Batiquin',
                'position'=>'Super Admin - Admin Staff',
                'password'=> bcrypt('ACX-20-005'),
            ],
            [
                'employee_id'=>'ACX-20-006',
                'username'=>'michael',
                'first_name'=>'Michael',
                'last_name'=>'Lacbayo',
                'position'=>'Super Admin - Admin Staff',
                'password'=> bcrypt('ACX-20-006'),
            ],
            [
                'employee_id'=>'ACX-20-007',
                'username'=>'kenneth',
                'first_name'=>'Kenneth',
                'last_name'=>'Catigan',
                'position'=>'Head Graphic Designer',
                'password'=> bcrypt('ACX-20-007'),
            ],
            [
                'employee_id'=>'ACX-20-008',
                'username'=>'lester',
                'first_name'=>'John Lester',
                'last_name'=>'Ramos',
                'position'=>'Relevate - Designer',
                'password'=> bcrypt('ACX-20-008'),
            ],
            [
                'employee_id'=>'ACX-20-009',
                'username'=>'mark',
                'first_name'=>'Mark Niño',
                'last_name'=>'Pantinople',
                'position'=>'Relevate - Designer',
                'password'=> bcrypt('ACX-20-009'),
            ],
            [
                'employee_id'=>'ACX-20-010',
                'username'=>'alfredo',
                'first_name'=>'Alfredo Jr.',
                'last_name'=>'Sarraga',
                'position'=>'Relevate - Designer',
                'password'=> bcrypt('ACX-20-010'),
            ],
            [
                'employee_id'=>'ACX-20-011',
                'username'=>'jellie',
                'first_name'=>'Jellie Vey',
                'last_name'=>'Saromines',
                'position'=>'Project Coordinator',
                'password'=> bcrypt('ACX-20-011'),
            ],
            [
                'employee_id'=>'ACX-20-014',
                'username'=>'jPaul',
                'first_name'=>'John Paul',
                'last_name'=>'Apa',
                'position'=>'Digital Marketing Associate',
                'password'=> bcrypt('ACX-20-014'),
            ],
            [
                'employee_id'=>'ACX-20-017',
                'username'=>'rica',
                'first_name'=>'Rica Mae',
                'last_name'=>'Mahinay',
                'position'=>'Relevate - Data Specialist',
                'password'=> bcrypt('ACX-20-0017'),
            ],
            [
                'employee_id'=>'ACX-20-020',
                'username'=>'jhandy',
                'first_name'=>'Jhandy',
                'last_name'=>'Amandoron',
                'position'=>'Relevate - Designer',
                'password'=> bcrypt('ACX-20-020'),
            ],
            [
                'employee_id'=>'ACX-20-021',
                'username'=>'junel',
                'first_name'=>'Junel',
                'last_name'=>'Naparate',
                'position'=>'Digital Marketing Associate',
                'password'=> bcrypt('ACX-20-021'),
            ],
            [
                'employee_id'=>'ACX-20-022',
                'username'=>'edda',
                'first_name'=>'Edda Ria',
                'last_name'=>'Rodero',
                'position'=>'Senior Project Coordinator',
                'password'=> bcrypt('ACX-20-022'),
            ],
            [
                'employee_id'=>'ACX-20-023',
                'username'=>'bryl',
                'first_name'=>'Bryl',
                'last_name'=>'Lim',
                'position'=>'Relevate - Designer',
                'password'=> bcrypt('ACX-20-023'),
            ],
            [
                'employee_id'=>'ACX-20-025',
                'username'=>'paulAllen',
                'first_name'=>'Paul Allen',
                'last_name'=>'Velasco',
                'position'=>'Graphic Designer',
                'password'=> bcrypt('ACX-20-025'),
            ],
            [
                'employee_id'=>'ACX-20-027',
                'username'=>'johnFred',
                'first_name'=>'John Fredirick',
                'last_name'=>'Rebaner',
                'position'=>'Web Developer',
                'password'=> bcrypt('ACX-20-027'),
            ],
            [
                'employee_id'=>'ACX-20-028',
                'username'=>'marvinAaron',
                'first_name'=>'Marvin Aaron',
                'last_name'=>'Panerio',
                'position'=>'Web Developer',
                'password'=> bcrypt('ACX-20-028'),
            ],
            [
                'employee_id'=>'ACX-20-029',
                'username'=>'wilma',
                'first_name'=>'Wilma',
                'last_name'=>'Ligan',
                'position'=>'Production Support Staff',
                'password'=> bcrypt('ACX-20-029'),
            ],
            [
                'employee_id'=>'ACX-20-034',
                'username'=>'ninaG',
                'first_name'=>'Niña Grace',
                'last_name'=>'Alisaca',
                'position'=>'Relevate - Designer',
                'password'=> bcrypt('ACX-20-034'),
            ],
            [
                'employee_id'=>'ACX-20-035',
                'username'=>'denwell',
                'first_name'=>'Denwell',
                'last_name'=>'Gonzales',
                'position'=>'Relevate - Designer',
                'password'=> bcrypt('ACX-20-035'),
            ],
            [
                'employee_id'=>'ACX-20-036',
                'username'=>'marlon',
                'first_name'=>'Marlon',
                'last_name'=>'Garcia',
                'position'=>'Virtual Assistant',
                'password'=> bcrypt('ACX-20-036'),
            ],
            [
                'employee_id'=>'ACX-20-037',
                'username'=>'zarah',
                'first_name'=>'Zarah',
                'last_name'=>'Abellana',
                'position'=>'Channel Associate',
                'password'=> bcrypt('ACX-20-037'),
            ],
            [
                'employee_id'=>'ACX-20-038',
                'username'=>'gvy',
                'first_name'=>'Gvy Cypruz',
                'last_name'=>'Teleron',
                'position'=>'Graphic Designer',
                'password'=> bcrypt('ACX-20-038'),
            ],
            [
                'employee_id'=>'ACX-20-039',
                'username'=>'lolits',
                'first_name'=>'Lolita',
                'last_name'=>'Ganapin',
                'position'=>'Super Admin - Admin Staff',
                'password'=> bcrypt('ACX-20-039'),
            ],
            [
                'employee_id'=>'ACX-20-040',
                'username'=>'oljee',
                'first_name'=>'Oljee',
                'last_name'=>'Gamboa',
                'position'=>'Graphic Designer',
                'password'=> bcrypt('ACX-20-040'),
            ],
            [
                'employee_id'=>'ACX-20-041',
                'username'=>'emman',
                'first_name'=>'Emmanuel Jesus',
                'last_name'=>'Niango',
                'position'=>'Office Maintenance Staff',
                'password'=> bcrypt('ACX-20-041'),
            ],
            [
                'employee_id'=>'ACX-20-042',
                'username'=>'nech',
                'first_name'=>'Nech Michelle',
                'last_name'=>'Tuazon',
                'position'=>'Graphic Designer',
                'password'=> bcrypt('ACX-20-042'),
            ],

            
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }

        $admin = [
            [
                'admin_employee_id'=>'ACX-20-005',
                'username'=>'admin1',
                'password'=> bcrypt('admin1'),
            ],
            [
                'admin_employee_id'=>'ACX-20-006',
                'username'=>'admin2',
                'password'=> bcrypt('admin2'),
            ],
            [
                'admin_employee_id'=>'ACX-20-039',
                'username'=>'admin3',
                'password'=> bcrypt('admin3'),
            ],

        ];
  
        foreach ($admin as $key => $value) {
            Admin::create($value);
        }
    }
}
