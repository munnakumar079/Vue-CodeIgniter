<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use CodeIgniter\RESTful\ResourceController;

class EmployeeController extends ResourceController
{
    protected $format = 'json';

    // GET /employees
    public function index()
    {
        $employeeModel = new EmployeeModel();

        return $this->respond([
            'status' => true,
            'data'   => $employeeModel->findAll()
        ]);
    }

    // GET /employees/1
    public function show($id = null)
    {
        $employeeModel = new EmployeeModel();

        $employee = $employeeModel->find($id);

        if (!$employee) {
            return $this->failNotFound('Employee not found');
        }

        return $this->respond([
            'status' => true,
            'data'   => $employee
        ]);
    }

    // POST /employees
    public function create()
    {
        $employeeModel = new EmployeeModel();

        $data = [
            'name'       => $this->request->getVar('name'),
            'email'      => $this->request->getVar('email'),
            'department' => $this->request->getVar('department'),
            'status'     => $this->request->getVar('status'),
        ];

        $employeeModel->insert($data);

        return $this->respondCreated([
            'status'  => true,
            'message' => 'Employee created successfully'
        ]);
    }

    // PUT /employees/1
    public function update($id = null)
    {
        $employeeModel = new EmployeeModel();

        $employee = $employeeModel->find($id);

        if (!$employee) {
            return $this->failNotFound('Employee not found');
        }

        $data = $this->request->getJSON(true);

        $employeeModel->update($id, [
            'name'       => $data['name'] ?? $employee['name'],
            'email'      => $data['email'] ?? $employee['email'],
            'department' => $data['department'] ?? $employee['department'],
            'status'     => $data['status'] ?? $employee['status'],
        ]);

        return $this->respond([
            'status'  => true,
            'message' => 'Employee updated successfully'
        ]);
    }

    // DELETE /employees/1
    public function delete($id = null)
    {
        $employeeModel = new EmployeeModel();

        $employee = $employeeModel->find($id);

        if (!$employee) {
            return $this->failNotFound('Employee not found');
        }

        $employeeModel->delete($id);

        return $this->respond([
            'status'  => true,
            'message' => 'Employee deleted successfully'
        ]);
    }
}