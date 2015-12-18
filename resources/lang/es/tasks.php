<?php

return [
	'titles' => [
        "index" => "Tasks",
        "new" => "New Task",
        "edit" => "Edit Task",
        "delete" => "Delete Task"
    ],
	'fields' => [
        "name" => "Name",
        "active" => "Active"
    ],
	'buttons' => [
        "register" => "Register",
        "update" => "Update",
        "cancel" => "Cancel",
        "yes" => "Yes",
        "no" => "No"
    ],
	'notifications' => [
        "register_successful" => "The task has been successfully registered.",
        "update_successful" => "The task has been successfully updated.",
        "activated_successful" => "The task has been successfully activated.",
        "deactivated_successful" => "The task has been successfully deactivated.",
        "delete_successful" => "The task has been successfully deleted.",
        "already_register" => "The task had been registered previously.",
        "no_exists" => "The task does not exist.",
        "delete_confirmation" => "Are you sure, that you will delete selected task?",
        "field_name_missing" => "The field name is required.",
        "field_active_missing" => "The field active is required."
    ],
	'validations' => [
        "required" => "This field is required.",
        "email" => "This field is an invalid email.",
        "digits" => "This field only accepts digits.",
        "number" => "This field only accepts numeric values.",
        "minlength" => "the minimum length of the field is {0}.",
        "maxlength" => "the maximum length of the field is {0}."
    ]
];
