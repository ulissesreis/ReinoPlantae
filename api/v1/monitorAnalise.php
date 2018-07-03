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
    'Planta' as tipo
    FROM plantas_medicinais_edicao e
    WHERE usuario_rejeicao is null and usuario_aprovador is null and usuario_solicitante = ".$_SESSION['admin']."
    
    UNION ALL
    SELECT 
    concat((select pn.nome
        from plantas_nomes pn
        Where pn.plantas_medicinais_id = e.plantas_medicinais_id ORDER BY pn.nome_tipo_planta_id ASC LIMIT 1)
        ,' para '
        ,s.nome
    ) as nome,
    e.solicitacao,
    'Indicacao' as tipo
    FROM indicacao_edicao e
    INNER JOIN plantas_medicinais pm
    On pm.id = e.plantas_medicinais_id
    INNER JOIN sintomas s 
    ON s.id = e.sintomas_id
    WHERE usuario_rejeicao is null and usuario_aprovador is null and usuario_solicitante = ".$_SESSION['admin']."
    
    UNION ALL
    SELECT 
    e.nome,
    e.solicitacao,
    'Sintomas' as tipo
    FROM sintomas_edicao e
    WHERE usuario_rejeicao is null and usuario_aprovador is null and usuario_solicitante = ".$_SESSION['admin'];
     
processaConsulta($query);
}


