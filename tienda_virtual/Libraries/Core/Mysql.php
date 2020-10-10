<?php


    class Mysql extends Conexion
    {
        private $conexion;
        private $strquery;
        private $arrValues;

        public function __construct()
        {
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conect();

        }
        
        //Insertar un registro
        public function insert(string $query,array $arrValues)
        {
            $this->strquery=$query;//almacena el query parametro
            $this->arrValues=$arrValues;//alamacena el array
            //preparar el query
   
            $insert = $this->conexion->prepare($this->strquery);
           
            $resInsert= $insert->execute($this->arrValues);
            if($resInsert)
            {
                $lasInsert = $this->conexion->lastInsertID();//si almacena el ultimo id
            }
            else{
                $lasInsert=0;
            }
           
            return $lasInsert;


        }

        //devulve un registo
        public function select(string  $query)
        {
            $this->strquery=$query;
            $result = $this->conexion->prepare($this->strquery);
            $result->execute();
           
            $data = $result->fetch(PDO::FETCH_ASSOC);//solo un registro

            
            return $data;
        }

        //mas de uno
        public function select_all(string  $query)
        {
            $this->strquery=$query;
            $result = $this->conexion->prepare($this->strquery);
            $result->execute();
           
            $data = $result->fetchall(PDO::FETCH_ASSOC);
            return $data;


        }

        //actualizar
        public function update(string  $query,array $arrValues)
        {
            $this->strquery=$query;
            $this->arrValues=$arrValues;
            $update = $this->conexion->prepare($this->strquery);
            
           
            $resExecute = $update->execute($this->arrValues);
            return $resExecute;


        }
        //eliminar
        public function delete(string  $query)
        {
            $this->strquery=$query;
            $result = $this->conexion->prepare($this->strquery);
            $del=$result->execute();
           
            
            return $del;


        }



    }
?>