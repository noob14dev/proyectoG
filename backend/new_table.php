<?php
// incluir archivo de conexión existente
include_once "config.php";

// 1. Crear la tabla si no existe
$createTable = "
create table if not exists res_encuesta_resultados_vf (
    codigo bigint,
    periodo smallint,
    proyecto_curricular smallint,
    ano smallint,
    permanencia_en_semestres smallint,
    num smallint,
    varres varchar(20),
    valor smallint
)";
if (!$conexion->query($createTable)) {
    die("Error al crear la tabla: " . $conexion->error);
}

// 2. Revisar si la tabla ya tiene datos
$result = $conexion->query("select count(*) as total from res_encuesta_resultados_vf");
$row = $result->fetch_assoc();
if ($row['total'] > 0) {
    echo "✅ La tabla ya tiene datos, no se insertará nada.\n";
    exit;
}

// 3. Insertar datos pivotados solo si la tabla está vacía
$insertData = "
insert into res_encuesta_resultados_vf
  (codigo, periodo, proyecto_curricular, ano, permanencia_en_semestres, num, varres, valor)
select
    r.codigo,
    r.periodo,
    r.proyecto_curricular,
    r.ano,
    r.permanencia_en_semestres,
    v.num,
    v.res,
    case v.num
        when 1 then r.varres_01
        when 2 then r.varres_02
        when 3 then r.varres_03
        when 4 then r.varres_04
        when 5 then r.varres_05
        when 6 then r.varres_06
        when 7 then r.varres_07
        when 8 then r.varres_08
        when 9 then r.varres_09
        when 10 then r.varres_10
        when 11 then r.varres_11
        when 12 then r.varres_12
        when 13 then r.varres_13
        when 14 then r.varres_14
        when 15 then r.varres_15
        when 16 then r.varres_16
        when 17 then r.varres_17
        when 18 then r.varres_18
        when 19 then r.varres_19
        when 20 then r.varres_20
        when 21 then r.varres_21
        when 22 then r.varres_22
        when 23 then r.varres_23
        when 24 then r.varres_24
        when 25 then r.varres_25
        when 26 then r.varres_26
        when 27 then r.varres_27
        when 28 then r.varres_28
        when 29 then r.varres_29
        when 30 then r.varres_30
        when 31 then r.varres_31
        when 32 then r.varres_32
        when 33 then r.varres_33
        when 34 then r.varres_34
        when 35 then r.varres_35
        when 36 then r.varres_36
        when 37 then r.varres_37
        when 38 then r.varres_38
        when 39 then r.varres_39
        when 40 then r.varres_40
        when 41 then r.varres_41
        when 42 then r.varres_42
        when 43 then r.varres_43
        when 44 then r.varres_44
        when 45 then r.varres_45
        when 46 then r.varres_46
        when 47 then r.varres_47
        when 48 then r.varres_48
        when 49 then r.varres_49
        when 50 then r.varres_50
        when 51 then r.varres_51
        when 52 then r.varres_52
        when 53 then r.varres_53
        when 54 then r.varres_54
        when 55 then r.varres_55
        when 56 then r.varres_56
        when 57 then r.varres_57
    end as valor
from sistematizaciondatos_com.res_encuesta_resultados r
cross join (
    select 1 as num, 'varres_01' as res union all
    select 2, 'varres_02' union all
    select 3, 'varres_03' union all
    select 4, 'varres_04' union all
    select 5, 'varres_05' union all
    select 6, 'varres_06' union all
    select 7, 'varres_07' union all
    select 8, 'varres_08' union all
    select 9, 'varres_09' union all
    select 10, 'varres_10' union all
    select 11, 'varres_11' union all
    select 12, 'varres_12' union all
    select 13, 'varres_13' union all
    select 14, 'varres_14' union all
    select 15, 'varres_15' union all
    select 16, 'varres_16' union all
    select 17, 'varres_17' union all
    select 18, 'varres_18' union all
    select 19, 'varres_19' union all
    select 20, 'varres_20' union all
    select 21, 'varres_21' union all
    select 22, 'varres_22' union all
    select 23, 'varres_23' union all
    select 24, 'varres_24' union all
    select 25, 'varres_25' union all
    select 26, 'varres_26' union all
    select 27, 'varres_27' union all
    select 28, 'varres_28' union all
    select 29, 'varres_29' union all
    select 30, 'varres_30' union all
    select 31, 'varres_31' union all
    select 32, 'varres_32' union all
    select 33, 'varres_33' union all
    select 34, 'varres_34' union all
    select 35, 'varres_35' union all
    select 36, 'varres_36' union all
    select 37, 'varres_37' union all
    select 38, 'varres_38' union all
    select 39, 'varres_39' union all
    select 40, 'varres_40' union all
    select 41, 'varres_41' union all
    select 42, 'varres_42' union all
    select 43, 'varres_43' union all
    select 44, 'varres_44' union all
    select 45, 'varres_45' union all
    select 46, 'varres_46' union all
    select 47, 'varres_47' union all
    select 48, 'varres_48' union all
    select 49, 'varres_49' union all
    select 50, 'varres_50' union all
    select 51, 'varres_51' union all
    select 52, 'varres_52' union all
    select 53, 'varres_53' union all
    select 54, 'varres_54' union all
    select 55, 'varres_55' union all
    select 56, 'varres_56' union all
    select 57, 'varres_57'
) as v
";

if ($conexion->query($insertData)) {
    echo "✅ Datos insertados correctamente en res_encuesta_resultados_vf.\n";
} else {
    die("❌ Error al insertar datos: " . $conexion->error);
}

$conexion->close();
