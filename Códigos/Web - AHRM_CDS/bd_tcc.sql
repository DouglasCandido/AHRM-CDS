# drop schema bd_tcc;
create schema bd_tcc;
use bd_tcc;

# Tabela utilizada para armazenar os estados cadastrados no sistema
create table if not exists Uf(

    codigo int not null auto_increment,
    sigla varchar(2) not null,
    nome varchar(25) not null,
    primary key(codigo) 
    
);

/* create table if not exists Cidade(
	codigo int not null auto_increment,
    nome varchar(30) not null,
    uf int not null,
    primary key(codigo),
    foreign key(uf) references Uf(codigo)
); */

insert into uf(sigla, nome) values("AC","Acre");
insert into uf(sigla, nome) values("AL","Alagoas");
insert into uf(sigla, nome) values("AP","Amapá");
insert into uf(sigla, nome) values("AM","Amazonas");
insert into uf(sigla, nome) values("BA","Bahia");
insert into uf(sigla, nome) values("CE","Ceará");
insert into uf(sigla, nome) values("DF","Distrito Federal");
insert into uf(sigla, nome) values("ES","Espírito Santo");
insert into uf(sigla, nome) values("GO","Goiás");
insert into uf(sigla, nome) values("MA","Maranhão");
insert into uf(sigla, nome) values("MT","Mato Grosso");
insert into uf(sigla, nome) values("MS","Mato Grosso do Sul");
insert into uf(sigla, nome) values("MG","Minas Gerais");
insert into uf(sigla, nome) values("PA","Pará");
insert into uf(sigla, nome) values("PB","Paraíba");
insert into uf(sigla, nome) values("PR","Paraná");
insert into uf(sigla, nome) values("PE","Pernambuco");
insert into uf(sigla, nome) values("PI","Piauí");
insert into uf(sigla, nome) values("RJ","Rio de Janeiro");
insert into uf(sigla, nome) values("RN","Rio Grande do Norte");
insert into uf(sigla, nome) values("RS","Rio Grande do Sul");
insert into uf(sigla, nome) values("RO","Rondônia");
insert into uf(sigla, nome) values("RR","Roraima");
insert into uf(sigla, nome) values("SC","Santa Catarina");
insert into uf(sigla, nome) values("SP","São Paulo");
insert into uf(sigla, nome) values("SE","Sergipe");
insert into uf(sigla, nome) values("TO","Tocantins");

# Tabela utilizada para armazenar os médicos cadastrados no sistema
create table if not exists medico(

	codigo int unique auto_increment,
    nome_medico varchar(50) not null,
    cpf_medico varchar(14) unique not null,
    crm char(6) not null,
    email_medico varchar(100) not null,
    telefone varchar(12) not null,
    senha varchar(16) not null,
	uf varchar(2) null,
    cidade varchar(30) not null,
    bairro varchar(30) not null,
    rua varchar(30) not null,
    numero varchar(4) not null,
    genero varchar(6) not null,
    data_de_nascimento date not null,
    nome_imagem_perfil varchar(100) not null,
    tamanho_imagem_perfil varchar(30) not null,
    tipo_imagem_perfil text not null,
    imagem_perfil longblob not null,
	primary key(codigo),
	foreign key(uf) references Uf(codigo)
    
);
drop table medico;

# Tabela utilizada para armazenar os pacientes cadastrados no sistema
create table if not exists paciente(

	codigo int unique auto_increment,
    nome_paciente varchar(50) not null,
    cpf_paciente varchar(14) unique not null,
    email_paciente varchar(100) not null, 
    telefone varchar(12) not null,
    senha varchar(16) not null,
	uf varchar(2) not null,
    cidade varchar(30) not null,
	bairro varchar(30) not null,
    rua varchar(30) not null,
    numero varchar(4) not null,
    genero varchar(6) not null,
    peso varchar(6) not null,
    altura varchar(4) not null,
	diabetico varchar(3) not null,
    data_de_nascimento date not null,
    nome_imagem_perfil varchar(30) not null,
    tamanho_imagem_perfil varchar(30) not null,
    tipo_imagem_perfil text not null,
    imagem_perfil longblob not null,
	medico_paciente int,
	primary key(codigo),
    foreign key(medico_paciente) references medico(codigo),
    foreign key(uf) references Uf(codigo)
    
);
drop table paciente;

