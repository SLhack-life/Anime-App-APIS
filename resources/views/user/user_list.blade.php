@extends('include.master')
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">


    <!-- <h4 class="py-3 breadcrumb-wrapper mb-2">Roles List</h4>

    <p>A role provided access to predefined menus and features so that depending on <br> assigned
        role an administrator can have access to what user needs.</p> -->
    <!-- Role cards -->
    <div class="row g-4">
        <!-- <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-normal">Total 4 users</h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/5.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Allen Rieske" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/12.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Julee Rossignol" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/6.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/15.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="John Doe" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/1.png" alt="Avatar">
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">Administrator</h4>
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                class="role-edit-modal"><small>Edit
                                    Role</small></a>
                        </div>
                        <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-normal">Total 7 users</h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/4.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="John Doe" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/1.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Kristi Lawker" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/2.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/15.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Danny Paul" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/7.png" alt="Avatar">
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">Manager</h4>
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                class="role-edit-modal"><small>Edit
                                    Role</small></a>
                        </div>
                        <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-normal">Total 5 users</h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Andrew Tye" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/6.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Rishi Swaat" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/9.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Rossie Kim" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/12.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Kim Merchent" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/10.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Sam D'souza" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/13.png" alt="Avatar">
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">Users</h4>
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                class="role-edit-modal"><small>Edit
                                    Role</small></a>
                        </div>
                        <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-normal">Total 3 users</h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Kim Karlos" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/3.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Katy Turner" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/9.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Peter Adward" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/15.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/10.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="John Parker" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/11.png" alt="Avatar">
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">Support</h4>
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                class="role-edit-modal"><small>Edit
                                    Role</small></a>
                        </div>
                        <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-normal">Total 2 users</h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Kim Merchent" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/10.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Sam D'souza" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/13.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Nurvi Karlos" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/15.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Andrew Tye" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/8.png" alt="Avatar">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                title="Rossie Kim" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="assets/img/avatars/9.png" alt="Avatar">
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">Restricted User</h4>
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                class="role-edit-modal"><small>Edit
                                    Role</small></a>
                        </div>
                        <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100">
                <div class="row h-100">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                            <img src="assets/img/illustrations/lady-with-laptop-light.png" class="img-fluid" alt="Image"
                                width="100" data-app-light-img="illustrations/lady-with-laptop-light.png"
                                data-app-dark-img="illustrations/lady-with-laptop-dark.png">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                class="btn btn-primary mb-3 text-nowrap add-new-role">Add New
                                Role</button>
                            <p class="mb-0">Add role, if it does not exist</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="col-12">
            <!-- Role Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                 <th>Profile Image</th>
                                <th class="text-center">Email</th>
                               

                                
                                <th class="text-center">Name</th>
                                <th class="text-center">points</th>

                                <!-- <th>Phone Number</th> -->
                               
                                <th class="text-center">Actions</th>
                            </tr>
                          
                        </thead>
                    </table>
                </div>
            </div>
            <!--/ Role Table -->
        </div>
    </div>
    <!--/ Role cards -->

    <!-- Add Role Modal -->
    <!-- Add Role Modal -->
    
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
            <div class="modal-content p-3 p-md-5">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h3 class="role-title">Add New Role</h3>
                        <p>Set role permissions</p>
                    </div>
                    <!-- Add role form -->
                    <form id="addRoleForm" class="row g-3" onsubmit="return false">
                        <div class="col-12 mb-4">
                            <label class="form-label" for="modalRoleName">Role Name</label>
                            <input type="text" id="modalRoleName" name="modalRoleName" class="form-control"
                                placeholder="Enter a role name" tabindex="-1">
                        </div>
                        <div class="col-12">
                            <h5>Role Permissions</h5>
                            <!-- Permission table -->
                            <div class="table-responsive">
                                <table class="table table-flush-spacing">
                                    <tbody>
                                        <tr>
                                            <td class="text-nowrap">Administrator Access <i
                                                    class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Allows a full access to the system"></i>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                                    <label class="form-check-label" for="selectAll">
                                                        Select All
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">User Management</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="userManagementRead">
                                                        <label class="form-check-label" for="userManagementRead">
                                                            Read
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="userManagementWrite">
                                                        <label class="form-check-label" for="userManagementWrite">
                                                            Write
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="userManagementCreate">
                                                        <label class="form-check-label" for="userManagementCreate">
                                                            Create
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">Content Management</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="contentManagementRead">
                                                        <label class="form-check-label" for="contentManagementRead">
                                                            Read
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="contentManagementWrite">
                                                        <label class="form-check-label" for="contentManagementWrite">
                                                            Write
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="contentManagementCreate">
                                                        <label class="form-check-label" for="contentManagementCreate">
                                                            Create
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">Disputes Management</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="dispManagementRead">
                                                        <label class="form-check-label" for="dispManagementRead">
                                                            Read
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="dispManagementWrite">
                                                        <label class="form-check-label" for="dispManagementWrite">
                                                            Write
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="dispManagementCreate">
                                                        <label class="form-check-label" for="dispManagementCreate">
                                                            Create
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">Database Management</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="dbManagementRead">
                                                        <label class="form-check-label" for="dbManagementRead">
                                                            Read
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="dbManagementWrite">
                                                        <label class="form-check-label" for="dbManagementWrite">
                                                            Write
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="dbManagementCreate">
                                                        <label class="form-check-label" for="dbManagementCreate">
                                                            Create
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">Financial Management</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="finManagementRead">
                                                        <label class="form-check-label" for="finManagementRead">
                                                            Read
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="finManagementWrite">
                                                        <label class="form-check-label" for="finManagementWrite">
                                                            Write
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="finManagementCreate">
                                                        <label class="form-check-label" for="finManagementCreate">
                                                            Create
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">Reporting</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="reportingRead">
                                                        <label class="form-check-label" for="reportingRead">
                                                            Read
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="reportingWrite">
                                                        <label class="form-check-label" for="reportingWrite">
                                                            Write
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="reportingCreate">
                                                        <label class="form-check-label" for="reportingCreate">
                                                            Create
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">API Control</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="apiRead">
                                                        <label class="form-check-label" for="apiRead">
                                                            Read
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="apiWrite">
                                                        <label class="form-check-label" for="apiWrite">
                                                            Write
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="apiCreate">
                                                        <label class="form-check-label" for="apiCreate">
                                                            Create
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">Repository Management</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="repoRead">
                                                        <label class="form-check-label" for="repoRead">
                                                            Read
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="repoWrite">
                                                        <label class="form-check-label" for="repoWrite">
                                                            Write
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="repoCreate">
                                                        <label class="form-check-label" for="repoCreate">
                                                            Create
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">Payroll</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="payrollRead">
                                                        <label class="form-check-label" for="payrollRead">
                                                            Read
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="payrollWrite">
                                                        <label class="form-check-label" for="payrollWrite">
                                                            Write
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="payrollCreate">
                                                        <label class="form-check-label" for="payrollCreate">
                                                            Create
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Permission table -->
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </form>
                    <!--/ Add role form -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true" aria-labelledby="editUserLabel" >
       <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                    <h3>Edit Product Information</h3>
                
                    </div>
                    <form id="codeForm" class="row g-3">
                        <!-- @csrf -->
                        <input type="hidden" name="user_id" id="user_id" value="">
                        <div class="col-12">
                            <label class="form-label" for="modalEditProductName">User Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="">
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label" for="modalEditProductImage">User Image</label>
                            <input type="file" id="image" name="image" class="form-control" placeholder="">
                        </div>
                    
                    
                    
                    <!-- <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserCountry">Country</label>
                        <select id="modalEditUserCountry" name="modalEditUserCountry" class="select2 form-select" data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="Australia">Australia</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Canada">Canada</option>
                        <option value="China">China</option>
                        <option value="France">France</option>
                        <option value="Germany">Germany</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Japan">Japan</option>
                        <option value="Korea">Korea, Republic of</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Russia">Russian Federation</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        </select>
                    </div> -->
            
                        <div class="col-12 text-center mt-4">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" id="submit">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="close">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_points" tabindex="-1" aria-hidden="true" aria-labelledby="editUserLabel" >
       <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                    <h3>Edit Points</h3>
                
                    </div>
                    <form id="codeForm" class="row g-3">
                        <!-- @csrf -->
                        <input type="hidden" name="user_id" id="user_point_id" value="">
                        <div class="col-12">
                            <label class="form-label" for="modalEditProductName">Edit_Points</label>
                            <input type="text" id="user_point" name="name" class="form-control" placeholder="">
                            <span class="error"></span>
                        </div> 
                    </div>
            
                        <div class="col-12 text-center mt-4">
                            <button type="button" class="btn btn-primary me-sm-3 me-1 points_action" data-id=1>Add Points</button>
                            <button type="reset" class="btn btn-label-secondary points_action" data-id=2 >Remove Points</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Add Role Modal -->

    <!-- / Add Role Modal -->

