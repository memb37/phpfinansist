<?
class Model {
    public function from_array($array) {
        foreach($array as $k => $v) {
            if(property_exists($this, $k)) {
                $this->$k = $v;
            } else {
                throw new OutOfBoundsException('Нет такого поля');
            }
        }
    }
}