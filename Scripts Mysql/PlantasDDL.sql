-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Table `plantas_medicinais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantas_medicinais` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `imagem` VARCHAR(70) NULL DEFAULT NULL,
  `status` TINYINT(4) NULL DEFAULT NULL,
  `descricao_resumida` VARCHAR(150) NULL DEFAULT NULL,
  `descricao_completa` VARCHAR(250) NULL DEFAULT NULL,
  `visualizacoes` INT(10) NULL DEFAULT '1',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 122
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sintomas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sintomas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `descricao_resumida` VARCHAR(170) NULL DEFAULT NULL,
  `descricao_completa` VARCHAR(250) NULL DEFAULT NULL,
  `status` TINYINT(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `indicacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `indicacao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `status` TINYINT(4) NULL DEFAULT NULL,
  `indicacao` VARCHAR(250) NULL DEFAULT NULL,
  `sintomas_id` INT(11) NOT NULL,
  `plantas_medicinais_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_sintomas_plantas_sintomas1_idx` (`sintomas_id` ASC),
  INDEX `fk_sintomas_plantas_plantas_medicinais1_idx` (`plantas_medicinais_id` ASC),
  CONSTRAINT `fk_sintomas_plantas_plantas_medicinais1`
    FOREIGN KEY (`plantas_medicinais_id`)
    REFERENCES `plantas_medicinais` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sintomas_plantas_sintomas1`
    FOREIGN KEY (`sintomas_id`)
    REFERENCES `sintomas` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `status` TINYINT(4) NULL DEFAULT NULL,
  `ultimo_acesso` DATE NULL DEFAULT NULL,
  `perfil` INT(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `indicacao_edicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `indicacao_edicao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `status` TINYINT(4) NULL DEFAULT NULL,
  `indicacao` VARCHAR(250) NOT NULL,
  `indicacao_id` INT(11) NULL DEFAULT NULL,
  `solicitacao` DATETIME NULL DEFAULT NULL,
  `usuario_solicitante` INT(11) NOT NULL,
  `usuario_aprovador` INT(11) NULL DEFAULT NULL,
  `plantas_medicinais_id` INT(11) NOT NULL,
  `sintomas_id` INT(11) NOT NULL,
  `usuario_rejeicao` INT(11) NULL DEFAULT NULL,
  `descricao_parecer` VARCHAR(45) NULL DEFAULT NULL,
  `resposta` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_plantas_sugestao_sintomas_plantas1_idx` (`indicacao_id` ASC),
  INDEX `fk_indicacao_edicao_usuario1_idx` (`usuario_solicitante` ASC),
  INDEX `fk_indicacao_edicao_usuario2_idx` (`usuario_aprovador` ASC),
  INDEX `fk_indicacao_edicao_plantas_medicinais1_idx` (`plantas_medicinais_id` ASC),
  INDEX `fk_indicacao_edicao_sintomas1_idx` (`sintomas_id` ASC),
  INDEX `fk_indicacao_edicao_usuario3_idx` (`usuario_rejeicao` ASC),
  CONSTRAINT `fk_indicacao_edicao_plantas_medicinais1`
    FOREIGN KEY (`plantas_medicinais_id`)
    REFERENCES `plantas_medicinais` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_indicacao_edicao_sintomas1`
    FOREIGN KEY (`sintomas_id`)
    REFERENCES `sintomas` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_indicacao_edicao_usuario1`
    FOREIGN KEY (`usuario_solicitante`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_indicacao_edicao_usuario2`
    FOREIGN KEY (`usuario_aprovador`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_indicacao_edicao_usuario3`
    FOREIGN KEY (`usuario_rejeicao`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_plantas_sugestao_sintomas_plantas1`
    FOREIGN KEY (`indicacao_id`)
    REFERENCES `indicacao` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `nome_tipo_planta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nome_tipo_planta` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `status` TINYINT(4) NULL DEFAULT NULL,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `plantas_classificacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantas_classificacao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `plantas_medicinais_id` INT(11) NOT NULL,
  `voto` INT(2) NOT NULL DEFAULT '0',
  `data_hora` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_classificacao_plantas_medicinais_idx` (`plantas_medicinais_id` ASC),
  CONSTRAINT `fk_classificacao_plantas_medicinais`
    FOREIGN KEY (`plantas_medicinais_id`)
    REFERENCES `plantas_medicinais` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 27
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `plantas_medicinais_edicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantas_medicinais_edicao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `imagem` VARCHAR(70) NULL DEFAULT NULL,
  `status` TINYINT(4) NULL DEFAULT NULL,
  `descricao_resumida` VARCHAR(150) NOT NULL,
  `descricao_completa` VARCHAR(250) NOT NULL,
  `visualizacoes` INT(10) NULL DEFAULT '1',
  `plantas_medicinais_id` INT(11) NULL DEFAULT NULL,
  `usuario_solicitante` INT(11) NOT NULL,
  `usuario_aprovador` INT(11) NULL DEFAULT NULL,
  `solicitacao` DATETIME NULL DEFAULT NULL,
  `usuario_rejeicao` INT(11) NULL DEFAULT NULL,
  `descricao_parecer` VARCHAR(45) NULL DEFAULT NULL,
  `resposta` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_plantas_medicinais_edicao_plantas_medicinais1_idx` (`plantas_medicinais_id` ASC),
  INDEX `fk_plantas_medicinais_edicao_usuario1_idx` (`usuario_solicitante` ASC),
  INDEX `fk_plantas_medicinais_edicao_usuario2_idx` (`usuario_aprovador` ASC),
  INDEX `fk_plantas_medicinais_edicao_usuario3_idx` (`usuario_rejeicao` ASC),
  CONSTRAINT `fk_plantas_medicinais_edicao_plantas_medicinais1`
    FOREIGN KEY (`plantas_medicinais_id`)
    REFERENCES `plantas_medicinais` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_plantas_medicinais_edicao_usuario1`
    FOREIGN KEY (`usuario_solicitante`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_plantas_medicinais_edicao_usuario2`
    FOREIGN KEY (`usuario_aprovador`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_plantas_medicinais_edicao_usuario3`
    FOREIGN KEY (`usuario_rejeicao`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 167
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `plantas_nomes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantas_nomes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `nome_tipo_planta_id` INT(11) NULL DEFAULT NULL,
  `plantas_medicinais_id` INT(11) NULL DEFAULT NULL,
  `plantas_medicinais_edicao_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_plantas_nomes_nome_tipo_planta1_idx` (`nome_tipo_planta_id` ASC),
  INDEX `fk_plantas_nomes_plantas_medicinais1_idx` (`plantas_medicinais_id` ASC),
  INDEX `fk_plantas_nomes_plantas_medicinais_edicao1_idx` (`plantas_medicinais_edicao_id` ASC),
  CONSTRAINT `fk_plantas_nomes_nome_tipo_planta1`
    FOREIGN KEY (`nome_tipo_planta_id`)
    REFERENCES `nome_tipo_planta` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_plantas_nomes_plantas_medicinais1`
    FOREIGN KEY (`plantas_medicinais_id`)
    REFERENCES `plantas_medicinais` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_plantas_nomes_plantas_medicinais_edicao1`
    FOREIGN KEY (`plantas_medicinais_edicao_id`)
    REFERENCES `plantas_medicinais_edicao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 162
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sintomas_edicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sintomas_edicao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao_resumida` VARCHAR(170) NOT NULL,
  `descricao_completa` VARCHAR(250) NOT NULL,
  `status` TINYINT(4) NULL DEFAULT NULL,
  `sintomas_id` INT(11) NULL DEFAULT NULL,
  `solicitacao` DATETIME NULL DEFAULT NULL,
  `usuario_solicitante` INT(11) NOT NULL,
  `usuario_aprovador` INT(11) NULL DEFAULT NULL,
  `usuario_rejeicao` INT(11) NULL DEFAULT NULL,
  `descricao_parecer` VARCHAR(45) NULL DEFAULT NULL,
  `resposta` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_sintomas_sugestao_sintomas1_idx` (`sintomas_id` ASC),
  INDEX `fk_sintomas_edicao_usuario1_idx` (`usuario_solicitante` ASC),
  INDEX `fk_sintomas_edicao_usuario2_idx` (`usuario_aprovador` ASC),
  INDEX `fk_sintomas_edicao_usuario3_idx` (`usuario_rejeicao` ASC),
  CONSTRAINT `fk_sintomas_edicao_usuario1`
    FOREIGN KEY (`usuario_solicitante`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sintomas_edicao_usuario2`
    FOREIGN KEY (`usuario_aprovador`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sintomas_edicao_usuario3`
    FOREIGN KEY (`usuario_rejeicao`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sintomas_sugestao_sintomas1`
    FOREIGN KEY (`sintomas_id`)
    REFERENCES `sintomas` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sugestoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sugestoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  `email` VARCHAR(70) NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `descricao` VARCHAR(250) NOT NULL,
  `envio` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `status` TINYINT(4) NULL DEFAULT '1',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- procedure sp_AvaliarIndicacao
-- -----------------------------------------------------

DELIMITER $$
CREATE DEFINER=`plantas`@`%%` PROCEDURE `sp_AvaliarIndicacao`(
IN in_indicacao_edicao_id int(11),
IN in_user_id int(11),
IN in_descricao_parecer varchar(45),
IN in_boolean int(02))
BEGIN

declare var_status int(11);
declare var_indicacao varchar(250);
declare var_indicacao_id int(11);
declare var_sintomas_id int(11);
declare var_plantas_id int(11);

select indicacao_id,indicacao,plantas_medicinais_id,sintomas_id,status
into var_indicacao_id,var_indicacao,var_plantas_id,var_sintomas_id,var_status 
from indicacao_edicao 
where id = in_indicacao_edicao_id;
    
if (in_boolean = 1) THEN  -- aprovou
    if(var_indicacao_id is not null) then
        UPDATE indicacao 
			set indicacao= var_indicacao, status = var_status, plantas_medicinais_id = var_plantas_id, sintomas_id = var_sintomas_id
		WHERE id = var_indicacao_id;
        
        UPDATE indicacao_edicao set usuario_aprovador = in_user_id,resposta =now() WHERE id = in_indicacao_edicao_id;
	else
		INSERT INTO indicacao(indicacao,status,plantas_medicinais_id,sintomas_id) 
		VALUES(var_indicacao,var_status,var_plantas_id,var_sintomas_id);
            
		UPDATE indicacao_edicao set indicacao_id = LAST_INSERT_ID(),resposta =now(),usuario_aprovador = in_user_id WHERE id = in_indicacao_edicao_id;
	end if;
    
else -- recusou
	UPDATE indicacao_edicao set usuario_rejeicao = in_user_id,resposta =now(),descricao_parecer = in_descricao_parecer WHERE id = in_indicacao_edicao_id;
end if;
    
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_AvaliarPlanta
-- -----------------------------------------------------

DELIMITER $$
CREATE DEFINER=`plantas`@`%%` PROCEDURE `sp_AvaliarPlanta`(
IN in_planta_edicao_id int(11),
IN in_user_id int(11),
IN in_descricao_parecer varchar(45),
IN in_boolean int(02))
BEGIN

declare var_imagem varchar(70);
declare var_status int;
declare var_descricao_resumida varchar(150);
declare var_descricao_completa varchar(250);
declare var_planta_id int;
declare var_planta_nome_id int;

select plantas_medicinais_id,imagem,status,descricao_resumida,descricao_completa 
into var_planta_id,var_imagem,var_status,var_descricao_resumida,var_descricao_completa 
from plantas_medicinais_edicao 
where id = in_planta_edicao_id;
    
if (in_boolean = 1) THEN  -- aprovou    
    if(var_planta_id is not null) then -- PLANTA JA EXISTE
        -- ATUALIZA NO REPOSITORIO PRINCIPAIS
        UPDATE plantas_medicinais 
			set imagem = var_imagem, status = var_status, descricao_resumida = var_descricao_resumida, descricao_completa = var_descricao_completa
		WHERE id = var_planta_id;
        
        -- SINALIZA APROVACAO
        UPDATE plantas_medicinais_edicao set usuario_aprovador = in_user_id,resposta =now() WHERE id = in_planta_edicao_id;
        
	else -- NOVA PLANTA
    
		-- INSERE NO REPOSITORIO PRINCIPAIS
		INSERT INTO plantas_medicinais(imagem,status,descricao_resumida,descricao_completa) 
		VALUES(var_imagem,var_status,var_descricao_resumida,var_descricao_completa);
        
        set var_planta_id = LAST_INSERT_ID();
        
        -- SINALIZA APROVACAO
		UPDATE plantas_medicinais_edicao set plantas_medicinais_id = var_planta_id,resposta =now(),usuario_aprovador = in_user_id WHERE id = in_planta_edicao_id;
        
        -- NOME EDICAO PARA REPOSITORIO PRINCIPAL
        select id into var_planta_nome_id from plantas_nomes WHERE plantas_medicinais_edicao_id = in_planta_edicao_id ORDER BY nome_tipo_planta_id ASC limit 1;        
        if var_planta_nome_id is not null THEN
			Update plantas_nomes set plantas_medicinais_id = var_planta_id,plantas_medicinais_edicao_id = NULL where id = var_planta_nome_id;				
		end if;	
        
	end if;
else -- recusou
	UPDATE plantas_medicinais_edicao set usuario_rejeicao = in_user_id,resposta =now(),descricao_parecer = in_descricao_parecer WHERE id = in_planta_edicao_id;	
end if;  
  
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_AvaliarSintoma
-- -----------------------------------------------------

DELIMITER $$
CREATE DEFINER=`plantas`@`%%` PROCEDURE `sp_AvaliarSintoma`(
IN in_sintoma_edicao_id int(11),
IN in_user_id int(11),
IN in_descricao_parecer varchar(45),
IN in_boolean int(02))
BEGIN

declare var_nome varchar(70);
declare var_status int;
declare var_descricao_resumida varchar(150);
declare var_descricao_completa varchar(250);
declare var_sintoma_id int;

select sintomas_id,nome,status,descricao_resumida,descricao_completa 
into var_sintoma_id,var_nome,var_status,var_descricao_resumida,var_descricao_completa 
from sintomas_edicao 
where id = in_sintoma_edicao_id;
    
if (in_boolean = 1) THEN  -- aprovou    
    if(var_sintoma_id is not null) then
        UPDATE sintomas 
			set nome= var_nome, status = var_status, descricao_resumida = var_descricao_resumida, descricao_completa = var_descricao_completa
		WHERE id = var_sintoma_id;
        
        UPDATE sintomas_edicao set usuario_aprovador = in_user_id,resposta =now() WHERE id = in_sintoma_edicao_id;
	else
		INSERT INTO sintomas(nome,status,descricao_resumida,descricao_completa) 
		VALUES(var_nome,var_status,var_descricao_resumida,var_descricao_resumida);
            
		UPDATE sintomas_edicao set sintomas_id = LAST_INSERT_ID(),resposta =now(),usuario_aprovador = in_user_id WHERE id = in_sintoma_edicao_id;
	end if;
else -- recusou

	UPDATE sintomas_edicao set usuario_rejeicao = in_user_id,resposta =now(),descricao_parecer = in_descricao_parecer WHERE id = in_sintoma_edicao_id;

    end if;    
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_PlantaVisualizacaoContabilizar
-- -----------------------------------------------------

DELIMITER $$
CREATE DEFINER=`plantas`@`%%` PROCEDURE `sp_PlantaVisualizacaoContabilizar`(
in id_planta int(11)
)
begin
declare qtd int(11);

select visualizacoes + 1 into qtd from plantas_medicinais WHERE id = id_planta;
update plantas_medicinais set visualizacoes = qtd WHERE id = id_planta;

end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_SetIndicacao
-- -----------------------------------------------------

DELIMITER $$
CREATE DEFINER=`plantas`@`%%` PROCEDURE `sp_SetIndicacao`(
IN in_indicacao_id int(11),
IN in_sintoma_id int(11),
IN in_planta_id int(11),
IN in_user_id int(11),
IN in_indicacao varchar(250),
IN in_status tinyint(4)
)
BEGIN
declare var_perfil int(11);

select perfil into var_perfil from usuario where id = in_user_id;

if in_indicacao_id is null then -- CADASTRAR

	if (var_perfil > 1) then -- PROFESSOR / ADMIN	 
    
		-- INSERE NO REPOSITORIO PRINCIPAL
		INSERT INTO indicacao (indicacao,plantas_medicinais_id,sintomas_id,status) 
		VALUES(in_indicacao,in_planta_id,in_sintoma_id,in_status); 
		
        -- GERA  SOLICITACAO JA APROVADA AFIM DE HISTORICO
		INSERT INTO indicacao_edicao (indicacao,plantas_medicinais_id,sintomas_id,usuario_solicitante,usuario_aprovador,solicitacao,resposta,status,indicacao_id) 
		VALUES(in_indicacao,in_planta_id,in_sintoma_id,in_user_id,in_user_id,now(),now(),in_status,last_insert_id());
    
    ELSE -- ALUNO
		
        -- GERA  SOLICITACAO
		INSERT INTO indicacao_edicao (indicacao,plantas_medicinais_id,sintomas_id,usuario_solicitante,solicitacao,status) 
		VALUES(in_indicacao,in_planta_id,in_sintoma_id,in_user_id,now(),in_status);
        		        
	end if;
    
else -- ALTERAR
    
	if (var_perfil > 1) then -- PROFESSOR / ADMIN	 
    
			-- ATUALIZA NO REPOSITORIO PRINCIPAL
            UPDATE indicacao i set i.indicacao = in_indicacao, i.status = in_status, plantas_medicinais_id = in_planta_id,sintomas_id = in_sintoma_id WHERE id = in_indicacao_id;
						
			-- GERA  SOLICITACAO JA APROVADA AFIM DE HISTORICO
			INSERT INTO indicacao_edicao (indicacao,plantas_medicinais_id,sintomas_id,usuario_solicitante,usuario_aprovador,solicitacao,resposta,status,indicacao_id) 
			VALUES(in_indicacao,in_planta_id,in_sintoma_id,in_user_id,in_user_id,now(),now(),in_status,in_indicacao_id);
    
    ELSE -- ALUNO
	
			-- GERA  SOLICITACAO
			INSERT INTO indicacao_edicao (indicacao,plantas_medicinais_id,sintomas_id,usuario_solicitante,solicitacao,status,indicacao_id) 
			VALUES(in_indicacao,in_planta_id,in_sintoma_id,in_user_id,now(),in_status,in_indicacao_id);
    
	end if;
end if;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_SetPlanta
-- -----------------------------------------------------

DELIMITER $$
CREATE DEFINER=`plantas`@`%%` PROCEDURE `sp_SetPlanta`(
IN in_planta_id int(11),
IN in_user_id int(11),
IN in_nome varchar(70), 
IN in_imagem varchar(70), 
IN in_desc_resumida varchar(150), 
IN in_desc_completa varchar(250),
IN in_status tinyint(4)
)
BEGIN
declare var_perfil int(11);
declare var_planta_id int(11);

select perfil into var_perfil from usuario where id = in_user_id;

if in_planta_id is null then -- CADASTRAR

	if (var_perfil > 1) then -- PROFESSOR / ADMIN	 
    
		-- INSERE NO REPOSITORIO PRINCIPAL
		INSERT INTO plantas_medicinais(descricao_resumida,descricao_completa,status) 
		VALUES(in_desc_resumida,in_desc_completa,in_status);
		
        SET var_planta_id = last_insert_id();
		            
		-- ATRIBUI NOME PRINCIPAL        
        insert into plantas_nomes(nome,nome_tipo_planta_id,plantas_medicinais_id) values (in_nome,1,var_planta_id);
    
        -- GERA  SOLICITACAO JA APROVADA AFIM DE HISTORICO
		INSERT INTO plantas_medicinais_edicao (descricao_resumida,descricao_completa,status,imagem,usuario_solicitante,usuario_aprovador,solicitacao,resposta,plantas_medicinais_id) 
		VALUES(in_desc_resumida,in_desc_completa,in_status,in_imagem,in_user_id,in_user_id,now(),now(),var_planta_id);
        
        -- INSERE IMAGEM
		IF in_imagem is not null THEN 
			UPDATE plantas_medicinais_edicao set imagem=in_imagem WHERE id = last_insert_id();
			UPDATE plantas_medicinais set imagem=in_imagem WHERE id = var_planta_id;
        END IF;
    	        
    ELSE -- ALUNO
	
		-- GERA  SOLICITACAO
		INSERT INTO plantas_medicinais_edicao (descricao_resumida,descricao_completa,status,imagem,usuario_solicitante,solicitacao) 
		VALUES(in_desc_resumida,in_desc_completa,in_status,in_imagem,in_user_id,now());
        
        SET var_planta_id = last_insert_id();
    
		-- ATRIBUI NOME PRINCIPAL        
        insert into plantas_nomes(nome,nome_tipo_planta_id,plantas_medicinais_edicao_id) values (in_nome,1,var_planta_id);
        
        -- INSERE IMAGEM
        IF in_imagem is not null THEN 
			UPDATE plantas_medicinais_edicao set imagem=in_imagem WHERE id = var_planta_id;
        END IF;
        
	end if;
    
else -- ALTERAR
    
	if (var_perfil > 1) then -- PROFESSOR / ADMIN	 
    
			-- ATUALIZA NO REPOSITORIO PRINCIPAL
			UPDATE plantas_medicinais set descricao_resumida = in_desc_resumida, descricao_completa = in_desc_completa, status = in_status
			WHERE id = in_planta_id;

			-- GERA  SOLICITACAO JA APROVADA AFIM DE HISTORICO
			INSERT INTO plantas_medicinais_edicao (descricao_resumida,descricao_completa,status,usuario_solicitante,usuario_aprovador,solicitacao,resposta,plantas_medicinais_id) 
			VALUES(in_desc_resumida,in_desc_completa,in_status,in_user_id,in_user_id,now(),now(),in_planta_id);
            
             -- INSERE IMAGEM
			IF in_imagem is null THEN 
				UPDATE plantas_medicinais_edicao set imagem=(select imagem from plantas_medicinais where id = in_planta_id) WHERE id = last_insert_id();				
            else
				UPDATE plantas_medicinais_edicao set imagem=in_imagem WHERE id = last_insert_id();
				UPDATE plantas_medicinais set imagem=in_imagem WHERE id = in_planta_id;
			END IF;
    
    ELSE -- ALUNO
	
			-- GERA  SOLICITACAO
			INSERT INTO plantas_medicinais_edicao(descricao_resumida,descricao_completa,status,usuario_solicitante,solicitacao,plantas_medicinais_id) 
			VALUES(in_desc_resumida,in_desc_completa,in_status,in_user_id,now(),in_planta_id);
            
             -- INSERE IMAGEM
			IF in_imagem is null THEN 
				UPDATE plantas_medicinais_edicao set imagem=(select imagem from plantas_medicinais where id = in_planta_id) WHERE id = last_insert_id();				
            else
				UPDATE plantas_medicinais_edicao set imagem=in_imagem WHERE id = last_insert_id();				
			END IF;
	end if;
end if;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_SetPlantaClassificacao
-- -----------------------------------------------------

DELIMITER $$
CREATE DEFINER=`plantas`@`%%` PROCEDURE `sp_SetPlantaClassificacao`(
in id_planta int(11),
in voto int(11)
)
begin

INSERT into plantas_classificacao(plantas_medicinais_id,voto) VALUES(id_planta,voto);

end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_SetSintoma
-- -----------------------------------------------------

DELIMITER $$
CREATE DEFINER=`plantas`@`%%` PROCEDURE `sp_SetSintoma`(
IN in_sintoma_id int(11),
IN in_user_id int(11),
IN in_nome varchar(70), 
IN in_desc_resumida varchar(150), 
IN in_desc_completa varchar(250),
IN in_status tinyint(4)
)
BEGIN
declare var_perfil int(11);

select perfil into var_perfil from usuario where id = in_user_id;

if in_sintoma_id is null then -- CADASTRAR

	if (var_perfil > 1) then -- PROFESSOR / ADMIN	 
    
		-- INSERE NO REPOSITORIO PRINCIPAL
		INSERT INTO sintomas (nome,descricao_resumida,descricao_completa,status) 
		VALUES(in_nome,in_desc_resumida,in_desc_completa,in_status);
		
        -- GERA  SOLICITACAO JA APROVADA AFIM DE HISTORICO
		INSERT INTO sintomas_edicao (nome,descricao_resumida,descricao_completa,status,usuario_solicitante,usuario_aprovador,solicitacao,resposta,sintomas_id) 
		VALUES(in_nome,in_desc_resumida,in_desc_completa,in_status,in_user_id,in_user_id,now(),now(),last_insert_id());
    
    ELSE -- ALUNO
	
		-- GERA  SOLICITACAO
		INSERT INTO sintomas_edicao (nome,descricao_resumida,descricao_completa,status,usuario_solicitante,solicitacao) 
		VALUES(in_nome,in_desc_resumida,in_desc_completa,in_status,in_user_id,now());
        
	end if;
    
else -- ALTERAR
    
	if (var_perfil > 1) then -- PROFESSOR / ADMIN	 
    
			-- ATUALIZA NO REPOSITORIO PRINCIPAL
			UPDATE sintomas set nome = in_nome, descricao_resumida = in_desc_resumida, descricao_completa = in_desc_completa, status = in_status
			WHERE id = in_sintoma_id;

			-- GERA  SOLICITACAO JA APROVADA AFIM DE HISTORICO
			INSERT INTO sintomas_edicao (nome,descricao_resumida,descricao_completa,status,usuario_solicitante,usuario_aprovador,solicitacao,resposta,sintomas_id) 
			VALUES(in_nome,in_desc_resumida,in_desc_completa,in_status,in_user_id,in_user_id,now(),now(),in_sintoma_id);
    
    ELSE -- ALUNO
	
			-- GERA  SOLICITACAO
			INSERT INTO sintomas_edicao (nome,descricao_resumida,descricao_completa,status,usuario_solicitante,solicitacao,sintomas_id) 
			VALUES(in_nome,in_desc_resumida,in_desc_completa,in_status,in_user_id,now(),in_sintoma_id);
    
	end if;
end if;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_SetSugestoes
-- -----------------------------------------------------

DELIMITER $$
CREATE DEFINER=`plantas`@`%%` PROCEDURE `sp_SetSugestoes`(
IN pnome varchar(100), 
IN ptelefone varchar(45),
IN pemail varchar(45),
IN ptitulo varchar(70),
IN pdescricao varchar(250))
BEGIN
INSERT INTO sugestoes (nome,telefone,email,titulo,descricao) 
    VALUES(pnome,ptelefone,pemail,ptitulo,pdescricao);
END$$

DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
