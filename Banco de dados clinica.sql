
create database if not exists clinica;
use clinica;

create table if not exists tb_usuarios(
id_usuario int not null auto_increment,
no_usuario varchar(24) not null,
ds_senha varchar(24) not null,
ds_situacao enum ("ativo", "inativo") not null,
ds_tipo_usuario enum("admin","doutor","master") not null,
ds_email varchar(100) not null,
constraint pk_usuario primary key (id_usuario)
)CHARACTER SET latin1 COLLATE latin1_bin;

insert into tb_usuarios(ds_senha,no_usuario,ds_situacao,ds_tipo_usuario,ds_email)
values('a','A','ativo','master','a@gmail.com');

create table if not exists tb_especialidades(
co_especialidade int not null auto_increment,
ds_especialidade varchar(100) not null,
vl_consulta dec(10,2) not null,
constraint primary key (co_especialidade)
);



create table if not exists tb_doutores(
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
constraint primary key (nu_crm),

constraint foreign key (id_usuario) references tb_usuarios (id_usuario),
constraint foreign key (co_especialidade) references tb_especialidades (co_especialidade)
);

create table if not exists tb_convenios(
id_convenio int not null auto_increment,
no_convenio varchar(45) not null,
nu_convenio int not null,
in_especial boolean DEFAULT FALSE,
constraint primary key(id_convenio)
);

create table if not exists tb_pacientes(
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
constraint primary key (id_paciente),
constraint foreign key(id_convenio) references tb_convenios(id_convenio)
);



create table if not exists tb_acompanhantes(
id_acompanhante int not null auto_increment,
no_acompanhante varchar(45) not null,
nu_cpf varchar (15) not null,
nu_rg varchar(10)not null,
nu_telefone varchar(15) not null,
id_paciente int not null,
ds_email varchar(100),
constraint primary key (id_acompanhante),
constraint foreign key(id_paciente) references tb_pacientes (id_paciente)
);

create table if not exists tb_agendamentos(
co_agendamento int not null auto_increment,
dt_agendamento Date not null,
hr_agendamento time not null,
id_paciente int not null,
nu_crm_doutor int not null,
in_cancelado boolean,
ds_motivo_cancelamento varchar(100),
constraint primary key (co_agendamento),
constraint foreign key(id_paciente) references tb_pacientes (id_paciente),
constraint foreign key(nu_crm_doutor) references tb_doutores (nu_crm)
);

create table if not exists tb_consultas(
co_consulta int not null auto_increment,
dt_consulta dateTime not null,
vl_consulta float not null,
ds_convenio enum("social", "particular", "convênio") not null,
id_paciente int not null,
nu_crm_doutor int not null,
constraint primary key (co_consulta),
constraint foreign key(id_paciente) references tb_pacientes (id_paciente),
constraint foreign key(nu_crm_doutor) references tb_doutores (nu_crm)
);


create table if not exists tb_prontuarios(
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
constraint primary key (id_prontuario),
constraint foreign key(id_paciente) references tb_pacientes (id_paciente),
constraint foreign key(nu_crm_doutor) references tb_doutores (nu_crm)
);

create table if not exists tb_estados (
  `id_estado` int(11) NOT NULL,
  `no_estado` varchar(75) DEFAULT NULL,
  `co_estado` varchar(2) DEFAULT NULL,
  Constraint primary key(id_estado)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO tb_estados (`id_estado`, `no_estado`, `co_estado`) VALUES
(1, 'Acre', 'AC'),
(2, 'Alagoas', 'AL'),
(3, 'Amazonas', 'AM'),
(4, 'Amapá', 'AP'),
(5, 'Bahia', 'BA'),
(6, 'Ceará', 'CE'),
(7, 'Distrito Federal', 'DF'),
(8, 'Espírito Santo', 'ES'),
(9, 'Goiás', 'GO'),
(10, 'Maranhão', 'MA'),
(11, 'Minas Gerais', 'MG'),
(12, 'Mato Grosso do Sul', 'MS'),
(13, 'Mato Grosso', 'MT'),
(14, 'Pará', 'PA'),
(15, 'Paraíba', 'PB'),
(16, 'Pernambuco', 'PE'),
(17, 'Piauí', 'PI'),
(18, 'Paraná', 'PR'),
(19, 'Rio de Janeiro', 'RJ'),
(20, 'Rio Grande do Norte', 'RN'),
(21, 'Rondônia', 'RO'),
(22, 'Roraima', 'RR'),
(23, 'Rio Grande do Sul', 'RS'),
(24, 'Santa Catarina', 'SC'),
(25, 'Sergipe', 'SE'),
(26, 'São Paulo', 'SP'),
(27, 'Tocantins', 'TO');

CREATE VIEW view_paciente AS
SELECT p.*, c.no_convenio,c.nu_convenio,a.id_acompanhante, a.no_acompanhante, a.nu_cpf AS cpf_acompanhante, a.nu_telefone AS telefone_acompanhante, a.ds_email AS email_acompanhante
FROM tb_pacientes AS p
LEFT JOIN tb_convenios AS c ON p.id_convenio = c.id_convenio
LEFT JOIN tb_acompanhantes AS a ON a.id_paciente = p.id_paciente;


CREATE VIEW view_agenda AS SELECT
  e.*,
  d.no_doutor,
  d.nu_crm,
  a.co_agendamento,
  a.dt_agendamento,
  a.id_paciente as agendamento_id_paciente,
  a.nu_crm_doutor,
  a.hr_agendamento,
  a.in_cancelado,
  a.ds_motivo_cancelamento,
  p.id_paciente,
  p.nu_cpf,
  p.no_paciente,
  p.id_convenio
FROM
  tb_especialidades e
LEFT JOIN
  tb_doutores d ON e.co_especialidade = d.co_especialidade
LEFT JOIN
  tb_agendamentos a ON a.nu_crm_doutor = d.nu_crm
LEFT JOIN
  tb_pacientes p ON a.id_paciente = p.id_paciente
;
