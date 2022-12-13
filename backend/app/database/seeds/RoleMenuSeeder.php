<?php
class RoleMenuSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            $query = DB::table('menu')
               ->select('menuId')
               ->where('menuNonActive','0')
               ->get();
           
            DB::table('role_menu')->truncate();
            
            foreach($query as $k => $val){
                DB::table('role_menu')->insert(
                     array('rolmMenuId' => $val->menuId, 
                         'rolmRoleId' => 1,
                         'rolmView' => 1,
                         'rolmNew' => 1,
                         'rolmEdit' => 1,
                         'rolmDelete' => 1,
                         'rolmConfirm' => 1,
                         'rolmVoid' => 1
                         )
                 );
            }
	}

}
