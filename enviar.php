<?php
#dados de conexão com o banco, root e pass vazio é padrão no xampp
$host = "localhost";
$dbname = "dbdevwebpro";
$user = "root";
$pass = "";       

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    #pega os dados do formulário
    $nome = strip_tags($_POST["nome"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $mensagem = strip_tags($_POST["mensagem"]);

    #validação simples
    if (!$nome || !$email || !$mensagem) {
        echo "Preencha todos os campos obrigatórios.";
        exit;
    }

    #prepara e executa o insert
    $stmt = $pdo->prepare("INSERT INTO clientes (nome, email, mensagem) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $mensagem]);

    echo "Mensagem enviada e salva com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao salvar: " . $e->getMessage();
}
?>
