 <?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::firstOrNew(['key' => 'browse_dashboard', 'group' => 'General'])->save();
        $groups = [
            'users', 'roles', 'pages', 'news',
        ];
        foreach ($groups as $group){
            Permission::firstOrNew(['key' => 'browse_'.$group, 'group' => $group])->save();
            Permission::firstOrNew(['key' => 'read_'.$group, 'group' => $group])->save();
            Permission::firstOrNew(['key' => 'edit_'.$group, 'group' => $group])->save();
            Permission::firstOrNew(['key' => 'add_'.$group, 'group' => $group])->save();
            Permission::firstOrNew(['key' => 'delete_'.$group, 'group' => $group])->save();
        }

    }
}
