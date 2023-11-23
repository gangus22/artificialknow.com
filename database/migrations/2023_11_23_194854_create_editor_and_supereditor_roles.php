<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration {
    public function up(): void
    {
        DB::transaction(function () {
            $editorRole = Role::create(['name' => 'editor']);
            $superEditorRole = Role::create(['name' => 'supereditor']);
            $createRedirectsPermission = Permission::create(['name' => 'create redirects']);

            $superEditorRole->givePermissionTo($createRedirectsPermission);
            $superEditorRole->save();
        });
    }
};
