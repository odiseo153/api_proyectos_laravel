<?php

namespace App\Abilities;

use App\Models\User;

class Abilities
{
    // Habilidades para Admin
    public const ManageProjects = "projects:manage"; // Crear, editar, eliminar proyectos
    public const ManageTasks = "tasks:manage";       // Crear, editar, eliminar tareas
    public const ManageUsers = "users:manage";       // Crear, editar, eliminar usuarios
    public const AuditAccess = "audit:access";       // Acceder auditorías
    public const ManageIntegrations = "integrations:manage"; // Generar/revocar tokens

    // Habilidades para Líder
    public const CreateProject = "projects:create";
    public const DeleteProject = "projects:delete";
    public const EditOwnProject = "projects:own.edit";
    public const ArchiveOwnProject = "projects:own.archive";
    public const ManageTasksInOwnProject = "tasks:own.manage";
    public const AssignMembers = "projects:members.assign";
    public const ViewReports = "projects:reports.view";

    // Habilidades para Miembro
    public const ViewAssignedProjects = "projects:assigned.view";
    public const ManageOwnTasks = "tasks:own.manage"; // Cambiar estado/comentar tareas propias
    public const ReceiveNotifications = "notifications:receive";

    public static function getAbilities(User $user)
    {
        switch ($user->role) {
            case "admin":
                return [
                    self::ManageProjects,
                    self::ManageTasks,
                    self::ManageUsers,
                    self::AuditAccess,
                    self::ManageIntegrations
                ];

            case "lider":
                return [
                    self::CreateProject,
                    self::DeleteProject,
                    self::EditOwnProject,
                    self::ArchiveOwnProject,
                    self::ManageTasksInOwnProject,
                    self::AssignMembers,
                    self::ViewReports
                ];

            case "miembro":
                return [
                    self::ViewAssignedProjects,
                    self::ManageOwnTasks,
                    self::ReceiveNotifications
                ];

            default:
                return [];
        }
    }
}
