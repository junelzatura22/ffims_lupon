<?php

use App\Models\Program;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('administrator.dashboard', function (BreadcrumbTrail $trail): void {
    $trail->push('Dashboard', route('administrator.dashboard'));
});
Breadcrumbs::for('management.program', function (BreadcrumbTrail $trail): void {
    $trail->push('Program', route('management.program'));
});
Breadcrumbs::for('management.createprogram', function (BreadcrumbTrail $trail): void {
    $trail->parent('management.program');
    $trail->push('Create Program', route('management.createprogram'));
});
Breadcrumbs::for('management.getdtoupdate', function (BreadcrumbTrail $trail, $program): void {
    $trail->parent('management.program');
    $trail->push($program->program_name, route('management.getdtoupdate', $program->program_id));
});

// for the farmer and fisherfolk breadcrumbs 

Breadcrumbs::for('f2.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('administrator.dashboard');
    $trail->push('F2 List', route('f2.index'));
});
Breadcrumbs::for('f2.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('f2.index');
    $trail->push('Create', route('f2.create'));
});
Breadcrumbs::for('f2.information', function (BreadcrumbTrail $trail, $f2_data): void {
    $trail->parent('f2.index');
    $trail->push("Information", route('f2.information', $f2_data->ff_id));
});
Breadcrumbs::for('f2.details', function (BreadcrumbTrail $trail, $f2_data): void {
    $trail->parent('f2.index');
    $trail->push("Details", route('f2.details', $f2_data->ff_id));
});
Breadcrumbs::for('f2.livelihood', function (BreadcrumbTrail $trail, $f2_data): void {
    $trail->parent('f2.index');
    $trail->push("Livelihood", route('f2.livelihood', $f2_data->ff_id));
});
Breadcrumbs::for('f2.farm', function (BreadcrumbTrail $trail, $f2_data): void {
    $trail->parent('f2.index');
    $trail->push("Farm Details", route('f2.farm', $f2_data->ff_id));
});
Breadcrumbs::for('farmdetails', function (BreadcrumbTrail $trail, $f2_data): void {
    $trail->parent('f2.index');
    $trail->push("Farm Details", route('f2.farm', $f2_data->ff_id));
    $trail->push("Register Farm", route('f2.registerfarmdetails', $f2_data->ff_id));
});
Breadcrumbs::for('updateFarmDetails', function (BreadcrumbTrail $trail, $f2_data): void {
    $trail->parent('f2.index');
    $trail->push("Farm Details", route('f2.farm', $f2_data->ff_id));
    $trail->push("Update Farm", route('f2.getfarmdetails', $f2_data->ff_id));
});

Breadcrumbs::for('farmactivity', function (BreadcrumbTrail $trail, $f2_data): void {
    $trail->parent('f2.index');
    $trail->push("Farm Activity", route('f2.activity', $f2_data->ff_id));
   
});
Breadcrumbs::for('createActivity', function (BreadcrumbTrail $trail, $f2_data): void {
    $trail->parent('f2.index');
    $trail->push($f2_data->fname."'s Farm Activity", route('f2.activity', $f2_data->ff_id));
    $trail->push("Create Activity");
});
Breadcrumbs::for('updateActivity', function (BreadcrumbTrail $trail, $f2_data): void {
    $trail->parent('f2.index');
    $trail->push($f2_data->fname."'s Farm Activity", route('f2.activity', $f2_data->ff_id));
    $trail->push("Update Activity");
});


// Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, User $user): void {
//     $trail->parent('users.index');
 
//     $trail->push($user->name, route('users.show', $user));
// });
 
// Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, User $user): void {
//     $trail->parent('users.show');
 
//     $trail->push('Edit', route('users.edit', $user));
// });