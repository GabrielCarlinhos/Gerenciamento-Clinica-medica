create database clinica;
use clinica;

create table tb_usuarios(
id_usuario int not null auto_increment,
senha_usuario varchar(24) not null,
login_usuario varchar(16) not null,
situacao_usuario enum ("ativo", "inativo") not null,
tipo_usuario enum("admin","doutor","master") not null,
email_usuario varchar(100) not null,
constraint pk_usuario primary key (id_usuario)
)CHARACTER SET latin1 COLLATE latin1_bin;

insert into tb_usuarios(senha_usuario,login_usuario,situacao_usuario,tipo_usuario,email_usuario)
values('a','A','ativo','master','a@gmail.com');

create table tb_especialidades(
codigo_especialidade int not null auto_increment,
descricao_especialidade varchar(100) not null,
valor_consulta dec(10,2) not null,
constraint pk_especialidade primary key (codigo_especialidade)
);



create table tb_doutores(
crm_doutor int not null,
nome_doutor varchar (45) not null,
cpf_doutor varchar(15) not null, 
rg_doutor varchar(10) not null,
telefone_doutor varchar (15) not null,
cep_doutor varchar(9) not null,
numero_doutor varchar(6) not null,
logradouro_doutor varchar(45) not null,
bairro_doutor varchar(45) not null,
cidade_doutor varchar(45) not null,
estado_doutor varchar(45) not null,
codigo_especialidade int not null,
id_usuario int,
constraint pk_doutor primary key (crm_doutor),

constraint fk_id_usuario foreign key (id_usuario) references tb_usuarios (id_usuario),
constraint fk_cd_especialidade foreign key (codigo_especialidade) references tb_especialidades (codigo_especialidade)
);

create table tb_convenios(
id_convenio int not null auto_increment,
nome_convenio varchar(45) not null,
numero_convenio int not null,
constraint pk_convenio primary key(id_convenio)
);

create table tb_pacientes(
id_paciente int not null auto_increment,
nome_paciente varchar(45) not null,
cpf_paciente varchar (15) not null,
telefone_paciente varchar(15) not null,
email_paciente varchar (100) not null,
genero_paciente enum ("masculino","feminino", "outros")not null,
logradouro_paciente varchar (100) not null,
numero_paciente varchar(6) not null,
bairro_paciente varchar (100) not null,
cidade_paciente varchar(100) not null,
uf_paciente enum('AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'),
cep_paciente varchar (9) not null,
dataNascimento_paciente date not null,
situacao_paciente enum("ativo","inativo"),
nomeMae_paciente varchar(45) not null,
rg_paciente varchar(9) not null,
id_convenio int,
constraint pk_paciente primary key (id_paciente),
constraint fk_id_convenio foreign key(id_convenio) references tb_convenios(id_convenio)
);

create table tb_acompanhantes(
id_acompanhante int not null auto_increment,
nome_acompanhante varchar(45) not null,
cpf_acompanhante varchar (15) not null,
rg_acompanhante varchar(10)not null,
telefone_acompanhante varchar(15) not null,
id_paciente int not null,
email_acompanhante varchar(100),
constraint pk_acompanhante primary key (id_acompanhante),
constraint fk_id_paciente foreign key(id_paciente) references tb_pacientes (id_paciente)
);

create table tb_agendamentos(
codigo_agendamento int not null auto_increment,
horario_agendamento time not null,
data_agendamento date not null,
id_paciente int not null,
crm_doutor int not null,
constraint pk_agendamento primary key (codigo_agendamento),
constraint fk_id_paciente_agendamento foreign key(id_paciente) references tb_pacientes (id_paciente),
constraint fk_crm_doutor foreign key(crm_doutor) references tb_doutores (crm_doutor)
);

create table tb_agendamentosCancelados(
codigo_agendamento int not null auto_increment,
id_paciente int not null,
crm_doutor int not null,
motivo_cancelamento varchar(100) not null,
data_agendamento date not null,
constraint pk_cancelamento primary key(codigo_agendamento),
constraint fk_id_paciente_agendamento_cancelado foreign key(id_paciente) references tb_pacientes (id_paciente),
constraint fk_crm_doutor_cancelado foreign key(crm_doutor) references tb_doutores(crm_doutor)
);

create table tb_consultas(
codigo_consulta int not null auto_increment,
horario_consulta time not null,
data_consulta date not null,
valor_consulta float not null,
convenio_consulta enum("social", "particular") not null,
id_paciente int not null,
crm_doutor int not null,
constraint pk_consulta primary key (codigo_consulta),
constraint fk_id_paciente_consulta foreign key(id_paciente) references tb_pacientes (id_paciente),
constraint fk_crm_doutor_consulta foreign key(crm_doutor) references tb_doutores (crm_doutor)
);





create table tb_prontuarios(
id_prontuario int not null auto_increment,
peso_paciente float,
altura_paciente float,
imc_paciente float,
descricaoExameFisico_paciente mediumtext,
solicitacaoExame_paciente mediumtext,
tipoSanguineo_paciente enum('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'),
alergias_paciente mediumtext,
id_paciente int not null,
crm_doutor int not null,
constraint pk_prontuario primary key (id_prontuario),
constraint fk_id_paciente_prontuario foreign key(id_paciente) references tb_pacientes (id_paciente),
constraint fk_crm_doutor_prontuario foreign key(crm_doutor) references tb_doutores (crm_doutor)
);

insert into tb_consultas(horario_consulta,data_consulta,valor_consulta,convenio_consulta,id_paciente,crm_doutor)
values("20:40","2022-01-09",250,"social",1,131313);

insert into tb_consultas(horario_consulta,data_consulta,valor_consulta,convenio_consulta,id_paciente,crm_doutor)
values("20:40","2022-01-09",250,"particular",1,131313);

insert into tb_consultas(horario_consulta,data_consulta,valor_consulta,convenio_consulta,id_paciente,crm_doutor)
values("20:40","2022-02-09",250,"social",1,131313);

insert into tb_consultas(horario_consulta,data_consulta,valor_consulta,convenio_consulta,id_paciente,crm_doutor)
values("20:40","2022-02-09",250,"social",1,131313);

insert into tb_consultas(horario_consulta,data_consulta,valor_consulta,convenio_consulta,id_paciente,crm_doutor)
values("20:40","2022-03-09",250,"particular",1,131313);

insert into tb_consultas(horario_consulta,data_consulta,valor_consulta,convenio_consulta,id_paciente,crm_doutor)
values("20:40","2022-03-09",250,"particular",1,131313);

insert into tb_consultas(horario_consulta,data_consulta,valor_consulta,convenio_consulta,id_paciente,crm_doutor)
values("20:40","2022-04-09",250,"social",1,131313);

insert into tb_consultas(horario_consulta,data_consulta,valor_consulta,convenio_consulta,id_paciente,crm_doutor)
values("20:40","2022-04-09",250,"particular",1,131313);

insert into tb_consultas(horario_consulta,data_consulta,valor_consulta,convenio_consulta,id_paciente,crm_doutor)
values("20:40","2022-05-09",250,"social",1,131313);

insert into tb_consultas(horario_consulta,data_consulta,valor_consulta,convenio_consulta,id_paciente,crm_doutor)
values("20:40","2022-05-09",250,"social",1,131313);

select * from tb_convenios;
select * from tb_prontuarios;
select * from tb_pacientes;
select * from tb_usuarios;
select * from tb_consultas;
select * from tb_doutores;
select * from tb_agendamentos;
select * from tb_acompanhantes;
select * from tb_especialidades;	





