<?php
    use \Illuminate\Support\Facades\DB;
    use App\Menu;
    use App\Submenu;
    class MainMenu{
        public function __contruct()
        {
        }
        public function menu_options()
        {
            $menu_options=Menu::select(['id','name','url','icon'])->get();
            $response=array();
            foreach($menu_options as $key=>$val){
                $submenu=Submenu::select(['id','name','url','icon'])->where('menu_id',$val->id)->get();
                $temp=array(
                    'name'=>$val->name,
                    'url'=>$val->url,
                    'icon'=>$val->icon,
                    'submenu'=>$submenu
                );
                array_push($response,$temp);
            }
            return $response;
        }
    }
