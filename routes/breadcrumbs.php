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

Breadcrumbs::for('booking.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Booking');
    $trail->push('Create', route('booking.create'));
});

Breadcrumbs::for('booking.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Booking');
    $trail->push('Edit');
});

Breadcrumbs::for('booking.trash', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Booking');
    $trail->push('Trashed');
});

Breadcrumbs::for('booking.show', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Booking');
    $trail->push('Preview');
});

// Gallery Breadcrumbs
Breadcrumbs::for('gallery.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Gallery', route('gallery.index'));
});

Breadcrumbs::for('gallery.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Gallery');
    $trail->push('Create', route('gallery.create'));
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
    $trail->push('Profile');
    $trail->push('Edit Profile', route('profile.index'));
});

Breadcrumbs::for('event.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard');
    $trail->push('Event', route('event.index'));
});
