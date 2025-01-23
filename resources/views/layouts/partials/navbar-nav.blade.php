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
<x-nav-item route="dashboard" icon="fas fa-fw fa-tachometer-alt" label="Dashboard" />

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
    <a class="collapse-item" href="{{ route('dashboard.catalogos.index') }}">
        <i class="fas fa-truck-loading mr-2"></i>Catálogos
    </a>

</x-nav-item-collapsive>

<!-- Divider -->
<x-sidebar-divider />

<!-- Heading  PARA COMPRAS -->
<x-sidebar-heading label="Administrar Compras" />

<x-nav-item-collapsive name="collapseThree" icon="fas fa-shopping-cart" label="Compras">

    <a class="collapse-item" href="{{ route('dashboard.proveedores.index') }}">
        <i class="fas fa-ruler-vertical mr-2"></i>Proveedores
    </a>

    <a class="collapse-item" href="{{ route('dashboard.compras.index') }}">
        <i class="fas fa-sitemap mr-2"></i>Compras
    </a>

</x-nav-item-collapsive>

<!-- Divider -->
<x-sidebar-divider />