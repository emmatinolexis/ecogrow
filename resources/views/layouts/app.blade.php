<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('styles')
</head>

<body style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh;">
    @auth
        @if(auth()->user()->user_type === 'admin')
            <nav class="navbar navbar-expand-lg navbar-dark shadow mb-4" style="background: #259242;">
                <div class="container">
                    <a class="navbar-brand fw-bold"
                        href="{{ route('admin.dashboard') }}">{{ config('app.name', 'Laravel') }}</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar"
                        aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="adminNavbar">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle @if(request()->routeIs('products.index') || request()->routeIs('categories.index') || request()->routeIs('brands.index')) active @endif"
                                    href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <span class="material-icons" style="vertical-align:middle;">inventory_2</span> Products
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                                    <li><a class="dropdown-item @if(request()->routeIs('products.index')) active @endif"
                                            href="{{ route('products.index') }}"><span class="material-icons"
                                                style="vertical-align:middle;">inventory_2</span> All Products</a></li>
                                    <li><a class="dropdown-item @if(request()->routeIs('categories.index')) active @endif"
                                            href="{{ route('categories.index') }}"><span class="material-icons"
                                                style="vertical-align:middle;">category</span> Categories</a></li>
                                    <li><a class="dropdown-item @if(request()->routeIs('brands.index')) active @endif"
                                            href="{{ route('brands.index') }}"><span class="material-icons"
                                                style="vertical-align:middle;">branding_watermark</span> Brands</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('discounts.index')) active @endif"
                                    href="{{ route('discounts.index') }}">
                                    <span class="material-icons" style="vertical-align:middle;">local_offer</span> Discounts
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('admin.orders.index')) active @endif"
                                    href="{{ route('admin.orders.index') }}">
                                    <span class="material-icons" style="vertical-align:middle;">shopping_cart</span> Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('admin.customers.index')) active @endif"
                                    href="{{ route('admin.customers.index') }}">
                                    <span class="material-icons" style="vertical-align:middle;">people</span> Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('admin.blogs.index')) active @endif"
                                    href="{{ route('admin.blogs.index') }}">
                                    <span class="material-icons" style="vertical-align:middle;">article</span> Blogs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('admin.customer_reviews.index')) active @endif"
                                    href="{{ route('admin.customer_reviews.index') }}">
                                    <span class="material-icons" style="vertical-align:middle;">rate_review</span> Customer
                                    Reviews
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle @if(request()->routeIs('admin.profile.edit') || request()->routeIs('users.index')) active @endif"
                                    href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <span class="material-icons" style="vertical-align:middle;">settings</span> Settings
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                                    <li><a class="dropdown-item @if(request()->routeIs('admin.profile.edit')) active @endif"
                                            href="{{ route('admin.profile.edit') }}"><span class="material-icons"
                                                style="vertical-align:middle;">person</span> My Profile</a></li>
                                    <li><a class="dropdown-item @if(request()->routeIs('users.index')) active @endif"
                                            href="{{ route('users.index') }}"><span class="material-icons"
                                                style="vertical-align:middle;">manage_accounts</span> User Management</a></li>
                                    <li><a class="dropdown-item @if(request()->routeIs('admin.team_members.index')) active @endif"
                                            href="{{ route('admin.team_members.index') }}"><span class="material-icons"
                                                style="vertical-align:middle;">groups</span> Team Members</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link nav-link text-white"
                                        style="display:inline;cursor:pointer;">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        @endif
    @endauth
    <main class="py-4"
        style="background: rgba(255,255,255,0.85); min-height: 80vh; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); margin: 0 auto; max-width: 1200px;">
        @yield('content')
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.material.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <style>
        .table thead,
        .table th {
            background: #eaf8d7 !important;
            color: #000 !important;
        }

        .card-header {
            background: #eaf8d7 !important;
            color: #000 !important;
        }

        .btn-create,
        .btn-create:focus,
        .btn-create:active {
            background-color: #259242 !important;
            border-color: #259242 !important;
            color: #fff !important;
        }

        .btn-edit,
        .btn-edit:focus,
        .btn-edit:active,
        .btn-update,
        .btn-update:focus,
        .btn-update:active {
            background-color: #eaf8d7 !important;
            border-color: #eaf8d7 !important;
            color: #259242 !important;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var editorElement = document.querySelector('#productDescription');
            if (editorElement) {
                ClassicEditor
                    .create(editorElement)
                    .catch(error => {
                        console.error('CKEditor initialization error:', error);
                    });
            }
        });
    </script>

    @yield('scripts')

</body>

</html>