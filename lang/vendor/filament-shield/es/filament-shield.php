<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Table Columns
    |--------------------------------------------------------------------------
    */

    'column.name' => 'Nombre',
    'column.guard_name' => 'Podra',
    'column.roles' => 'Roles',
    'column.permissions' => 'Permisos',
    'column.updated_at' => 'Actualizado el',

    /*
    |--------------------------------------------------------------------------
    | Form Fields
    |--------------------------------------------------------------------------
    */

    'field.name' => 'Nombre',
    'field.guard_name' => 'Podra',
    'field.permissions' => 'Permisos',
    'field.select_all.name' => 'Seleccionar todos',
    'field.select_all.message' => 'Habilitar todos los permisos actualmente <span class="text-primary font-medium">disponibles</span> para este rol',

    /*
    |--------------------------------------------------------------------------
    | Navigation & Resource
    |--------------------------------------------------------------------------
    */

    'nav.group' => 'Administración',
    'nav.role.label' => 'Roles',
    'nav.role.icon' => 'heroicon-o-square-3-stack-3d',
    'resource.label.role' => 'Rol',
    'resource.label.roles' => 'Roles',

    /*
    |--------------------------------------------------------------------------
    | Section & Tabs
    |--------------------------------------------------------------------------
    */

    'section' => 'Entidades',
    'resources' => 'Permisos',
    'widgets' => 'Widgets',
    'pages' => 'Páginas',
    'custom' => 'Permisos personalizados',

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */

    'forbidden' => 'Usted no tiene permiso de acceso',

    /*
    |--------------------------------------------------------------------------
    | Resource Permissions' Labels
    |--------------------------------------------------------------------------
    */

    'resource_permission_prefixes_labels' => [
        'view' => 'Ver un registro en particular',
        'view_any' => 'Ver el listado de registros',
        'create' => 'Crear registros',
        'update' => 'Actualizar registros',
        'delete' => 'Eliminar un registro en particular',
        'delete_any' => 'Eliminar varios registros a la vez',
        'force_delete' => 'Forzar elminación de un registro en particular',
        'force_delete_any' => 'Forzar eliminación de varios registros',
        'restore' => 'Restaurar un registro en particular',
        'reorder' => 'Reordenar',
        'restore_any' => 'Restaurar varios registros',
        'replicate' => 'Replicar',
    ],
];
