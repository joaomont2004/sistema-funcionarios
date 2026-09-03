<?php

class FuncionarioRepository
{
    private string $arquivo;

    public function __construct(string $arquivo = __DIR__ . '/data/funcionarios.json')
    {
        $this->arquivo = $arquivo;

        if (!file_exists($this->arquivo)) {
            file_put_contents($this->arquivo, json_encode([]));
        }
    }

    private function lerTodos(): array
    {
        $conteudo = file_get_contents($this->arquivo);
        return json_decode($conteudo, true) ?: [];
    }

    private function salvarTodos(array $dados): void
    {
        file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
    }

    public function cadastrar(string $nome, string $cargo, float $salario): void
    {
        $dados = $this->lerTodos();

        $novoId = count($dados) > 0
            ? max(array_column($dados, 'id')) + 1
            : 1;

        $dados[] = [
            'id' => $novoId,
            'nome' => $nome,
            'cargo' => $cargo,
            'salario' => $salario,
        ];

        $this->salvarTodos($dados);
    }

    public function listar(): array
    {
        return $this->lerTodos();
    }
}