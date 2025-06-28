<?php
//incluir classe conexao
include_once 'Conexao.class.php';

//classe cartão
class Cartao extends Conexao
{
    //atributos
    private $id_cartao;
    private $id_cad_band;
    private $nome_cartao;
    private $num_cartao;

    //getters e setters
    public function getId_cartao()
    {
        return $this->id_cartao;
    }

    public function setId_cartao($value)
    {
        $this->id_cartao = $value;
    }

    public function getIdCadBand()
    {
        return $this->id_cad_band;
    }

    public function setIdCadBand($value)
    {
        $this->id_cad_band = $value;
    }

    public function getNome_cartao()
    {
        return $this->nome_cartao;
    }

    public function setNome_cartao($value)
    {
        $this->nome_cartao = $value;
    }

    public function getNum_cartao()
    {
        return $this->num_cartao;
    }

    public function setNum_cartao($value)
    {
        $this->num_cartao = $value;
    }

    //método inserir cartao
    public function inserirCartao($id_cad_band, $nome_cartao, $num_cartao)
    {
        //setar os atributos
        $this->setId_cartao($id_cartao);
        $this->setIdCadBand($id_cad_band);
        $this->setNome_cartao(strtoupper($nome_cartao));
        $this->setNum_cartao(strtoupper($num_cartao));

        //montar query
        $sql = "INSERT INTO tb_cad_cartao (id_cad_cartao, id_cad_band, nome_cartao, num_cartao) VALUES (NULL, :id_cad_band, :nome_cartao, :num_cartao)";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blindagem dos dados
            $query->bindValue(':id_cad_band', $this->getIdCadBand(), PDO::PARAM_INT);
            $query->bindValue(':nome_cartao', $this->getNome_cartao(), PDO::PARAM_STR);
            $query->bindValue(':num_cartao', $this->getNum_cartao(), PDO::PARAM_STR);
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

    //metodo consultar
    public function consultarCartao($nome_cartao)
    {
        //setar os atributos
        $this->setNome_cartao($nome_cartao);

        //montar query
        $sql = "select id_cad_cartao, tb.id_cad_band, tb.nome_band, nome_cartao, num_cartao
                from tb_cad_cartao as tc
                left join tb_cad_bandeira as tb on tc.id_cad_band = tb.id_cad_band
                where true";

        //vericar se o nome do cartão é nulo
        if ($this->getNome_cartao() != null) {
            $sql .= " and nome_cartao like :nome_cartao";
        }

        //ordenar a tabela
        $sql .= " order by nome_cartao ";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            if ($this->getNome_cartao() != null) {
                $this->setNome_cartao("%" . $nome_cartao . "%");
                $query->bindValue(':nome_cartao', $this->getNome_cartao(), PDO::PARAM_STR);
            }
            // if ($this->getId_bandeira() != null) {
            //     $query->bindValue(':id_cad_band', $this->getId_bandeira(), PDO::PARAM_INT);
            // }

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

    //método alterar cartao
    public function alterarCartao($id_cad_cartao, $id_cad_band, $nome_cartao, $num_cartao)
    {
        //setar os atributos
        $this->setId_cartao($id_cad_cartao);
        $this->setIdCadBand($id_cad_band);
        $this->setNome_cartao(strtoupper($nome_cartao));
        $this->setNum_cartao($num_cartao);

        //montar query
        $sql = "UPDATE tb_cad_cartao SET id_cad_cartao = :id_cad_cartao, id_cad_band = :id_cad_band, nome_cartao = :nome_cartao, num_cartao = :num_cartao WHERE id_cad_cartao = :id_cad_cartao";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_cad_cartao', $this->getId_cartao(), PDO::PARAM_INT);
            $query->bindValue(':id_cad_band', $this->getIdCadBand(), PDO::PARAM_INT);
            $query->bindValue(':nome_cartao', $this->getNome_cartao(), PDO::PARAM_STR);
            $query->bindValue(':num_cartao', $this->getNum_cartao(), PDO::PARAM_STR);
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

    //método excluir cartao
    public function excluirCartao($id_cad_cartao)
    {
        //setar os atributos
        $this->setId_cartao($id_cad_cartao);

        //montar query
        $sql = "DELETE FROM tb_cad_cartao WHERE id_cad_cartao = :id_cad_cartao";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blindagem dos dados
            $query->bindValue(':id_cad_cartao', $this->getId_cartao(), PDO::PARAM_INT);
            //excutar a query
            $query->execute();
            //retorna o resultado
            //print "Excluido";
            return true;

        } catch (PDOException $e) {
            // print "Erro ao excluir: " . $e->getMessage();
            return false;
        }
    }

}
