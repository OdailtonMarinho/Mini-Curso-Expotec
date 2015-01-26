create database ged;

create table nivel(
   Id int auto_increment,
   Nome varchar(18),
   primary key(Id));

create table usuario(
   cpf varchar(11),
   nome varchar(50),
   email varchar(50) unique,
   senha varchar(20),
   nivel int,
   primary key(cpf),
   foreign key(nivel) references nivel (Id));

create table solicitacao(
   texto mediumtext,
   id int auto_increment,
   cpf varchar(11),
   primary key(id),
   foreign key (cpf) references usuario(cpf) on delete cascade);

create table documento(
   cod varchar(8),
   dat date,
   nome mediumtext,
   excluido tinyint,
   autor varchar(11),
   primary key(cod),
   foreign key(autor) references usuario(cpf) on delete cascade);

create table permissao(
   id int,
   nome varchar(8),
   cod varchar(8),
   cpf varchar(11),
   primary key(id),
   foreign key(cpf) references usuario(cpf) on delete cascade,
   foreign key(cod) references documento(cod) on delete cascade);
   
insert into nivel(Nome) values('root'),
                              ('comum'),
							         ('Fundo do Mar'),
                              ('Estagiarios');
							  
insert into usuario(nome, cpf, email, senha, nivel) values('Rute', '01755255446', 'root', '123456', '1'),
                                                          ('Téo', '65178291646', 'teo', '123456', '2'),
                                                          ('Mega-Man', '67340418164', 'mm@htm.com', '2'),
                                                          ('Bob Esponja', '37788649805', 'be@fdm.com', '3'),
                                                          ('Patrick Estrela', '47794237599', 'pte@fdm.com', '3');