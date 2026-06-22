<?php
require_once __DIR__ . '/Config/Database.php';
require_once __DIR__ . '/Models/Usuario.php';

use Models\Usuario;

echo "<h1>Teste de Encapsulamento e regras de negócios</h1>";

try{
    //Teste o caminho feliz
    echo "1. Criando um usuário válido...";

    $usuario = new Usuario("João da Silva", "joao@mail.com", "senha_super_secreta");

    echo "Usuario instanciado com sucesso!<br>";
    echo "<ul>";
    echo "<li><strong>Nome:</strong>" . $usuario->getNome() . "</li>";
    echo "<li><strong>Email:</strong>" . $usuario->getEmail() . "</li>";
    echo "</ul>";

    //Teste 2, caminho triste, forçando erro.

    echo "<hr><h3>2. Tentando burlar a segurança do sistema...</h3>";
    echo "<p>O código agora vai tentar chamar: <code>\$usuario->setPapel('hacker');</code></p>";

    //Vai engatilhar o throw new InvalidArgumentException
    $usuario->setPapel('hacker');

    echo "<p>Se você está vendo essa mensagem, o sistema falhou em proteger o objeto.</p>";

} catch (\InvalidArgumentException $e){

    echo "<div style='background-color: #ffebee; border: 1px solid #c62828; color: #c62828; padding: 15px; border-radius: 5px;'>";
    echo "<strong>🚨 Operação Abortada! Regra de Negócio Violada:</strong><br>";;
    echo $e->getMessage();
    echo "</div>";

    echo "<p><em>Perceba que o código não quebrou de forma feia, nós mantivemos o controle total da situação!</em></p>";
}

?>