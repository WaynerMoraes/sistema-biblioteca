<?php

namespace Config;

use PDO;
use PDOException;

class Database {
    // A variável estática que vai gardar a única instância de conexão
    private static $instance = null;
    private $conn;

    //Credenciais de banco
    //O host é db porqueé o nome do container Mysql na rede do Docker
    private $host = 'db';
    private $db_name = 'biblioteca';
    private $username = 'user_biblioteca';
    private $password = 'password123';

    // 1. O construtor deve ser privado no padrão Singleton.
    // Isso impede que outros arquivos façam "$db = new Database();"
    private function __construct(){
        try{
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password);

            //Configura o PDO para estourar exceções detalhadas se houver erro no SQL
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Define que as buscas no banco retornarão arrays associativos por padrão
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            // Em um sistema real, aqui poderíamos gravar o log (Conceito de observabilidade)
            echo "Erro na conexão com banco de dados: " . $e->getMessage();
            exit;
        }
    }

    // 2. O método de acesso global. É ele quem os repositórios vão chamar.
    public static function getInstance(){
        //Se a conexção ainda não existir, ele cria. Se ja existir, ele devolve a que esta pronta.
        if (self::$instance === null){
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}




?>