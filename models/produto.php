<?php
class Produto
{
    private $id;
    private $nome;
    private $marca;
    private $tipo;
    private $valor;
    private $imagem;
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    //GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getImagem()
    {
        return $this->imagem;
    }


    //SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }

    public function listarProdutos()
    {
        $query = "SELECT id, nome, marca, tipo, valor, imagem FROM produtos ORDER BY id DESC";

        $resultado = mysqli_query($this->conexao, $query);

        if ($resultado) {
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        } else {
            echo "Erro ao listar produtos: " . mysqli_error($this->conexao);
            return [];
        }
    }
}
