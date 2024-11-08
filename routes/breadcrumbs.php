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
Breadcrumbs::for('order.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Orders', route('order.index'));
});

// Breadcrumbs::for('booking.create', function (BreadcrumbTrail $trail) {
//     $trail->parent('dashboard');
//     $trail->push('Booking');
//     $trail->push('Create', route('booking.create'));
// });

// Breadcrumbs::for('booking.edit', function (BreadcrumbTrail $trail) {
//     $trail->parent('dashboard');
//     $trail->push('Booking');
//     $trail->push('Edit');
// });

// Breadcrumbs::for('booking.trash', function (BreadcrumbTrail $trail) {
//     $trail->parent('dashboard');
//     $trail->push('Booking');
//     $trail->push('Trashed');
// });

// Breadcrumbs::for('booking.show', function (BreadcrumbTrail $trail) {
//     $trail->parent('dashboard');
//     $trail->push('Booking');
//     $trail->push('Preview');
// });

// Gallery Breadcrumbs
Breadcrumbs::for('inventory.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Inventory', route('inventory.index'));
});

// Chat Breadcrumbs
Breadcrumbs::for('chat.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Chat', route('chat.index'));
});

// Profile Breadcrumbs
Breadcrumbs::for('profile.index', function (BreadcrumbTrail $trail) {
    $trail->push('Profile');
});

Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->push('Profile');
    $trail->push('Edit Profile');
});

Breadcrumbs::for('event.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard');
    $trail->push('Event', route('event.index'));
});

Breadcrumbs::for('event.create', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard');
    $trail->push('Event');
    $trail->push('Create', route('event.create'));
});

Breadcrumbs::for('event.edit', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard');
    $trail->push('Event');
    $trail->push('Edit');
});

Breadcrumbs::for('schedule.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard');
    $trail->push('Pages');
    $trail->push('Schedule');
});

Breadcrumbs::for('product.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Inventory');
    $trail->push('Product');
});

Breadcrumbs::for('product.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Inventory');
    $trail->push('Product');
    $trail->push('Create');
});

Breadcrumbs::for('product.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Inventory');
    $trail->push('Product');
    $trail->push('Edit');
});