# Tabela utilizada para armazenar os pedidos de vínculo dos pacientes para os médicos
create table if not exists pedido_vinculo(

	codigo int unique auto_increment,
    codigo_medico int not null,
    codigo_paciente int unique not null,
	primary key(codigo),
    foreign key(codigo_medico) references medico(codigo),
    foreign key(codigo_paciente) references paciente(codigo)

);

# Tabela utilizada para armazenar os vínculos entre pacientes e médicos
create table if not exists vinculo(

	codigo int unique auto_increment,
    codigo_medico int not null,
    codigo_paciente int unique not null,
	primary key(codigo),
    foreign key(codigo_medico) references medico(codigo),
    foreign key(codigo_paciente) references paciente(codigo)

);

# Tabela utilizada para armazenar os sintomas default, esses sintomas são utilizados para o médico elaborar o diagnóstico
create table if not exists sintoma(

	codigo int unique auto_increment,
    nome varchar(50) not null,
    /*
    cronologia datetime not null,
    quantidade varchar(30) not null,
    circunstancia varchar(500), 
    */
	primary key(codigo)

);

insert into sintoma(nome) values("DOR TORÁXICA");
insert into sintoma(nome) values("INSUFICIÊNCIA RESPIRATÓRIA");
insert into sintoma(nome) values("EDEMA NOS PÉS E TORNOZELOS");
insert into sintoma(nome) values("PALPITAÇÕES");
insert into sintoma(nome) values("FEBRE");
insert into sintoma(nome) values("FADIGA");
insert into sintoma(nome) values("PERDA DE APETITE");

# Tabela utilizada para armazenar os exames realizados pelos pacientes (tanto o paciente quanto o médico possuem acesso)
create table if not exists exame(

	codigo int unique auto_increment,
    codigo_paciente int not null,
	codigo_medico int not null,
    data_do_exame date not null,
    tipo_exame varchar(50) not null,
    descricao_exame varchar(100),
    nome_pdf varchar(100) not null,
	tamanho_pdf varchar(100) not null,
    tipo_pdf text not null,
    pdf longblob not null,
	primary key(codigo),
    foreign key(codigo_medico) references medico(codigo),
    foreign key(codigo_paciente) references paciente(codigo)
    
);

# Tabela utilizada para armazenar os laudos enviados por um médico (tanto o paciente quanto o médico possuem acesso)
create table if not exists laudo(

	codigo int unique auto_increment,
    codigo_paciente int not null,
	codigo_medico int not null,
    data_do_laudo date not null,
    # tipo_laudo varchar(50) not null,
	descricao_laudo varchar(100) not null, 
    nome_pdf varchar(100) not null,
	tamanho_pdf varchar(100) not null,
    tipo_pdf text not null,
    pdf longblob not null,
	primary key(codigo),
    foreign key(codigo_medico) references medico(codigo),
    foreign key(codigo_paciente) references paciente(codigo)
    
);
drop table laudo;

# Falta implementar no PHP
create table if not exists notificacao(

    codigo int not null auto_increment,
    foreign key(codigo_medico) references medico(codigo),
    codigo_paciente int,
	codigo_medico int,
    descricao_notificacao varchar(100) not null,
    foreign key(codigo_paciente) references paciente(codigo),
    primary key(codigo) 
    
);

# Falta implementar no PHP
create table  if not exists tabelasensor(

  hora varchar(30) not null,
  bpm int not null,
  primary key(hora)
  
);
















