<?php 

namespace App\Model;

trait Model {

    private $toConnection;

    function __construct(){
      $this->initConnectionWithDb();
    }

    private function initConnectionWithDb(){
      $toConnection = new Connection();
      $this->toConnection = $toConnection->getConnection();
    }

    private function getClassMapping(){
      $mapClass = get_class($this) . 'Map';
      if(!class_exists($mapClass)){
        throw new \Exception('Classe '. $mapClass . ' não encontrada!');
      }
      return $mapClass;
    }

    public function transformInItem($item){
          if (isset($item['0'])) {
            $item = $item['0'];
        }
        $classMap = $this->getClassMapping();
        return new $classMap($item);
    }

    public function transformInList($itens)
    {
        if (is_array($itens)) {
            $list = array();
            $classMap = $this->getClassMapping();
            foreach ($itens as $item) {
                $list[] = new $classMap($item);
            }
            return $list;
        }
    }
}
