<?php
// incluir classe conexão
include_once 'Conexao.class.php';

// classe bandeira
class Banco extends Conexao
{
    // atributos
    private $id_cad_banco;
    private $nome_banco;
    private $num_agencia;
    private $num_conta;

    // getters & setters
    public function getIdCadBanco()
    {
        return $this->id_cad_banco;
    }

    public function setIdCadBanco($id_cad_banco)
    {
        $this->id_cad_banco = $id_cad_banco;
    }

    public function getNomeBanco()
    {
        return $this->nome_banco;
    }

    public function setNomeBanco($nome_banco)
    {
        $this->nome_banco = $nome_banco;
    }

    public function getNumAgencia()
    {
        return $this->num_agencia;
    }

    public function setNumAgencia($num_agencia)
    {
        $this->num_agencia = $num_agencia;
    }

    public function getNumConta()
    {
        return $this->num_conta;
    }

    public function setNumConta($num_conta)
    {
        $this->num_conta = $num_conta;
    }

    //método inserir Banco
    public function inserirBanco($nome_banco, $num_agencia, $num_conta)
    {
        //setar os atributos
        $this->setNomeBanco(strtoupper($nome_banco));
        $this->setNumAgencia(strtoupper($num_agencia));
        $this->setNumConta(strtoupper($num_conta));

        //montar query
        $sql = "INSERT INTO tb_cad_banco (id_cad_banco, nome_banco, num_agencia, num_conta)
        VALUES (NULL, :nome_banco, :num_agencia, :num_conta)";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':nome_banco', $this->getNomeBanco(), PDO::PARAM_STR);
            $query->bindValue(':num_agencia', $this->getNumAgencia(), PDO::PARAM_STR);
            $query->bindValue(':num_conta', $this->getNumConta(), PDO::PARAM_STR);

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

    //metodo consultar banco
    public function consultarBanco($nome_banco)
    {
        //setar os atributos
        $this->setNomeBanco($nome_banco);

        //montar query
        $sql = "SELECT * FROM tb_cad_banco where true ";

        //vericar se o nome é nulo
        if ($this->getNomeBanco() != null) {
            $sql .= " and nome_banco like :nome_banco";
        }

        //ordenar a tabela
        $sql .= " order by nome_banco ";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            if ($this->getNomeBanco() != null) {
                $this->setNomeBanco("%" . $nome_banco . "%");
                $query->bindValue(':nome_banco', $this->getNomeBanco(), PDO::PARAM_STR);
            }
            //excutar a query
            $query->execute();
            //retorna o resultado
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;

        } catch (PDOException $e) {
            //print "Erro ao consultar banco";
            return false;
        }
    }

    //método alterar banco
    public function alterarBanco($id_cad_banco, $nome_banco, $num_agencia, $num_conta)
    {
        //setar os atributos
        $this->setIdCadBanco($id_cad_banco);
        $this->setNomeBanco(strtoupper($nome_banco));
        $this->setNumAgencia(strtoupper($num_agencia));
        $this->setNumConta(strtoupper($num_conta));

        //montar query
        $sql = "UPDATE tb_cad_banco SET nome_banco = :nome_banco, num_agencia = :num_agencia, num_conta = :num_conta WHERE id_cad_banco = :id_cad_banco";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_cad_banco', $this->getIdCadBanco(), PDO::PARAM_INT);
            $query->bindValue(':nome_banco', $this->getNomeBanco(), PDO::PARAM_STR);
            $query->bindValue(':num_agencia', $this->getNumAgencia(), PDO::PARAM_STR);
            $query->bindValue(':num_conta', $this->getNumConta(), PDO::PARAM_STR);
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

    //método excluir banco
    public function excluirBanco($id_cad_banco)
    {
        //setar os atributos
        $this->setIdCadBanco($id_cad_banco);

        //montar query
        $sql = "DELETE FROM tb_cad_banco WHERE id_cad_banco = :id_cad_banco";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blindagem dos dados
            $query->bindValue(':id_cad_banco', $this->getIdCadBanco(), PDO::PARAM_INT);
            //excutar a query
            $query->execute();
            //retorna o resultado
            print "Excluido";
            return true;

        } catch (PDOException $e) {
            // print "Erro ao excluir banco: " . $e->getMessage();
            return false;
        }
    }
}
