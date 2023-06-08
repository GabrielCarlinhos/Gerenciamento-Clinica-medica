create database clinica;
use clinica;

create table tb_usuarios(
no_usuario int not null auto_increment,
ds_senha varchar(24) not null,
no_login varchar(16) not null,
ds_situacao enum ("ativo", "inativo") not null,
ds_tipo_usuario enum("admin","doutor","master") not null,
ds_email varchar(100) not null,
constraint pk_usuario primary key (id_usuario)
)CHARACTER SET latin1 COLLATE latin1_bin;

insert into tb_usuarios(senha_usuario,login_usuario,situacao_usuario,tipo_usuario,email_usuario)
values('a','A','ativo','master','a@gmail.com');

create table tb_especialidades(
co_especialidade int not null auto_increment,
ds_especialidade varchar(100) not null,
vl_consulta dec(10,2) not null,
constraint pk_especialidade primary key (co_especialidade)
);



create table tb_doutores(
nu_crm int not null,
no_doutor varchar (45) not null,
nu_cpf varchar(14) not null, 
nu_rg varchar(10) not null,
nu_telefone varchar (15) not null,
nu_cep varchar(9) not null,
nu_doutor varchar(6) not null,
ds_logradouro varchar(45) not null,
ds_bairro varchar(45) not null,
ds_cidade varchar(45) not null,
co_estado varchar(45) not null,
co_especialidade int not null,
id_usuario int,
constraint pk_doutor primary key (nu_crm),

constraint fk_id_usuario foreign key (id_usuario) references tb_usuarios (id_usuario),
constraint fk_cd_especialidade foreign key (co_especialidade) references tb_especialidades (co_especialidade)
);

create table tb_convenios(
id_convenio int not null auto_increment,
no_convenio varchar(45) not null,
nu_convenio int not null,
constraint pk_convenio primary key(id_convenio)
);

create table tb_pacientes(
id_paciente int not null auto_increment,
no_paciente varchar(45) not null,
nu_cpf varchar (15) not null,
nu_telefone varchar(15) not null,
ds_email varchar (100) not null,
ds_genero enum ("masculino","feminino") not null,
ds_logradouro varchar (100) not null,
nu_paciente varchar(6) not null,
ds_bairro varchar (100) not null,
ds_cidade varchar(100) not null,
co_estado enum('AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'),
nu_cep varchar (9) not null,
dt_nascimento date not null,
in_ativo boolean,
no_mae varchar(45) not null,
nu_rg varchar(9) not null,
id_convenio int,
constraint pk_paciente primary key (id_paciente),
constraint fk_id_convenio foreign key(id_convenio) references tb_convenios(id_convenio)
);

create table tb_acompanhantes(
id_acompanhante int not null auto_increment,
no_acompanhante varchar(45) not null,
nu_cpf varchar (15) not null,
nu_rg varchar(10)not null,
nu_telefone varchar(15) not null,
id_paciente int not null,
ds_email varchar(100),
constraint pk_acompanhante primary key (id_acompanhante),
constraint fk_id_paciente foreign key(id_paciente) references tb_pacientes (id_paciente)
);

create table tb_agendamentos(
co_agendamento int not null auto_increment,
dt_agendamento DateTime not null,
id_paciente int not null,
nu_crm_doutor int not null,
in_cancelado boolean,
ds_motivo_cancelamento varchar(100),
constraint pk_agendamento primary key (co_agendamento),
constraint fk_id_paciente_agendamento foreign key(id_paciente) references tb_pacientes (id_paciente),
constraint fk_crm_doutor foreign key(nu_crm_doutor) references tb_doutores (nu_crm)
);

create table tb_consultas(
co_consulta int not null auto_increment,
dt_consulta dateTime not null,
vl_consulta float not null,
ds_convenio enum("social", "particular") not null,
id_paciente int not null,
nu_crm_doutor int not null,
constraint pk_consulta primary key (codigo_consulta),
constraint fk_id_paciente_consulta foreign key(id_paciente) references tb_pacientes (id_paciente),
constraint fk_crm_doutor_consulta foreign key(nu_crm_doutor) references tb_doutores (crm_doutor)
);





create table tb_prontuarios(
id_prontuario int not null auto_increment,
nu_peso float,
nu_altura float,
nu_imc float,
ds_exame_fisico mediumtext,
ds_solicitacao_exame mediumtext,
tp_sanguineo enum('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'),
ds_alergias mediumtext,
id_paciente int not null,
nu_crm_doutor int not null,
constraint pk_prontuario primary key (id_prontuario),
constraint fk_id_paciente_prontuario foreign key(id_paciente) references tb_pacientes (id_paciente),
constraint fk_crm_doutor_prontuario foreign key(nu_crm_doutor) references tb_doutores (crm_doutor)
);

INSERT INTO tb_consultas (dt_consulta, vl_consulta, ds_convenio, id_paciente, nu_crm_doutor)
VALUES ('2022-01-09 20:40:00', 250, 'social', 1, 131313);

INSERT INTO tb_consultas (dt_consulta, vl_consulta, ds_convenio, id_paciente, nu_crm_doutor)
VALUES ('2022-01-09 20:40:00', 250, 'particular', 1, 131313);

INSERT INTO tb_consultas (dt_consulta, vl_consulta, ds_convenio, id_paciente, nu_crm_doutor)
VALUES ('2022-02-09 20:40:00', 250, 'social', 1, 131313);

INSERT INTO tb_consultas (dt_consulta, vl_consulta, ds_convenio, id_paciente, nu_crm_doutor)
VALUES ('2022-02-09 20:40:00', 250, 'social', 1, 131313);

INSERT INTO tb_consultas (dt_consulta, vl_consulta, ds_convenio, id_paciente, nu_crm_doutor)
VALUES ('2022-03-09 20:40:00', 250, 'particular', 1, 131313);

INSERT INTO tb_consultas (dt_consulta, vl_consulta, ds_convenio, id_paciente, nu_crm_doutor)
VALUES ('2022-03-09 20:40:00', 250, 'particular', 1, 131313);

INSERT INTO tb_consultas (dt_consulta, vl_consulta, ds_convenio, id_paciente, nu_crm_doutor)
VALUES ('2022-04-09 20:40:00', 250, 'social', 1, 131313);

INSERT INTO tb_consultas (dt_consulta, vl_consulta, ds_convenio, id_paciente, nu_crm_doutor)
VALUES ('2022-04-09 20:40:00', 250, 'particular', 1, 131313);

INSERT INTO tb_consultas (dt_consulta, vl_consulta, ds_convenio, id_paciente, nu_crm_doutor)
VALUES ('2022-05-09 20:40:00', 250, 'social', 1, 131313);

INSERT INTO tb_consultas (dt_consulta, vl_consulta, ds_convenio, id_paciente, nu_crm_doutor)
VALUES ('2022-05-09 20:40:00', 250, 'social', 1, 131313);


select * from tb_convenios;
select * from tb_prontuarios;
select * from tb_pacientes;
select * from tb_usuarios;
select * from tb_consultas;
select * from tb_doutores;
select * from tb_agendamentos;
select * from tb_acompanhantes;
select * from tb_especialidades;	





