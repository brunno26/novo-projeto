<?php
//incluir classe conexao
include_once 'Conexao.class.php';

//classe Bandeira
class Bandeira extends Conexao
{
    //atributos
    private $id_cad_band;
    private $nome_band;

    //getters e setters
    public function getIdCadBand()
    {
        return $this->id_cad_band;
    }

    public function setIdCadBand($id_cad_band)
    {
        $this->id_cad_band = $id_cad_band;
    }

    public function getNomeBand()
    {
        return $this->nome_band;
    }

    public function setNomeBand($nome_band)
    {
        $this->nome_band = $nome_band;
    }

    //método inserir Bandeira
    public function inserirBandeira($nome_band)
    {
        //setar os atributos
        $this->setNomeBand(strtoupper($nome_band));

        //montar query
        $sql = "INSERT INTO tb_cad_bandeira (id_cad_band, nome_band) VALUES (NULL, :nome_band)";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':nome_band', $this->getNomeBand(), PDO::PARAM_STR);
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

    //metodo consultar bandeira
    public function consultarBandeira($nome_band)
    {
        //setar os atributos
        $this->setNomeBand($nome_band);

        //montar query
        $sql = "SELECT * FROM tb_cad_bandeira where true ";

        //vericar se o nome é nulo
        if ($this->getNomeBand() != null) {
            $sql .= " and nome_band like :nome_band";
        }

        //ordenar a tabela
        $sql .= " order by nome_band ";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            if ($this->getNomeBand() != null) {
                $this->setNomeBand("%" . $nome_band . "%");
                $query->bindValue(':nome_band', $this->getNomeBand(), PDO::PARAM_STR);
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

    //método alterar bandeira
    public function alterarBandeira($id_cad_band, $nome_band)
    {
        //setar os atributos
        $this->setIdCadBand($id_cad_band);
        $this->setNomeBand(strtoupper($nome_band));

        //montar query
        $sql = "UPDATE tb_cad_bandeira SET nome_band = :nome_band WHERE id_cad_band = :id_cad_band";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_cad_band', $this->getIdCadBand(), PDO::PARAM_INT);
            $query->bindValue(':nome_band', $this->getNomeBand(), PDO::PARAM_STR);
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

    //método excluir bandeira
    public function excluirBandeira($id_cad_band)
    {
        //setar os atributos
        $this->setIdCadBand($id_cad_band);

        //montar query
        $sql = "DELETE FROM tb_cad_bandeira WHERE id_cad_band = :id_cad_band";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blindagem dos dados
            $query->bindValue(':id_cad_band', $this->getIdCadBand(), PDO::PARAM_INT);
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