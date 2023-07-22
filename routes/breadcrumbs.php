<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
// Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
//     $trail->push('Dashboard', route('admin.dashboard'));
// });

// // Home > Complaint
// Breadcrumbs::for('complaint', function (BreadcrumbTrail $trail) {
//     $trail->parent('dashboard');
//     $trail->push('Complaint', route('admin.complaint.index'));
// });

// // Home > Complaint > Detail
// Breadcrumbs::for('detail', function (BreadcrumbTrail $trail) {
//     $trail->parent('dashboard ');
//     $trail->push(sroute('admin.complaint.detail'));
// });
