<?php 
// incluir a classe conexão
include_once 'Conexao.class.php';

// Class Forma
class Forma extends Conexao{

    // atributos
    private $id_cad_forma;
    private $desc_forma;

    // getters & setters
    
    public function getIdCadForma()
    {
        return $this->id_cad_forma;
    }

    public function setIdCadForma($id_cad_forma): self
    {
        $this->id_cad_forma = $id_cad_forma;

        return $this;
    }

    public function getDescForma()
    {
        return $this->desc_forma;
    }

    public function setDescForma($desc_forma): self
    {
        $this->desc_forma = $desc_forma;

        return $this;
    }

    //método inserir Forma
    public function inserirForma($desc_forma)
    {
        //setar os atributos
        $this->setDescForma(strtoupper($desc_forma));

        //montar query
        $sql = "INSERT INTO tb_cad_forma (id_cad_forma, desc_forma) VALUES (NULL, :desc_forma)";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':desc_forma', $this->getDescForma(), PDO::PARAM_STR);
            //excutar a query
            $query->execute();
            //retorna o resultado
            //print "Inserido";
            return true;

        } catch (PDOException $e) {
            //print "Erro ao inserir";
            return false;
        }
    }

    //metodo consultar forma
    public function consultarForma($desc_forma)
    {
        //setar os atributos
        $this->setDescForma($desc_forma);

        //montar query
        $sql = "SELECT * FROM tb_cad_forma where true ";

        //vericar se o nome é nulo
        if ($this->getDescForma() != null) {
            $sql .= " and desc_forma like :desc_forma";
        }

        //ordenar a tabela
        $sql .= " order by desc_forma ";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            if ($this->getDescForma() != null) {
                $this->setDescForma("%" . $desc_forma . "%");
                $query->bindValue(':desc_forma', $this->getDescForma(), PDO::PARAM_STR);
            }
            //excutar a query
            $query->execute();
            //retorna o resultado
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;

        } catch (PDOException $e) {
            //print "Erro ao consultar forma";
            return false;
        }
    }

    //método alterar forma
    public function alterarForma($id_cad_forma, $desc_forma)
    {
        //setar os atributos
        $this->setIdCadForma($id_cad_forma);
        $this->setDescForma(strtoupper($desc_forma));

        //montar query
        $sql = "UPDATE tb_cad_forma SET desc_forma = :desc_forma WHERE id_cad_forma = :id_cad_forma";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_cad_forma', $this->getIdCadForma(), PDO::PARAM_INT);
            $query->bindValue(':desc_forma', $this->getDescForma(), PDO::PARAM_STR);
            //excutar a query
            $query->execute();
            //retorna o resultado
            //print "Alterado";
            return true;

        } catch (PDOException $e) {
            //print "Erro ao alterar";
            return false;
        }
    }

    //método excluir forma
    public function excluirForma($id_cad_forma)
    {
        //setar os atributos
        $this->setIdCadForma($id_cad_forma);

        //montar query
        $sql = "DELETE FROM tb_cad_forma WHERE id_cad_forma = :id_cad_forma";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blindagem dos dados
            $query->bindValue(':id_cad_forma', $this->getIdCadForma(), PDO::PARAM_INT);
            //excutar a query
            $query->execute();
            //retorna o resultado
            print "Excluido";
            return true;

        } catch (PDOException $e) {
            // print "Erro ao excluir: " . $e->getMessage();
            return false;
        }
    }
}

?>