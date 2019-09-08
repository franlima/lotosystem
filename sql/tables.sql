CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idtype INT NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    finished DATETIME NULL
);

CREATE TABLE userstype (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    type VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255) NOT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    finished DATETIME
);


CREATE TABLE tfloperation (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255) NOT NULL,
    delta  INT DEFAULT 0,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    finished DATETIME NULL
);

INSERT INTO tfloperation ('name','description')
VALUES ('Sangria','Valor é retirado do TFL'),
('Vale','Valor é colocado no TFL'),
('Comissao Bolao','Valor da comissao de bolao do dia'),
('Bolao','Valor do Bolao gerado no dia'),
('Telesena','Valor da Telesena'),
('Other','Valor de outros produtos no TFL'),
('Relatorio TFL','Valor total no relatorio financeiro TFL'),
('Total','Valor total no TFL'),
('Quebra de Caixa','Valor resultante do fechamento do TFL')

CREATE TABLE tfllog (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idop INT NOT NULL,
    iduser INT NOT NULL,
    value DOUBLE NOT NULL,
    status  TINYINT NOT NULL DEFAULT 0,
    due DATETIME NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    finished DATETIME NULL
);

SELECT reports.idop, operations.name, SUM(reports.value) AS soma FROM reports JOIN operations ON reports.idop = operations.id JOIN users ON reports.iduser = users.id WHERE username = 'keite' GROUP BY operations.name