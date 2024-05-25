<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Roles Breadcrumbs
Breadcrumbs::for('roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Roles & Permissions');
    $trail->push('Roles', route('roles.index'));
});

Breadcrumbs::for('roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('roles.index');
    $trail->push('Create Role', route('roles.create'));
});

Breadcrumbs::for('roles.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('roles.index');
    $trail->push('Edit Role', route('roles.edit', ['id' => $id]));
});

Breadcrumbs::for('permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Roles & Permissions');
    $trail->push('Permissions', route('permissions.index'));
});

// Stakeholder Breadcrumbs
Breadcrumbs::for('stakeholders.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User Management');
    $trail->push('Stakeholders', route('stakeholders.index'));
});

// Paper Type
Breadcrumbs::for('paper-type.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Paper Type', route('paper-type.index'));
});

// Paper Quality
Breadcrumbs::for('paper-quality.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Paper Quality', route('paper-quality.index'));
});

// Location
Breadcrumbs::for('location.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Location', route('location.index'));
});

// Location
Breadcrumbs::for('route.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Route', route('route.index'));
});

// Design Breadcrumbs
Breadcrumbs::for('design.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Design', route('design.index'));
});

// Orders Breadcrumbs
Breadcrumbs::for('orders.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Orders', route('orders.index'));
});

Breadcrumbs::for('orders.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Orders');
    $trail->push('Create Order', route('orders.create'));
});

Breadcrumbs::for('orders.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Orders');
    $trail->push('Edit Order');
});

Breadcrumbs::for('orders.trash', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Orders');
    $trail->push('Trashed Order');
});

Breadcrumbs::for('orders.show', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Orders');
    $trail->push('Preview');
});

// Printing Press Breadcrumbs
Breadcrumbs::for('printing-press.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Printing Press', route('printing-press.index'));
});

// Distributor Breadcrumbs
Breadcrumbs::for('distributor.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Distributions', route('distributor.index'));
});

// Vehicle Media Breadcrumbs
Breadcrumbs::for('vehicle-media.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Vehicle Media', route('vehicle-media.index'));
});

// Reports Breadcrumbs
Breadcrumbs::for('reports.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Reports', route('reports.index'));
});

// Chat Breadcrumbs
Breadcrumbs::for('chat.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Chat', route('chat.index'));
});

// Profile Breadcrumbs
Breadcrumbs::for('profile.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Profile', route('profile.index'));
});
