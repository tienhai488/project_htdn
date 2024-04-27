<?php

namespace App\Acl;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class Acl
{
    const ROLE_ADMIN = 'admin';
    const ROLE_HR = 'hr';
    const ROLE_WAREHOUSE = 'warehouse';
    const ROLE_BUSINESS = 'business';
    const ROLE_STAFF = 'staff';

    const PERMISSION_USER_MANAGE_HR = 'manage user';
    const PERMISSION_USER_LIST_HR   = 'user list';
    const PERMISSION_USER_ADD_HR    = 'user add';
    const PERMISSION_USER_EDIT_HR   = 'user edit';
    const PERMISSION_USER_DELETE_HR = 'user delete';

    const PERMISSION_POSITION_MANAGE_HR    = 'manage position';
    const PERMISSION_POSITION_LIST_HR      = 'position list';
    const PERMISSION_POSITION_ADD_HR       = 'position add';
    const PERMISSION_POSITION_EDIT_HR      = 'position edit';
    const PERMISSION_POSITION_DELETE_HR    = 'position delete';

    const PERMISSION_DEPARTMENT_MANAGE_HR    = 'manage department';
    const PERMISSION_DEPARTMENT_LIST_HR      = 'department list';
    const PERMISSION_DEPARTMENT_ADD_HR       = 'department add';
    const PERMISSION_DEPARTMENT_EDIT_HR      = 'department edit';
    const PERMISSION_DEPARTMENT_DELETE_HR    = 'department delete';

    const PERMISSION_ROLE_MANAGE_HR = 'manage role';
    const PERMISSION_ROLE_LIST_HR   = 'role list';
    const PERMISSION_ROLE_ADD_HR    = 'role add';
    const PERMISSION_ROLE_EDIT_HR   = 'role edit';
    const PERMISSION_ROLE_DELETE_HR = 'role delete';

    const PERMISSION_SALARY_MANAGE_HR = 'manage salary';
    const PERMISSION_SALARY_LIST_HR   = 'salary list';
    const PERMISSION_SALARY_ADD_HR    = 'salary add';
    const PERMISSION_SALARY_EDIT_HR   = 'salary edit';
    const PERMISSION_SALARY_DELETE_HR = 'salary delete';

    const PERMISSION_RECRUITMENT_MANAGE_HR = 'manage recruitment';
    const PERMISSION_RECRUITMENT_LIST_HR   = 'recruitment list';
    const PERMISSION_RECRUITMENT_ADD_HR    = 'recruitment add';
    const PERMISSION_RECRUITMENT_EDIT_HR   = 'recruitment edit';
    const PERMISSION_RECRUITMENT_DELETE_HR = 'recruitment delete';

    const PERMISSION_PRODUCT_CATEGORY_MANAGE_WAREHOUSE = 'manage product category';
    const PERMISSION_PRODUCT_CATEGORY_LIST_WAREHOUSE   = 'product category list';
    const PERMISSION_PRODUCT_CATEGORY_ADD_WAREHOUSE    = 'product category add';
    const PERMISSION_PRODUCT_CATEGORY_EDIT_WAREHOUSE   = 'product category edit';
    const PERMISSION_PRODUCT_CATEGORY_DELETE_WAREHOUSE = 'product category delete';

    const PERMISSION_PRODUCT_MANAGE_WAREHOUSE = 'manage product';
    const PERMISSION_PRODUCT_LIST_WAREHOUSE   = 'product list';
    const PERMISSION_PRODUCT_ADD_WAREHOUSE    = 'product add';
    const PERMISSION_PRODUCT_EDIT_WAREHOUSE   = 'product edit';
    const PERMISSION_PRODUCT_DELETE_WAREHOUSE = 'product delete';

    const PERMISSION_SUPPLIER_MANAGE_WAREHOUSE = 'manage supplier';
    const PERMISSION_SUPPLIER_LIST_WAREHOUSE   = 'supplier list';
    const PERMISSION_SUPPLIER_ADD_WAREHOUSE    = 'supplier add';
    const PERMISSION_SUPPLIER_EDIT_WAREHOUSE   = 'supplier edit';
    const PERMISSION_SUPPLIER_DELETE_WAREHOUSE = 'supplier delete';

    const PERMISSION_PURCHASE_ORDER_MANAGE_WAREHOUSE = 'manage purchase order';
    const PERMISSION_PURCHASE_ORDER_LIST_WAREHOUSE   = 'purchase order list';
    const PERMISSION_PURCHASE_ORDER_ADD_WAREHOUSE    = 'purchase order add';
    const PERMISSION_PURCHASE_ORDER_EDIT_WAREHOUSE   = 'purchase order edit';
    const PERMISSION_PURCHASE_ORDER_DELETE_WAREHOUSE = 'purchase order delete';

    const PERMISSION_CUSTOMER_MANAGE_BUSINESS = 'manage customer';
    const PERMISSION_CUSTOMER_LIST_BUSINESS   = 'customer list';
    const PERMISSION_CUSTOMER_ADD_BUSINESS    = 'customer add';
    const PERMISSION_CUSTOMER_EDIT_BUSINESS   = 'customer edit';
    const PERMISSION_CUSTOMER_DELETE_BUSINESS   = 'customer delete';

    const PERMISSION_SHIPPING_UNIT_MANAGE_BUSINESS = 'manage shipping unit';
    const PERMISSION_SHIPPING_UNIT_LIST_BUSINESS   = 'shipping unit list';
    const PERMISSION_SHIPPING_UNIT_ADD_BUSINESS    = 'shipping unit add';
    const PERMISSION_SHIPPING_UNIT_EDIT_BUSINESS   = 'shipping unit edit';
    const PERMISSION_SHIPPING_UNIT_DELETE_BUSINESS   = 'shipping unit delete';

    const PERMISSION_ORDER_MANAGE_BUSINESS = 'manage order';
    const PERMISSION_ORDER_LIST_BUSINESS   = 'order list';
    const PERMISSION_ORDER_ADD_BUSINESS    = 'order add';
    const PERMISSION_ORDER_EDIT_BUSINESS   = 'order edit';
    const PERMISSION_ORDER_DELETE_BUSINESS   = 'order delete';

    /**
     * @param  array  $exclusives Exclude some permissions from the list
     */
    public static function permissions(array $exclusives = []): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function ($value, $key) use ($exclusives) {
                return !in_array($value, $exclusives) && Str::startsWith($key, 'PERMISSION_');
            });

            return array_values($permissions);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    public static function rolePermissions(array $exclusives = [], string $role): array
    {

        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();

            $permissions = Arr::where($constants, function ($value, $key) use ($exclusives, $role) {
                return !in_array($value, $exclusives) && Str::startsWith($key, 'PERMISSION_') && Str::endsWith($key, '_' . Str::upper($role));
            });

            return array_values($permissions);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    public static function menuPermissions(): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function ($value, $key) {
                return Str::startsWith($key, 'PERMISSION_VIEW_MENU_');
            });

            return array_values($permissions);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    public static function roles(): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $roles = Arr::where($constants, function ($value, $key) {
                return Str::startsWith($key, 'ROLE_');
            });

            return array_values($roles);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }
}