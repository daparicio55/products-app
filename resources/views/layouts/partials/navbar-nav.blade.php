<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
    {{-- ICONO DE LA APLICACION --}}
    <div class="sidebar-brand-icon rotate-n-15">
        @yield('brand-icon')
    </div>
    {{-- MARCA DE LA APLICACION --}}
    <div class="sidebar-brand-text mx-1">{{ config('app.name') }}</div>
</a>
<!-- Divider -->
<x-sidebar-divider class="my-0" />
<!-- Nav Item - Dashboard -->

@role('Administrador')
    <x-nav-item route="dashboard" icon="fas fa-fw fa-tachometer-alt" label="Dashboard" />
@endrole

@role('SystemAdministrador')
    <x-nav-item route="administrador.dashboard.index" icon="fas fa-fw fa-tachometer-alt" label="Dashboard" />
@endrole

@hasrole('SystemAdministrador')
    <!-- Divider -->
    <x-sidebar-divider />
    <x-nav-item route="administrador.empresas.index" icon="far fa-building" label="Empresas" />

    <!-- Divider -->
    <x-sidebar-divider />
    <x-nav-item route="administrador.locales.index" icon="fas fa-store-alt" label="Locales" />

    <!-- Divider -->
    <x-sidebar-divider />
    <x-nav-item route="administrador.users.index" icon="fas fa-users" label="Usuarios" />
@endhasrole




<!-- Divider -->
<x-sidebar-divider />

<!-- Heading PARA CATALOGOS -->
<x-sidebar-heading label="Administrar Catálogos" />

<!-- Nav Item - Pages Collapse Menu -->
<x-nav-item-collapsive name="collapseTwo" icon="fas fa-list" label="Catálogos">

    <a class="collapse-item" href="{{ route('dashboard.medidas.index') }}">
        <i class="fas fa-ruler-vertical mr-2"></i>Medidas
    </a>
    <a class="collapse-item" href="{{ route('dashboard.categorias.index') }}">
        <i class="fas fa-sitemap mr-2"></i>Categorias
    </a>
    <a class="collapse-item" href="{{ route('dashboard.marcas.index') }}">
        <i class="fas fa-copyright mr-2"></i>Marcas
    </a>
    @role('Administrador')
        <a class="collapse-item" href="{{ route('dashboard.catalogos.index') }}">
            <i class="fas fa-truck-loading mr-2"></i>Catálogos
        </a>
    @endrole

</x-nav-item-collapsive>



<!-- Divider -->
<x-sidebar-divider />

<!-- Heading  PARA COMPRAS -->
<x-sidebar-heading label="Administrar Compras" />

<x-nav-item-collapsive name="collapseThree" icon="fas fa-shopping-cart" label="Compras">

    <a class="collapse-item" href="{{ route('dashboard.proveedores.index') }}">
        <i class="fas fa-ruler-vertical mr-2"></i>Proveedores
    </a>
    @hasrole('Administrador')
        <a class="collapse-item" href="{{ route('dashboard.compras.index') }}">
            <i class="fas fa-sitemap mr-2"></i>Compras
        </a>
    @endhasrole

</x-nav-item-collapsive>

<!-- Divider -->
<x-sidebar-divider />

<!-- Heading PARA VENTAS -->
<x-sidebar-heading label="Administrar Ventas" />

<x-nav-item-collapsive name="collapseFour" icon="fas fa-shopping-cart" label="Ventas">

    <a class="collapse-item" href="{{ route('dashboard.metodospagos.index') }}">
        <i class="fab fa-paypal mr-2"></i>Métodos de Pagos
    </a>

    <a class="collapse-item" href="{{ route('dashboard.tiposcomprobantes.index') }}">
        <i class="fas fa-paste mr-2"></i>T. Comprobantes
    </a>

    <a class="collapse-item" href="{{ route('dashboard.clientes.index') }}">
        <i class="fas fa-users mr-2"></i>Clientes
    </a>
    @hasrole('Administrador')
        <a class="collapse-item" href="{{ route('dashboard.ventas.index') }}">
            <i class="fas fa-shopping-cart mr-2"></i>Ventas
        </a>
    @endhasrole
</x-nav-item-collapsive>

<!-- Divider -->
<x-sidebar-divider />
{{-- Heading para Reportes --}}
<x-sidebar-heading label="Administrar Reportes" />

<x-nav-item label="Reportes de Ventas" icon="fas fa-list" route="dashboard.reportes.ventas.index" />

<x-nav-item label="Reportes de Compras" icon="fas fa-list-ul" route="dashboard.reportes.compras.index" />
