<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title><?= esc($title) ?> — Store Manager</title>
    <style>
        body { background-color: #f5f6fa; }
        .navbar-brand { font-weight: 700; letter-spacing: .4px; }
        .stat-card { border: none; border-radius: 12px; transition: transform .15s; }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px;
                     display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
        .stock-badge { font-size: .72rem; font-weight: 600; padding: .25em .55em; }
        .table th { white-space: nowrap; font-size: .83rem; text-transform: uppercase;
                    letter-spacing: .04em; color: #6c757d; }
        .table td { vertical-align: middle; font-size: .9rem; }
        .sort-link { color: inherit; text-decoration: none; }
        .sort-link:hover { color: #0d6efd; }
        .sort-icon { font-size: .7rem; opacity: .5; }
        .sort-icon.active { opacity: 1; color: #0d6efd; }
        .empty-state { padding: 5rem 0; color: #adb5bd; }
        .empty-state .bi { font-size: 3.5rem; display: block; }
        .card { border: none; border-radius: 12px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        code { font-size: .82rem; color: #6c757d; background: #f0f0f0;
               padding: .1em .4em; border-radius: 4px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('/') ?>">
            <i class="bi bi-box-seam me-2"></i>Store Manager
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/') ?>">
                        <i class="bi bi-speedometer2 me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/products') ?>">
                        <i class="bi bi-grid me-1"></i>Products
                    </a>
                </li>
            </ul>
            <div class="d-flex gap-2">
                <a href="<?= site_url('/products/export') ?>" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-download me-1"></i>Export CSV
                </a>
                <a href="<?= site_url('/administracion/nuevo') ?>" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i>Add Product
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container pb-5">

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i><?= esc(session()->getFlashdata('success')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif ?>
