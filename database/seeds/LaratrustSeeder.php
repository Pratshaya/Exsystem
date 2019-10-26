<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Room;
use App\Department;
use App\Faculty;
use App\Campus;
use App\Branch;
use App\Role;
use App\User;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        $this->truncateLaratrustTables();

        $config = config('laratrust_seeder.role_structure');
        $userPermission = config('laratrust_seeder.permission_structure');
        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        $campus = Campus::create([
            'name' => 'กรุงเทพฯ'
        ]);

        $faculty =  Faculty::create([
           'name' => 'ครุศาสตร์อุตสาหกรรม',
            'campus_id' => '1'

        ]);

        $department = Department::create([
            'name' => 'คอมพิวเตอร์ศึกษา',
            'faculty_id' => '1'
        ]);

        $branch = Branch::create([
            'name' => 'เทคโนโลยีคอมพิวเตอร์',
            'department_id' => '1'
        ]);

        $room = Room::create([
            'name' => 'ced58',
            'detail' => 'computer education 2558',
            'department_id' => '1'
        ]);

        foreach ($config as $key => $modules) {

            // Create a new role
            $role = Role::create([
                'name' => $key,
                'display_name' => ucwords(str_replace('_', ' ', $key)),
                'description' => ucwords(str_replace('_', ' ', $key))
            ]);
            /* $permissions = [];

            $this->command->info('Creating Role '. strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {

                foreach (explode(',', $value) as $p => $perm) {
                    $permissionValue = $mapPermission->get($perm);

                    $permissions[] = \App\Permission::firstOrCreate([
                        'name' => $permissionValue . '-' . $module,
                        'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                    ])->id;

                    $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                }
            }

            // Attach all permissions to the role
            $role->permissions()->sync($permissions);
            */

            $this->command->info("Creating '{$key}' user");

            // Create default user for each role
            $user = User::create([
                'name' => ucwords(str_replace('_', ' ', $key)),
                'email' => $key.'@app.com',
                'password' => bcrypt('password'),
                'room_id' => $room->id,
                'department_id' => $department->id,
                'branch_id' => $branch->id
            ]);

            $user->attachRole($role);
        }

        // Creating user with permissions
        if (!empty($userPermission)) {

            foreach ($userPermission as $key => $modules) {

                foreach ($modules as $module => $value) {

                    // Create default user for each permission set
                    $user = User::create([
                        'name' => ucwords(str_replace('_', ' ', $key)),
                        'email' => $key.'@app.com',
                        'password' => bcrypt('password'),
                        'remember_token' => str_random(10),
                        'room_id' => $room->id,
                        'department_id' => $department->id,
                        'branch_id' => $branch->id
                    ]);
                    $permissions = [];

                    foreach (explode(',', $value) as $p => $perm) {

                        $permissionValue = $mapPermission->get($perm);

                        $permissions[] = \App\Permission::firstOrCreate([
                            'name' => $permissionValue . '-' . $module,
                            'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                            'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        ])->id;

                        $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                    }
                }

                // Attach all permissions to the user
                $user->permissions()->sync($permissions);
            }
        }
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return    void
     */
    public function truncateLaratrustTables()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();
        \App\User::truncate();
        \App\Role::truncate();
        \App\Permission::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
