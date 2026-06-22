<?php

namespace Models;

class Usuario 
{
    // 1. Propriedades Privadas (O estado interno)
    private ?int $id;
    private string $nome;
    private string $email;
    private string $senha_hash;
    private string $papel;

    // 2. Método Construtor (Como o objeto "nasce")

    public function __construct(string $nome, 
                                string $email, 
                                string $senha_hash, 
                                string $papel = 'leitor', 
                                ?int $id = null)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha_hash = $senha_hash;
        $this->papel = $papel;
        $this->id = $id;
    }

    // 3. Getters (Porta de saída: como o mundo externo lê os dados)

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPapel(): string
    {
        return $this->papel;
    }

    // 4. Setters (Porta de entrada: como o mundo externo altera os dados com regras)

    public function setNome(string $nome): void
    {
        // Exemplo de regra de negócio blindando o objeto:
        if (strlen(trim($nome)) < 3)
        {
            throw new \InvalidArgumentException("O nome deve conter pelo menos 3 caracteres.");
        }
        $this->nome = $nome;
    }

    public function setPapel(string $papel): void
    {
        if ($papel !== 'admin' && $papel !== 'leitor')
        {
            throw new \InvalidArgumentException("Papel inválido. deve ser 'admin' ou 'leitor'.");
        }
        $this->papel = $papel;
    }
}


?>