</div>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">


$(document).ready(function() {

    $.noConflict();
    var table = $('#table').DataTable({
        
        processing: true,
        serverSide: true,
        ajax: "{{ route('user_list') }}",

        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: "image", name: "Profile Image","searchable": false,"orderable":false,},   
            {data: 'email', name: 'email'},
            {data: 'user_name', name: 'Name'},
            {data: 'points', name: 'points'},
            {data: 'action', name: 'action', orderable: false,
        }
        
        ]
    });
$('.points_action').click(function(){
    var id=  $('#user_point_id').val();
    var status=$(this).data("id");
    
    var user_points=$('#user_point').val();
    $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: "{{url('change_points_value')}}",
                  data: {
                      'id': id,
                      'user_points':user_points,
                      'status':status,
                      "_token": "{{ csrf_token() }}",
                  },
                  success: function(data) {
                    if(data.statuscode==200){

                    
                        setTimeout(function() {
                            window.location.reload()
                        }, 2000);;
                        showToastr('success', 'Success!', "Points edit successfully")
                            .fadeout(1000);
                    
                        // $('#edit_points').css({'display':'none','opacity':0});
                        // window.location.reload();
                    }
                    if(data.statuscode==400){
                      
                        $('.error').text(data.msg).css({'color':'red'});
                    }

                

                  }
              });

})
$('.btn-close').click(function(){
   
                        $('#edit_points').css({'display':'none','opacity':0});

})
  
    
  });

  function changeStatus(id) {
              
            
              //   var user_id = $(this).attr('data-id');
                console.log(status);
              $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: "{{url('change_status')}}",
                  data: {
                      'id': id,
                      "_token": "{{ csrf_token() }}",
                  },
                  success: function(data) {
                    
                

                  }
              });
   }

   function changePoints(id) {
    $.noConflict();
    var id=id;
    $('#user_point_id').val(id);
    $('#edit_points').css({'display':'block','opacity':1});
     
              
            
              //   var user_id = $(this).attr('data-id');
                // console.log(status);
              $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: "{{url('change_points')}}",
                  data: {
                      'id': id,
                      "_token": "{{ csrf_token() }}",
                  },
                  success: function(data) {
                     $('#user_point').val(data.data.points)
                    
                    
                // if (data == 1) {
                //     $('.user-active').text('Active');
                // } else {
                //     $('.user-active').text('Inactive');
                // }
                        // console.log(data.msg);
                      //   $('.user-active').text(data.msg);
                      //  $('.guard_active').text(data.guard);
                      // //  console.log(data.success)
                        console.log(data)

                  }
              });
   }
   function showToastr(type, title, message) {
    let body;
    toastr.options = {
      "closeButton": false,
               "debug": false,
               "newestOnTop": false,
               "progressBar": true,
               "positionClass": "toast-top-right",
               "preventDuplicates": true,
               "onclick": null,
               "showDuration": "3000",
               "hideDuration": "2000",
               "timeOut": "2000",
               "extendedTimeOut": "1000",
               "showEasing": "swing",
               "hideEasing": "linear",
               "showMethod": "fadeIn",
               "hideMethod": "fadeOut"
    };
    switch(type){
        case "info": body = "<span> <i class='fa fa-spinner fa-pulse'></i></span>";
            break;
        default: body = '';
    }
    const content = message + body;
    toastr[type](content, title)
}
</script>

<!-- / Content -->
@endsection
