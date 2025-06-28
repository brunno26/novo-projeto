<?php
//classe de conexao
class Conexao
{
    //atributos
    private $host = "db_financaspi.mysql.dbaas.com.br";
    private $db_name = "db_financaspi";
    private $user = "db_financaspi";
    private $pwd = "Gzfinanceiro1@";
    private $link = null;

    //métodos
    public function conectar()
    {
        try {
            //se tudo der certo
            $pdo = new PDO("mysql:host={$this->host};dbname={$this->db_name}", "{$this->user}", "{$this->pwd}");
            $this->link = $pdo;
            //print "Conectado";
            return $this->link;
        } catch (PDOException $e) {
            //print 'Nao conectado: ' . $e->getMessage();
            return false;
        }
    }
}

//testar a conexao
//$objConexao = new Conexao();
//$objConexao->conectar();