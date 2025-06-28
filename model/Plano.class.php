<?php
//incluir classe conexao
include_once 'Conexao.class.php';

//classe Plano
class Plano extends Conexao
{
    //atributos
    private $id_cad_plano;
    private $desc_plano;

    //getters e setters
    public function getIdCadPlano()
    {
        return $this->id_cad_plano;
    }

    public function setIdCadPlano($id_cad_plano)
    {
        $this->id_cad_plano = $id_cad_plano;
    }

    public function getDescPlano()
    {
        return $this->desc_plano;
    }

    public function setDescPlano($desc_plano)
    {
        $this->desc_plano = $desc_plano;
    }

    //método inserir Plano
    public function inserirPlano($desc_plano)
    {
        //setar os atributos
        $this->setDescPlano(strtoupper($desc_plano));

        //montar query
        $sql = "INSERT INTO tb_cad_plano (id_cad_plano, desc_plano) VALUES (NULL, :desc_plano)";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':desc_plano', $this->getDescPlano(), PDO::PARAM_STR);
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

    //metodo consultar Plano
    public function consultarPlano($desc_plano)
    {
        //setar os atributos
        $this->setDescPlano($desc_plano);

        //montar query
        $sql = "SELECT * FROM tb_cad_plano where true ";

        //vericar se o nome é nulo
        if ($this->getDescPlano() != null) {
            $sql .= " and desc_plano like :desc_plano";
        }

        //ordenar a tabela
        $sql .= " order by desc_plano ";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            if ($this->getDescPlano() != null) {
                $this->setDescPlano("%" . $desc_plano . "%");
                $query->bindValue(':desc_plano', $this->getDescPlano(), PDO::PARAM_STR);
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

    //método alterar Plano
    public function alterarPlano($id_cad_plano, $desc_plano)
    {
        //setar os atributos
        $this->setIdCadPlano($id_cad_plano);
        $this->setDescPlano(strtoupper($desc_plano));

        //montar query
        $sql = "UPDATE tb_cad_plano SET desc_plano = :desc_plano WHERE id_cad_plano = :id_cad_plano";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blindagem dos dados
            $query->bindValue(':id_cad_plano', $this->getIdCadPlano(), PDO::PARAM_INT);
            $query->bindValue(':desc_plano', $this->getDescPlano(), PDO::PARAM_STR);
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

    //método excluir Plano
    public function excluirPlano($id_cad_plano)
    {
        //setar os atributos
        $this->setIdCadPlano($id_cad_plano);

        //montar query
        $sql = "DELETE FROM tb_cad_plano WHERE id_cad_plano = :id_cad_plano";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blindagem dos dados
            $query->bindValue(':id_cad_plano', $this->getIdCadPlano(), PDO::PARAM_INT);
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