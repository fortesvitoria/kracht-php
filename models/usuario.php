<?php
class Usuario {
    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;
    private $dt_nascimento;
    private $is_admin;

    public function __construct($id = null, $nome = null, $sobrenome = null, $email = null, $senha = null, $dt_nascimento = null, $is_admin = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->senha = $senha;
        $this->dt_nascimento = $dt_nascimento;
        $this->is_admin = $is_admin;
    }

    //GETTERS
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getDtNascimeno() {
        return $this->dt_nascimento;
    }

    public function getIsAdmin() {
        return $this->is_admin;
    }

    //SETTERS
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setFoto($dt_nascimento) {
        $this->dt_nascimento = $dt_nascimento;
    }

    public function setIsAdmin($is_admin) {
        $this->is_admin = $is_admin;
    }
    
    //METODOS

    //Metodo de autenticação de login
    public function autenticarLogin($email, $senha, $conexao) {
        $sql = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$email'");
        $registro = mysqli_fetch_assoc($sql);
    
        if ($registro) {
            if ($registro['senha'] === sha1($senha)) {
                // Se o login for bem-sucedido, armazena os dados do usuário na sessão
                $_SESSION['usuario'] = array(
                    'id' => $registro['id_usuario'],
                    'nome' => $registro['nome'],
                    'sobrenome' => $registro['sobrenome'],
                    'email' => $registro['email'],
                    'senha' => $registro['senha'],
                    'dt_nascimento' => $registro['dt_nascimento'],
                    'is_admin' => $registro['is_admin']
                );
                
                return true; // Login bem-sucedido
            } else {
                return 'Senha incorreta. Por favor, tente novamente.'; // Senha incorreta
            }
        } else {
            return 'E-mail não encontrado. Por favor, verifique seus dados e tente novamente.'; // E-mail não encontrado
        }
    }
    
}

?>