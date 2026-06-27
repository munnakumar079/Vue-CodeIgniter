import axios from "axios";

const API_URL = "http://localhost:8080/api";

export const getEmployees = () => {
  return axios.get(`${API_URL}/employees`);
};

export const createEmployee = (data) => {
  return axios.post(`${API_URL}/employees`, data);
};

export const updateEmployee = (id, data) => {
  return axios.put(`${API_URL}/employees/${id}`, data);
};

export const deleteEmployeeApi = (id) => {
  return axios.delete(`${API_URL}/employees/${id}`);
};