<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nomepet = $_POST['nomepet'];
    $especie = $_POST['especie'];
    $petraca = $_POST['petraca'];
    $data_nascimento = $_POST['data_nascimento'];
    $peso = $_POST['peso'];
    $sexo = $_POST['sexo'];
    $servicos = isset($_POST['servicos']) ? implode(', ', $_POST['servicos']) : 'Nenhum serviço selecionado';

    // Validando os dados
    if (empty($nome) || empty($email) || empty($telefone) || empty($nomepet) || empty($especie) || empty($petraca)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
        exit;
    }

    // Processando a foto do pet
    if (isset($_FILES['foto_pet']) && $_FILES['foto_pet']['error'] == 0) {
        $foto_tmp = $_FILES['foto_pet']['tmp_name'];
        $foto_nome = $_FILES['foto_pet']['name'];
        $foto_tipo = $_FILES['foto_pet']['type'];
        $foto_tamanho = $_FILES['foto_pet']['size'];

        // Diretório onde a imagem será salva
        $pasta_destino = 'uploads/';
        $foto_destino = $pasta_destino . basename($foto_nome);

        // Verificando se o arquivo é uma imagem e seu tamanho
        if (getimagesize($foto_tmp) !== false && $foto_tamanho < 5000000) {
            if (move_uploaded_file($foto_tmp, $foto_destino)) {
                echo "Foto do pet enviada com sucesso!<br>";
            } else {
                echo "Erro ao enviar a foto.<br>";
            }
        } else {
            echo "A foto não é válida ou o tamanho excede o limite.<br>";
        }
    }

    // Exibindo os dados recebidos
    echo "<h2>Dados Recebidos:</h2>";
    echo "<p><strong>Nome do Tutor:</strong> $nome</p>";
    echo "<p><strong>E-mail:</strong> $email</p>";
    echo "<p><strong>Telefone:</strong> $telefone</p>";
    echo "<p><strong>Nome do Pet:</strong> $nomepet</p>";
    echo "<p><strong>Espécie:</strong> $especie</p>";
    echo "<p><strong>Raça:</strong> $petraca</p>";
    echo "<p><strong>Data de Nascimento:</strong> $data_nascimento</p>";
    echo "<p><strong>Peso:</strong> $peso kg</p>";
    echo "<p><strong>Sexo:</strong> $sexo</p>";
    echo "<p><strong>Serviços Selecionados:</strong> $servicos</p>";

    // Se a foto do pet foi enviada, exibe a imagem
    if (isset($foto_destino)) {
        echo "<p><strong>Foto do Pet:</strong> <img src='$foto_destino' alt='Foto do Pet' width='150'></p>";
    }

} else {
    echo "<h2>Por favor, preencha o formulário acima para ver os resultados.</h2>";
}
?>
