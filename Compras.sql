CREATE DATABASE compras;
USE compras;
DROP TABLE vendas;


CREATE TABLE Vendas (
  id int(11) NOT NULL AUTO_INCREMENT,
  descricao varchar(200) NOT NULL,
  vendedor varchar(100) NOT NULL,
  imagem varchar(200) NOT NULL,
  valor DOUBLE(7,2) NOT NULL,
  PRIMARY KEY (id)
);


INSERT INTO Vendas (id, descricao, vendedor, imagem, valor) VALUES
	(1, 'Impressora Epson L3250', 'vendedor', 'L3250.jpg', 1000.00),
	(2, 'Impressora Canon Pro-200', 'vendedor', 'Canon Pro-200.jpg', 1250.00),
	(3, 'Impressora Aurelia 252', 'vendedor', 'Aurelia 252.jpg', 65000.00),
	(4, 'Impressora imageClass MF452dw', 'vendedor', 'imageClass MF452dw.png', 3473.00),	
	(5, 'Impressora SureColor P6570DE', 'vendedor', 'SureColor P6570DE.jpg', 2500.00);

CREATE TABLE usuario ( 
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  created_at datetime DEFAULT current_timestamp(),
  email varchar(100) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY username (username),
  UNIQUE KEY email (email)
);

INSERT INTO usuario (id, username, password, created_at, email) VALUES
	(1, 'First-One', 'etec123', '2024-11-23 18:59:36', 'abc@gmail.com');
