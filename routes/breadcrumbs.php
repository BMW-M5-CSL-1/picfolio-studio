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

// Orders Breadcrumbs
Breadcrumbs::for('booking.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Bookings', route('booking.index'));
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

// Chat Breadcrumbs
Breadcrumbs::for('chat.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Chat', route('chat.index'));
});

// Profile Breadcrumbs
Breadcrumbs::for('profile.index', function (BreadcrumbTrail $trail) {
    $trail->push('Profile', route('profile.index'));
});

Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->push('Edit Profile', route('profile.index'));
});
