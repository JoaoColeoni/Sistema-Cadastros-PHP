#Sistema-Cadastros-PHP
Esse projeto é um sistema que simula uma area administrativa onde você pode cadastrar/editar/excluir/consultar Clientes.

# PHP
`versão 7.4.33`

# Banco de dados MySQL
`versão 8.3.0`

# Inicializar Projeto
1 - Crie um Schema no banco de dados.
2 - Restaure o backup das 3 tabelas da pasta `db` na raiz do projeto.
3 - Crie uma copia do arquivo `config_template.php` e renomeie o arquivo para `config.php`.
4 - Altere os dados do arquivo `config.php` com as informações do seu banco de dados MySQL e na variavel `$SITE` coloque o IP e Porta caso utilize, se for conexão local pode ser mantido o `http://localhost/`.
5 - Acesse o arquivo `index.php` e acesse o sistema usando as credenciais de algum usuário da tabela `usuarios` (No backup já é inserido por padrão o usuário Login:`admin` e Senha:`12345`).
6 - Utilize o Sistema como desejar.
