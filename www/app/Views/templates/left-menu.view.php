<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="<?php echo $_ENV['host.folder'] ?>" class="nav-link
                <?php echo $seccion === $_ENV['host.folder'] . 'inicio' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Inicio
                </p>
            </a>
        </li>
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item
          <?php echo (in_array($seccion, [
                $_ENV['host.folder'] . 'demo-proveedores',
                $_ENV['host.folder'] . 'panel/temas',
                $_ENV['host.folder'] . 'panel/usuario',
                $_ENV['host.folder'] . 'panel/usuarios-sistema'
        ])) ? 'menu-open' :
                ''; ?>">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Panel de control
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <?php if ($_SESSION['permisos']['proveedor']->canRead()) { ?>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>demo-proveedores" class="nav-link
                    <?php echo $seccion === $_ENV['host.folder'] . 'demo-proveedores' ? 'active' : ''; ?>">
                            <i class="fas fa-laptop-code nav-icon"></i>
                            <p>Demo Proveedores</p>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="<?php echo $_ENV['host.folder'] ?>panel/temas" class="nav-link
                <?php echo $seccion === $_ENV['host.folder'] . 'panel/temas' ? 'active' : ''; ?>">
                        <i class="fas fa-paint-brush nav-icon"></i>
                        <p>Temas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $_ENV['host.folder'] ?>panel/usuario" class="nav-link
                    <?php echo $seccion === $_ENV['host.folder'] . 'panel/usuario' ? 'active' : ''; ?>">
                        <i class="fas fa-user nav-icon"></i>
                        <p>Cuenta</p>
                    </a>
                </li>
                <?php if ($_SESSION['permisos']['usuario_sistema']->canRead()) { ?>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>panel/usuarios-sistema" class="nav-link
                    <?php echo $seccion === $_ENV['host.folder'] . 'panel/usuario-sistema' ? 'active' : ''; ?>">
                            <i class="fas fa-user nav-icon"></i>
                            <p>Usuarios del Sistema</p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </li>
        <?php if ($_SESSION['permisos']['trabajadores']->canRead()) { ?>
            <li class="nav-item <?php echo (in_array($seccion, [
                    $_ENV['host.folder'] . 'trabajadores-all',
                    $_ENV['host.folder'] . 'trabajadores',
                    $_ENV['host.folder'] . 'trabajadores-salario',
                    $_ENV['host.folder'] . 'trabajadores-standard',
                    $_ENV['host.folder'] . 'trabajadores-carlos',
                    $_ENV['host.folder'] . 'trabajadores-all-assoc',
                    $_ENV['host.folder'] . 'trabajadores-salario-assoc',
                    $_ENV['host.folder'] . 'trabajadores-standard-assoc',
                    $_ENV['host.folder'] . 'trabajadores-carlos-assoc'
            ])) ? 'menu-open' :
                                ''; ?>">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>
                        Trabajadores
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>trabajadores" class="nav-link
                        <?php echo
                        substr_compare(
                            $seccion,
                            $_ENV['host.folder'] . 'trabajadores',
                            0,
                            strlen($_ENV['host.folder'] . 'trabajadores')
                        ) === 0 ? 'active' : ''; ?>">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Filtrar Usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>trabajadores-all" class="nav-link
                        <?php echo $seccion === $_ENV['host.folder'] . 'trabajadores-all' ? 'active' :
                                ''; ?>">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Todos los trabajadores</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>trabajadores-salario" class="nav-link
                        <?php echo $seccion === $_ENV['host.folder'] . 'trabajadores-salario' ?
                                'active' : ''; ?>">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Todos los trabajadores ordenados por salario</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>trabajadores-standard" class="nav-link
                        <?php echo $seccion === $_ENV['host.folder'] . 'trabajadores-standard' ?
                                'active' : ''; ?>">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Trabajadores standard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>trabajadores-carlos" class="nav-link
                        <?php echo $seccion === $_ENV['host.folder'] . 'trabajadores-carlos' ?
                                'active' : ''; ?>">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Trabajadores con nombre Carlos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>trabajadores-all-assoc" class="nav-link
                        <?php echo $seccion === $_ENV['host.folder'] . 'trabajadores-all-assoc' ?
                                'active' : ''; ?>">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Todos los trabajadores(ASSOC)</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>trabajadores-salario-assoc" class="nav-link
                        <?php echo $seccion === $_ENV['host.folder'] . 'trabajadores-salario-assoc' ?
                                'active' : ''; ?>">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Todos los trabajadores ordenados por salario(ASSOC)</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>trabajadores-standard-assoc" class="nav-link
                        <?php echo $seccion === $_ENV['host.folder'] . 'trabajadores-standard-assoc' ?
                                'active' : ''; ?>">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Trabajadores standard(ASSOC)</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>trabajadores-carlos-assoc" class="nav-link
                        <?php echo $seccion === $_ENV['host.folder'] . 'trabajadores-carlos-assoc' ?
                                'active' : ''; ?>">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Trabajadores con nombre Carlos(ASSOC)</p>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <?php if ($_SESSION['permisos']['csv']->canRead()) { ?>
            <li class="nav-item <?php echo (in_array($seccion, [
                    $_ENV['host.folder'] . 'poblacion-pontevedra',
                    $_ENV['host.folder'] . 'poblacion-grupos-edad'
            ])) ? 'menu-open' :
                                ''; ?>">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-file-archive"></i>
                    <p>
                        CSV
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>poblacion-pontevedra" class="nav-link
                        <?php echo $seccion === $_ENV['host.folder'] . 'poblacion-pontevedra' ?
                                'active' : ''; ?>">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Histórico población Pontevedra</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>poblacion-grupos-edad" class="nav-link
                        <?php echo $seccion === $_ENV['host.folder'] . 'poblacion-grupos-edad' ?
                                'active' : ''; ?>">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Población España grupos edad</p>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <?php if ($_SESSION['permisos']['producto']->canRead()) { ?>
            <li class="nav-item <?php echo (in_array($seccion, [$_ENV['host.folder'] . 'productos'])) ? 'menu-open' :
                    ''; ?>">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-archive"></i>
                    <p>
                        Productos
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>productos" class="nav-link
                        <?php echo $seccion === $_ENV['host.folder'] . 'productos' ?
                                'active' : ''; ?>">
                            <i class="nav-icon fas fa-barcode"></i>
                            <p>Productos</p>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <?php if ($_SESSION['permisos']['proveedor']->canRead()) { ?>
            <li class="nav-item <?php echo (in_array($seccion, [$_ENV['host.folder'] . 'proveedores'])) ? 'menu-open' :
                    ''; ?>">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>
                        Proveedores
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>proveedores" class="nav-link
                        <?php echo $seccion === $_ENV['host.folder'] . 'proveedores' ?
                                'active' : ''; ?>">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>Proveedores</p>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <?php if ($_SESSION['permisos']['categoria']->canRead()) { ?>
            <li class="nav-item <?php echo (in_array($seccion, [$_ENV['host.folder'] . 'categorias'])) ?
                    'menu-open' : ''; ?>">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Categorías
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>categorias" class="nav-link
                        <?php echo $seccion === $_ENV['host.folder'] . 'categorias' ?
                                'active' : ''; ?>">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Categorías</p>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
    </ul>
</nav>
<!-- /.sidebar-menu -->