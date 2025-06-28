<?php
//incluir classe conexao
include_once 'Conexao.class.php';

//classe Bandeira
class Tipo extends Conexao
{
    //atributos
    private $id_cad_tipo;
    private $desc_tipo;

    //getters e setters
    public function getIdCadTipo()
    {
        return $this->id_cad_tipo;
    }

    public function setIdCadTipo($id_cad_tipo)
    {
        $this->id_cad_tipo = $id_cad_tipo;
    }

    public function getDescTipo()
    {
        return $this->desc_tipo;
    }

    public function setDescTipo($desc_tipo)
    {
        $this->desc_tipo = $desc_tipo;
    }

    //metodo consultar
    public function consultarTipo($desc_tipo)
    {
        //setar os atributos
        $this->setDescTipo($desc_tipo);

        //montar query
        $sql = "SELECT * FROM tb_cad_tipo where true";

        //vericar se o nome é nulo
        if ($this->getDescTipo() != null) {
            $sql .= " AND desc_tipo LIKE :desc_tipo";
        }

        //ordenar a tabela
        $sql .= " order by desc_tipo DESC";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            if ($this->getDescTipo() != null) {
                $this->setDescTipo("%" . $desc_tipo . "%");
                $query->bindValue(':desc_tipo', $this->getDescTipo(), PDO::PARAM_STR);
            }
            //excutar a query
            $query->execute();
            //retorna o resultado
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;

        } catch (PDOException $e) {
            //print "Erro ao consultar";
            return false;
        }
    }
}