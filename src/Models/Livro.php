<?php

namespace Models;

class Livro{
    private ?int $id;
    private string $titulo;
    private string $autor;
    private int $quantidade_total;
    private int $quantidade_disponivel;

    public function __construct(string $titulo, 
                                string $autor, 
                                ?int $quantidade_total = null, 
                                ?int $quantidade_disponivel = null,
                                ?int $id = null)
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        
        //Não deixar cadastrar com 0 copias
        if ($quantidade_total < 1)
        {
            throw new \InvalidArgumentException("A quantidade total de livros deve ser pelo menos 1.");
        }
        $this->quantidade_total = $quantidade_total;
        $this->quantidade_disponivel = $quantidade_disponivel ?? $quantidade_total;
        $this->id = $id;

    }

    // Getters

    public function getId(): ?int {return $this->id;}
    public function getTitulo(): string {return $this->titulo;}
    public function getAutor(): string {return $this->autor;}
    public function getQuantidadeTotal(): int {return $this->quantidade_total;}
    public function getQuantidadeDisponivel(): int {return $this->quantidade_disponivel;}

    public function emprestar(): void
    {
        if ($this->quantidade_disponivel < 1)
        {
            throw new \DomainException("Operação negada: O livro '{$this->titulo}' não possui cópias disponíveis no momento.");
        }
        $this->quantidade_disponivel--;
    }

    public function devolver(): void
    {
        if ($this->quantidade_disponivel >= $this->quantidade_total)
        {
            throw new \DomainException("Operação negada: Tentativa de devolver mais cópias que o acervo físico possui.");
        }
        $this->quantidade_disponivel++;
    }
}


?>