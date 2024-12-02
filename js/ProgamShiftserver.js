const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

// Criar o servidor Express
const app = express();
const port = 3000;

// Configurar a conexão com o banco de dados MySQL
const db = mysql.createConnection({
    host: 'localhost',    // Ou o IP do seu servidor MySQL
    user: 'root',         // Seu usuário do MySQL
    password: '',         // Sua senha do MySQL
    database: 'ProgramShift' // Banco de dados que você criou
});

// Conectar ao banco de dados
db.connect((err) => {
    if (err) throw err;
    console.log('Conectado ao banco de dados MySQL!');
});

// Middleware para processar JSON
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Rota para cadastrar usuário
app.post('/cadastrar', (req, res) => {
    const { email, nome, numero, senha } = req.body;

    // Verificar se os dados estão completos
    if (!email || !nome || !numero || !senha) {
        return res.status(400).json({ message: 'Todos os campos são obrigatórios' });
    }

    // Inserir dados na tabela 'dadosdosusuarios'
    const sql = `INSERT INTO dadosdosusuarios (email, nome, numero, senha) VALUES (?, ?, ?, ?)`;
    db.query(sql, [email, nome, numero, senha], (err, result) => {
        if (err) {
            console.error('Erro ao inserir no banco de dados:', err);
            return res.status(500).json({ message: 'Erro ao cadastrar usuário' });
        }
        res.status(200).json({ message: 'Usuário cadastrado com sucesso' });
    });
});

// Rota para servir os arquivos estáticos (HTML, CSS, etc)
app.use(express.static('public'));

// Iniciar o servidor na porta 3000
app.listen(port, () => {
    console.log(`Servidor rodando em http://localhost:${port}`);
});