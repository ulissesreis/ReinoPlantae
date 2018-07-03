<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") { 
 
    $query= "SELECT
    coalesce(
        (select nome
        from plantas_nomes pn
        Where pn.plantas_medicinais_id = e.plantas_medicinais_id ORDER BY pn.nome_tipo_planta_id ASC LIMIT 1), 
        (select nome
        from plantas_nomes pn
        Where pn.plantas_medicinais_edicao_id = e.plantas_medicinais_id ORDER BY pn.nome_tipo_planta_id ASC LIMIT 1)
    ) as nome,
    e.solicitacao,
    e.resposta,
    coalesce(uap.nome,urj.nome) as usuario_resposta,
    e.descricao_parecer,
    (CASE
        WHEN e.usuario_aprovador IS NOT NULL THEN 1
        ELSE 0
    END) as aprovacao,
    'Planta' as tipo
    FROM plantas_medicinais_edicao e
    left join usuario uap
    ON uap.id = e.usuario_aprovador
    left join usuario urj
    on urj.id = e.usuario_rejeicao
    WHERE usuario_solicitante = ".$_SESSION['admin']." AND (e.usuario_rejeicao is not null OR e.usuario_aprovador is not null)
    
    UNION ALL
    SELECT 
    concat((select pn.nome
        from plantas_nomes pn
        Where pn.plantas_medicinais_id = e.plantas_medicinais_id ORDER BY pn.nome_tipo_planta_id ASC LIMIT 1)
        ,' para '
        ,s.nome
    ) as nome,
    e.solicitacao,
    e.resposta,
    coalesce(uap.nome,urj.nome) as usuario_resposta,
    e.descricao_parecer,
    (CASE
        WHEN e.usuario_aprovador IS NOT NULL THEN 1
        ELSE 0
    END) as aprovacao,
    'Indicacao' as tipo
    FROM indicacao_edicao e
    INNER JOIN plantas_medicinais pm
    On pm.id = e.plantas_medicinais_id
    INNER JOIN sintomas s 
    ON s.id = e.sintomas_id
    left join usuario uap
    ON uap.id = e.usuario_aprovador
    left join usuario urj
    on urj.id = e.usuario_rejeicao
    WHERE usuario_solicitante = ".$_SESSION['admin']." AND (e.usuario_rejeicao is not null OR e.usuario_aprovador is not null)
    UNION ALL
    SELECT 
    e.nome,
    e.solicitacao,
    e.resposta,
    coalesce(uap.nome,urj.nome) as usuario_resposta,
    e.descricao_parecer,
    (CASE
        WHEN e.usuario_aprovador IS NOT NULL THEN 1
        ELSE 0
    END) as aprovacao,
    'Sintomas' as tipo
    FROM sintomas_edicao e
    left join usuario uap
    ON uap.id = e.usuario_aprovador
    left join usuario urj
    on urj.id = e.usuario_rejeicao
    WHERE usuario_solicitante = ".$_SESSION['admin']." AND (e.usuario_rejeicao is not null OR e.usuario_aprovador is not null)";
    
    processaConsulta($query);
}


